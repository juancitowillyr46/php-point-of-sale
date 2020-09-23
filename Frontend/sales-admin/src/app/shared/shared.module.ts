import { CUSTOM_ELEMENTS_SCHEMA, NgModule } from '@angular/core';
import { GridSimpleComponent } from './components/grid-simple/grid-simple.component';
import { SideNavComponent } from './components/side-nav/side-nav.component';
import { FooterComponent } from './components/footer/footer.component';
import { MenuComponent } from './components/menu/menu.component';
import { CommonModule } from '@angular/common';
import { ModalsModule } from './components/modals/modals.module';

@NgModule({
  declarations: [GridSimpleComponent, SideNavComponent, FooterComponent, MenuComponent],
  imports: [
    CommonModule,
    ModalsModule
  ],
  exports: [
    GridSimpleComponent, SideNavComponent, FooterComponent, MenuComponent, ModalsModule
  ],
})
export class SharedModule { }
