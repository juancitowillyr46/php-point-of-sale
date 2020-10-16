import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { DataService } from "../../../core/base/data.service";
import { ResponseDataDto } from '../../../core/base/response-data.dto';
import { ResponseIdDataDto } from '../../../core/entities/response-id-data.dto';
import { PurchaseDto } from '../model/purchase.dto';
import { PurchaseStoreDto } from '../model/purchase-store.dto';
import { CommonDto } from '../../commons/model/common.dto';

@Injectable({
    providedIn: 'root'
})
export class PurchaseRepository {

    private resource = 'purchases';

    constructor(private dataService: DataService){

    }

    getAll(): Observable<ResponseDataDto<PurchaseDto[]>> {
        const that = this;
        return that.dataService.get(that.resource + '?size=10&page=1');
    }
    
    get(id: string): Observable<ResponseDataDto<PurchaseDto>> {
        const that = this;
        return that.dataService.get(that.resource, id);
    }

    edit(id: string, object: PurchaseStoreDto): Observable<ResponseDataDto<ResponseIdDataDto>> {
        const that = this;
        return that.dataService.put(that.resource, id, object);
    }

    add(object: PurchaseStoreDto): Observable<ResponseDataDto<ResponseIdDataDto>> {
        const that = this;
        return that.dataService.post(that.resource, object);
    }

    remove(id: string): Observable<ResponseDataDto<ResponseIdDataDto>> { 
        const that = this;
        return that.dataService.delete(that.resource, id);
    }

    getProducts(prodiverId: string): Observable<ResponseDataDto<CommonDto[]>> { 
        const that = this;
        return that.dataService.get(that.resource + '/' + prodiverId + '/products');
    }

}