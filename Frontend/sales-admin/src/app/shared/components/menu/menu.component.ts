import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  public menus: any[] = [
    {
      title: 'Configuración', 
      path: '/modules/configuration/',
      order: 0,
      icon: 'bx-cog',  
      children: [
        {
          title: 'Data Maestra',
          path: 'maintainer'
        }
      ]
    },
    {
      title: 'Clientes', 
      path: '/modules/customers/',
      icon: 'bx-group',  
      children: [
        {
          title: 'Gestionar clientes',
          path: 'maintainer'
        }
      ]
    },
    {
      title: 'Productos', 
      path: '/modules/products/',
      icon: 'bxl-dropbox',  
      children: [
        {
          title: 'Categorias',
          path: 'categories'
        },
        {
          title: 'Productos',
          path: 'maintainer'
        },
        // {
        //   title: 'Stock',
        //   path: 'stock'
        // }
      ]
    },
    {
      title: 'Compras', 
      path: '/modules/purchases/',
      icon: 'bx-cart-alt',  
      children: [
        {
          title: 'Gestionar compras',
          path: 'maintainer'
        }
      ]
    },
    {
      title: 'Usuarios', 
      path: '/modules/users/',
      order: 0,
      icon: 'bx-user',  
      children: [
        {
          title: 'Gestionar usuarios',
          path: 'maintainer'
        }
      ]
    },
    {
      title: 'Proveedores', 
      path: '/modules/providers/',
      order: 0,
      icon: 'bxs-truck',  
      children: [
        {
          title: 'Proveedores',
          path: 'maintainer'
        },
        {
          title: 'Representantes',
          path: 'legal-representative'
        }
      ]
    },
    // {
    //   title: 'Vender', 
    //   path: '/modules/providers/',
    //   order: 0,
    //   icon: 'bx-store',  
    //   children: [
    //     {
    //       title: 'Proveedores',
    //       path: 'maintainer'
    //     },
    //     {
    //       title: 'Representantes',
    //       path: 'legal-representative'
    //     }
    //   ]
    // },
    // {
    //   title: 'Reportes', 
    //   path: '/modules/providers/',
    //   order: 0,
    //   icon: 'bxs-report',  
    //   children: [
    //     {
    //       title: 'Stock',
    //       path: 'maintainer'
    //     },
    //     {
    //       title: 'Kardex',
    //       path: 'legal-representative'
    //     }
    //   ]
    // },
    // {
    //   title: 'Employees', 
    //   path: '/modules/employees/',
    //   order: 0,
    //   icon: 'bxs-user',  
    //   children: [
    //     {
    //       title: 'Employees',
    //       path: 'maintainer'
    //     }
    //   ]
    // }
  ];

  public isParent: string = '';
  public isChildren: string = '';

  constructor(
    private route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit(): void {
    const that = this;
  }

  ngAfterViewInit(): void {
    const that = this;
    $('.sidebar-menu').tree();
  }
  
}
