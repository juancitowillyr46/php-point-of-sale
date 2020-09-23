import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CustomersMaintainerComponent } from '../customers/customers-maintainer/customers-maintainer.component';
import { CustomersComponent } from '../customers/customers.component';

const routes: Routes = [
  {
    path: '',
    component: CustomersComponent,
    children: [
      {
        path: 'maintainer',
        component: CustomersMaintainerComponent,
        data: {title: 'Clientes'},
        // resolve
      }
    ]
  },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CustomersRoutingModule { }
