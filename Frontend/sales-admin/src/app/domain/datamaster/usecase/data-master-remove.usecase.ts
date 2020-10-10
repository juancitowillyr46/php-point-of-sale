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
export class DataMasterRemoveUseCase implements UseCase<string, ResponseIdDataDto> {

    constructor(private dataMasterRepository: DataMasterRepository) {

    }

    public execute(id: string): Observable<ResponseIdDataDto> {
        const that = this;
        console.log(id);
        let responseIdDataDto: ResponseIdDataDto;
        return that.dataMasterRepository.remove(id).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}