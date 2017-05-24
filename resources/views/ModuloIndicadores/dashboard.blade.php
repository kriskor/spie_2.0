@extends('layouts.ModuloIndicadores')

@section('header')
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.light.css" type="text/css" />

@endsection

@section('content')

  <div class="container-fluid">

      <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="white-box">
                <div id="grafica_1" style="min-width: 280px; width: 100%;height: 500px; margin: 0 auto"></div>
            </div>
        </div>


      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="white-box">
                <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                            <div class="white-box">

                              <div id="grafica_2" style="min-width: 280px; width: 100%;height: 500px; margin: 0 auto"></div>


                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                            <div class="white-box">
                              <h3 class="box-title">Cantidad de Indicadores por Pilar y Punto de medición</h3>
                              <div id="jqxgrid_1"></div>
                            </div>
                        </div>
                </div>
            </div>

        </div>
      </div>

  </div>
  <!-- /.container-fluid -->

@endsection

@push('script-head')
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.sort.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.pager.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.selection.js"></script>
    <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.edit.js"></script>


  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>

  <script type="text/javascript">
      function activarMenu(id,sub){
          $('#'+id).addClass('active');
      }
      $(document).ready(function(){
          activarMenu('inicio',0);

// categories: ['PILAR 1', 'PILAR 2','PILAR 3', 'PILAR 4', 'PILAR 5','PILAR 6', 'PILAR 7','PILAR 8', 'PILAR 9', 'PILAR 10', 'PILAR 11', 'PILAR 12'],
// Create the chart
          $.ajax({
            url: "{{ url('/moduloindicadores/ajax/listaindicadorespilares') }}",
            data: { '_token': $('input[name=_token]').val(),id: null },
            type: "POST",
            dataType: 'json',
            success: function (data) {
                var res = [];
                $.each(data, function (i, item) {
                    res[i] = ([item.nombre, parseInt(item.total)]);
                });

                $('#grafica_1').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'CANTIDAD DE INDICADORES POR PILAR'
                    },
                    subtitle: {
                        text: '(SPIE: Módulo de Indicadores)'
                    },
                    xAxis: {
                        type: 'category',
                        labels: {
                            //rotation: -90,
                            style: {
                                fontSize: '11px',
                                fontFamily: 'Verdana, sans-serif'

                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad de Indicadores'
                        }
                    },

                    credits: {
                         enabled: false
                    },
                    legend: {
                        enabled: false
                    },

                        exporting: {
                            scale:2
                        },
                    series: [{
                    name: 'Nº Indicadores',
                    data: res,
                    dataLabels: {
                        enabled: true,
                        //rotation: -90,
                        color: '#000',
                        align: 'CENTER',
                        borderRadius: 7,
                        backgroundColor: 'rgba(252, 255, 197, 0.7)',
                        borderWidth: 1,
                        borderColor: '#AAA',
                        format: '{point.y:.f}', // one decimal
                        style: {
                            fontSize: '10px',
                            fontWeight: "bold",
                            fontFamily: 'Verdana, sans-serif'
                        }
                    },
                    color: '#278EA7',
                    pointWidth: 25
                }]
            });

            }
        });






            $.ajax({
                url: "{{ url('/moduloindicadores/ajax/listapuntomedicion') }}",
                data: { '_token': $('input[name=_token]').val(),id: null },
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    Highcharts.chart('grafica_2', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'INDICADORES POR PUNTO DE MEDICIÓN'
                        },
                        subtitle: {
                            text: '(SPIE: Módulo de Indicadores)'
                        },
                        xAxis: {
                            categories: data.pilar,
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Cantidad de Indicadores'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y}</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    //rotation: -90,
                                    color: '#000',
                                    align: 'CENTER',
                                    borderRadius: 7,
                                    backgroundColor: 'rgba(252, 255, 197, 0.7)',
                                    borderWidth: 1,
                                    borderColor: '#AAA',
                                    format: '{point.y:.f}', // one decimal
                                    style: {
                                        fontSize: '10px',
                                        fontWeight: "bold",
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            }
                        },
                        credits: {
                             enabled: false
                        },
                        legend: {
                            enabled: false
                        },

                        series: [{
                          data: data.total,
                          name: 'Indicadores',
                          color: '#278EA7',
                          pointWidth: 80
                        }]
                    });



                }

              });


              ///TABLAS
              var theme = 'light';
              var source_1 =
              {
                  dataType: "json",
                  dataFields: [
                    { name: 'cod_p',type: 'number' },
                    { name: 'nombre', type: 'string' },
                    { name: 'proceso', type: 'number' },
                    { name: 'producto', type: 'number' },
                    { name: 'resultado', type: 'number' }
                  ],
                  id: 'cod_p',
                  data:{'is': 1},
                  url: "{{ url('/moduloindicadores/ajax/listapilarpuntomedicion') }}"
              };
              var dataAdapter_1 = new $.jqx.dataAdapter(source_1);
              $("#jqxgrid_1").jqxGrid(
                {
                    width: '100%',
                    theme:theme,
                    source: dataAdapter_1,
                    sortable: true,
                    autoheight: true,

                    columns: [
                      { text: 'Pilares',datafield: 'nombre', width: 100 },
                      { text: 'Proceso', datafield: 'proceso',columngroup: 'clasificacionG',  align: 'center', cellsalign: 'right'},
                      { text: 'Producto', datafield: 'producto', columngroup: 'clasificacionG',  align: 'center', cellsalign: 'right'},
                      { text: 'Resultado', datafield: 'resultado', columngroup: 'clasificacionG',  align: 'center', cellsalign: 'right' }
                    ],
                    columngroups: [
                        { text: 'Clasificacion', align: 'center', name: 'clasificacionG' }
                    ]
                });

      });

    </script>
@endpush
