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
export class ProviderRemoveUseCase implements UseCase<string, ResponseIdDataDto> {

    constructor(private providerRepository: ProviderRepository) {

    }

    public execute(id: string): Observable<ResponseIdDataDto> {
        const that = this;
        console.log(id);
        let responseIdDataDto: ResponseIdDataDto;
        return that.providerRepository.remove(id).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}