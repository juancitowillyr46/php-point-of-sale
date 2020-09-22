import { CUSTOM_ELEMENTS_SCHEMA, NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './login/login.component';
import { DataMasterComponent } from './data-master/data-master.component';
import { SharedModule } from '../shared/shared.module';
import { ModalsModule } from '../shared/components/modals/modals.module';
import { UsersComponent } from './users/users.component';
import { CategoriesComponent } from './categories/categories.component';
import { ProductsComponent } from './products/products.component';
import { PurchasesComponent } from './purchases/purchases.component';

@NgModule({
  declarations: [LoginComponent, DataMasterComponent, UsersComponent, CategoriesComponent, ProductsComponent, PurchasesComponent],
  imports: [
    SharedModule,
    ModalsModule
  ]
})
export class PresentationModule { }
