import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Inject, Injectable } from '@angular/core';
import { CommonAuditStatusUseCase } from 'src/app/domain/commons/usecase/common-audit-status.usecase';
import { CommonDto } from 'src/app/domain/commons/model/common.dto';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

@Injectable()
export class BaseModalComponent {

    public loadData: any = null;
    public formBuilder: FormBuilder = null;
    public formGroup: FormGroup = null;

    public commonAuditStatus: CommonDto[] = [];
    public commonAuditStatusUseCase: CommonAuditStatusUseCase;

    public modalService: NgbModal = null;

    constructor(
        @Inject(FormBuilder) formBuilder: FormBuilder,
        @Inject(CommonAuditStatusUseCase) commonAuditStatusUseCase: CommonAuditStatusUseCase,
        @Inject(NgbModal) modalService: NgbModal,
    ) {
        const that = this;
        that.formBuilder = formBuilder;
        that.commonAuditStatusUseCase = commonAuditStatusUseCase;
        that.modalService = modalService;
        that.commonAuditStatusLoad();
    }

    buildingForm(group: any): FormGroup {
        const that = this;
        const formGroup = that.formBuilder.group(group);
        return formGroup;
    }

    // editValues(obj: any): void {
    //     const that = this;
    //     that.loadData = false;
    // }

    resetForm(obj: any): void {
        const that = this;
        that.loadData = true;
        that.formGroup.markAsDirty();
        that.formGroup.reset();
    }

    

    newValues(): void {
        const that = this;
        that.loadData = false;
        // that.formGroup.enable();
    }

    commonAuditStatusLoad() {
        const that = this;
        that.loadData = true;
        that.commonAuditStatusUseCase.execute().subscribe(res => {
            that.commonAuditStatus = res;
            that.loadData = false;
        });
    }

    closeModal(reason: string) {
        const that = this;
        that.modalService.dismissAll(reason);
    }

}