import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { UserRepository } from "../repository/user.repository";
// import { AccessTokenDto } from "../model/access-token.dto"; 
import { map } from 'rxjs/operators';
// import { UserDto } from '../model/user.dto';
import { UserStoreDto } from '../model/user-store.dto';

@Injectable({
    providedIn: 'root'
})
export class UserAddUseCase implements UseCase<UserStoreDto, any> {

    constructor(private userRepository: UserRepository) {

    }

    public execute(object: UserStoreDto): Observable<any> {
        const that = this;
        // let userDto: UserDto;

        return that.userRepository.add(object).pipe(map(res => {
            console.log(res);
            return res;
            // userDto = res.data;
            // return userDto;
        }));
    }

}