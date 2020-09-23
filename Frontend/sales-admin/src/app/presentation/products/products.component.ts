import { AfterViewInit, Component, Input, OnInit } from '@angular/core';
import { InitFunctionJsService } from 'src/app/shared/services/init-function-js.service';
declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit, AfterViewInit {

  constructor(
    private initFunctionJsService: InitFunctionJsService,
  ) { }

  ngOnInit(): void {

  }

  ngAfterViewInit(): void {
    const that = this;
    that.initFunctionJsService.executeFunction();
  }

}
