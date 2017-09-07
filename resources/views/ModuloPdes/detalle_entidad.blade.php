@extends('layouts.ModuloPdes')

@section('header')
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.light.css" type="text/css" />
<link href="/plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />


<style media="screen">
#chartdivP {
  width		: 100%;
  height		: 100%;
  font-size	: 11px;
}
#chartdivM {
  width		: 100%;
  height		: 100%;
  font-size	: 11px;
}

#chartdivR {
  width		: 100%;
  height		: 100%;
  font-size	: 11px;
}
</style>
@endsection

@section('content')
  <div class="row bg-title p-t-0 p-b-0 m-b-5">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="page-title">Detalle Entidad</h5>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
              <li><a href="#">Detalle</a></li>
              <li class="active">Entidad</li>
          </ol>
      </div>
      <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="white-box p-10">
          <div class="row">
            <select id="entidad_sel" class="select2"  name="entidad_sel" style="width:100%;" tabindex="1">
                  <option value=""></option>

                  @foreach($entidades as $e)
                        <option value="{{$e->id}}">{{$e->nombre}} </option>
                  @endforeach
            </select>

          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-12 ">
        <div class="white-box p-10">
            <h3 class="box-title">Pilares articulados</h3>
            <div style="height: 330px;">
              <div id="chartdivP"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 ">
        <div class="white-box p-10">
            <h3 class="box-title">Metas articuladas</h3>

            <div style="height: 330px;">
              <div id="chartdivM"></div>
            </div>

        </div>
    </div>
    <div class="col-lg-4 col-md-12 ">
        <div class="white-box p-10">
            <h3 class="box-title">Resultados Articulados</h3>
            <div style="height: 330px;">
              <div id="chartdivR"></div>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-12 ">
        <div class="white-box p-10">
            <h3 class="box-title">Lista de Entidades responsables</h3>
            <div style="height: 330px;">
              <select id="filtro_pdes" name="filtro_pdes" style="width:50%;" tabindex="4">
                        <option value="1">Pilar</option>
                        <option value="2">Meta</option>
                        <option value="3">Resultado</option>
              </select>

              <div id="jqxgrid"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 ">
        <div class="white-box p-10">
            <h3 class="box-title">Presupuesto Total Programado</h3>

            <div style="height: 330px;">

            </div>

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
  <script src="/plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
  <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
  <script src="https://www.amcharts.com/lib/3/serial.js"></script>
  <script type="text/javascript" src="https://www.amcharts.com/lib/3/themes/light.js"></script>
  <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
  <script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
  <script src="http://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>
  <script type="text/javascript">

  var chartData = [];

  $(document).ready(function(){
    $(".select2").select2({
       placeholder: 'Seleccione la Entidad'
    });


  $('#entidad_sel').on('change',function() {
      $.ajax({
            url: "{{url("/modulopdes/ajax/graficaentidadpilares")}}",
            data: { '_token': $('input[name=_token]').val(),'entidad': $(this).val() },
            type: "POST",
            dataType: 'json',
            success: function(date){
              chartData = [];
              date.forEach(function(d, i) {
                  chartData.push({
                      pilar: d.pilar,
                      valor: parseInt(d.valor, 10)
                  });
              });

              graficaPilares(chartData);


            },
            error:function(data){
              console("Error recuperar los datos.");
            }
        });



        $.ajax({
              url: "{{url("/modulopdes/ajax/graficaentidadmetas")}}",
              data: { '_token': $('input[name=_token]').val(),'entidad': $(this).val() },
              type: "POST",
              dataType: 'json',
              success: function(date){
                chartData = [];
                var tm = 0;
                date.forEach(function(d, i) {
                    chartData.push({
                        dato: d.sigla_p+'.'+d.sigla_m,
                        valor: parseInt(d.valor, 10)
                    });
                    tm++;
                });
//                $('#total_pilares').val(tp);

                graficaMetas(chartData);


              },
              error:function(data){
                console("Error recuperar los datos.");
              }
          });


          $.ajax({
                url: "{{url("/modulopdes/ajax/graficaentidadresultados")}}",
                data: { '_token': $('input[name=_token]').val(),'entidad': $(this).val() },
                type: "POST",
                dataType: 'json',
                success: function(date){
                  chartData = [];
                  var tr = 0;
                  date.forEach(function(d, i) {
                      chartData.push({
                          dato: d.sigla_p+'.'+d.sigla_m+'.'+d.sigla_r,
                          valor: parseInt(d.valor, 10)
                      });
                      tr++;
                  });
  //                $('#total_pilares').val(tp);

                  graficaResultados(chartData);


                },
                error:function(data){
                  console("Error recuperar los datos.");
                }
            });


            var source =
            {
                dataType: "json",
                dataFields: [
                  { name: 'codigo',type: 'string' },
                  { name: 'subentidad', type: 'string' }
                ],
                id: '',
                data:{'opcion':1,'entidad': $(this).val() },
                url: "{{ url('/modulopdes/ajax/detallesubentidad') }}"
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid({source: dataAdapter});



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

   $("#jqxgrid").jqxGrid(
     {
         //source:dataAdapter,
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
           { text: 'Codigo', datafield: 'codigo', width: 100},
           { text: 'Nombre Entidad', datafield: 'subentidad', columntype: 'textbox'}
         ]
     });

  // $('#entidad_sel').on('change',function() {
  //
  //  });

   function graficaPilares(ele){

     //Configuracion de GRAFICAAAAAAs
     var chart = AmCharts.makeChart( "chartdivP", {
     "type": "serial",
     "theme": "light",
     "dataProvider": ele,

     "valueAxes": [ {
       "title": "Nº de acciones",
       "gridColor": "#FFFFFF",
       "gridAlpha": 0.2,
       "dashLength": 0
     } ],
     "gridAboveGraphs": true,
     "startDuration": 1,
     "graphs": [ {
       "balloonText": "[[category]]: <b>[[value]] acciones</b>",
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
     "categoryField": "pilar",
     "categoryAxis": {
       "labelRotation": 45,
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


   function graficaMetas(ele){

     //Configuracion de GRAFICAAAAAAs
     var chart = AmCharts.makeChart( "chartdivM", {
     "type": "serial",
     "theme": "light",
     "dataProvider": ele,

     "valueAxes": [ {
       "title": "Nº de acciones",
       "gridColor": "#FFFFFF",
       "gridAlpha": 0.2,
       "dashLength": 0
     } ],
     "gridAboveGraphs": true,
     "startDuration": 1,
     "graphs": [ {
       "balloonText": "[[category]]: <b>[[value]] acciones</b>",
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
     "categoryField": "dato",
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

   function graficaResultados(ele){

     //Configuracion de GRAFICAAAAAAs
     var chart = AmCharts.makeChart( "chartdivR", {
     "type": "serial",
     "theme": "light",
     "dataProvider": ele,

     "valueAxes": [ {
       "title": "Nº de acciones",
       "gridColor": "#FFFFFF",
       "gridAlpha": 0.2,
       "dashLength": 0
     } ],
     "gridAboveGraphs": true,
     "startDuration": 1,
     "graphs": [ {
       "balloonText": "[[category]]: <b>[[value]] acciones</b>",
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
     "categoryField": "dato",
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
