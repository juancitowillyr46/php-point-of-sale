import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { DataService } from "../../../core/base/data.service";
import { ResponseDataDto } from '../../../core/base/response-data.dto';
import { CommonDto } from '../model/common.dto';

@Injectable({
    providedIn: 'root'
})
export class CommonRepository {

    private resource = 'commons/';

    constructor(private dataService: DataService){}

    getCommonRoles(): Observable<ResponseDataDto<CommonDto[]>> {
        const that = this;
        return that.dataService.get(that.resource + 'roles');
    }

    getCommonAuditStatus(): Observable<ResponseDataDto<CommonDto[]>> {
        const that = this;
        return that.dataService.get(that.resource + 'audit-status');
    }

    getCommonBlockedUser(): Observable<ResponseDataDto<CommonDto[]>> {
        const that = this;
        return that.dataService.get(that.resource + 'blocked-user');
    }

    getCommonCategories(): Observable<ResponseDataDto<CommonDto[]>> {
        const that = this;
        return that.dataService.get(that.resource + 'categories');
    }

    getCommonProviders(): Observable<ResponseDataDto<CommonDto[]>> {
        const that = this;
        return that.dataService.get(that.resource + 'providers');
    }

    getCommonUnitMeasurement(): Observable<ResponseDataDto<CommonDto[]>> {
        const that = this;
        return that.dataService.get(that.resource + 'unit-measurement');
    }
}