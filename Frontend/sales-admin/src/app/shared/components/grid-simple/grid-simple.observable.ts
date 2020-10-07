import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
// import { MeDto } from '../../domain/security/model/me.dto';
import { GridPaginateDto } from './grid-paginate.dto';

@Injectable()
export class GridSimpleObservable {
    
    private data = new BehaviorSubject<GridPaginateDto>(null);
    public currentData = this.data.asObservable();

    constructor() {}

    changeMe(value: GridPaginateDto) {
        const that = this;
        that.data.next(value);
    }

}