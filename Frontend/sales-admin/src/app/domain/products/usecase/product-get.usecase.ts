import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { ProductRepository } from "../repository/product.repository";
// import { AccessTokenDto } from "../model/access-token.dto"; 
import { map } from 'rxjs/operators';
import { ProductDto } from '../model/product.dto';

@Injectable({
    providedIn: 'root'
})
export class ProductGetUseCase implements UseCase<string, any> {

    constructor(private ProductRepository: ProductRepository) {

    }

    public execute(id: string): Observable<any> {
        const that = this;
        let ProductDto: ProductDto;

        return that.ProductRepository.get(id).pipe(map(res => {
            ProductDto = res.data;
            return ProductDto;
        }));
    }

}