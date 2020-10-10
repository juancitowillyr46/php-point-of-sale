import { Component, Input, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Subscription } from 'rxjs';
import { CommonDto } from 'src/app/domain/commons/model/common.dto';
import { CommonAuditStatusUseCase } from '../../../../domain/commons/usecase/common-audit-status.usecase';
import { CommonDataMasterTypeUseCase } from '../../../../domain/commons/usecase/common-data-master-type.usecase';

import { DataMasterGetUseCase } from '../../../../domain/datamaster/usecase/data-master-get.usecase';
import { DataMasterAddUseCase } from '../../../../domain/datamaster/usecase/data-master-add.usercase';
import { DataMasterEditUseCase } from '../../../../domain/datamaster/usecase/data-master-edit.usecase';
import { DataMasterRemoveUseCase } from '../../../../domain/datamaster/usecase/data-master-remove.usecase';

import { GridSimpleService } from '../../grid-simple/grid-simple.service';
import { BaseModalComponent } from '../base-modal.component';
import { ModalDataRemoveObservable } from '../modal-data-remove.observable';
import { ModalDataObservable } from '../modal-data.observable';
import { DataMasterStoreDto } from '../../../../domain/datamaster/model/data-master-store.dto';

@Component({
  selector: 'app-modal-data-master',
  templateUrl: './modal-data-master.component.html',
  styleUrls: ['./modal-data-master.component.css']
})
export class ModalDataMasterComponent extends BaseModalComponent implements OnInit {

  public modalDataSub: Subscription;
  public dataModal: any;
  public submit: any = null;
  public definedTable: boolean;
  public commonDataMasterType: CommonDto[] = [];

  constructor(
    private gridSimpleService: GridSimpleService,
    private modalDataObservable: ModalDataObservable,
    private modalDataRemoveObservable: ModalDataRemoveObservable,

    private dataMasterGetUseCase: DataMasterGetUseCase,
    private dataMasterAddUseCase: DataMasterAddUseCase,
    private dataMasterEditUseCase: DataMasterEditUseCase,
    private dataMasterRemoveUserCase: DataMasterRemoveUseCase,

    public commonAuditStatusUseCase: CommonAuditStatusUseCase,
    private commonDataMasterTypeUseCase: CommonDataMasterTypeUseCase,
    public formBuilder: FormBuilder
  ) { 
    super(formBuilder, commonAuditStatusUseCase);
    const that = this;
  }

  ngOnInit(): void {
    const that = this;
    that.loadCommonDataMaster();
    that.buildingFormDataMaster();

    that.modalDataSub = that.modalDataObservable.currentData.subscribe(res => {
      that.dataModal = null;
      that.submit = false;
      that.resetFormDataMaster();
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.dataMasterGetUseCase.execute(that.dataModal.id).subscribe( res => {
          that.submit = false;

          that.editValues(res);
          that.formGroup.controls.type.disable();
        });
      } else {
        that.newValues();
      }
    });

    that.modalDataRemoveObservable.currentData.subscribe( res => {
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.dataMasterRemoveUserCase.execute(that.dataModal.id).subscribe( response => {
          that.modalDataRemoveObservable.changeData(null);
          that.gridSimpleService.reload();
        });
      }
    });

  }

  loadCommonDataMaster(): void {
    const that = this;
    that.commonDataMasterTypeUseCase.execute().subscribe(res => {
      that.commonDataMasterType = res;
    });
  }

  buildingFormDataMaster(): void {
    const that = this;
    that.formGroup = that.buildingForm({
      type: ['', [Validators.required]],
      name: ['', [Validators.required]],
      description: ['', [Validators.required]],
      active: [true, [Validators.required]],
    });
  }

  resetFormDataMaster() {
    const that = this;
    that.resetForm({
      type: '',
      name: '',
      description: '',
      active: true,
    });
  }

  onChangeDefinedTable(event: any) {
    // console.log(event.target.checked);
    const that = this;
    that.definedTable = event.target.checked;
    that.formGroup.controls.type.setValue("");
  }
  
  onClickClose() {
    const that = this;
    
    that.gridSimpleService.closeModal();
  }

  onClickDone() {
    const that = this;
    
    let object: DataMasterStoreDto = that.formGroup.value;
    
    object.active = (that.formGroup.controls.active.value == 'true' || that.formGroup.controls.active.value == true)? true : false;

    if(that.dataModal !== null){
      object.id = that.dataModal.id;
      that.dataMasterEditUseCase.execute(object).subscribe( res => {
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      }, (error) => {
        alert(error);
        that.submit = false;
      });
    } else {
      that.dataMasterAddUseCase.execute(object).subscribe( res => {
        console.log(res);
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      });
    }
    
    that.submit = true;
  }

}
