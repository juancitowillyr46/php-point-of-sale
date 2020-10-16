import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { PurchaseRepository } from "../repository/purchase.repository";
import { map } from 'rxjs/operators';
import { PurchaseStoreDto } from '../model/purchase-store.dto';
import { ResponseIdDataDto } from '../../../core/entities/response-id-data.dto';

@Injectable({
    providedIn: 'root'
})
export class PurchaseAddUseCase implements UseCase<PurchaseStoreDto, ResponseIdDataDto> {

    constructor(private providerRepository: PurchaseRepository) {

    }

    public execute(object: PurchaseStoreDto): Observable<ResponseIdDataDto> {
        const that = this;
        let responseIdDataDto: ResponseIdDataDto;
        return that.providerRepository.add(object).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}