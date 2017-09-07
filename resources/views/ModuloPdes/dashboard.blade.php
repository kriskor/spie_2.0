@extends('layouts.ModuloPdes')

@section('header')
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<style>
.bg-pilar {
    background: #2d4d6a none repeat scroll 0 0;
}
.bg-meta {
    background: #8DB4E2 none repeat scroll 0 0;
}

.text-0 {
  color: #fff;
}
#chartdiv {
	width	: 100%;
	height	: 65%;
}
#chartdivQuin {
	width	: 100%;
	height	: 65%;
}
#chartdivPilares {
  width: 100%;
  height: 100%;
}
#chartdivPilarPres {
	width		: 100%;
	height		: 500px;
	font-size	: 11px;
}

</style>
@endsection

@section('content')
  {{-- Titulo --}}
<div class="row bg-title p-t-0 p-b-0 m-b-5">

</div>

<!--row -->
<div class="row">
    <div class="col-lg-8 col-md-12 ">
        <div class="white-box p-10">
          <div class="row">

            <div class="col-lg-6 col-md-12">
              <h3 class="box-title">Programado Vs. Ejecutado Anual</h3>
              <div style="height: 350px;">
                <div id="chartdiv"></div>
                <table class="table table-condensed table-bordered">
                      <tbody>
                          <tr>
                            <td colspan="2" align="center" class="p-10"><strong>Gestión 2017</strong></td>
                          </tr>
                          <tr>
                              <td class="p-10"> Programado:</td>
                              <td align="right" class="p-10"><span id="programado_ano" class="number">Bs.0</span></td>
                          </tr>
                          <tr>
                              <td class="p-10"> Ejecutado</td>
                              <td align="right" class="p-10"><span id="ejecutado_ano" class="number">Bs.0</span></td>
                          </tr>
                      </tbody>
                  </table>
              </div>
            </div>


            <div class="col-lg-6 col-md-12 ">
                  <h3 class="box-title">Programado Vs. Ejecutado Quinquenio</h3>
                  <div style="height: 350px;">
                    <div id="chartdivQuin"></div>
                    <table class="table table-condensed table-bordered">
                          <tbody>
                              <tr>
                                <td colspan="2" align="center" class="p-10"><strong>Quinquenio(2016-2020)</strong></td>
                              </tr>
                              <tr>
                                  <td class="p-10"> Programado:</td>
                                  <td align="right" class="p-10"><span id="programado_quin" >Bs.0</span></td>
                              </tr>
                              <tr>
                                  <td class="p-10"> Ejecutado</td>
                                  <td align="right" class="p-10"><span id="ejecutado_quin">Bs.0</span></td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
            </div>



          </div>


        </div>
    </div>

    <div class="col-lg-4 col-md-12 ">
        <div class="white-box p-10">
            <h3 class="box-title">Presupuesto por pilares</h3>
            <div style="height: 350px;">
                <div id="chartdivPilares"></div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12 col-md-12 ">
        <div class="white-box p-10">
          <h3 class="box-title">Prespuesto Programado Vs. Ejecutado por Pilares (Gestion 2017)</h3>
          <div id="chartdivPilarPres"></div>



        </div>
    </div>
</div>














<!-- .row eta configuracion esta buena-->
{{-- <div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info bg-pilar fon p-10">

          <div class="row text-0">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <i data-icon="E" class="linea-icon linea-basic"></i>
                <h5 class="text-0 vb">TOTAL PILARES</h5>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <h1 class="text-0 counter text-right m-t-0 m-b-0">13</h1>
            </div>

          </div>

        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info bg-meta p-10">
          <div class="row text-0">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <i data-icon="E" class="linea-icon linea-basic"></i>
                <h5 class="text-0 vb">TOTAL METAS</h5>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h1 class="counter text-right text-0 m-t-0 m-b-0">64</h1>
            </div>

          </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info bg-theme p-10">
          <div class="row text-0">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <i data-icon="E" class="linea-icon linea-basic"></i>
                <h5 class="text-0 vb">TOTAL RESULTADOS</h5>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h1 class="counter text-right text-0 m-t-0 m-b-0"> 341 </h1>
            </div>

          </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info  p-10">
          <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <i data-icon="E" class="linea-icon linea-basic"></i>
                <h5 class="vb">TOTAL PRESUPUESTO ($us)</h5>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <h2 class="counter text-right m-t-0 m-b-0"> 42.394.670.970,00 </h2>
            </div>
          </div>
        </div>
    </div>
</div> --}}
<!--/.row -->
@endsection
@push('script-head')
  <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
  <script src="https://www.amcharts.com/lib/3/gauge.js"></script>
  <script src="https://www.amcharts.com/lib/3/pie.js"></script>
  <script src="https://www.amcharts.com/lib/3/serial.js"></script>
  <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
  <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
  <script src="http://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>

  <script type="text/javascript">
  var gaugeChart = AmCharts.makeChart( "chartdiv", {
    "type": "gauge",
    "theme": "light",
    "axes": [ {
      "axisThickness": 1,
      "axisAlpha": 0.2,
      "tickAlpha": 0.2,
      "valueInterval": 20,
      "bands": [ {
        "color": "#84b761",
        "endValue": 90,
        "startValue": 0
      }, {
        "color": "#fdd400",
        "endValue": 130,
        "startValue": 90
      }, {
        "color": "#cc4748",
        "endValue": 220,
        "innerRadius": "95%",
        "startValue": 130
      } ],
      "bottomText": "0 %",
      "bottomTextYOffset": -20,
      "endValue": 220
    } ],
    "arrows": [ {} ],
    "export": {
      "enabled": true
    }
  } );

  var gaugeChartQuin = AmCharts.makeChart( "chartdivQuin", {
    "type": "gauge",
    "theme": "light",
    "axes": [ {
      "axisThickness": 1,
      "axisAlpha": 0.2,
      "tickAlpha": 0.2,
      "valueInterval": 20,
      "bands": [ {
        "color": "#84b761",
        "endValue": 90,
        "startValue": 0
      }, {
        "color": "#fdd400",
        "endValue": 130,
        "startValue": 90
      }, {
        "color": "#cc4748",
        "endValue": 220,
        "innerRadius": "95%",
        "startValue": 130
      } ],
      "bottomText": "0 %",
      "bottomTextYOffset": -20,
      "endValue": 220
    } ],
    "arrows": [ {} ],
    "export": {
      "enabled": true
    }
  } );


  var chartPilares = AmCharts.makeChart( "chartdivPilares", {
  "type": "pie",
  "theme": "light",
   "dataLoader": {
     "url": " {{ url("/modulopdes/ajax/datosgraficapilares") }}",
     "format": "json"
   },

  "valueField": "total",
  "titleField": "pilar",
  "outlineAlpha": 0.4,
  "depth3D": 15,
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 30,
  "export": {
    "enabled": true
  }
} );


var chartPilarPres = AmCharts.makeChart("chartdivPilarPres", {
    "theme": "light",
    "type": "serial",
    "dataLoader": {
      "url": " {{ url("/modulopdes/ajax/datosgraficapilarespres") }}",
      "format": "json"
    },

    "valueAxes": [{
        "unit": "Bs.",
        "position": "left",
        "title": "Programado Vs. Ejecutado por Pilares",
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": "[[category]]: <b>Bs.[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "Programado",
        "type": "column",
        "valueField": "programado"
    }, {
        "balloonText": "[[category]]: <b>Bs.[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "Ejecutado",
        "type": "column",
        "clustered":false,
        "columnWidth":0.5,
        "valueField": "ejecutado"
    }],
    "plotAreaFillAlphas": 0.1,
    "chartCursor": {
            "pan": true,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "cursorAlpha": 0,
            "valueLineAlpha": 0.2
    },
    "categoryField": "pilar",
    "categoryAxis": {
        "gridPosition": "start"
    },
    "export": {
    	"enabled": true
     }

});

$.ajax({
        url: "{{url("/modulopdes/ajax/datosgraficaano")}}",
        data: { '_token': $('input[name=_token]').val() },
        type: "POST",
        dataType: 'json',
        success: function(date){

          date.forEach(function(d, i) {
            $("#programado_ano").html(formatNumber(d.programado));
            $("#ejecutado_ano").html(formatNumber(d.ejecutado));
            gaugeChartEle(d.procentaje);
          });


        },
        error:function(data){
          console("Error recuperar los datos.");
        }
    });

    $.ajax({
            url: "{{url("/modulopdes/ajax/datosgraficaquin")}}",
            data: { '_token': $('input[name=_token]').val() },
            type: "POST",
            dataType: 'json',
            success: function(date){

              date.forEach(function(d, i) {
                $("#programado_quin").html(formatNumber(d.programado));
                $("#ejecutado_quin").html(formatNumber(d.ejecutado));
                gaugeChartQuinEle(d.procentaje);
              });


            },
            error:function(data){
              console("Error recuperar los datos.");
            }
        });


  // set random value
  function gaugeChartEle(ele) {
    gaugeChart.arrows[ 0 ].setValue( ele );
    gaugeChart.axes[ 0 ].setBottomText( ele + "%" );
  }
  function gaugeChartQuinEle(ele) {
    gaugeChartQuin.arrows[ 0 ].setValue( ele );
    gaugeChartQuin.axes[ 0 ].setBottomText( ele + "%" );
  }


  function formatNumber(num, prefix) {
              prefix = prefix || '';
              num += '';
              var splitStr = num.split(".");
              var splitLeft = splitStr[0];
              var splitRight = splitStr.length > 1 ? "." + splitStr[1] : '';
              var regx = /(\d+)(\d{3})/;
              while (regx.test(splitLeft)) {
                  splitLeft = splitLeft.replace(regx, "$1" + "," + "$2");
              }
              return prefix + splitLeft + splitRight;
          }
  </script>
@endpush
