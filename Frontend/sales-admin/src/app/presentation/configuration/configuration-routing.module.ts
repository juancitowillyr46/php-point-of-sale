import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ConfigurationMaintainerComponent } from '../configuration/configuration-maintainer/configuration-maintainer.component';
import { ConfigurationComponent } from '../configuration/configuration.component';

const routes: Routes = [
  {
    path: '',
    component: ConfigurationComponent,
    children: [
      {
        path: 'maintainer',
        component: ConfigurationMaintainerComponent,
        data: {title: 'Data Maestra'},
        // resolve
      }
    ]
  },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ConfigurationRoutingModule { }
