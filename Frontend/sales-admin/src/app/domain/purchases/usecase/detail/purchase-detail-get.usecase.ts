import { Injectable } from '@angular/core';
import { UseCase } from '../../../../core/base/use-case';
import { Observable } from "rxjs";
import { PurchaseRepository } from "../../repository/purchase.repository";
import { map } from 'rxjs/operators';
import { PurchaseDto } from '../../model/purchase.dto';

@Injectable({
    providedIn: 'root'
})
export class PurchaseDetailGetUseCase implements UseCase<string, any> {

    constructor(private providerRepository: PurchaseRepository) {

    }

    public execute(id: string): Observable<PurchaseDto> {
        const that = this;
        let ProductDto: PurchaseDto;

        return that.providerRepository.get(id).pipe(map(res => {
            ProductDto = res.data;
            return ProductDto;
        }));
    }

}