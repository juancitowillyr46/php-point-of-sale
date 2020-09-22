import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ModalDataMasterComponent } from './modal-data-master/modal-data-master.component';
import { ModalUsersComponent } from './modal-users/modal-users.component';
import { ModalCategoriesComponent } from './modal-categories/modal-categories.component';
import { ModalProductsComponent } from './modal-products/modal-products.component';
import { ModalPurchasesComponent } from './modal-purchases/modal-purchases.component';

@NgModule({
  declarations: [ModalDataMasterComponent, ModalUsersComponent, ModalCategoriesComponent, ModalProductsComponent, ModalPurchasesComponent],
  imports: [
    CommonModule
  ],
  exports: [ModalDataMasterComponent, ModalUsersComponent, ModalCategoriesComponent, ModalProductsComponent, ModalPurchasesComponent]
})
export class ModalsModule { }
