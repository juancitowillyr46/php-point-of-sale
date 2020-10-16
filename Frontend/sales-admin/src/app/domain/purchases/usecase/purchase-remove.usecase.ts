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
export class PurchaseRemoveUseCase implements UseCase<string, ResponseIdDataDto> {

    constructor(private providerRepository: PurchaseRepository) {

    }

    public execute(id: string): Observable<ResponseIdDataDto> {
        const that = this;
        console.log(id);
        let responseIdDataDto: ResponseIdDataDto;
        return that.providerRepository.remove(id).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}