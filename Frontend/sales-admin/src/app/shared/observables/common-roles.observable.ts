import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { CommonDto } from '../../domain/commons/model/common.dto';

@Injectable()
export class CommonRolesObservable {
    
    private data = new BehaviorSubject<any>(null);
    public currentData = this.data.asObservable();

    constructor() {

    }

    changeData(commonDto: any) {
        const that = this;
        that.data.next(commonDto);
    }

}