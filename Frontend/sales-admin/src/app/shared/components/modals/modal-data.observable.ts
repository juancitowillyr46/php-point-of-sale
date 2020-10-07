import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable()
export class ModalDataObservable {
    
    private data = new BehaviorSubject<any>(null);
    public currentData = this.data.asObservable();

    constructor() {}

    changeData(value: any) {
        const that = this;
        that.data.next(value);
    }

}