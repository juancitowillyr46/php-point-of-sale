import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ModalDataMasterComponent } from './modal-data-master/modal-data-master.component';
import { ModalUsersComponent } from './modal-users/modal-users.component';

@NgModule({
  declarations: [ModalDataMasterComponent, ModalUsersComponent],
  imports: [
    CommonModule
  ],
  exports: [ModalDataMasterComponent, ModalUsersComponent]
})
export class ModalsModule { }
