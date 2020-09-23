import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-products-categories',
  templateUrl: './products-categories.component.html',
  styleUrls: ['./products-categories.component.css']
})
export class ProductsCategoriesComponent implements OnInit {

  public data: any;

  constructor(
    private route: ActivatedRoute
  ) { }

  ngOnInit(): void {
    const that = this;
    that.route.data.subscribe( res => {
      console.log(res);
      that.data = res;
    });
  }

  ngAfterViewInit(): void {
    const that = this;
  }

}
