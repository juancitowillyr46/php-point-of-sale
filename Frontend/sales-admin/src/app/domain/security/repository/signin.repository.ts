import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from '../../../../environments/environment';
import { DataService } from "../../../core/base/data.service";
import { ResponseDataDto } from '../../../core/base/response-data.dto';
import { SignInDto } from '../model/signin.dto';
import { AccessTokenDto } from '../model/access-token.dto';
import { map } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class SignInRepository {

    private resource = 'security/login';

    constructor(private dataService: DataService){

    }

    signIn(signIn: SignInDto): Observable<ResponseDataDto<AccessTokenDto>> {
        const that = this;
        return that.dataService.post(that.resource, signIn);
    }

}