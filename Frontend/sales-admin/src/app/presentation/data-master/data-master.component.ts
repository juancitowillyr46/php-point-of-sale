import { AfterViewInit, Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { InitFunctionJsService } from '../../shared/services/init-function-js.service';
declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-data-master',
  templateUrl: './data-master.component.html',
  styleUrls: ['./data-master.component.css']
})
export class DataMasterComponent implements OnInit, AfterViewInit {

  public data: any;

  constructor(
    private initFunctionJsService: InitFunctionJsService,
    private route: ActivatedRoute
  ) { }

  ngOnInit(): void {
    const that = this;
    that.route.data.subscribe( res => {
      console.log(res);
      that.data = res;
    });
  }

  ngAfterViewInit(): void {
    const that = this;
    that.initFunctionJsService.executeFunction();
  }

}
