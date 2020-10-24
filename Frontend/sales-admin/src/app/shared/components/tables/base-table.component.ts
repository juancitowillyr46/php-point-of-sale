import { Inject, Injectable } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { BehaviorSubject } from 'rxjs';

@Injectable()
export class BaseTableComponent {

    // Refresh Table
    public actionStore = new BehaviorSubject<any>(null);
    public currentActionStore = this.actionStore.asObservable();

    // Remove
    public actionRemove = new BehaviorSubject<any>(null);
    public currentActionRemove = this.actionRemove.asObservable();

    // Paginate
    public totalPages: number = 10;
    public totalRows: number = 0;
    public currentPage: number = 1;
    public loadData: any;
    public data: any;
    public progress: any;

    // Modal Ref
    public modalService: NgbModal = null;
    public modalComponent: any;
    public modalRef: any;

    public route:ActivatedRoute = null;

    constructor(
      @Inject(NgbModal) modalService: NgbModal,
      @Inject(ActivatedRoute) route: ActivatedRoute
    ) {
        
      const that = this;
      that.modalService = modalService;
      that.route = route;
      that.actionStore.next(true);
    }

    // Data de la ruta
    public getDataRoute() {
      const that = this;
      that.route.data.subscribe( res => {
        that.data = res;
      });
    }

    // Refresh Table
    public onClickRefresh(): void {
      const that = this;
      that.progress = true;
      that.actionStore.next(true);
    }

    // Modal Form
    public onClickModalStore(id: string): void {

      const that = this;

      that.modalRef = this.modalService.open(that.modalComponent, 
        {
          ariaLabelledBy: 'modal-basic-title', 
          backdrop: 'static', 
          size: 'lg'
        }
      );
      
      that.modalRef.result.then((result: any) => {
        console.log(result);
      }, (reason: any) => {
        console.log(reason);
        if(reason == 'DONE'){
          that.actionStore.next(true);
        }
      });

      that.modalRef.componentInstance.dataModal = {
        id: id
      };

    }

    // Remove Row
    public onClickRemove(id: string): void {
      const that = this;
      const success = confirm('¿Estás seguro que deseas eliminar el registro?');
      if(success){
        that.actionRemove.next(id);
      }
    }

    // Change Page
    public onClickPageChange(page: number) {
      const that = this;
      that.progress = true;
      that.currentPage = page;
      that.actionStore.next(true);
    }

}