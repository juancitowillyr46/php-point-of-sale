import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Inject, Injectable } from '@angular/core';
import { CommonAuditStatusUseCase } from 'src/app/domain/commons/usecase/common-audit-status.usecase';
import { CommonDto } from 'src/app/domain/commons/model/common.dto';

@Injectable()
export class BaseModalComponent {

    public loadData: any = null;
    public formBuilder: FormBuilder = null;
    public formGroup: FormGroup = null;

    public commonAuditStatus: CommonDto[] = [];
    public commonAuditStatusUseCase: CommonAuditStatusUseCase;

    constructor(
        @Inject(FormBuilder) formBuilder: FormBuilder,
        @Inject(CommonAuditStatusUseCase) commonAuditStatusUseCase: CommonAuditStatusUseCase
    ) {
        const that = this;
        that.formBuilder = formBuilder;
        that.commonAuditStatusUseCase = commonAuditStatusUseCase;
        that.commonAuditStatusLoad();
    }

    buildingForm(group: any): FormGroup {
        const that = this;
        return that.formBuilder.group(group);
    }

    resetForm(obj: any): void {
        const that = this;
        that.loadData = true;
        that.formGroup.reset();
        that.formGroup.setValue(obj);
        that.formGroup.disable();
    }

    editValues(obj: any): void {
        const that = this;
        that.formGroup.patchValue(obj);
        that.loadData = false;
        that.formGroup.enable();
    }

    newValues(): void {
        const that = this;
        that.loadData = false;
        that.formGroup.enable();
    }

    commonAuditStatusLoad() {
        const that = this;
        that.loadData = true;
        that.commonAuditStatusUseCase.execute().subscribe(res => {
            that.commonAuditStatus = res;
            that.loadData = false;
        });
    }

}