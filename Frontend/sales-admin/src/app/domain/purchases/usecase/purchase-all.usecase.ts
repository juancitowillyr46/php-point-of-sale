import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { PurchaseRepository } from "../repository/purchase.repository";
import { map } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class PurchaseAllUseCase implements UseCase<any, any> {

    constructor(private providerRepository: PurchaseRepository) {

    }

    public execute(): Observable<any> {
        const that = this;
        //let accessTokenData: AccessTokenDto = new AccessTokenDto();

        return that.providerRepository.getAll().pipe(map(res => {
            console.log(res);
            return res;
            // accessTokenData.token = res.data.token;
            // return accessTokenData;
        }));
    }

}