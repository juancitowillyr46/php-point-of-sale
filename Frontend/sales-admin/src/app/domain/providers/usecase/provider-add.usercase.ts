import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { ProviderRepository } from "../repository/provider.repository";
import { map } from 'rxjs/operators';
import { ProviderStoreDto } from '../model/provider-store.dto';
import { ResponseIdDataDto } from '../../../core/entities/response-id-data.dto';

@Injectable({
    providedIn: 'root'
})
export class ProviderAddUseCase implements UseCase<ProviderStoreDto, ResponseIdDataDto> {

    constructor(private providerRepository: ProviderRepository) {

    }

    public execute(object: ProviderStoreDto): Observable<ResponseIdDataDto> {
        const that = this;
        let responseIdDataDto: ResponseIdDataDto;
        return that.providerRepository.add(object).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}