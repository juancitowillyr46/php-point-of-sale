import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { map } from 'rxjs/operators';
import { CommonDto } from '../model/common.dto';
import { CommonRepository } from '../repository/common.repository';

@Injectable({
    providedIn: 'root'
})
export class CommonUbigeoDepartmentsUseCase implements UseCase<any, CommonDto[]> {

    constructor(private commonRepository: CommonRepository) {}

    public execute(): Observable<CommonDto[]> {
        const that = this;
        let commonData: CommonDto[];
        return that.commonRepository.getCommonUbigeoDepartments().pipe(map(res => {
            commonData = res.data;
            return commonData;
        }));
    }

}