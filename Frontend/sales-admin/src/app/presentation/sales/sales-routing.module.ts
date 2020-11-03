import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { SalesComponent } from './sales.component';
import { SalesMaintainerComponent } from './sales-maintainer/sales-maintainer.component';
import { SalePosComponent } from './sale-pos/sale-pos.component';

const routes: Routes = [
  {
    path: '',
    component: SalesComponent,
    children: [
      {
        path: 'maintainer',
        component: SalesMaintainerComponent,
        data: {title: 'Ventas'}
        // resolve
      },
      {
        path: 'pos',
        component: SalePosComponent,
        data: {title: 'Ventas'}
        // resolve
      }
    ]
  },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class SalesRoutingModule { }
