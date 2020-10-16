import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { ProviderRepository } from "../repository/provider.repository";
import { map } from 'rxjs/operators';
import { CommonDto } from '../../commons/model/common.dto';

@Injectable({
    providedIn: 'root'
})
export class ProviderGetProductsUseCase implements UseCase<any, any> {

    constructor(private providerRepository: ProviderRepository) {

    }

    public execute(obj: any): Observable<any> {
        const that = this;
        let productDto: CommonDto[] = [];
        return that.providerRepository.getProducts(obj.providerId).pipe(map(res => {
            productDto = res.data;
            return productDto;
        }));
    }

}