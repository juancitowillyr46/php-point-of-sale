import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { GridSimpleService } from 'src/app/shared/components/grid-simple/grid-simple.service';
import { ModalDataObservable } from 'src/app/shared/components/modals/modal-data.observable';

@Component({
  selector: 'app-products-categories',
  templateUrl: './products-categories.component.html',
  styleUrls: ['./products-categories.component.css']
})
export class ProductsCategoriesComponent implements OnInit {

  public data: any;
  public progress: any;

  constructor(
    private route: ActivatedRoute,
    private gridSimpleService: GridSimpleService,
    private modalDataObservable: ModalDataObservable
  ) { }

  ngOnInit(): void {
    const that = this;
    that.route.data.subscribe( res => {
      that.data = res;
    });
  }

  ngAfterViewInit(): void {
    const that = this;
    that.gridSimpleService.loadGrid({
      endoPoint: '/categories',
      page: 1,
      size: 10,
      columns: [
        { "data": "id", "title": "Id", "width": '20%', "visible": false},
        { "data": "name", "title": "Nombre", "width": '20%'},
        { "data": "description", "title": "Descripción", "width": '20%'},
        { 
          "data": null, 
          "title": "", 
          "defaultContent": '<div style="text-align:right"><button type="button" class="btn btn-edit btn-primary btn-circle mb-2 mr-1"><i class="ti-pencil"></i> </button><button type="button" class="btn-remove btn btn-danger btn-circle mb-2"><i class="ti-trash"></i> </button></div>', 
          "width": '20%'
        }
      ]
    });
  }

  onClickRefresh(): void {
    const that = this;
    that.progress = true;
    that.gridSimpleService.reload();
  }

  onClickAdd(): void {
    const that = this;
    that.progress = true;
    // that.gridSimpleService.reload();
    that.modalDataObservable.changeData(null);
  }

}
