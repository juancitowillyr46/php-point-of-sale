import { BrowserModule } from '@angular/platform-browser';
import { CUSTOM_ELEMENTS_SCHEMA, NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

import { SharedModule } from './../app/shared/shared.module';
import { PresentationModule } from './../app/presentation/presentation.module';
import { SecurityModule } from './../app/security/security.module';
// import { SecurityComponent } from './security/security.component';
import { CommonModule } from '@angular/common';
// import { PresentationComponent } from './presentation/presentation.component';
// import { ModalsModule } from './shared/components/modals/modals.module';
// import { ConfigurationModule } from './presentation/configuration/configuration.module';
// import { UsersModule } from './presentation/users/users.module';
// import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/compiler';

import { HTTP_INTERCEPTORS } from '@angular/common/http';

import { AuthHttpHeaderInterceptor } from './shared/interceptors/auth-http-header.interceptor';
import { AuthHttpErrorsInterceptor } from './shared/interceptors/auth-http-errors.interceptor';

import { CoreModule } from './core/core.module';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { InputSelectDirective } from './shared/directives/input-select.directive';


@NgModule({
  declarations: [
    AppComponent,
   // InputSelectDirective
  ],
  imports: [
    BrowserModule,
    CommonModule,

    AppRoutingModule,
    CoreModule,
    
    SecurityModule,
    PresentationModule,
    // NgbModule,
    
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AuthHttpHeaderInterceptor,
      multi: true
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AuthHttpErrorsInterceptor,
      multi: true
    }
  ],
  exports: [],
  bootstrap: [AppComponent],
  schemas: [ CUSTOM_ELEMENTS_SCHEMA ]
})
export class AppModule { }
