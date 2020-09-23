import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-products-maintainer',
  templateUrl: './products-maintainer.component.html',
  styleUrls: ['./products-maintainer.component.css']
})
export class ProductsMaintainerComponent implements OnInit {

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
