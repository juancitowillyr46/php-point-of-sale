import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { DataService } from "../../../core/base/data.service";
import { ResponseDataDto } from '../../../core/base/response-data.dto';
import { UserDto } from '../../users/model/user.dto';

@Injectable({
    providedIn: 'root'
})
export class UserRepository {

    private resource = 'users';

    constructor(private dataService: DataService){

    }

    getAll(): Observable<ResponseDataDto<UserDto[]>> {
        const that = this;
        return that.dataService.get(that.resource + '?size=10&page=1');
    }
    
    getById(id: string): Observable<ResponseDataDto<UserDto>> {
        const that = this;
        return that.dataService.get(that.resource + '/' + id);
    }

    

}