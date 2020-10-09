import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { UsersComponent} from './users.component';
import { UsersMaintainerComponent} from './users-maintainer/users-maintainer.component';
import { RolesMaintainerComponent} from './roles-maintainer/roles-maintainer.component';

const routes: Routes = [
  {
    path: '',
    component: UsersComponent,
    children: [
      {
        path: 'maintainer',
        component: UsersMaintainerComponent,
        data: {title: 'Usuarios'},
        // resolve
      },
      {
        path: 'roles',
        component: RolesMaintainerComponent,
        data: {title: 'Roles y permisos'},
        // resolve
      }
    ]
  },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class UsersRoutingModule { }
