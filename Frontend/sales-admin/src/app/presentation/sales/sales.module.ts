import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SalesComponent } from './sales.component';
import { FormsModule } from '@angular/forms';
import { SharedModule } from './../../../app/shared/shared.module';
import { SalesRoutingModule } from './sales-routing.module';
import { SalesMaintainerComponent } from './sales-maintainer/sales-maintainer.component';
import { NgbModule, NgbPaginationModule, NgbTooltip, NgbTooltipModule, NgbTypeaheadModule } from '@ng-bootstrap/ng-bootstrap';
import { SalePosComponent } from './sale-pos/sale-pos.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { InputSelectDirectiveModule } from 'src/app/shared/directives/input-select.directive';

@NgModule({
  declarations: [SalesComponent, SalesMaintainerComponent, SalePosComponent],
  imports: [
    CommonModule,
    FormsModule,      
    SharedModule,
    SalesRoutingModule,
    NgbPaginationModule,
    NgbModule,
    FontAwesomeModule,
    InputSelectDirectiveModule,
    NgbTypeaheadModule
  ],
  exports: [SalesComponent, SalesMaintainerComponent]
})
export class SalesModule { }
