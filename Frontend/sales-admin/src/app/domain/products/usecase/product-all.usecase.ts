import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { ProductRepository } from "../repository/product.repository";
// import { AccessTokenDto } from "../model/access-token.dto"; 
import { map } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class ProductAllUseCase implements UseCase<any, any> {

    constructor(private productRepository: ProductRepository) {

    }

    public execute(): Observable<any> {
        const that = this;
        //let accessTokenData: AccessTokenDto = new AccessTokenDto();

        return that.productRepository.getAll().pipe(map(res => {
            console.log(res);
            return res;
            // accessTokenData.token = res.data.token;
            // return accessTokenData;
        }));
    }

}