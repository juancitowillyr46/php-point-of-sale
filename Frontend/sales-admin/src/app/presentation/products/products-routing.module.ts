import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ProductsCategoriesComponent } from '../products/products-categories/products-categories.component';
import { ProductsMaintainerComponent } from '../products/products-maintainer/products-maintainer.component';
import { ProductsStockComponent } from '../products/products-stock/products-stock.component';

import { ProductsComponent } from '../products/products.component';

const routes: Routes = [
  {
    path: '',
    component: ProductsComponent,
    children: [
      {
        path: 'maintainer',
        component: ProductsMaintainerComponent,
        data: {title: 'Productos'},
        // resolve
      },
      {
        path: 'categories',
        component: ProductsCategoriesComponent,
        data: {title: 'Categorias'},
        // resolve
      },
      {
        path: 'stock',
        component: ProductsStockComponent,
        data: {title: 'Stock'},
        // resolve
      }
    ]
  },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ProductsRoutingModule { }
