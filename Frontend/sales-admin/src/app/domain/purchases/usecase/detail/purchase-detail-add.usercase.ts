import { Injectable } from '@angular/core';
import { UseCase } from '../../../../core/base/use-case';
import { Observable } from "rxjs";
import { PurchaseDetailRepository } from "../../repository/purchase-detail.repository";
import { map } from 'rxjs/operators';
import { PurchaseDetailStoreDto } from '../../model/purchase-detail-store.dto';
import { ResponseIdDataDto } from '../../../../core/entities/response-id-data.dto';

@Injectable({
    providedIn: 'root'
})
export class PurchaseDetailAddUseCase implements UseCase<PurchaseDetailStoreDto, ResponseIdDataDto> {

    constructor(private providerDetailRepository: PurchaseDetailRepository) {

    }

    public execute(object: PurchaseDetailStoreDto): Observable<ResponseIdDataDto> {
        const that = this;
        let responseIdDataDto: ResponseIdDataDto;
        return that.providerDetailRepository.add(object).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}