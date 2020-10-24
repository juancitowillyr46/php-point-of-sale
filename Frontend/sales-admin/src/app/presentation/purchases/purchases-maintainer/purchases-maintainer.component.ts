import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { PurchaseAllUseCase } from '../../../domain/purchases/usecase/purchase-all.usecase';
import { PurchaseRemoveUseCase } from '../../../domain/purchases/usecase/purchase-remove.usecase';

import { PurchaseDto } from '../../../domain/purchases/model/purchase.dto';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ModalPurchasesComponent } from '../../../shared/components/modals/modal-purchases/modal-purchases.component';
import { BaseTableComponent } from '../../../shared/components/tables/base-table.component';

@Component({
  selector: 'app-purchases-maintainer',
  templateUrl: './purchases-maintainer.component.html',
  styleUrls: ['./purchases-maintainer.component.css']
})
export class PurchasesMaintainerComponent extends BaseTableComponent implements OnInit {

  public dataRows: PurchaseDto[] = [];

  constructor(
    public route: ActivatedRoute,
    private purchaseAllUseCase: PurchaseAllUseCase,
    private purchaseRemoveUseCase: PurchaseRemoveUseCase,
    public modalService: NgbModal
  ) { 
    super(modalService, route);
    const that = this;
    that.modalComponent = ModalPurchasesComponent;
  }

  ngOnInit(): void {
    const that = this;
    that.getDataRoute();
    that.getActionStoreAndRemove();
  }


  getActionStoreAndRemove(): void {
    const that = this;
    that.currentActionStore.subscribe( res => {
      if(res === true){
        that.getPaginatedRows(that.currentPage);
      }
    });
    that.currentActionRemove.subscribe( res => {
      if(res){
        that.deleteRow(res);
      }
    });
  }


  getPaginatedRows(page: number): void {
    const that = this;
    that.loadData = true;
    that.purchaseAllUseCase.execute({
      page: page,
      size: that.totalPages
    }).subscribe(res => {
      that.loadData = false;
      that.dataRows = res.data.rows;
      that.currentPage = page;
      that.totalRows = res.data.totalRows;
      that.actionStore.next(null);
    }, (error) => {
      that.loadData = false;
    });
  }

  deleteRow(idPurchase: string): void {
    const that = this;
    that.loadData = true;
    that.purchaseRemoveUseCase.execute(idPurchase).subscribe( res => {
      that.loadData = false;
      that.actionRemove.next(null);
      that.getPaginatedRows(that.currentPage);
    }, (error) => {
      that.loadData = false;
    });
  }

}
