import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, RouterEvent } from '@angular/router';

declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  public pathComponent: string;
  public parentPath: string;
  public menu: any[] = [
    {
      module: 'Productos', 
      path: '',
      icon: '',  
      children: [
        {
          module: 'Categorias',
          path: ''
        },
        {
          module: 'Categorias',
          path: ''
        }
      ]
    }
  ];

  constructor(
    private route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit(): void {
    //$('.sidebar-menu').tree();
    const that = this;
    that.route.parent.url.subscribe(res=>{
      console.log(res[0].path);
      that.parentPath = res[0].path;
    });
    that.route.children[0].url.subscribe( res => {
      console.log(res[0].path);
    });
  }

  ngAfterViewInit(): void {
    const that = this;
    //$('.sidebar-menu').tree();
  }
  
}
