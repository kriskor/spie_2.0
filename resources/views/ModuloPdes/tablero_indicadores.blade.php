@extends('layouts.ModuloPdes')

@section('header')
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.light.css" type="text/css" />
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
<div class="row">
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
</div>
@endsection


@push('script-head')
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
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

  <script type="text/javascript">
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
        promptText: "Seleccionar pilar...",
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
        promptText: "Seleccionar meta...",
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
        promptText: "Seleccionar resultado...",
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


    });
  </script>
@endpush
