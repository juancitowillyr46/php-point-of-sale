import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { DataMasterRepository } from "../repository/data-master.repository";
import { map } from 'rxjs/operators';
import { DataMasterStoreDto } from '../model/data-master-store.dto';
import { ResponseIdDataDto } from '../../../core/entities/response-id-data.dto';

@Injectable({
    providedIn: 'root'
})
export class DataMasterAddUseCase implements UseCase<DataMasterStoreDto, ResponseIdDataDto> {

    constructor(private dataMasterRepository: DataMasterRepository) {

    }

    public execute(object: DataMasterStoreDto): Observable<ResponseIdDataDto> {
        const that = this;
        let responseIdDataDto: ResponseIdDataDto;
        return that.dataMasterRepository.add(object).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}