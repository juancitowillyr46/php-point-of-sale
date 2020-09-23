import { NgModule } from '@angular/core';
import { LoginComponent } from '../security/login/login.component';
import { SecurityRoutingModule } from '../security/security-routing.module';

@NgModule({
  declarations: [LoginComponent],
  imports: [
    SecurityRoutingModule
  ]
})
export class SecurityModule { }
