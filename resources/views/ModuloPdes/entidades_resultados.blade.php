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
          <h5 class="page-title">Entidades Por Resultados</h5>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
              <li><a href="#">Entidad</a></li>
              <li class="active">Resultados</li>
          </ol>
      </div>
      <!-- /.col-lg-12 -->
</div>
<div class="row">

    <div class="col-lg-6 col-md-12 ">
        <div class="white-box p-10">
            <h3 class="box-title">Total Entidades por Resultados</h3>
            <div style="height: 350px;">
              <div id="chartdiv"></div>

            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 ">
        <div class="white-box p-10">
            <h3 class="box-title">Resultados / Entidades </h3>

            <div id="jqxgrid"></div>

        </div>
    </div>
</div>
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
  <script type="text/javascript" src="https://www.amcharts.com/lib/3/themes/light.js"></script>
  <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
  <script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
  <script src="http://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>

  <script type="text/javascript">

    var chartData = [];
    $(document).ready(function(){

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
      var source =
      {
          dataType: "json",
          dataFields: [

            { name: 'codigo',type: 'string' },
            { name: 'nombre', type: 'string' }
          ],
          id: '',
          url: "{{ url('/modulopdes/ajax/listaresultadosentidades') }}"
      };
      var dataAdapter = new $.jqx.dataAdapter(source);
      // $("#jqxgrid").jqxGrid({source: dataAdapter});
      $("#jqxgrid").jqxGrid(
        {
            source:dataAdapter,
            width: '100%',
            height: 350,
            theme: theme,
            groupable: true,
            filterable: true,
            filtermode: 'excel',
            //pageable: true,
            //pagermode: 'simple',
            //pagesize: 500,
            //autorowheight:true,
            //columnsresize:true,
            ready: function () {
              $("#jqxgrid").jqxGrid('localizestrings', localizationobj);
            },
            columns: [
              { text: 'Codigo', datafield: 'codigo', width: 95},
              { text: 'Nombre Entidad', datafield: 'nombre', columntype: 'textbox'}
            ]
        });




        $.ajax({
                url: "{{url("/modulopdes/ajax/totalresultadosentidades")}}",
                data: { '_token': $('input[name=_token]').val() },
                type: "POST",
                dataType: 'json',
                success: function(date){
                  // $.each(date, function(i, data) {

                  // });
                  chartData = [];
                  date.forEach(function(d, i) {
                      chartData.push({
                          resultado: d.codigo,
                          valor: parseInt(d.valor, 10)
                      });
                  });

                  GRaficarDatos(chartData);


                },
                error:function(data){
                  console("Error recuperar los datos.");
                }
            });



        function GRaficarDatos(ele){
          //Configuracion de GRAFICAAAAAAs
          var chart = AmCharts.makeChart( "chartdiv", {
          "type": "serial",
          "theme": "light",
          "dataProvider": ele,

          "valueAxes": [ {
            "title": "Nº de Entidades por resultado",
            "gridColor": "#FFFFFF",
            "gridAlpha": 0.2,
            "dashLength": 0
          } ],
          "gridAboveGraphs": true,
          "startDuration": 1,
          "graphs": [ {
            "balloonText": "[[category]]: <b>[[value]] Entidades</b>",
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
          "categoryField": "resultado",
          "categoryAxis": {
            "labelRotation": 45,
            "gridPosition": "start",
            "gridAlpha": 0,
            "tickPosition": "start",
            "tickLength": 20
          },
          "chartScrollbar": {
        		"enabled": true,
        	},
          "export": {
            "enabled": false
          }

          } );
        }


    });


  </script>
@endpush
