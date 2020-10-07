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

@Component({
  selector: 'app-modal-users',
  templateUrl: './modal-users.component.html',
  styleUrls: ['./modal-users.component.css']
})
export class ModalUsersComponent implements OnInit {

  public modalDataSub: Subscription;
  public dataModal: any;

  public formGroup: FormGroup = null;
  public submit: any = null;

  public commonRoles: CommonDto[] = [];
  public commonAuditStatus: CommonDto[] = [];
  public commonBlockedUser: CommonDto[] = [];

  constructor(
    private gridSimpleService: GridSimpleService,
    private modalDataObservable: ModalDataObservable,
    private commonRolesUseCase: CommonRolesUseCase,
    private commonBlockedUserUseCase: CommonBlockedUserUseCase,
    private commonAuditStatusUseCase: CommonAuditStatusUseCase,

    private userGetUseCase: UserGetUseCase,
    private formBuilder: FormBuilder,
  ) { 
    const that = this;
  }

  ngOnInit(): void {
    const that = this;

    
    that.formGroup = that.formBuilder.group({
      firstName: ['', [Validators.required]],
      lastName: ['', [Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      username: ['', [Validators.required]],
      password: ['', [Validators.required, Validators.minLength(8)]],
      roleId: ['', [Validators.required]],
      blocked: ['', [Validators.required]],
      active: ['', [Validators.required]],
    });

    that.loadCommon();

    that.modalDataSub = that.modalDataObservable.currentData.subscribe(res => {
      that.dataModal = res;
      if(that.dataModal !== null){

        let dataModal = JSON.parse(this.dataModal);

        that.userGetUseCase.execute(dataModal.id).subscribe( res => {
          console.log(res);
          that.formGroup.patchValue(res);
        });
        
        console.log('Obtener registro');
      } else {
        console.log('Nuevo registro');
      }
    });
  }

  loadCommon(): void {
    const that = this;
    that.commonRolesUseCase.execute().subscribe(res => {
      that.commonRoles = res;
    });

    that.commonAuditStatusUseCase.execute().subscribe(res => {
      that.commonAuditStatus = res;
    });

    that.commonBlockedUserUseCase.execute().subscribe( res => {
      that.commonBlockedUser = res;
    });
  }

  onClickClose() {
    const that = this;
    that.gridSimpleService.closeModal();
  }

  onClickDone() {
    const that = this;
    // that.gridSimpleService.closeModal();
    console.log(that.formGroup.value);
    that.submit = true;
  }

}
