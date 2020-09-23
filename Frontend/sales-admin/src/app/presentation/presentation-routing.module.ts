import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { PresentationComponent } from './presentation.component';

const routes: Routes = [
  {
    path: 'modules',
    component: PresentationComponent,
    children: [
      {
        path: 'configuration',
        loadChildren: () => import('./configuration/configuration.module')
        .then(m => m.ConfigurationModule)
        // resolve
      },
      {
        path: 'users',
        loadChildren: () => import('./users/users.module')
        .then(m => m.UsersModule)
        // resolve
      },
      {
        path: 'products',
        loadChildren: () => import('./products/products.module')
        .then(m => m.ProductsModule)
        // resolve
      },
      {
        path: 'purchases',
        loadChildren: () => import('./purchases/purchases.module')
        .then(m => m.PurchasesModule)
        // resolve
      }
    ]
  },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PresentationRoutingModule { }
