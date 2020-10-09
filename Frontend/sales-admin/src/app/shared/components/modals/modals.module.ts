import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ModalDataMasterComponent } from './modal-data-master/modal-data-master.component';
import { ModalUsersComponent } from './modal-users/modal-users.component';
import { ModalCategoriesComponent } from './modal-categories/modal-categories.component';
import { ModalProductsComponent } from './modal-products/modal-products.component';
import { ModalPurchasesComponent } from './modal-purchases/modal-purchases.component';
import { ModalProvidersComponent } from './modal-providers/modal-providers.component';
import { ModalRepresentativeComponent } from './modal-representative/modal-representative.component';
import { ModalCustomersComponent } from './modal-customers/modal-customers.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { ModalRolesComponent } from './modal-roles/modal-roles.component';

@NgModule({
  declarations: [
    ModalDataMasterComponent, 
    ModalUsersComponent, 
    ModalCategoriesComponent, 
    ModalProductsComponent, 
    ModalPurchasesComponent, 
    ModalProvidersComponent, 
    ModalRepresentativeComponent, 
    ModalCustomersComponent, 
    ModalRolesComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    FormsModule,
    FontAwesomeModule
  ],
  exports: [
    ModalDataMasterComponent, 
    ModalUsersComponent, 
    ModalCategoriesComponent, 
    ModalProductsComponent, 
    ModalPurchasesComponent, 
    ModalProvidersComponent, 
    ModalRepresentativeComponent,
    ModalCustomersComponent,
    ModalRolesComponent
  ]
})
export class ModalsModule { }
