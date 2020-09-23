import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SharedModule } from './../../../app/shared/shared.module';

import { PurchasesComponent } from './purchases.component';
import { PurchasesMaintainerComponent } from './purchases-maintainer/purchases-maintainer.component';
import { PurchasesRoutingModule } from './purchases-routing.module';

@NgModule({
  declarations: [PurchasesComponent, PurchasesMaintainerComponent],
  imports: [
    CommonModule,
    SharedModule,
    PurchasesRoutingModule
  ],
  exports: [PurchasesComponent, PurchasesMaintainerComponent]
})
export class PurchasesModule { }
