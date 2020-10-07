import { Component, OnInit } from '@angular/core';
import { Subscription } from 'rxjs';
import { environment } from 'src/environments/environment';
import { GridSimpleObservable } from './grid-simple.observable';
import { GridSimpleService } from './grid-simple.service';
declare var $: any;

@Component({
  selector: 'app-grid-simple',
  templateUrl: './grid-simple.component.html',
  styleUrls: ['./grid-simple.component.css']
})
export class GridSimpleComponent implements OnInit {

  public restApi: any = environment.REST_API;
  public grisSubscribe: Subscription;
  
  constructor(
    private gridSimpleObservable: GridSimpleObservable,
    private gridSimpleService: GridSimpleService
  ) { }

  ngOnInit(): void {
    const that = this;

  }

  ngAfterViewInit(): void { 

  }


}
