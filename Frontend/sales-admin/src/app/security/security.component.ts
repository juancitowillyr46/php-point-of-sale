import { Component, OnInit } from '@angular/core';
// import { InitFunctionJsService } from '../shared/services/init-function-js.service';
declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-security',
  templateUrl: './security.component.html',
  styleUrls: ['./security.component.css']
})
export class SecurityComponent implements OnInit {

  constructor() { }

  ngOnInit(): void { 
    
  }

  ngAfterViewInit(): void {
    const that = this;
    $('#preloader').fadeOut('slow', function () {
      $(this).remove();
    });
  }
}
