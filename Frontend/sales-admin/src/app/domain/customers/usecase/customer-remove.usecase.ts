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
export class CustomerRemoveUseCase implements UseCase<string, ResponseIdDataDto> {

    constructor(private customerRepository: CustomerRepository) {

    }

    public execute(id: string): Observable<ResponseIdDataDto> {
        const that = this;
        console.log(id);
        let responseIdDataDto: ResponseIdDataDto;
        return that.customerRepository.remove(id).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}