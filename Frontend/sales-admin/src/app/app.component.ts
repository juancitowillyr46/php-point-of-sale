import { AfterViewInit, Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { InitFunctionJsService } from './../app/shared/services/init-function-js.service';
declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {

  title = 'sales-admin';

  public data: any;

  constructor(
    private initFunctionJsService: InitFunctionJsService,
    private route: ActivatedRoute
  ) { }

  ngOnInit(): void {
    const that = this;
    that.route.data.subscribe( res => {
      that.data = res;
    });
  }


  ngAfterViewInit(): void {
    const that = this;
    that.initFunctionJsService.executeFunction();
  }


}
