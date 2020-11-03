import { CUSTOM_ELEMENTS_SCHEMA, NgModule } from '@angular/core';
import { GridSimpleComponent } from './components/grid-simple/grid-simple.component';
import { SideNavComponent } from './components/side-nav/side-nav.component';
import { FooterComponent } from './components/footer/footer.component';
import { MenuComponent } from './components/menu/menu.component';
import { CommonModule } from '@angular/common';
import { ModalsModule } from './components/modals/modals.module';
import { RouterModule } from '@angular/router';
import { FontAwesomeModule, FaIconLibrary } from '@fortawesome/angular-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faSpinner, faSignInAlt, faBan, faSync, faDownload, faTrash, faPencilAlt, faMoneyBillAlt } from '@fortawesome/free-solid-svg-icons';
import { MeObservable } from '../shared/observables/me.observable';
import { GridSimpleObservable } from '../shared/components/grid-simple/grid-simple.observable';
import { GridSimpleService } from '../shared/components/grid-simple/grid-simple.service';

import { ModalDataObservable } from '../shared/components/modals/modal-data.observable';
import { ModalDataRemoveObservable } from '../shared/components/modals/modal-data-remove.observable';

import { CommonRolesObservable } from './observables/common-roles.observable';
import { NgxCurrencyModule } from 'ngx-currency';

@NgModule({
  declarations: [GridSimpleComponent, SideNavComponent, FooterComponent, MenuComponent],
  imports: [
    CommonModule,
    ModalsModule,
    RouterModule,
    FontAwesomeModule,
    // MeObservable,
    NgxCurrencyModule,
  ],
  exports: [
    GridSimpleComponent, 
    SideNavComponent, 
    FooterComponent, 
    MenuComponent, 
    ModalsModule,
    FontAwesomeModule,
    // MeObservable
    NgxCurrencyModule
  ],
  providers: [
    MeObservable,
    GridSimpleObservable,
    GridSimpleService,
    ModalDataObservable,
    ModalDataRemoveObservable,
    CommonRolesObservable,
    
  ]
})
export class SharedModule { 

  constructor(private library: FaIconLibrary) {
    library.addIcons(
      faSpinner,
      faSignInAlt,
      faBan,
      faSync,
      faDownload,
      faTrash,
      faPencilAlt,
      faMoneyBillAlt
    )
  }

}
