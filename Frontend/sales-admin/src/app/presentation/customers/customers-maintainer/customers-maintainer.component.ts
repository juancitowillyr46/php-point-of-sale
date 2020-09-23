import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-customers-maintainer',
  templateUrl: './customers-maintainer.component.html',
  styleUrls: ['./customers-maintainer.component.css']
})
export class CustomersMaintainerComponent implements OnInit {

  public data: any;

  constructor(private route: ActivatedRoute) { }

  ngOnInit(): void {
    const that = this;
    that.route.data.subscribe( res => {
      console.log(res);
      that.data = res;
    });
  }

}
