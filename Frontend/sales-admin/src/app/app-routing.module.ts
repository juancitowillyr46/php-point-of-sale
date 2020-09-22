import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './presentation/home/home.component';
import { LoginComponent } from './presentation/login/login.component';
import { DataMasterComponent } from './presentation/data-master/data-master.component';
import { UsersComponent } from './presentation/users/users.component';

const routes: Routes = [
  {
    path: 'data-master',
    component: DataMasterComponent,
    data: {title: 'Data Maestra'},
    // resolve
  },
  {
    path: 'users',
    component: UsersComponent,
    data: {title: 'Usuarios'},
    // resolve
  },
  {
    path: 'login',
    component: LoginComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes, {useHash: true})],
  exports: [RouterModule]
})
export class AppRoutingModule { }
