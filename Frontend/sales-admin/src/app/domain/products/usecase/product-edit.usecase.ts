import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { ProductRepository } from "../repository/product.repository";
import { map } from 'rxjs/operators';
import { ProductStoreDto } from '../model/Product-store.dto';
import { ResponseIdDataDto } from '../../../core/entities/response-id-data.dto';

@Injectable({
    providedIn: 'root'
})
export class ProductEditUseCase implements UseCase<ProductStoreDto, ResponseIdDataDto> {

    constructor(private ProductRepository: ProductRepository) {

    }

    public execute(object: ProductStoreDto): Observable<ResponseIdDataDto> {
        const that = this;
        let responseIdDataDto: ResponseIdDataDto;
        return that.ProductRepository.edit(object.id, object).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}