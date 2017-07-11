@extends('layouts.SubsistemaPlanificacion')

@section('header')
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.darkblue.css" type="text/css" />
  <link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
  <style type="text/css">

  .jqx-grid-column-header{
    z-index:0!important;
  }
  .jqx-grid-content{
    z-index:0!important;
  }
  .jqx-grid{
    z-index:0!important;
  }
  #pagerjqxgrid{
    z-index:0!important;
  }


  </style>
@endsection

@section('content')

  <div class="container-fluid">
      <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h4 class="page-title">Planes territoriales</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                  <li><a href="#">Planes</a></li>
                  <li class="active">Planes territoriales</li>
              </ol>
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="white-box">
                  <div id="jqxgrid"> </div>
              </div>
          </div>
      </div>


 </div>
  <!-- /.container-fluid -->

@endsection

@push('script-head')
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxcore.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxbuttons.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxwindow.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxscrollbar.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxdatatable.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxlistbox.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxdropdownlist.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxmenu.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxcombobox.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.filter.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.edit.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.selection.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.columnsresize.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.pager.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxdata.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxtooltip.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxcheckbox.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxinput.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxpanel.js"></script>

  <script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
  <script src="/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" ></script>
  <script type="text/javascript">
      function activarMenu(id,sub){
          $('#'+id).addClass('active');
      }
      $(document).ready(function(){
          activarMenu(2,0);

          var theme = 'darkblue';
          var source =
          {
              dataType: "json",
              dataFields: [
                { name: 'id',type: 'number' },
                { name: 'denominacion', type: 'string' },
                { name: 'sigla', type: 'string' },
                { name: 'codigo', type: 'string' }
              ],
              id: 'id',
              url: "{{ url('/subsistemaplanificacion/ajax/listaentidadesterritoriales') }}"
          };
          var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                height: 510,
                //height: '100%',
                theme: theme,
                source: dataAdapter,
                filterable: true,
                showfilterrow: true,
                pageable: true,
                pagesize: 15,
                pagermode: 'simple',
                autorowheight:true,
                columnsresize:true,
                //autoheight: true,
                columns: [
                  { text: '#', datafield: 'id',  width: 50 },
                  { text: 'Nombre Entidad', datafield: 'denominacion',  width: 600 },
                  { text: 'Sigla', datafield: 'sigla', width: 160 },
                  { text: 'Codigo MEF', datafield: 'codigo' }
                ]
            });

            $("#jqxgrid").on('rowdoubleclick', function (event) {

                  var args = event.args;
                  var row = args.rowindex;
                  var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
                  var id = dataRecord.id;
                  location.href = "/subsistemaplanificacion/articulacion/" + dataRecord.id;

            });
      });
    </script>
@endpush
