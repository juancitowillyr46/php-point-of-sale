import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Subscription } from 'rxjs';
import { CommonAuditStatusUseCase } from '../../../../../app/domain/commons/usecase/common-audit-status.usecase';
import { CommonUbigeoDepartmentsUseCase } from '../../../../../app/domain/commons/usecase/common-ubigeo-departments.usecase';
import { CommonUbigeoProvincesUseCase } from '../../../../../app/domain/commons/usecase/common-ubigeo-provinces.usecase';
import { CommonUbigeoDistrictsUseCase } from '../../../../../app/domain/commons/usecase/common-ubigeo-districts.usecase';

import { GridSimpleService } from '../../grid-simple/grid-simple.service';
import { BaseModalComponent } from '../base-modal.component';
import { ModalDataRemoveObservable } from '../modal-data-remove.observable';
import { ModalDataObservable } from '../modal-data.observable';

import { ProviderGetUseCase } from '../../../../domain/providers/usecase/provider-get.usecase';
import { ProviderAddUseCase } from '../../../../domain/providers/usecase/provider-add.usercase';
import { ProviderEditUseCase } from '../../../../domain/providers/usecase/provider-edit.usecase';
import { ProviderRemoveUseCase } from '../../../../domain/providers/usecase/provider-remove.usecase';
import { ProviderStoreDto } from '../../../../../app/domain/providers/model/provider-store.dto';
import { CommonDto } from 'src/app/domain/commons/model/common.dto';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';


@Component({
  selector: 'app-modal-providers',
  templateUrl: './modal-providers.component.html',
  styleUrls: ['./modal-providers.component.css']
})
export class ModalProvidersComponent extends BaseModalComponent implements OnInit {

  public modalDataSub: Subscription;
  public dataModal: any;
  public submit: any = null;
  public commonUbigeoDepartments: CommonDto[] = [];
  public commonUbigeoProvinces: CommonDto[] = [];
  public commonUbigeoDistricts: CommonDto[] = [];

  constructor(
    private gridSimpleService: GridSimpleService,
    private modalDataObservable: ModalDataObservable,
    private modalDataRemoveObservable: ModalDataRemoveObservable,
    private providerGetUseCase: ProviderGetUseCase,
    private providerAddUseCase: ProviderAddUseCase,
    private providerEditUseCase: ProviderEditUseCase,
    private providerRemoveUserCase: ProviderRemoveUseCase,
    private commonUbigeoDepartmentsUseCase: CommonUbigeoDepartmentsUseCase,
    private commonUbigeoProvincesUseCase: CommonUbigeoProvincesUseCase,
    private commonUbigeoDistrictsUseCase: CommonUbigeoDistrictsUseCase,
    public commonAuditStatusUseCase: CommonAuditStatusUseCase,
    public formBuilder: FormBuilder,
    public modalService: NgbModal
  ) { 
    super(formBuilder, commonAuditStatusUseCase, modalService);
    const that = this;
  }

  ngOnInit(): void {
    const that = this;
    that.buildingFormProvider();
    that.loadCommonProvider();
    

    that.modalDataSub = that.modalDataObservable.currentData.subscribe(res => {
      that.dataModal = null;
      that.submit = false;
      that.resetFormProvider();
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.loadData = true;
        that.providerGetUseCase.execute(that.dataModal.id).subscribe( res => {
          that.submit = false;
          //that.editValues(res);
          that.onChangeDepartament(res.departmentId);
          that.onChangeProvince(res.provinceId);
        });
      } else {
        that.newValues();
      }
    });

    that.modalDataRemoveObservable.currentData.subscribe( res => {
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.providerRemoveUserCase.execute(that.dataModal.id).subscribe( response => {
          that.modalDataRemoveObservable.changeData(null);
          that.gridSimpleService.reload();
        });
      }
    });

  }

  loadCommonProvider(): void {
    const that = this;
    that.formGroup.controls.departmentId.disable();
    that.commonUbigeoDepartmentsUseCase.execute().subscribe(res => {
      that.commonUbigeoDepartments = res;
      that.formGroup.controls.departmentId.enable();
    });
  }

  buildingFormProvider(): void {
    const that = this;
    that.formGroup = that.buildingForm({
      name: ['', [Validators.required]],
      ruc: ['', [Validators.required]],
      departmentId: [null, [Validators.required]],
      provinceId: [null, [Validators.required]],
      districtId: [null, [Validators.required]],
      address: ['', [Validators.required]],
      description: ['', [Validators.required]],
      homePhoneNumber: ['', [Validators.required]],
      cellPhoneNumber: ['', [Validators.required]],
      active: [true, [Validators.required]]
    });
  }

  resetFormProvider() {
    const that = this;
    that.resetForm({
      name: '',
      ruc: '',
      departmentId: '',
      provinceId: '',
      districtId: '',
      address: '',
      description: '',
      homePhoneNumber: '',
      cellPhoneNumber: '',
      active: true
    });
  }

  onClickClose() {
    const that = this;
    
    that.gridSimpleService.closeModal();
  }

  onClickDone() {
    const that = this;
    
    let object: ProviderStoreDto = that.formGroup.value;
    
    object.active = (that.formGroup.controls.active.value == 'true' || that.formGroup.controls.active.value == true)? true : false;

    if(that.dataModal !== null){
      object.id = that.dataModal.id;
      that.providerEditUseCase.execute(object).subscribe( res => {
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      }, (error) => {
        alert(error);
        that.submit = false;
      });
    } else {
      that.providerAddUseCase.execute(object).subscribe( res => {
        console.log(res);
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      });
    }
    
    that.submit = true;
  }

  onChangeDepartament(value: any): void {
    const that = this;
    that.loadData = true;
    that.formGroup.controls.provinceId.disable();
    that.commonUbigeoProvincesUseCase.execute({
      departmentId: value
    }).subscribe( res => {
      that.commonUbigeoProvinces = res;
      that.loadData = false;
      that.formGroup.controls.provinceId.enable();
    });
  }

  onChangeProvince(value: any): void {
    const that = this;
    that.loadData = true;
    that.formGroup.controls.districtId.disable();
    that.commonUbigeoDistrictsUseCase.execute({
      departmentId: that.formGroup.controls.departmentId.value,
      provinceId: value
    }).subscribe( res => {
      that.commonUbigeoDistricts = res;
      that.loadData = false;
      that.formGroup.controls.districtId.enable();
    });
  }

  onChangeDistrict(event: any): void {
    console.log(event);
  }

}
