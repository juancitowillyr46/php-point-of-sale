import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { DataService } from "../../../core/base/data.service";
import { ResponseDataDto } from '../../../core/base/response-data.dto';
import { ResponseIdDataDto } from '../../../core/entities/response-id-data.dto';
import { DataMasterDto } from '../model/data-master.dto';
import { DataMasterStoreDto } from '../model/data-master-store.dto';

@Injectable({
    providedIn: 'root'
})
export class DataMasterRepository {

    private resource = 'data-master';

    constructor(private dataService: DataService){

    }

    getAll(): Observable<ResponseDataDto<DataMasterDto[]>> {
        const that = this;
        return that.dataService.get(that.resource + '?size=10&page=1');
    }
    
    get(id: string): Observable<ResponseDataDto<DataMasterDto>> {
        const that = this;
        return that.dataService.get(that.resource, id);
    }

    edit(id: string, object: DataMasterStoreDto): Observable<ResponseDataDto<ResponseIdDataDto>> {
        const that = this;
        return that.dataService.put(that.resource, id, object);
    }

    add(object: DataMasterStoreDto): Observable<ResponseDataDto<ResponseIdDataDto>> {
        const that = this;
        return that.dataService.post(that.resource, object);
    }

    remove(id: string): Observable<ResponseDataDto<ResponseIdDataDto>> { 
        const that = this;
        return that.dataService.delete(that.resource, id);
    }

    

}