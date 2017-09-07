@extends('layouts.ModuloPdes')

@section('header')
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.light.css" type="text/css" />

  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

  <style media="screen">
  #chartdiv {
    width		: 100%;
    height		: 100%;
    font-size	: 11px;
  }
  </style>
@endsection

@section('content')
<div class="row bg-title p-t-0 p-b-0 m-b-5">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="page-title">TABLERO INDICADORES</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Tablero</a></li>
            <li class="active">Indicadores</li>
        </ol>
    </div>

    <!-- /.col-lg-12 -->
</div>
<!--row -->
<div class="row">
    <div class="col-lg-12">
        <div class="white-box p-10">
          <div class="row">
             <div class="col-lg-3 btn-group">
                 <div>
                 <button id="clear_filtro_pdes" type="button" class="btn btn-sm btn-info btn-circle">
                   <i class="fa fa-times"></i>
                 </button>
                 </div>
                <div  id="pilares"></div>
                <div id="metas"></div>
                <div id="resultados"></div>
                <div>
                <button id="aplicar_filtro" class="btn btn-sm btn-info waves-effect waves-light">
                  <span>Aplicar</span> <i class="fa fa-filter m-l-5"></i>
                </button>
                </div>

             </div>

             <div id="desc_resultado" class="col-lg-9 list-group-item-warning font-normal "> </div>
          </div>
        </div>
    </div>
</div>

<!--row -->
<div class="row">
    <div class="col-lg-4 col-md-12 ">
        <div class="white-box p-10">

            <h3 class="box-title">Lista de Indicadores
              <button id="graficar" class="btn btn-sm btn-info waves-effect waves-light pull-right">
              <span>Graficar</span> <i class="fa fa-bar-chart-o m-l-5"></i>
              </button>
            </h3>

            <div id="jqxgrid"></div>

        </div>
    </div>
    <div class="col-lg-8 col-md-12 ">
        <div class="white-box p-10">
            <h3 class="box-title">Grafica de indicadores</h3>
            <div style="height: 350px;">
              <div id="chartdiv"></div>

            </div>
        </div>
    </div>
    {{-- <div class="col-lg-12 col-md-12 ">
        <div class="white-box">
            <h3 class="box-title">Grafica progreso de Indicador</h3>
            <div class="stats-row">
                <div class="stat-item">
                    <h6>Usage</h6> <b>60GB</b></div>
                <div class="stat-item">
                    <h6>Space</h6> <b>320 GB</b></div>
                <div class="stat-item">
                    <h6>CPU</h6> <b>50%</b></div>
            </div>
            <div style="height: 280px;">
                <div id="placeholder" class="demo-placeholder"></div>
            </div>
        </div>
    </div> --}}

</div>
<!-- /.row -->



{{-- <div class="row">
    <div class="col-md-12">
        <div class="white-box ">





          <div class="btn-group dropdown">
            <div class="row">
              <div class="col-md-12">
                <button id="clear_filtro_pdes" type="button" class="btn btn-info btn-circle"><i class="fa ti-reload"></i></button>
                Limpiar Filtro
              </div>
                <div class="col-md-12">
                      <div class="form-group">
                          <label class="control-label" for="pilares">Pilares</label>
                          <div  id="pilares"></div>
                      </div>
                </div>
               <div class="col-md-12">
                      <div class="form-group">
                          <label class="control-label" for="metas">Metas</label>
                          <div id="metas"></div>
                      </div>
                </div>
              <div class="col-md-12">
                      <div class="form-group">
                          <label class="control-label" for="resultado">Resultados</label>
                          <div id="resultados"></div>
                      </div>
              </div>
              </div>
          </div>
        </div>
    </div>
</div> --}}

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
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.grouping.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.filter.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.edit.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.selection.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.sort.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxtabs.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.columnsresize.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.pager.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxdata.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxtooltip.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxcheckbox.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxinput.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxpanel.js"></script>


<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
<script src="http://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>

  <script type="text/javascript">

    var chartData = [];
    $(document).ready(function(){


      var pilaresSource =
      {
        dataType: "json",
        dataFields: [
          { name: 'nombre'},
          { name: 'id'}
        ],
        url: '{{ url('/modulopdes/ajax/listarpilares') }}',
        async: false
      };
      var pilaresAdapter = new $.jqx.dataAdapter(pilaresSource);

      $("#pilares").jqxComboBox(
      {
        source: pilaresAdapter,
        width: '100%',
        height: 25,
        promptText: "PILAR",
        displayMember: 'nombre',
        valueMember: 'id'
      });
      var metasSource =
      {
          dataType: "json",
          dataFields: [
            { name: 'nombre'},
            { name: 'pilar'},
            { name: 'id'}
          ],
          url:  '{{ url('/modulopdes/ajax/listarmetas') }}',
          async: false
      };
      var metasAdapter = new $.jqx.dataAdapter(metasSource);
      $("#metas").jqxComboBox(
      {
        width: '100%',
        height: 25,
        disabled: true,
        promptText: "META",
        displayMember: 'nombre',
        valueMember: 'id'
      });
      var resultadosSource =
      {
          dataType: "json",
          dataFields: [
            { name: 'nombre'},
            { name: 'meta'},
            { name: 'id'}
          ],
          url:  '{{ url('/modulopdes/ajax/listarresultados') }}'
      };
      var resultadosAdapter = new $.jqx.dataAdapter(resultadosSource);

      $("#resultados").jqxComboBox(
      {
        width: '100%',
        height: 25,
        disabled: false,
        source: resultadosAdapter,
        promptText: "Resultado",
        displayMember: 'nombre',
        valueMember: 'id'
      });

      $("#pilares").bind('select', function(event)
      {
        if (event.args)
            {
              $("#metas").jqxComboBox({ disabled: false});
              $("#resultados").jqxComboBox({ disabled: true});
              var value = event.args.item.value;
              metasSource.data = {pilar: value};
              metasAdapter = new $.jqx.dataAdapter(metasSource, {
                  beforeLoadComplete: function (records) {
                      var filteredRecords = new Array();
                      for (var i = 0; i < records.length; i++) {
                          if (records[i].pilar == value)
                              filteredRecords.push(records[i]);
                      }
                      return filteredRecords;
                  }
              });
              $("#metas").jqxComboBox({ source: metasAdapter, autoDropDownHeight: metasAdapter.records.length > 10 ? false : true});


            }
      });


      $("#metas").bind('select', function(event)
      {

        if (event.args)
            {
              $("#resultados").jqxComboBox({ disabled: false});
              var value = event.args.item.value;
              resultadosSource.data = {meta: value};
              resultadosAdapter = new $.jqx.dataAdapter(resultadosSource, {
                  beforeLoadComplete: function (records) {
                      var filteredRecords = new Array();
                      for (var i = 0; i < records.length; i++) {
                          if (records[i].meta == value)
                              filteredRecords.push(records[i]);
                      }
                      return filteredRecords;
                  }
              });
              $("#resultados").jqxComboBox({ source: resultadosAdapter, height: 25, autoDropDownHeight: resultadosAdapter.records.length > 10 ? false : true});

            }
      });

      $('#clear_filtro_pdes').click(function() {
              var pilaresSource =
              {
                dataType: "json",
                dataFields: [
                  { name: 'nombre'},
                  { name: 'id'}
                ],
                url: '{{ url('/modulopdes/ajax/listarpilares') }}',
                async: false
              };
              var pilaresAdapter = new $.jqx.dataAdapter(pilaresSource);
              $("#pilares").jqxComboBox({source: pilaresAdapter });
              $("#metas").jqxComboBox({ disabled: true});

              var resultadosSource =
              {
                  dataType: "json",
                  dataFields: [
                    { name: 'nombre'},
                    { name: 'meta'},
                    { name: 'id'}
                  ],
                  url:  '{{ url('/modulopdes/ajax/listarresultados') }}'
              };
              var resultadosAdapter = new $.jqx.dataAdapter(resultadosSource);
              $("#resultados").jqxComboBox({ source: resultadosAdapter, disabled: false, autoDropDownHeight:false });

      });




      //Configuracion de Grid Lista Indicadores
      $('#aplicar_filtro').click(function() {
        var idR = $("#resultados").val();
        $.ajax({
                url: "{{ url('/moduloindicadores/ajax/datosresultado') }}",
                data: { 'resultado': idR },
                type: "GET",
                dataType: 'json',
                success: function(date){
                  $.each(date, function(i, data) {
                        //var descripcion = "<b>"+data.pilar_nombre+"</b>: "+data.pilar_desc+"<br/>"+"<b>"+data.meta_nombre+"</b>: "+ data.meta_desc+"<br/><b>"+data.nombre+"</b>: "+data.descripcion;
                        var descripcion = "<b>"+data.nombre+"</b>: "+data.descripcion;
                        $("#desc_resultado").html(descripcion);
                  });
                },
                error:function(data){
                  console("Error recuperar los datos.");
                }
            });
          if(idR){
              var source =
              {
                  dataType: "json",
                  dataFields: [
                    { name: 'id_indicador',type: 'number' },
                    { name: 'id_resultado_indicador',type: 'number' },
                    { name: 'nombre', type: 'string' },
                    { name: 'punto_medicion', type: 'string' },
                    { name: 'vista_base_estadistica', type: 'string' }
                  ],
                  id: 'id_resultado_indicador',
                  data:{'resultado': idR},
                  url: "{{ url('/moduloindicadores/ajax/listaindicadores') }}"
              };
              var dataAdapter = new $.jqx.dataAdapter(source);
              $("#jqxgrid").jqxGrid({source: dataAdapter});
          }


       });

      var theme = 'light';
      var localizationobj = {};
      localizationobj.loadtext = "Cargando...";
      localizationobj.emptydatastring = "No hay registros que mostrar";
      localizationobj.groupsheaderstring = "Arrastre una columna para que se agrupe por ella";
      localizationobj.filterclearstring = "Limpiar";
      localizationobj.filterstring = "Filtro";
      localizationobj.groupbystring = "Agrupar por esta columna";
      localizationobj.groupremovestring = "Quitar de grupos";
      localizationobj.filterselectallstring = "(Seleccionar Todo)";
      localizationobj.filtershowrowstring = "Mostrar filas donde:";
      localizationobj.pagerrangestring = " de ";

      var cellGrafIcono = function (row, columnfield, value, defaulthtml, columnproperties) {
            var archivo = $('#jqxgrid').jqxGrid('getcellvalue', row, "vista_base_estadistica");
            if(archivo != '' && archivo != null){
                return '<i class="fa fa-bar-chart-o"></i>';
            }else{
                return '';
            }

        }
      $("#jqxgrid").jqxGrid(
        {
            width: '100%',
            height: 350,
            theme: theme,
            filterable: true,
            filtermode: 'excel',
            pageable: true,
            pagermode: 'simple',
            pagesize: 6,
            autorowheight:true,
            columnsresize:true,
            ready: function () {
              $("#jqxgrid").jqxGrid('localizestrings', localizationobj);
            },
            columns: [
              { text: '-', cellsrenderer: cellGrafIcono},
              { text: 'Tipo', datafield: 'punto_medicion', width: 130},
              { text: 'Nombre Indicador', datafield: 'nombre', columntype: 'textbox'}
            ]
        });




        $('#graficar').click(function() {
          var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
          if (rowindex > -1)
          {

              var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
              if(dataRecord.vista_base_estadistica != "" && dataRecord.vista_base_estadistica != null ){
              var idI = $("#resultados").val();
              $.ajax({
                      url: "{{url("/modulopdes/ajax/datosgraficaindicador")}}",
                      data: { '_token': $('input[name=_token]').val(),'vista': dataRecord.vista_base_estadistica },
                      type: "POST",
                      dataType: 'json',
                      success: function(date){
                        // $.each(date, function(i, data) {

                        // });
                        chartData = [];
                        date.forEach(function(d, i) {
                            chartData.push({
                                gestion: d.gestion,
                                valor: parseInt(d.valor, 10)
                            });
                        });

                        GRaficarDatos(chartData);


                      },
                      error:function(data){
                        console("Error recuperar los datos.");
                      }
                  });
              }else{
                  GRaficarDatos(null);
              }

            }else {
                  alert("Seleccione un indicador.");
            }

         });

    function GRaficarDatos(ele){
      //Configuracion de GRAFICAAAAAAs
      var chart = AmCharts.makeChart( "chartdiv", {
      "type": "serial",
      "theme": "none",
      "dataProvider": ele,

      "valueAxes": [ {
        "title": "Indicador nombre",
        "gridColor": "#FFFFFF",
        "gridAlpha": 0.2,
        "dashLength": 0
      } ],
      "gridAboveGraphs": true,
      "startDuration": 1,
      "graphs": [ {
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "fillAlphas": 0.8,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "valor"
      } ],
      "plotAreaFillAlphas": 0.1,
      "depth3D": 39,
      "angle": 45,
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "gestion",
      "categoryAxis": {
        "gridPosition": "start",
        "gridAlpha": 0,
        "tickPosition": "start",
        "tickLength": 20
      },
      "export": {
        "enabled": true
      }

      } );
    }





    });


  </script>
@endpush
