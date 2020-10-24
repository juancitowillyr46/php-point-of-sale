import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { DataService } from "../../../core/base/data.service";
import { ResponseDataDto } from '../../../core/base/response-data.dto';
import { ResponseIdDataDto } from '../../../core/entities/response-id-data.dto';
import { PurchaseDto } from '../model/purchase.dto';
import { PurchaseDetailStoreDto } from '../model/purchase-detail-store.dto';
import { CommonDto } from '../../commons/model/common.dto';

@Injectable({
    providedIn: 'root'
})
export class PurchaseDetailRepository {

    private resource = 'purchases';

    constructor(private dataService: DataService){

    }

    getAll(purchaseId: string): Observable<ResponseDataDto<PurchaseDto[]>> {
        const that = this;
        return that.dataService.get(that.resource +'/'+ purchaseId +'/detail' + '?size=10&page=1');
    }
    
    get(id: string): Observable<ResponseDataDto<PurchaseDto>> {
        const that = this;
        return that.dataService.get(that.resource, id);
    }

    edit(id: string, object: PurchaseDetailStoreDto): Observable<ResponseDataDto<ResponseIdDataDto>> {
        const that = this;
        return that.dataService.put(that.resource +'/'+ object.purchaseId +'/detail', id, object);
    }

    add(object: PurchaseDetailStoreDto): Observable<ResponseDataDto<ResponseIdDataDto>> {
        const that = this;
        return that.dataService.post(that.resource +'/'+ object.purchaseId +'/detail', object);
    }

    remove(id: string, object: PurchaseDetailStoreDto): Observable<ResponseDataDto<ResponseIdDataDto>> { 
        const that = this;
        return that.dataService.delete(that.resource +'/'+ object.purchaseId +'/detail', id);
    }

    getProducts(prodiverId: string): Observable<ResponseDataDto<CommonDto[]>> { 
        const that = this;
        return that.dataService.get(that.resource + '/' + prodiverId + '/products');
    }

}