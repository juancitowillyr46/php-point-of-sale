import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SharedModule } from '../../../app/shared/shared.module';

import { EmployeesComponent } from './employees.component';
import { EmployeesMaintainerComponent } from './employees-maintainer/employees-maintainer.component';
import { EmployeesRoutingModule } from './employees-routing.module';

@NgModule({
  declarations: [EmployeesComponent, EmployeesMaintainerComponent],
  imports: [
    CommonModule,
    SharedModule,
    EmployeesRoutingModule
  ]
})
export class EmployeesModule { }
