import { NgModule } from '@angular/core';
import { CommonModule, DecimalPipe } from '@angular/common';

import { SharedModule } from './../../../app/shared/shared.module';

import { PurchasesComponent } from './purchases.component';
import { PurchasesMaintainerComponent } from './purchases-maintainer/purchases-maintainer.component';
import { PurchasesRoutingModule } from './purchases-routing.module';
import { NgbModule, NgbPaginationModule, NgbRadioGroup } from '@ng-bootstrap/ng-bootstrap';
// import { PurchaseService } from './purchases-maintainer/purchase.service';
import { FormsModule } from '@angular/forms';

@NgModule({
  declarations: [PurchasesComponent, PurchasesMaintainerComponent],
  imports: [
    CommonModule,
    FormsModule,      
    SharedModule,
    PurchasesRoutingModule,

    NgbPaginationModule,
    NgbModule,
    // NgbRadioGroup

  ],
  providers: [
    DecimalPipe
  ],
  exports: [PurchasesComponent, PurchasesMaintainerComponent]
})
export class PurchasesModule { }
