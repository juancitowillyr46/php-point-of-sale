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

  constructor(
    private initFunctionJsService: InitFunctionJsService
  ) { }

  ngOnInit(): void {
    const that = this;
  }

  ngAfterViewInit(): void {
    const that = this;
    that.initFunctionJsService.executeFunction();
  }
}
