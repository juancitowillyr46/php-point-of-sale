import { AfterViewInit, Component, OnInit } from '@angular/core';
// import { InitFunctionJsService } from '../../shared/services/init-function-js.service';
// declare var jquery: any;
// declare var $: any;

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit, AfterViewInit {

  constructor() { }

  ngOnInit(): void {
    
  }

  ngAfterViewInit(): void {
    const that = this;
    //that.initFunctionJsService.executeFunction();
  }

}
