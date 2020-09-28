import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { InitFunctionJsService } from 'src/app/shared/services/init-function-js.service';

@Component({
  selector: 'app-providers-maintainer',
  templateUrl: './providers-maintainer.component.html',
  styleUrls: ['./providers-maintainer.component.css']
})
export class ProvidersMaintainerComponent implements OnInit {

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
