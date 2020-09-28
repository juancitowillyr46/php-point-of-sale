import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { EmployeesMaintainerComponent } from '../employees/employees-maintainer/employees-maintainer.component';
import { EmployeesComponent } from '../employees/employees.component';

const routes: Routes = [
  {
    path: '',
    component: EmployeesComponent,
    children: [
      {
        path: 'maintainer',
        component: EmployeesMaintainerComponent,
        data: {title: 'Empleados'},
        // resolve
      }
    ]
  },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class EmployeesRoutingModule { }
