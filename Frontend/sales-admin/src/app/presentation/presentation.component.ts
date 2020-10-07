import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { MeDto } from '../domain/security/model/me.dto';
import { MeUseCase } from '../domain/security/usecase/me.usecase';
import { CommonRolesObservable } from '../shared/observables/common-roles.observable';
// import { CommonAuditStatusUseCase } from '../domain/commons/usecase/common-roles.usecase';
import { MeObservable } from '../shared/observables/me.observable';

@Component({
  selector: 'app-presentation',
  templateUrl: './presentation.component.html',
  styleUrls: ['./presentation.component.css']
})
export class PresentationComponent implements OnInit {

  public meDto: MeDto;

  constructor(
    private meUseCase: MeUseCase,
    private meObservable: MeObservable,
    private route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit(): void {
    const that = this;

    // that.meObservable.changeMe({
    //   email: 'jrodas@analytics.pe',
    //   permissions: [],
    //   role: 'vendedor',
    //   username: 'vendedor'
    // });

    that.meUseCase.execute().subscribe(res => {
      // console.log(res);
      that.meObservable.changeMe(res);
    }, (error) => {

    }, () => {
      
    });

    // console.log('Complete...');
    that.meObservable.currentData.subscribe( res => {
      if(res){
        that.meDto = res;
      }
    });

    // that.commonUseCase.execute().subscribe(res => {
    //   console.log(res);
    //   that.commonRolesObservable.changeData(res);
    // });

    // this.router.routerState.root.url.subscribe(res => {
    //   console.log(res);
    //   console.log(this.router.routerState.snapshot.url);
    // });
  }



}
