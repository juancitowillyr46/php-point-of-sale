import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { MeDto } from '../../domain/security/model/me.dto';

@Injectable()
export class MeObservable {
    
    private data = new BehaviorSubject<MeDto>(null);
    public currentData = this.data.asObservable();

    constructor() {

    }

    changeMe(value: MeDto) {
        const that = this;
        that.data.next(value);
    }

}