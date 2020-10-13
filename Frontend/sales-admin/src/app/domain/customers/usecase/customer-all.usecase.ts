import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { CustomerRepository } from "../repository/customer.repository";
import { map } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class ProviderAllUseCase implements UseCase<any, any> {

    constructor(private customerRepository: CustomerRepository) {

    }

    public execute(): Observable<any> {
        const that = this;
        //let accessTokenData: AccessTokenDto = new AccessTokenDto();

        return that.customerRepository.getAll().pipe(map(res => {
            console.log(res);
            return res;
            // accessTokenData.token = res.data.token;
            // return accessTokenData;
        }));
    }

}