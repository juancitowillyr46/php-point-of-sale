import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-providers-representative',
  templateUrl: './providers-representative.component.html',
  styleUrls: ['./providers-representative.component.css']
})
export class ProvidersRepresentativeComponent implements OnInit {

  public data: any;

  constructor(
    private route: ActivatedRoute
  ) { }

  ngOnInit(): void {
    const that = this;
    that.route.data.subscribe( res => {
      that.data = res;
    });
  }

  ngAfterViewInit(): void {
    const that = this;
  }

}
