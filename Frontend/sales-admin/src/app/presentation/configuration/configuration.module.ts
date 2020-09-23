import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SharedModule } from '../../../app/shared/shared.module';

import { ConfigurationComponent } from './configuration.component';
import { ConfigurationMaintainerComponent } from './configuration-maintainer/configuration-maintainer.component';
import { ConfigurationRoutingModule } from './configuration-routing.module';


@NgModule({
  declarations: [ConfigurationComponent, ConfigurationMaintainerComponent],
  imports: [
    CommonModule,
    SharedModule,
    ConfigurationRoutingModule
  ],
  exports: [ConfigurationComponent, ConfigurationMaintainerComponent]
})
export class ConfigurationModule { }
