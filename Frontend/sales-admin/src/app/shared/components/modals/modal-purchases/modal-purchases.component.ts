import { Component, Input, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { CommonDto } from '../../../../domain/commons/model/common.dto';

import { CommonAuditStatusUseCase } from '../../../../domain/commons/usecase/common-audit-status.usecase';
import { CommonTypeTaxDocumentUseCase } from '../../../../domain/commons/usecase/common-type-tax-document.usecase';
import { CommonProvidersUseCase } from '../../../../domain/commons/usecase/common-providers.usecase';
import { CommonStatusPurchaseUseCase } from '../../../../domain/commons/usecase/common-status-purchase';

import { PurchaseGetUseCase } from '../../../../domain/purchases/usecase/purchase-get.usecase';
import { PurchaseAddUseCase } from '../../../../domain/purchases/usecase/purchase-add.usercase';
import { PurchaseEditUseCase } from '../../../../domain/purchases/usecase/purchase-edit.usecase';
import { ProviderGetProductsUseCase } from '../../../../domain/providers/usecase/provider-get-products.usecase';

import { PurchaseDetailAddUseCase } from '../../../../domain/purchases/usecase/detail/purchase-detail-add.usercase';
import { PurchaseDetailAllUseCase } from '../../../../domain/purchases/usecase/detail/purchase-detail-all.usecase';
import { PurchaseDetailRemoveUseCase } from '../../../../domain/purchases/usecase/detail/purchase-detail-remove.usecase';
import { PurchaseDetailEditUseCase } from '../../../../domain/purchases/usecase/detail/purchase-detail-edit.usecase';

import { BaseModalComponent } from '../base-modal.component';
import { BehaviorSubject, Subscription } from 'rxjs';
import { PurchaseStoreDto } from '../../../../domain/Purchases/model/purchase-store.dto';
import { PurchaseDetailStoreDto } from '../../../../domain/purchases/model/purchase-detail-store.dto';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

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
  id: string;
  productId: string;
  productName: string;
  quantity: number;
  price: number;
  purchaseId: string;

  public get subTotal(): number {
    const that = this;
    return that.quantity * that.price;
  }

  constructor() {
    const that = this;
    that.id = '';
  }

}

@Component({
  selector: 'app-modal-purchases',
  templateUrl: './modal-purchases.component.html',
  styleUrls: ['./modal-purchases.component.css']
})
export class ModalPurchasesComponent extends BaseModalComponent implements OnInit {

  public modalDataSub: Subscription;

  public submit: any = null;
  public selectedProduct: any = null;
  
  public purchase: Purchase = new Purchase();
  public products: Product[] = [];

  public commonProviders: CommonDto[] = [];
  public commonTypeTaxDocument: CommonDto[] = [];
  public commonStatusPurchase: CommonDto[] = [];
  public providerGetProducts: CommonDto[] = [];

  public countReponse: BehaviorSubject<any> = new BehaviorSubject<any>(null);
  public currentData = this.countReponse.asObservable();

  @Input() public dataModal: any = null;
  
  constructor(
    private purchaseGetUseCase: PurchaseGetUseCase,
    private purchaseAddUseCase: PurchaseAddUseCase,
    private purchaseEditUseCase: PurchaseEditUseCase,
    
    private purchaseDetailAddUseCase: PurchaseDetailAddUseCase,
    private providerGetProductsUseCase: ProviderGetProductsUseCase,

    private purchaseDetailAllUseCase: PurchaseDetailAllUseCase,
    private purchaseDetailEditUseCase: PurchaseDetailEditUseCase,
    private purchaseDetailRemoveUserCase: PurchaseDetailRemoveUseCase,
    
    public commonAuditStatusUseCase: CommonAuditStatusUseCase,
    public commonProvidersUseCase: CommonProvidersUseCase,
    public commonTypeTaxDocumentUseCase: CommonTypeTaxDocumentUseCase,
    public commonStatusPurchaseUseCase: CommonStatusPurchaseUseCase,
    
    public formBuilder: FormBuilder,
    private modalService: NgbModal
  ) { 
    super(formBuilder, commonAuditStatusUseCase, modalService);
    const that = this;
    
  }

  ngOnInit(): void {
    const that = this;
    that.buildingFormPurchases();
    that.loadCommonPurchases();
    that.getRow();
  }

  // closeModal(reason: string) {
  //   const that = this;
  //   that.modalService.dismissAll(reason);
  // }

  getRow() {
    const that = this;
    if(that.dataModal.id != ''){
      that.loadData = true;
      that.formGroup.disable();
      that.purchaseGetUseCase.execute(that.dataModal.id).subscribe( res => {
        that.loadData = false;
        that.formGroup.patchValue(res);
        that.formGroup.enable();
        that.onChangeProductByProvider(that.formGroup.controls.providerId.value);
        that.getRowsOrders();
      }, (error) => {
        
      });
    }
  }

  loadCommonPurchases(): void {
    const that = this;
    that.loadData = true;
    that.commonProvidersUseCase.execute().subscribe( res => {
      that.commonProviders = res;
      that.loadData = false;
    });

    that.commonTypeTaxDocumentUseCase.execute().subscribe( res => {
      that.commonTypeTaxDocument = res;
      that.loadData = false;
    });

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
      note: [''],
      active: [true, [Validators.required]]
    });
    $('#date').datepicker().on('changeDate', function (ev) {
      $('#date').attr("value", $('#date').val());
      that.formGroup.controls.date.setValue($('#date').val());
      that.formGroup.controls.date.markAsTouched();
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
    that.closeModal('DONE');
  }

  onClickDone() {
    const that = this;
    
    that.submit = true;

    let object: PurchaseStoreDto = that.formGroup.value;
    object.total = that.purchase.total;
    object.active = (that.formGroup.controls.active.value == 'true' || that.formGroup.controls.active.value == true)? true : false;
    that.formGroup.disable();

    if(that.dataModal.id !== ''){
      object.id = that.dataModal.id;
      that.purchaseEditUseCase.execute(object).subscribe( res => {
        that.submit = true;
        that.formGroup.enable();
        that.storeOrders(res.id);
      });
    } else {
      that.purchaseAddUseCase.execute(object).subscribe( res => {
        that.submit = true;
        that.formGroup.enable();
        that.storeOrders(res.id);
      });
    }
    
  }

  onChangeProductByProvider(value: any) {
    const that = this;
    that.loadData = true;
    that.selectedProduct = null;
    that.providerGetProductsUseCase.execute({providerId: value}).subscribe( res => {
      that.providerGetProducts = res;
      that.loadData = false;
    }, (error) => {

    });
  }


  onChangeProductId(productId: string) {
    const that = this;

    const exist = that.validateDuplicateOfProduct(productId);

    if(exist) {
      alert('El producto ya agregó');
      this.selectedProduct = null;
      return false;    
    } else {
      
      const productName = that.providerGetProducts.find( f => f.value === productId).text;
      let addProduct = new Product();
      addProduct.id = '';
      addProduct.price = 0;
      addProduct.quantity = 0;
      addProduct.productId = productId;
      addProduct.productName = (productName != undefined)? productName : '';
      that.purchase.detail.push(addProduct);
      this.selectedProduct = null;
    }

  }

  // Detalle producto
  validateDuplicateOfProduct(productId: string): boolean {
    const that = this;
    return (that.purchase.detail.find(f => f.productId === productId) !== undefined)? true : false;    
  }

  onClickRemove(idx: number) {
    const that = this;
    if(that.purchase.detail[idx].id == ''){
      that.purchase.detail.splice(idx, 1);
    } else {  
      const confirm = window.confirm('¿Estás seguro que deseas eliminar?');
      if(confirm){
        console.log('Eliminar desde el servidor');
        that.purchaseDetailRemoveUserCase.execute({
          id: that.purchase.detail[idx].id,
          price: that.purchase.detail[idx].price,
          productId: that.purchase.detail[idx].productId,
          purchaseId: that.purchase.detail[idx].purchaseId,
          quantity: that.purchase.detail[idx].quantity,
          subtotal: that.purchase.detail[idx].subTotal,
          active: true
        }).subscribe(res => {
          console.log(res);
          that.getRowsOrders();
        });
      }
    }
  }

  storeOrders(purchaseId: string) {
    const that = this;

    that.submit = true;

    let countResponseSuccess: number = 0;

    that.purchase.detail.forEach(item => {

      const obj: PurchaseDetailStoreDto = {
        price: item.price,
        productId: item.productId,
        quantity: item.quantity,
        subtotal: item.subTotal,
        purchaseId: purchaseId, 
        active: true
      };

      if(item.id == ''){
        that.purchaseDetailAddUseCase.execute(obj).subscribe(res => {
          that.submit = false;
          countResponseSuccess += 1;
          that.countReponse.next(countResponseSuccess);
        });
      } else {
        obj.id = item.id;
        that.purchaseDetailEditUseCase.execute(obj).subscribe( res => {
          that.submit = false;
          countResponseSuccess += 1;
          that.countReponse.next(countResponseSuccess);
        });
      }
    });

    that.countReponse.subscribe( countResponseSuccess => {
      if(countResponseSuccess){
        that.submit = true;
        that.formGroup.enable();
        if(that.purchase.detail.length === countResponseSuccess) {
          that.submit = false;
          that.closeModal('DONE');
        }
      }
    });
   
  }

  getRowsOrders(): void {
    const that = this;
    that.loadData = true;
    that.purchase.detail = [];
    that.purchaseDetailAllUseCase.execute(that.dataModal.id).subscribe( res => {
      if(res.data.rows.length == 0){
        alert('No existen productos agregados a la compra');
      } else {
        res.data.rows.forEach(detail => {

          const purchaseItem = new Product();
          purchaseItem.id = detail.id;
          purchaseItem.purchaseId = detail.purchaseId;
          purchaseItem.productId = detail.productId;
          purchaseItem.productName = detail.productName;
          purchaseItem.quantity = detail.quantity;
          purchaseItem.price = detail.price;
          that.purchase.detail.push(purchaseItem);
          
        });
      }
      that.loadData = false;
    });
  }

  get validateOrder(): boolean {
    const that = this;
    let countError = 0;

    if(that.purchase.detail.length === 0) {
      countError = countError + 1;
    }

    that.purchase.detail.forEach(product => {
      if(product.price == 0 || product.quantity == 0){
        countError = countError + 1;
      }
    });
    
    return (countError > 0);
  }

}
