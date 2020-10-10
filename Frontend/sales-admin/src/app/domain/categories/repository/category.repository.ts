import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { DataService } from "../../../core/base/data.service";
import { ResponseDataDto } from '../../../core/base/response-data.dto';
import { ResponseIdDataDto } from '../../../core/entities/response-id-data.dto';
import { CategoryDto } from '../model/category.dto';
import { CategoryStoreDto } from '../model/category-store.dto';

@Injectable({
    providedIn: 'root'
})
export class CategoryRepository {

    private resource = 'categories';

    constructor(private dataService: DataService){

    }

    getAll(): Observable<ResponseDataDto<CategoryDto[]>> {
        const that = this;
        return that.dataService.get(that.resource + '?size=10&page=1');
    }
    
    get(id: string): Observable<ResponseDataDto<CategoryDto>> {
        const that = this;
        return that.dataService.get(that.resource, id);
    }

    edit(id: string, object: CategoryStoreDto): Observable<ResponseDataDto<ResponseIdDataDto>> {
        const that = this;
        return that.dataService.put(that.resource, id, object);
    }

    add(object: CategoryStoreDto): Observable<ResponseDataDto<ResponseIdDataDto>> {
        const that = this;
        return that.dataService.post(that.resource, object);
    }

    remove(id: string): Observable<ResponseDataDto<ResponseIdDataDto>> { 
        const that = this;
        return that.dataService.delete(that.resource, id);
    }

    

}