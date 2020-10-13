import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { ProviderRepository } from "../repository/provider.repository";
import { map } from 'rxjs/operators';
import { ProviderDto } from '../model/provider.dto';

@Injectable({
    providedIn: 'root'
})
export class ProviderGetUseCase implements UseCase<string, any> {

    constructor(private providerRepository: ProviderRepository) {

    }

    public execute(id: string): Observable<ProviderDto> {
        const that = this;
        let ProductDto: ProviderDto;

        return that.providerRepository.get(id).pipe(map(res => {
            ProductDto = res.data;
            return ProductDto;
        }));
    }

}