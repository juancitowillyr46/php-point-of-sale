import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { InitFunctionJsService } from 'src/app/shared/services/init-function-js.service';

@Component({
  selector: 'app-sales',
  templateUrl: './sales.component.html',
  styleUrls: ['./sales.component.css']
})
export class SalesComponent implements OnInit {

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
