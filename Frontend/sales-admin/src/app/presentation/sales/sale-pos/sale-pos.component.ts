import { HttpClient, HttpParams } from '@angular/common/http';
import { Component, Injectable, OnInit } from '@angular/core';
import {Observable, of} from 'rxjs';
import {catchError, debounceTime, distinctUntilChanged, map, tap, switchMap} from 'rxjs/operators';

const WIKI_URL = 'http://localhost:8088/api/providers/e76b1daa-0c00-4285-80c3-c60d56a8b9ea/products';
const PARAMS = new HttpParams({
  fromObject: {
    action: 'opensearch',
    format: 'json',
    origin: '*'
  }
});

@Injectable()
export class WikipediaService {
  constructor(private http: HttpClient) {}

  search(term: string) {
    if (term === '') {
      return of([]);
    }

    return this.http
      .get(WIKI_URL, {params: PARAMS.set('search', term)}).pipe(
        map(response => response['data'])
      );
  }
}

export class Sale {
  detail: Product[] = [];
  public get total(): number {
    const that = this;
    let sumTotal: number = 0;
    that.detail.forEach(product => {
      sumTotal = sumTotal + product.subTotal;
    })
    return sumTotal;
  }
}

export class Product {
  id: string;
  productId: string;
  productName: string;
  quantity: number;
  price: number;
  purchaseId: string;

  public get subTotal(): number {
    const that = this;
    return that.quantity * that.price;
  }

  constructor() {
    const that = this;
    that.id = '';
  }

}

@Component({
  selector: 'app-sale-pos',
  templateUrl: './sale-pos.component.html',
  styleUrls: ['./sale-pos.component.css'],
  providers: [WikipediaService],
})
export class SalePosComponent implements OnInit {
 
  model: any;
  searching = false;
  searchFailed = false;

  public sale: Sale = new Sale();
  public products: Product[] = [];

  public vuelto: any = 0;

  constructor(private _service: WikipediaService) { }

  ngOnInit(): void {
  }

  onSelect(event: any) {
    const that = this;
    event.preventDefault();
    
    const product = new Product();
    product.id = 'dsdsd';
    product.productId = 'asdasd';
    product.productName = 'dsdasdas';
    product.purchaseId = 'asdasd';
    product.quantity = 1;
    product.price = 120;

    that.sale.detail.push(product);
    that.model = null;
  }

  search = (text$: Observable<string>) => {
    return text$.pipe(      
        debounceTime(200), 
        distinctUntilChanged(),
        tap(() => this.searching = true),
        switchMap( (searchText) =>  
          this._service.search(searchText).pipe(
          tap(() => this.searchFailed = false),
          catchError(() => {
            this.searchFailed = true;
            return of([]);
          }))
        ),
        catchError(() => {
          this.searchFailed = true;
          return of([]);
        }),
        tap(() => {
          this.searching = false;
          this.model = null;
        })              
    );                 
  }

  resultFormatBandListValue(value: any) {            
    return value.text;
  } 

  inputFormatBandListValue(value: any)   {
    if(value.text)
      return value.text
    return value;
  }

  onClickRemove(idx: number) { 
    const that = this;
    that.sale.detail.splice(idx, 1);
  }

}
