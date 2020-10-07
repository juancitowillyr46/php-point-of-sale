import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { SecurityRepository } from "../repository/security.repository";
import { SignInDto } from "../model/signin.dto";
import { AccessTokenDto } from "../model/access-token.dto"; 
import { map } from 'rxjs/operators';
import { MeDto } from '../model/me.dto';

@Injectable({
    providedIn: 'root'
})
export class MeUseCase implements UseCase<any, MeDto> {

    constructor(private securityRepository: SecurityRepository) {

    }

    public execute(): Observable<MeDto> {
        const that = this;
        let meDto: MeDto;

        return that.securityRepository.me().pipe(map(res => {
            meDto = res.data;
            return meDto;
        }));
    }

}