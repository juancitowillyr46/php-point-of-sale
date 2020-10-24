import { Injectable } from '@angular/core';
import { UseCase } from '../../../../core/base/use-case';
import { Observable } from "rxjs";
import { PurchaseDetailRepository } from "../../repository/purchase-detail.repository";
import { map } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class PurchaseDetailAllUseCase implements UseCase<any, any> {

    constructor(private providerDetailRepository: PurchaseDetailRepository) {

    }

    public execute(purchaseId: string): Observable<any> {

        const that = this;
        //let accessTokenData: AccessTokenDto = new AccessTokenDto();

        return that.providerDetailRepository.getAll(purchaseId).pipe(map(res => {
            console.log(res);
            return res;
            // accessTokenData.token = res.data.token;
            // return accessTokenData;
        }));
    }

}