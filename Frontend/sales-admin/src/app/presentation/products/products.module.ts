import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SharedModule } from './../../../app/shared/shared.module';

import { ProductsComponent } from './products.component';
import { ProductsMaintainerComponent } from './products-maintainer/products-maintainer.component';
import { ProductsCategoriesComponent } from './products-categories/products-categories.component';
import { ProductsStockComponent } from './products-stock/products-stock.component';
import { ProductsRoutingModule } from './products-routing.module';

@NgModule({
  declarations: [ProductsComponent, ProductsMaintainerComponent, ProductsCategoriesComponent, ProductsStockComponent],
  imports: [
    CommonModule,
    SharedModule,
    ProductsRoutingModule
  ],
  exports: [ProductsComponent, ProductsMaintainerComponent, ProductsCategoriesComponent, ProductsStockComponent],
})
export class ProductsModule { }
