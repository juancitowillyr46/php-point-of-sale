import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { CategoryRepository } from "../repository/category.repository";
import { map } from 'rxjs/operators';
import { CategoryDto } from '../model/category.dto';

@Injectable({
    providedIn: 'root'
})
export class CategoryGetUseCase implements UseCase<string, any> {

    constructor(private categoryRepository: CategoryRepository) {

    }

    public execute(id: string): Observable<any> {
        const that = this;
        let categoryDto: CategoryDto;

        return that.categoryRepository.get(id).pipe(map(res => {
            categoryDto = res.data;
            return categoryDto;
        }));
    }

}