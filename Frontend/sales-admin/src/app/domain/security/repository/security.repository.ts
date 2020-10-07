import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from '../../../../environments/environment';
import { DataService } from "../../../core/base/data.service";
import { ResponseDataDto } from '../../../core/base/response-data.dto';
import { SignInDto } from '../model/signin.dto';
import { MeDto } from '../model/me.dto';
import { AccessTokenDto } from '../model/access-token.dto';
import { map } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class SecurityRepository {

    private resource = 'security/';

    constructor(private dataService: DataService){

    }

    signIn(signIn: SignInDto): Observable<ResponseDataDto<AccessTokenDto>> {
        const that = this;
        return that.dataService.post(that.resource + 'login', signIn);
    }

    me(): Observable<ResponseDataDto<MeDto>> {
        const that = this;
        return that.dataService.get(that.resource + 'me');
    }

}