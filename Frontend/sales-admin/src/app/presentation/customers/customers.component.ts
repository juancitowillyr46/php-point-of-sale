import { AfterViewInit, Component, OnInit } from '@angular/core';
import { InitFunctionJsService } from 'src/app/shared/services/init-function-js.service';

@Component({
  selector: 'app-customers',
  templateUrl: './customers.component.html',
  styleUrls: ['./customers.component.css']
})
export class CustomersComponent implements OnInit, AfterViewInit {

  constructor(
    private initFunctionJsService: InitFunctionJsService
  ) { }

  ngOnInit(): void {
  }

  ngAfterViewInit(): void {
    const that = this;
    that.initFunctionJsService.executeFunction();
  }

}
