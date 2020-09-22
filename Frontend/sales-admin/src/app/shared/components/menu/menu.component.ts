import { Component, OnInit } from '@angular/core';
declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  constructor() { }

  ngOnInit(): void {
    //$('.sidebar-menu').tree();
  }

  ngAfterViewInit(): void {
    const that = this;
    //$('.sidebar-menu').tree();
  }
  
}
