import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { UserRepository } from "../repository/user.repository";
// import { AccessTokenDto } from "../model/access-token.dto"; 
import { map } from 'rxjs/operators';
// import { UserDto } from '../model/user.dto';
import { UserStoreDto } from '../model/user-store.dto';
import { ResponseIdDataDto } from 'src/app/core/entities/response-id-data.dto';

@Injectable({
    providedIn: 'root'
})
export class UserRemoveUseCase implements UseCase<string, ResponseIdDataDto> {

    constructor(private userRepository: UserRepository) {

    }

    public execute(id: string): Observable<ResponseIdDataDto> {
        const that = this;
        console.log(id);
        let responseIdDataDto: ResponseIdDataDto;
        return that.userRepository.remove(id).pipe(map(res => {
            responseIdDataDto = res.data;
            return responseIdDataDto;
        }));
    }

}