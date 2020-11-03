import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Subscription } from 'rxjs';

import { CommonAuditStatusUseCase } from '../../../../domain/commons/usecase/common-audit-status.usecase';
import { GridSimpleService } from '../../grid-simple/grid-simple.service';
import { BaseModalComponent } from '../base-modal.component';
import { ModalDataRemoveObservable } from '../modal-data-remove.observable';
import { ModalDataObservable } from '../modal-data.observable';

import { CategoryGetUseCase } from '../../../../domain/categories/usecase/category-get.usecase';
import { CategoryAddUseCase } from '../../../../domain/categories/usecase/category-add.usercase';
import { CategoryEditUseCase } from '../../../../domain/categories/usecase/category-edit.usecase';
import { CategoryRemoveUseCase } from '../../../../domain/categories/usecase/category-remove.usecase';
import { CategoryStoreDto } from 'src/app/domain/categories/model/category-store.dto';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-modal-categories',
  templateUrl: './modal-categories.component.html',
  styleUrls: ['./modal-categories.component.css']
})
export class ModalCategoriesComponent extends BaseModalComponent implements OnInit {

  public modalDataSub: Subscription;
  public dataModal: any;
  public submit: any = null;
  
  constructor(
    private gridSimpleService: GridSimpleService,
    private modalDataObservable: ModalDataObservable,
    private modalDataRemoveObservable: ModalDataRemoveObservable,
    private categoryGetUseCase: CategoryGetUseCase,
    private categoryAddUseCase: CategoryAddUseCase,
    private categoryEditUseCase: CategoryEditUseCase,
    private categoryRemoveUserCase: CategoryRemoveUseCase,
    public commonAuditStatusUseCase: CommonAuditStatusUseCase,
    public formBuilder: FormBuilder,
    public modalService: NgbModal
  ) { 
    super(formBuilder, commonAuditStatusUseCase, modalService);
    const that = this;
  }

  ngOnInit(): void {
    const that = this;
    that.buildingFormCategory();

    that.modalDataSub = that.modalDataObservable.currentData.subscribe(res => {
      that.dataModal = null;
      that.submit = false;
      that.resetFormCategory();
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.categoryGetUseCase.execute(that.dataModal.id).subscribe( res => {
          that.submit = false;
          //that.editValues(res);
        });
      } else {
        that.newValues();
      }
    });

    that.modalDataRemoveObservable.currentData.subscribe( res => {
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.categoryRemoveUserCase.execute(that.dataModal.id).subscribe( response => {
          that.modalDataRemoveObservable.changeData(null);
          that.gridSimpleService.reload();
        });
      }
    });

  }

  buildingFormCategory(): void {
    const that = this;
    that.formGroup = that.buildingForm({
      name: ['', [Validators.required]],
      description: ['', [Validators.required]],
      active: [true, [Validators.required]],
    });
  }

  resetFormCategory() {
    const that = this;
    that.resetForm({
      name: '',
      description: '',
      active: true,
    });
  }

  onClickClose() {
    const that = this;
    
    that.gridSimpleService.closeModal();
  }

  onClickDone() {
    const that = this;
    
    let object: CategoryStoreDto = that.formGroup.value;
    
    object.active = (that.formGroup.controls.active.value == 'true' || that.formGroup.controls.active.value == true)? true : false;

    if(that.dataModal !== null){
      object.id = that.dataModal.id;
      that.categoryEditUseCase.execute(object).subscribe( res => {
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      }, (error) => {
        alert(error);
        that.submit = false;
      });
    } else {
      that.categoryAddUseCase.execute(object).subscribe( res => {
        console.log(res);
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      });
    }
    
    that.submit = true;
  }

}
