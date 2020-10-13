import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { DataService } from "../../../core/base/data.service";
import { ResponseDataDto } from '../../../core/base/response-data.dto';
import { ResponseIdDataDto } from '../../../core/entities/response-id-data.dto';
import { ProviderDto } from '../model/provider.dto';
import { ProviderStoreDto } from '../model/provider-store.dto';

@Injectable({
    providedIn: 'root'
})
export class ProviderRepository {

    private resource = 'providers';

    constructor(private dataService: DataService){

    }

    getAll(): Observable<ResponseDataDto<ProviderDto[]>> {
        const that = this;
        return that.dataService.get(that.resource + '?size=10&page=1');
    }
    
    get(id: string): Observable<ResponseDataDto<ProviderDto>> {
        const that = this;
        return that.dataService.get(that.resource, id);
    }

    edit(id: string, object: ProviderStoreDto): Observable<ResponseDataDto<ResponseIdDataDto>> {
        const that = this;
        return that.dataService.put(that.resource, id, object);
    }

    add(object: ProviderStoreDto): Observable<ResponseDataDto<ResponseIdDataDto>> {
        const that = this;
        return that.dataService.post(that.resource, object);
    }

    remove(id: string): Observable<ResponseDataDto<ResponseIdDataDto>> { 
        const that = this;
        return that.dataService.delete(that.resource, id);
    }

}