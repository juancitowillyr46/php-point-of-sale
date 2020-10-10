import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Subscription } from 'rxjs';

import { ProductGetUseCase } from '../../../../domain/products/usecase/product-get.usecase';
import { ProductAddUseCase } from '../../../../domain/products/usecase/product-add.usercase';
import { ProductEditUseCase } from '../../../../domain/products/usecase/product-edit.usecase';
import { ProductRemoveUseCase } from '../../../../domain/products/usecase/product-remove.usecase';

import { CommonDto } from 'src/app/domain/commons/model/common.dto';
import { CommonAuditStatusUseCase } from '../../../../domain/commons/usecase/common-audit-status.usecase';
import { CommonCategoriesUseCase } from '../../../../domain/commons/usecase/common-categories.usecase';
import { CommonProvidersUseCase } from '../../../../domain/commons/usecase/common-providers.usecase';
import { CommonMeasureUnitUseCase } from '../../../../domain/commons/usecase/common-measure-unit.usecase';

import { GridSimpleService } from '../../grid-simple/grid-simple.service';
import { BaseModalComponent } from '../base-modal.component';
import { ProductStoreDto } from '../../../../domain/products/model/product-store.dto';
import { ModalDataObservable } from '../modal-data.observable';
import { ModalDataRemoveObservable } from '../modal-data-remove.observable';

@Component({
  selector: 'app-modal-products',
  templateUrl: './modal-products.component.html',
  styleUrls: ['./modal-products.component.css']
})
export class ModalProductsComponent extends BaseModalComponent implements OnInit {

  public modalDataSub: Subscription;
  public dataModal: any;
  public submit: any = null;
  
  public commonCategories: CommonDto[] = [];
  public commonProviders: CommonDto[] = [];
  public commonMeasureUnits: CommonDto[] = [];

  constructor(
    private gridSimpleService: GridSimpleService,
    private modalDataObservable: ModalDataObservable,
    private modalDataRemoveObservable: ModalDataRemoveObservable,
    public commonProvidersUseCase: CommonProvidersUseCase,
    public commonCategoriesUseCase: CommonCategoriesUseCase,
    public commonAuditStatusUseCase: CommonAuditStatusUseCase,
    public commonMeasureUnitUseCase: CommonMeasureUnitUseCase,
    private productGetUseCase: ProductGetUseCase,
    private productAddUseCase: ProductAddUseCase,
    private productEditUseCase: ProductEditUseCase,
    private productRemoveUserCase: ProductRemoveUseCase,
    public formBuilder: FormBuilder
  ) { 
    super(formBuilder, commonAuditStatusUseCase);
  }

  ngOnInit(): void {
    const that = this;
    that.loadCommonProduct();
    that.buildingFormProduct();

    that.modalDataSub = that.modalDataObservable.currentData.subscribe(res => {
      that.dataModal = null;
      that.submit = false;
      that.resetFormProduct();
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.productGetUseCase.execute(that.dataModal.id).subscribe( res => {
          that.submit = false;
          that.editValues(res);
        });
      } else {
        that.newValues();
      }
    });

    that.modalDataRemoveObservable.currentData.subscribe( res => {
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.productRemoveUserCase.execute(that.dataModal.id).subscribe( response => {
          that.modalDataRemoveObservable.changeData(null);
          that.gridSimpleService.reload();
        });
      }
    });

  }

  loadCommonProduct(): void {
    const that = this;
    that.commonCategoriesUseCase.execute().subscribe( res => {
      that.commonCategories = res;
    });
    that.commonProvidersUseCase.execute().subscribe( res => {
      that.commonProviders = res;
    });
    that.commonMeasureUnitUseCase.execute().subscribe( res => {
      that.commonMeasureUnits = res;
    })
  }

  buildingFormProduct(): void {
    const that = this;
    that.formGroup = that.buildingForm({
      name: ['', [Validators.required]],
      categoryId: ['', [Validators.required]],
      providerId:['', [Validators.required]], 
      measureUnitId: ['', [Validators.required]],
      description: ['', [Validators.required]],
      active: [true, [Validators.required]],
    });
  }

  resetFormProduct() {
    const that = this;
    that.resetForm({
      name: '',
      categoryId: '',
      providerId: '',
      measureUnitId: '',
      description: '',
      active: true
    });
  }

  onClickClose() {
    const that = this;
    
    that.gridSimpleService.closeModal();
  }

  onClickDone() {
    const that = this;
    
    let object: ProductStoreDto = that.formGroup.value;
    
    object.active = (that.formGroup.controls.active.value == 'true' || that.formGroup.controls.active.value == true)? true : false;

    if(that.dataModal !== null){
      object.id = that.dataModal.id;
      that.productEditUseCase.execute(object).subscribe( res => {
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      }, (error) => {
        alert(error);
        that.submit = false;
      });
    } else {
      that.productAddUseCase.execute(object).subscribe( res => {
        console.log(res);
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      }, (error) => {
        that.submit = false;
      });
    }
    
    that.submit = true;
  }
}
