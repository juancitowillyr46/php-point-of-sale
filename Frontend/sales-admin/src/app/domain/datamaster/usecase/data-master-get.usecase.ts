import { Injectable } from '@angular/core';
import { UseCase } from '../../../core/base/use-case';
import { Observable } from "rxjs";
import { DataMasterRepository } from "../repository/data-master.repository";
import { map } from 'rxjs/operators';
import { DataMasterDto } from '../model/data-master.dto';


@Injectable({
    providedIn: 'root'
})
export class DataMasterGetUseCase implements UseCase<string, any> {

    constructor(private dataMasterRepository: DataMasterRepository) {

    }

    public execute(id: string): Observable<any> {
        const that = this;
        let dataMasterDto: DataMasterDto;

        return that.dataMasterRepository.get(id).pipe(map(res => {
            dataMasterDto = res.data;
            return dataMasterDto;
        }));
    }

}