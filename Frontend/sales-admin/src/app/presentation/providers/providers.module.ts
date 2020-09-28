import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ProvidersMaintainerComponent } from './providers-maintainer/providers-maintainer.component';
import { ProvidersRoutingModule } from '../providers/providers-routing.module';
import { SharedModule } from './../../../app/shared/shared.module';
import { ProvidersComponent } from './providers.component';
import { ProvidersRepresentativeComponent } from './providers-representative/providers-representative.component';



@NgModule({
  declarations: [ProvidersComponent, ProvidersMaintainerComponent, ProvidersRepresentativeComponent],
  imports: [
    CommonModule,
    SharedModule,
    ProvidersRoutingModule
  ],
  exports: [ProvidersComponent, ProvidersMaintainerComponent, ProvidersRepresentativeComponent]
})
export class ProvidersModule { }
