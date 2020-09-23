import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PurchasesComponent } from './purchases.component';
import { PurchasesMaintainerComponent } from './purchases-maintainer/purchases-maintainer.component';

const routes: Routes = [
  {
    path: '',
    component: PurchasesComponent,
    children: [
      {
        path: 'maintainer',
        component: PurchasesMaintainerComponent,
        data: {title: 'Compras'}
        // resolve
      }
    ]
  },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PurchasesRoutingModule { }
