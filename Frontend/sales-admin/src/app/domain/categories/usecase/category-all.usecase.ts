import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { CategoryRepository } from "../repository/category.repository";
import { map } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class CategoryAllUseCase implements UseCase<any, any> {

    constructor(private categoryRepository: CategoryRepository) {

    }

    public execute(): Observable<any> {
        const that = this;
        //let accessTokenData: AccessTokenDto = new AccessTokenDto();

        return that.categoryRepository.getAll().pipe(map(res => {
            console.log(res);
            return res;
            // accessTokenData.token = res.data.token;
            // return accessTokenData;
        }));
    }

}