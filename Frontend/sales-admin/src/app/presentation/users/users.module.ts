import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SharedModule } from '../../../app/shared/shared.module';

import { UsersComponent } from './users.component';
import { UsersMaintainerComponent } from './users-maintainer/users-maintainer.component';
import { UsersRoutingModule } from './users-routing.module';
import { RolesMaintainerComponent } from './roles-maintainer/roles-maintainer.component';



@NgModule({
  declarations: [UsersComponent, UsersMaintainerComponent, RolesMaintainerComponent],
  imports: [
    CommonModule,
    SharedModule,
    UsersRoutingModule
  ],
  exports: [UsersComponent, UsersMaintainerComponent, RolesMaintainerComponent],
})
export class UsersModule { }
