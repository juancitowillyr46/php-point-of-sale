import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: 'modules',
    loadChildren: () => import('./presentation/presentation.module')
    .then(m => m.PresentationModule)
  },
  {
    path: 'security',
    loadChildren: () => import('./security/security.module')
    .then(m => m.SecurityModule)
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes, {useHash: true})],
  exports: [RouterModule]
})
export class AppRoutingModule { }
