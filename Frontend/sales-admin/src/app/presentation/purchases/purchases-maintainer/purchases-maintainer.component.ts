import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-purchases-maintainer',
  templateUrl: './purchases-maintainer.component.html',
  styleUrls: ['./purchases-maintainer.component.css']
})
export class PurchasesMaintainerComponent implements OnInit {

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
