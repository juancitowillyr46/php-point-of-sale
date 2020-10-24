import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { AuthHttpGatewayService } from '../core/base/auth-http-gateway.service';
import { SharedModule } from '../shared/shared.module';
// import { InputSelectDirective } from '../shared/directives/input-select.directive';


@NgModule({
  declarations: [],
  imports: [
    HttpClientModule,
    CommonModule,
    SharedModule
  ],
  providers: [
    AuthHttpGatewayService
  ]
})
export class CoreModule { }
