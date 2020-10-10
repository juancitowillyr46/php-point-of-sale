import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { CategoryRepository } from "../repository/category.repository";
import { map } from 'rxjs/operators';
import { CategoryStoreDto } from '../model/category-store.dto';
import { ResponseIdDataDto } from '../../../core/entities/response-id-data.dto';

@Injectable({
    providedIn: 'root'
})
export class CategoryEditUseCase implements UseCase<CategoryStoreDto, ResponseIdDataDto> {

    constructor(private categoryRepository: CategoryRepository) {

    }

    public execute(object: CategoryStoreDto): Observable<ResponseIdDataDto> {
        const that = this;
        let responseIdDataDto: ResponseIdDataDto;
        return that.categoryRepository.edit(object.id, object).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}