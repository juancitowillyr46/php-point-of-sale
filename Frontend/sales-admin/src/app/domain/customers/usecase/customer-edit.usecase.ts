import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { CustomerRepository } from "../repository/customer.repository";
import { map } from 'rxjs/operators';
import { CustomerStoreDto } from '../model/customer-store.dto';
import { ResponseIdDataDto } from '../../../core/entities/response-id-data.dto';

@Injectable({
    providedIn: 'root'
})
export class CustomerEditUseCase implements UseCase<CustomerStoreDto, ResponseIdDataDto> {

    constructor(private customerRepository: CustomerRepository) {

    }

    public execute(object: CustomerStoreDto): Observable<ResponseIdDataDto> {
        const that = this;
        let responseIdDataDto: ResponseIdDataDto;
        return that.customerRepository.edit(object.id, object).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}