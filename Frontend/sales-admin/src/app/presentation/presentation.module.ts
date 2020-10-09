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
import { EmployeesModule } from '../presentation/employees/employees.module';
// import { RolesModule } from '../presentation/roles/roles.module';

// import { ProvidersComponent } from './providers/providers.component';

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
    EmployeesModule,
    // RolesModule
  ]
})
export class PresentationModule { }
