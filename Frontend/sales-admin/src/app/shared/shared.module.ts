import { NgModule } from '@angular/core';
import { GridSimpleComponent } from './components/grid-simple/grid-simple.component';
import { SideNavComponent } from './components/side-nav/side-nav.component';
import { FooterComponent } from './components/footer/footer.component';
import { MenuComponent } from './components/menu/menu.component';

@NgModule({
  declarations: [GridSimpleComponent, SideNavComponent, FooterComponent, MenuComponent],
  imports: [],
  exports: [
    GridSimpleComponent, SideNavComponent, FooterComponent, MenuComponent
  ]
})
export class SharedModule { }
