import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';


import { ProvidersComponent } from './providers.component';
import { ProvidersMaintainerComponent } from '../providers/providers-maintainer/providers-maintainer.component';
import { ProvidersRepresentativeComponent } from '../providers/providers-representative/providers-representative.component';

const routes: Routes = [
  {
    path: '',
    component: ProvidersComponent,
    children: [
      {
        path: 'maintainer',
        component: ProvidersMaintainerComponent,
        data: {title: 'Proveedores'},
        // resolve
      },
      {
        path: 'legal-representative',
        component: ProvidersRepresentativeComponent,
        data: {title: 'Representante'},
        // resolve
      }
    ]
  },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ProvidersRoutingModule { }
