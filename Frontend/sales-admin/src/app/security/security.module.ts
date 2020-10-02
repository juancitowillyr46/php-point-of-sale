import { CommonModule } from '@angular/common';
import { HttpClient } from '@angular/common/http';
import { NgModule } from '@angular/core';
import { FormGroup, FormsModule, ReactiveFormsModule } from '@angular/forms';
import { LoginComponent } from '../security/login/login.component';
import { SecurityRoutingModule } from '../security/security-routing.module';
import { SharedModule } from '../shared/shared.module';
import { SecurityComponent } from './security.component';

@NgModule({
  declarations: [SecurityComponent,LoginComponent],
  imports: [
    ReactiveFormsModule,
    FormsModule,
    CommonModule,
    SharedModule,
    SecurityRoutingModule
  ],
  exports: [SecurityComponent,LoginComponent],
})
export class SecurityModule { }
