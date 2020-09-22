import { AfterViewInit, Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { InitFunctionJsService } from '../../shared/services/init-function-js.service';
declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.css']
})
export class UsersComponent implements OnInit, AfterViewInit {

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
