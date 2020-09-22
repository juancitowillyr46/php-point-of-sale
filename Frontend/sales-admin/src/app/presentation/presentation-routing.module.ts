import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './../presentation/login/login.component';
import { DataMasterComponent } from './../presentation/data-master/data-master.component';
import { UsersComponent } from './../presentation/users/users.component';
import { CategoriesComponent } from './../presentation/categories/categories.component';
import { ProductsComponent } from './../presentation/products/products.component';
import { PurchasesComponent } from './../presentation/purchases/purchases.component';
import { PresentationComponent } from './presentation.component';


const routes: Routes = [
  {
    path: '',
    component: PresentationComponent,
    children: [
      {
        path: 'data-master',
        component: DataMasterComponent,
        data: {title: 'Data maestra'},
        // resolve
      },
      {
        path: 'users',
        component: UsersComponent,
        data: {title: 'Usuarios'},
        // resolve
      },
      {
        path: 'categories',
        component: CategoriesComponent,
        data: {title: 'Categorias'},
        // resolve
      },
      {
        path: 'products',
        component: ProductsComponent,
        data: {title: 'Productos'},
        // resolve
      },
      {
        path: 'purchases',
        component: PurchasesComponent,
        data: {title: 'Compras'},
        // resolve
      },
      {
        path: 'login',
        component: LoginComponent
      }
    ]
  },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PresentationRoutingModule { }
