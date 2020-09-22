import { AfterViewInit, Component, Input, OnInit } from '@angular/core';
declare var jquery: any;
declare var $: any;


@Component({
  selector: 'app-grid-simple',
  templateUrl: './grid-simple.component.html',
  styleUrls: ['./grid-simple.component.css']
})
export class GridSimpleComponent implements OnInit {

  constructor() { }

  ngOnInit(): void {
  }

  ngAfterViewInit(): void {
    const that = this;
    console.log('Grid componente load');
    $(document).ready(function(){
      "use strict";
      
      var table = $("#basic-datatable").removeAttr('width').DataTable({
          lengthChange: false,
          searching: false,
          colReorder: false,
          ordering: false,
  
          processing: true,
          serverSide: true,
          displayStart: 0,
          responsive: false,
          autoWidth: true,
          // scrollY: "300px",
          // scrollX: true,
          scrollCollapse: false,
          fixedColumns: false,
          ajax: {
              "url": "https://jsonplaceholder.typicode.com/posts?_page=0&_limit=5",
              "dataSrc": function(response){
                  response.draw = 0,
                  response.start = 0,
                  response.recordsTotal = 500;
                  response.recordsFiltered = 500;
                  response.data = response;
                  return response;
              },
              "type": "GET",
          },
          columns: [
              
              { "data": "title", "title": "Nombre", "width": '40%'},
              { "data": "title", "title": "Descripción", "width": '40%'},
              { 
                "data": null, 
                "title": "", 
                "defaultContent": '<div style="text-align:right"><button type="button" class="btn btn-edit btn-primary btn-circle mb-2 mr-1"><i class="ti-pencil"></i> </button><button type="button" class="btn-remove btn btn-danger btn-circle mb-2"><i class="ti-trash"></i> </button></div>', 
                "width": '10%'
              },
              // { "data": "title", "title": "Tipo"  },
              // { "data": "url", "title": "Estado"  },
              // { "data": "thumbnailUrl", "title": "Thumbnail"  },
              
              
          ],
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
          var info = table.page.info();
          table.ajax.url('https://jsonplaceholder.typicode.com/photos?_page='+(info.page + 1)+'&_limit=5');
          table.ajax.reload(null, false);       
      });
      
      
      $('#basic-datatable tbody').on( 'click', '.btn-edit', function () {
          var data = table.row( $(this).parents('tr') ).data();
          console.log(data);
          $('#exampleModal').modal({
              backdrop: 'static',
              show: true
          });
      });

      $('#basic-datatable tbody').on( 'click', '.btn-remove', function () {
        var alert = confirm('¿Estás seguro que deseas eliminar?');
      });

      $(document).on( 'click', '.btn-add', function () { 
        $('#exampleModal').modal({
          backdrop: 'static',
          show: true
        });
      });

      table.columns.adjust().draw();
      
    });
  }

}
