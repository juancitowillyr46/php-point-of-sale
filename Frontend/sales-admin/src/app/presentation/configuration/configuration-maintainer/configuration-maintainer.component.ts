import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-configuration-maintainer',
  templateUrl: './configuration-maintainer.component.html',
  styleUrls: ['./configuration-maintainer.component.css']
})
export class ConfigurationMaintainerComponent implements OnInit {

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
