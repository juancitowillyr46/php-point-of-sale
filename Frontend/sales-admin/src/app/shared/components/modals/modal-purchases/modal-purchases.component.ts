import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { CommonDto } from 'src/app/domain/commons/model/common.dto';

import { CommonAuditStatusUseCase } from 'src/app/domain/commons/usecase/common-audit-status.usecase';
import { CommonTypeTaxDocumentUseCase } from 'src/app/domain/commons/usecase/common-type-tax-document.usecase';
import { CommonProvidersUseCase } from 'src/app/domain/commons/usecase/common-providers.usecase';
import { CommonStatusPurchaseUseCase } from 'src/app/domain/commons/usecase/common-status-purchase';

import { PurchaseGetUseCase } from '../../../../domain/purchases/usecase/purchase-get.usecase';
import { PurchaseAddUseCase } from '../../../../domain/purchases/usecase/purchase-add.usercase';
import { PurchaseEditUseCase } from '../../../../domain/purchases/usecase/purchase-edit.usecase';
import { PurchaseRemoveUseCase } from '../../../../domain/purchases/usecase/purchase-remove.usecase';
import { ProviderGetProductsUseCase } from '../../../../domain/providers/usecase/provider-get-products.usecase';

import { BaseModalComponent } from '../base-modal.component';
import { GridSimpleService } from '../../grid-simple/grid-simple.service';
import { ModalDataObservable } from '../modal-data.observable';
import { ModalDataRemoveObservable } from '../modal-data-remove.observable';
import { Subscription } from 'rxjs';
import { PurchaseStoreDto } from 'src/app/domain/Purchases/model/purchase-store.dto';

declare var $: any;

export class Purchase {

  detail: Product[] = [];
  public get total(): number {
    const that = this;
    let sumTotal: number = 0;
    that.detail.forEach(product => {
      sumTotal = sumTotal + product.subTotal;
    })
    return sumTotal;
  }
}

export class Product {

  productId: string;
  productName: string;
  quantity: number;
  price: number;

  public get subTotal(): number {
    const that = this;
    return that.quantity * that.price;
  }

  constructor() {
    const that = this;
  }

}

@Component({
  selector: 'app-modal-purchases',
  templateUrl: './modal-purchases.component.html',
  styleUrls: ['./modal-purchases.component.css']
})
export class ModalPurchasesComponent extends BaseModalComponent implements OnInit {

  public modalDataSub: Subscription;
  public dataModal: any;
  public submit: any = null;
  public selectedProduct: any = null;
  
  public purchase: Purchase = new Purchase();
  public products: Product[] = [];

  public commonProviders: CommonDto[] = [];
  public commonTypeTaxDocument: CommonDto[] = [];
  public commonStatusPurchase: CommonDto[] = [];
  public providerGetProducts: CommonDto[] = [];
  
  constructor(
    private gridSimpleService: GridSimpleService,
    private modalDataObservable: ModalDataObservable,
    private modalDataRemoveObservable: ModalDataRemoveObservable,
    private purchaseGetUseCase: PurchaseGetUseCase,
    private purchaseAddUseCase: PurchaseAddUseCase,
    private purchaseEditUseCase: PurchaseEditUseCase,
    private purchaseRemoveUserCase: PurchaseRemoveUseCase,
    private providerGetProductsUseCase: ProviderGetProductsUseCase, 
    public commonAuditStatusUseCase: CommonAuditStatusUseCase,
    public commonProvidersUseCase: CommonProvidersUseCase,
    public commonTypeTaxDocumentUseCase: CommonTypeTaxDocumentUseCase,
    public commonStatusPurchaseUseCase: CommonStatusPurchaseUseCase,
    
    public formBuilder: FormBuilder
  ) { 
    super(formBuilder, commonAuditStatusUseCase);
  }

  ngOnInit(): void {
    const that = this;
    that.loadCommonPurchases();
    that.buildingFormPurchases();

    that.modalDataSub = that.modalDataObservable.currentData.subscribe(res => {
      that.dataModal = null;
      that.submit = false;
      that.resetFormPurchase();
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.purchaseGetUseCase.execute(that.dataModal.id).subscribe( res => {
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
        that.purchaseRemoveUserCase.execute(that.dataModal.id).subscribe( response => {
          that.modalDataRemoveObservable.changeData(null);
          that.gridSimpleService.reload();
        });
      }
    });


    $('#date').datepicker().on('changeDate', function (ev) {
      $('#date').attr("value", $('#date').val());
      that.formGroup.controls.date.setValue($('#date').val());
      that.formGroup.controls.date.markAsTouched();
    });

  }

  loadCommonPurchases(): void {
    const that = this;
    that.loadData = true;

    that.commonProvidersUseCase.execute().subscribe( res => {
      that.commonProviders = res;
      that.loadData = false;
    });
    that.loadData = true;
    that.commonTypeTaxDocumentUseCase.execute().subscribe( res => {
      that.commonTypeTaxDocument = res;
      that.loadData = false;
    });
    that.loadData = true;
    that.commonStatusPurchaseUseCase.execute().subscribe( res => {
      that.commonStatusPurchase = res;
      that.loadData = false;
    });
  }

  buildingFormPurchases() {
    const that = this;
    that.formGroup = that.buildingForm({
      providerId: ['', [Validators.required]],
      documentTypeId: ['', [Validators.required]],
      documentNumber: ['', [Validators.required]], 
      date: ['', [Validators.required]],
      note: ['', [Validators.required]],
      active: [true, [Validators.required]],
    });
  }

  resetFormPurchase() {
    const that = this;
    that.resetForm({
      providerId: '',
      documentTypeId: '',
      documentNumber: '',
      date: '',
      note: '',
      active: true
    });
  }

  onClickClose() {
    const that = this;
    
    that.gridSimpleService.closeModal();
  }

  onClickDone() {
    const that = this;
    
    let object: PurchaseStoreDto = that.formGroup.value;
    object.total = 123;
    object.active = (that.formGroup.controls.active.value == 'true' || that.formGroup.controls.active.value == true)? true : false;

    if(that.dataModal !== null){
      object.id = that.dataModal.id;
      that.purchaseEditUseCase.execute(object).subscribe( res => {
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      }, (error) => {
        alert(error);
        that.submit = false;
      });
    } else {
      that.purchaseAddUseCase.execute(object).subscribe( res => {
        console.log(res);
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      });
    }
    
    that.submit = true;
  }

  onChangeProductByProvider(value: any) {
    const that = this;
    that.loadData = true;
    that.selectedProduct = null;
    that.providerGetProductsUseCase.execute({providerId: value}).subscribe( res => {
      that.providerGetProducts = res;
      that.loadData = false;
    });
  }


  onChangeProductId(value: any) {
    const that = this;
    let addProduct = new Product();
    addProduct.price = 0;
    addProduct.quantity = 0;
    addProduct.productId = '1233434';
    addProduct.productName = 'sadasd';
    that.purchase.detail.push(addProduct);
    that.selectedProduct = null;
  }

  onClickRemove(idx: number) {
    const that = this;
    console.log(idx);
    that.purchase.detail.splice(idx, 1);
    console.log(that.products);
  }


}
