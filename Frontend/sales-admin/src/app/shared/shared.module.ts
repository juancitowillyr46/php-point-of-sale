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
import { faSpinner, faSignInAlt } from '@fortawesome/free-solid-svg-icons';

@NgModule({
  declarations: [GridSimpleComponent, SideNavComponent, FooterComponent, MenuComponent],
  imports: [
    CommonModule,
    ModalsModule,
    RouterModule,
    FontAwesomeModule
  ],
  exports: [
    GridSimpleComponent, 
    SideNavComponent, 
    FooterComponent, 
    MenuComponent, 
    ModalsModule,
    FontAwesomeModule
  ],
})
export class SharedModule { 

  constructor(private library: FaIconLibrary) {
    library.addIcons(
      faSpinner,
      faSignInAlt
    )
  }

}
