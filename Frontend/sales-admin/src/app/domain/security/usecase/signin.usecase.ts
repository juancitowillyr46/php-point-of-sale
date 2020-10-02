import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { SignInRepository } from "../repository/signin.repository";
import { SignInDto } from "../model/signin.dto";
import { AccessTokenDto } from "../model/access-token.dto"; 
import { map } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class SignInUseCase implements UseCase<SignInDto, AccessTokenDto> {

    constructor(private signInRepository: SignInRepository) {

    }

    public execute(signInDto: SignInDto): Observable<AccessTokenDto> {
        const that = this;
        let accessTokenData: AccessTokenDto = new AccessTokenDto();

        return that.signInRepository.signIn(signInDto).pipe(map(res => {
            console.log(res);
            accessTokenData.token = res.data.token;
            return accessTokenData;
        }));
    }

}