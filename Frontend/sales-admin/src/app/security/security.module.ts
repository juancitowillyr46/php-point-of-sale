import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { LoginComponent } from '../security/login/login.component';
import { SecurityRoutingModule } from '../security/security-routing.module';
import { SecurityComponent } from './security.component';

@NgModule({
  declarations: [SecurityComponent,LoginComponent],
  imports: [
    CommonModule,
    SecurityRoutingModule
  ],
  exports: [SecurityComponent,LoginComponent],
})
export class SecurityModule { }
