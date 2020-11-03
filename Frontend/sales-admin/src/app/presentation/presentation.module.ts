import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SharedModule } from '../shared/shared.module';

import { ConfigurationModule } from '../presentation/configuration/configuration.module';

import { PresentationComponent } from './presentation.component';
import { PresentationRoutingModule } from './../presentation/presentation-routing.module';

import { CustomersModule } from './customers/customers.module';
import { ProductsModule } from '../presentation/products/products.module';
import { UsersModule } from '../presentation/users/users.module';
import { PurchasesModule } from '../presentation/purchases/purchases.module';
import { ProvidersModule } from '../presentation/providers/providers.module';
import { SalesModule } from '../presentation/sales/sales.module';

@NgModule({
  declarations: [PresentationComponent],
  imports: [
    SharedModule,
    PresentationRoutingModule,
    CommonModule,

    // Modules
    ConfigurationModule,
    CustomersModule,
    ProductsModule,
    UsersModule,
    PurchasesModule,
    ProvidersModule,
    SalesModule
    // EmployeesModule,
    // RolesModule
  ]
})
export class PresentationModule { }
