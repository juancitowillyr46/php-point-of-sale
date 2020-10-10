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
export class DataMasterAllUseCase implements UseCase<any, any> {

    constructor(private dataMasterRepository: DataMasterRepository) {

    }

    public execute(): Observable<any> {
        const that = this;
        //let accessTokenData: AccessTokenDto = new AccessTokenDto();

        return that.dataMasterRepository.getAll().pipe(map(res => {
            console.log(res);
            return res;
            // accessTokenData.token = res.data.token;
            // return accessTokenData;
        }));
    }

}