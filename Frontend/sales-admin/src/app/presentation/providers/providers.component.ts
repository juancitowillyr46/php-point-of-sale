import { Component, OnInit } from '@angular/core';
import { InitFunctionJsService } from 'src/app/shared/services/init-function-js.service';

@Component({
  selector: 'app-providers',
  templateUrl: './providers.component.html',
  styleUrls: ['./providers.component.css']
})
export class ProvidersComponent implements OnInit {

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
