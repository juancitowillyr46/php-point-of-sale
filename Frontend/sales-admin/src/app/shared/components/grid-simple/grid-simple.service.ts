import { Injectable } from '@angular/core';
import { environment } from '../../../../environments/environment';
import { ModalDataObservable } from '../modals/modal-data.observable';
import { ModalDataRemoveObservable } from '../modals/modal-data-remove.observable';

import { GridPaginateDto } from './grid-paginate.dto';
declare var $: any;

@Injectable({
    providedIn: 'root'
})

export class GridSimpleService { 

    public ajaxUrl: any;
    public restApi: any = environment.REST_API;
    public dataTable: any;
    public dataModal: any;
    public dataStr: any;

    constructor(
        private modalDataObservable: ModalDataObservable,
        private modalDataRemoveObservable: ModalDataRemoveObservable
    ) {

    }


    public setPage(res: GridPaginateDto): void {
        const that = this;
        that.ajaxUrl = `${that.restApi}${res.endoPoint}?page=${res.page}&size=${res.size}`; 
    }

    /**
     * name
     */
    public loadGridLocal() {
        $("#grid-local").DataTable();
    }

    public loadGrid(res: GridPaginateDto): void {

        const that = this;

        that.setPage(res);
      
        $(document).ready(function(){
        "use strict";

            that.dataTable = $("#basic-datatable").removeAttr('width').DataTable({
                lengthChange: false,
                searching: false,
                colReorder: false,
                ordering: false,
                processing: true,
                serverSide: true,
                displayStart: 0,
                responsive: false,
                autoWidth: true,
                scrollCollapse: false,
                fixedColumns: false,
                retrieve: true,
                ajax: {
                    "url": that.ajaxUrl,
                    "headers": {
                        "Authorization": "Bearer " + localStorage.getItem('accessToken')
                    },
                    "dataSrc": function(response: any){
                    response.recordsTotal = response.data.totalRows;
                    response.recordsFiltered = response.data.totalRows;
                    return response.data.rows;
                    },
                    "error": function (xhr: any, error: any, thrown: any) {
                        console.log(xhr);
                        alert(JSON.stringify(error.status));
                    },
                    "type": "GET"
                },
                columns: res.columns,
                keys:!0,
                language:{
                    paginate:{
                        previous:"<i class='arrow_carrot-left'>",
                        next:"<i class='arrow_carrot-right'>"
                    }
                },
                drawCallback:function(){
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                }
            })
            .on('page.dt', function () {
                var info = that.dataTable.page.info();
                res.page = (info.page + 1);
                that.setPage(res);
                that.dataTable.ajax.url( that.ajaxUrl );
                that.dataTable.ajax.reload(null, false);       
            }).on('processing.dt', function (e, settings, processing) {
                // $('#processingIndicator').css('display', 'none');
                //      if (processing) {
                //      $(e.currentTarget).LoadingOverlay("show");
                //  } else {
                //      $(e.currentTarget).LoadingOverlay("hide", true);
                //  }
            });

            // $('#basic-datatable tbody').on( 'click', '.btn-edit', function () {
            //     var data = that.dataTable.row( $(this).parents('tr') ).data();
            //     // alert(JSON.stringify(data));
            //     // console.log(data);
            //     //that.data(JSON.stringify(data));
            //     // that.dataStr = JSON.stringify(data);

            //     $('#exampleModal').modal({
            //         backdrop: 'static',
            //         show: true
            //     });

            //     that.modalDataObservable.changeData(JSON.stringify(data));
            // });
        
            $('#basic-datatable tbody').on( 'click', '.btn-remove', function () {
                var data = that.dataTable.row( $(this).parents('tr') ).data();
                var alert = confirm('¿Estás seguro que deseas eliminar?');
                if(alert == true) {
                    that.dataStr = JSON.stringify(data);
                    that.modalDataRemoveObservable.changeData(that.dataStr);
                }
            });
        
            $(document).on( 'click', '.btn-add', function () { 
                $('#exampleModal').modal({
                    backdrop: 'static',
                    show: true
                });
            });
        
            that.dataTable.columns.adjust().draw();

        });
      
      
    }
    
    public reload(): void {
        const that = this;
        that.dataTable.ajax.reload(null, false);
    }

    public closeModal(): void {
        $(function(){
            $('#exampleModal').modal('hide');
        });
    }

    public getDataStr() : any {
        const that = this;
        return that.dataStr;
    }
         
    
}