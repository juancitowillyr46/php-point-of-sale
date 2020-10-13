import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { CustomerRepository } from "../repository/customer.repository";
import { map } from 'rxjs/operators';
import { CustomerDto } from '../model/customer.dto';

@Injectable({
    providedIn: 'root'
})
export class CustomerGetUseCase implements UseCase<string, any> {

    constructor(private customerRepository: CustomerRepository) {

    }

    public execute(id: string): Observable<CustomerDto> {
        const that = this;
        let ProductDto: CustomerDto;

        return that.customerRepository.get(id).pipe(map(res => {
            ProductDto = res.data;
            return ProductDto;
        }));
    }

}