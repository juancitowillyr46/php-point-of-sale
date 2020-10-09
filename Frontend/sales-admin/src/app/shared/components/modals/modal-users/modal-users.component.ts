import { Component, OnInit } from '@angular/core';
import { Subscription } from 'rxjs';
import { CommonRolesUseCase } from 'src/app/domain/commons/usecase/common-roles.usecase';
import { CommonAuditStatusUseCase } from 'src/app/domain/commons/usecase/common-audit-status.usecase';
import { CommonBlockedUserUseCase } from 'src/app/domain/commons/usecase/common-blocked-user.usecase';
import { CommonDto } from '../../../../domain/commons/model/common.dto';
declare var $: any;
import { GridSimpleService } from '../../grid-simple/grid-simple.service';
import { ModalDataObservable } from '../modal-data.observable';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

import { UserGetUseCase } from '../../../../domain/users/usecase/user-get.usecase';
import { UserAddUseCase } from '../../../../domain/users/usecase/user-add.usercase';
import { UserEditUseCase } from '../../../../domain/users/usecase/user-edit.usecase';
import { UserRemoveUseCase } from '../../../../domain/users/usecase/user-remove.usecase';

import { BaseModalComponent } from '../base-modal.component';
import { UserStoreDto } from 'src/app/domain/users/model/user-store.dto';
import { ModalDataRemoveObservable } from '../modal-data-remove.observable';

@Component({
  selector: 'app-modal-users',
  templateUrl: './modal-users.component.html',
  styleUrls: ['./modal-users.component.css']
})
export class ModalUsersComponent extends BaseModalComponent implements OnInit  {

  public modalDataSub: Subscription;
  public dataModal: any;
  public submit: any = null;

  public commonRoles: CommonDto[] = [];
  public commonBlockedUser: CommonDto[] = [];

  constructor(
    private gridSimpleService: GridSimpleService,
    private modalDataObservable: ModalDataObservable,
    private modalDataRemoveObservable: ModalDataRemoveObservable,
    private commonRolesUseCase: CommonRolesUseCase,
    private commonBlockedUserUseCase: CommonBlockedUserUseCase,
    private userGetUseCase: UserGetUseCase,
    private userAddUseCase: UserAddUseCase,
    private userEditUseCase: UserEditUseCase,
    private userRemoveUserCase: UserRemoveUseCase,
    public commonAuditStatusUseCase: CommonAuditStatusUseCase,
    public formBuilder: FormBuilder
  ) { 
    super(formBuilder, commonAuditStatusUseCase);
    const that = this;
  }

  ngOnInit(): void {
    const that = this;

    that.loadCommonUser();
    that.buildingFormUser();
    
    that.modalDataSub = that.modalDataObservable.currentData.subscribe(res => {
      that.dataModal = null;
      that.submit = false;
      that.resetFormUser();
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.userGetUseCase.execute(that.dataModal.id).subscribe( res => {
          that.submit = false;
          that.editValues(res);
        });
      } else {
        that.newValues();
      }
    });

    that.modalDataRemoveObservable.currentData.subscribe( res => {
      if(res !== null){
        that.dataModal = JSON.parse(res);
        that.userRemoveUserCase.execute(that.dataModal.id).subscribe( response => {
          that.modalDataRemoveObservable.changeData(null);
          that.gridSimpleService.reload();
        });
      }
    });

  }

  loadCommonUser(): void {
    const that = this;
    that.commonRolesUseCase.execute().subscribe(res => {
      that.commonRoles = res;
    });
    that.commonBlockedUserUseCase.execute().subscribe( res => {
      that.commonBlockedUser = res;
    });
  }

  buildingFormUser(): void {
    const that = this;
    that.formGroup = that.buildingForm({
      firstName: ['', [Validators.required]],
      lastName: ['', [Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      username: ['', [Validators.required]],
      password: ['', [Validators.required, Validators.minLength(8)]],
      roleId: ['', [Validators.required]],
      blocked: [false, [Validators.required]],
      active: [true, [Validators.required]],
    });
  }

  resetFormUser() {
    const that = this;
    that.resetForm({
      firstName: '',
      lastName: '',
      email: '',
      username: '',
      password: '',
      roleId: '',
      blocked: false,
      active: true,
    });
  }

  onClickClose() {
    const that = this;
    
    that.gridSimpleService.closeModal();
  }

  onClickDone() {
    const that = this;
    
    let object: UserStoreDto = that.formGroup.value;
    
    object.active = (that.formGroup.controls.active.value == 'true' || that.formGroup.controls.active.value == true)? true : false;
    object.blocked = (that.formGroup.controls.blocked.value == 'true' || that.formGroup.controls.blocked.value == true)? true : false;

    if(that.dataModal !== null){
      object.id = that.dataModal.id;
      that.userEditUseCase.execute(object).subscribe( res => {
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      }, (error) => {
        alert(error);
        that.submit = false;
      });
    } else {
      that.userAddUseCase.execute(object).subscribe( res => {
        console.log(res);
        that.submit = false;
        that.gridSimpleService.closeModal();
        that.gridSimpleService.reload();
      });
    }
    
    that.submit = true;
  }

}
