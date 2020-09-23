import { AfterViewInit, Component, OnInit } from '@angular/core';
import { InitFunctionJsService } from '../../shared/services/init-function-js.service';

@Component({
  selector: 'app-configuration',
  templateUrl: './configuration.component.html',
  styleUrls: ['./configuration.component.css']
})
export class ConfigurationComponent implements OnInit, AfterViewInit {

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
