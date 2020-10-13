import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Subscription } from 'rxjs';
import { CommonAuditStatusUseCase } from 'src/app/domain/commons/usecase/common-audit-status.usecase';
import { CommonUbigeoDepartmentsUseCase } from 'src/app/domain/commons/usecase/common-ubigeo-departments.usecase';
import { CommonUbigeoDistrictsUseCase } from 'src/app/domain/commons/usecase/common-ubigeo-districts.usecase';
import { CommonUbigeoProvincesUseCase } from 'src/app/domain/commons/usecase/common-ubigeo-provinces.usecase';
import { CommonDocumentTypesUseCase } from 'src/app/domain/commons/usecase/common-document-types.usecase';

import { GridSimpleService } from '../../grid-simple/grid-simple.service';
import { BaseModalComponent } from '../base-modal.component';
import { ModalDataRemoveObservable } from '../modal-data-remove.observable';
import { ModalDataObservable } from '../modal-data.observable';

import { CustomerGetUseCase } from '../../../../domain/customers/usecase/customer-get.usecase';
import { CustomerAddUseCase } from '../../../../domain/customers/usecase/customer-add.usercase';
import { CustomerEditUseCase } from '../../../../domain/customers/usecase/customer-edit.usecase';
import { CustomerRemoveUseCase } from '../../../../domain/customers/usecase/customer-remove.usecase';


import { CommonDto } from 'src/app/domain/commons/model/common.dto';
import { CustomerStoreDto } from 'src/app/domain/customers/model/customer-store.dto';

@Component({
  selector: 'app-modal-customers',
  templateUrl: './modal-customers.component.html',
  styleUrls: ['./modal-customers.component.css']
})
export class ModalCustomersComponent extends BaseModalComponent implements OnInit {

  public modalDataSub: Subscription;
  public dataModal: any;
  public submit: any = null;
  public commonUbigeoDepartments: CommonDto[] = [];
  public commonUbigeoProvinces: CommonDto[] = [];
  public commonUbigeoDistricts: CommonDto[] = [];
  public commonDocumentTypes: CommonDto[] = [];
  
  constructor(
    private gridSimpleService: GridSimpleService,
    private modalDataObservable: ModalDataObservable,
    private modalDataRemoveObservable: ModalDataRemoveObservable,

    private customerGetUseCase: CustomerGetUseCase,
    private customerAddUseCase: CustomerAddUseCase,
    private customerEditUseCase: CustomerEditUseCase,
    private customerRemoveUserCase: CustomerRemoveUseCase,

    private commonUbigeoDepartmentsUseCase: CommonUbigeoDepartmentsUseCase,
    private commonUbigeoProvincesUseCase: CommonUbigeoProvincesUseCase,
    private commonUbigeoDistrictsUseCase: CommonUbigeoDistrictsUseCase,
    public commonAuditStatusUseCase: CommonAuditStatusUseCase,
    public commonDocumentTypesUseCase: CommonDocumentTypesUseCase,
    public formBuilder: FormBuilder
  ) { 
    super(formBuilder, commonAuditStatusUseCase);
    const that = this;
  }

  ngOnInit(): void {
    const that = this;
    that.buildingFormCustomer();
    that.loadCommonCustomer();
    
    that.modalDataSub = that.modalDataObservable.currentData.subscribe(res => {
      that.dataModal = null;
      that.submit = false;
      that.resetFormCustomer();
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.loadData = true;
        that.customerGetUseCase.execute(that.dataModal.id).subscribe( res => {
          that.submit = false;
          that.editValues(res);
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
        that.customerRemoveUserCase.execute(that.dataModal.id).subscribe( response => {
          that.modalDataRemoveObservable.changeData(null);
          that.gridSimpleService.reload();
        });
      }
    });

  }

  loadCommonCustomer(): void {
    const that = this;
    that.formGroup.controls.departmentId.disable();
    that.commonUbigeoDepartmentsUseCase.execute().subscribe(res => {
      that.commonUbigeoDepartments = res;
      that.formGroup.controls.departmentId.enable();
    });
    that.commonDocumentTypesUseCase.execute().subscribe( res => {
      that.commonDocumentTypes = res;
    });
  }

  buildingFormCustomer(): void {
    const that = this;
    that.formGroup = that.buildingForm({
      firstName: ['', [Validators.required]],
      lastName: ['', [Validators.required]],
      documentNumber: [null, [Validators.required]],
      documentTypeId: [null, [Validators.required]],
      email: [null, [Validators.required]],
      businessName: ['', [Validators.required]],
      ruc: ['', [Validators.required]],
      homePhoneNumber: ['', [Validators.required]],
      cellPhoneNumber: ['', [Validators.required]],
      address: ['', [Validators.required]],
      departmentId: ['', [Validators.required]],
      provinceId: ['', [Validators.required]],
      districtId: ['', [Validators.required]],
      active: [true, [Validators.required]]
    });
  }

  resetFormCustomer() {
    const that = this;
    that.resetForm({
      firstName: '',
      lastName: '',
      documentNumber: '',
      documentTypeId: '',
      email: '',
      businessName: '',
      ruc: '',
      homePhoneNumber: '',
      cellPhoneNumber: '',
      address: '',
      departmentId: '',
      provinceId: '',
      districtId: '',
      active: true
    });
  }

  onClickClose() {
    const that = this;
    
    that.gridSimpleService.closeModal();
  }

  onClickDone() {
    const that = this;
    
    let object: CustomerStoreDto = that.formGroup.value;
    
    object.active = (that.formGroup.controls.active.value == 'true' || that.formGroup.controls.active.value == true)? true : false;

    if(that.dataModal !== null){
      object.id = that.dataModal.id;
      that.customerEditUseCase.execute(object).subscribe( res => {
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      }, (error) => {
        alert(error);
        that.submit = false;
      });
    } else {
      that.customerAddUseCase.execute(object).subscribe( res => {
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
