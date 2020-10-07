import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { MeObservable } from '../../observables/me.observable';

declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  public menus: any[] = [];
  public isParent: string = '';
  public isChildren: string = '';
  public parents: any[] = [];

  constructor(
    private meObservable: MeObservable,
    private route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit(): void {
    const that = this;
    that.meObservable.currentData.subscribe( res => {
      if(res){
        that.menus = res.permissions;
      }
    });
  }

  ngAfterViewInit(): void {
    const that = this;
    $('.sidebar-menu').tree();
  }
  
}
