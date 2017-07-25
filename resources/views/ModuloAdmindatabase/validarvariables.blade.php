@extends('layouts.ModuloAdmindatabase')

@section('header')
  <link href="/inspinia2.5/css/plugins/select2/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
  <style>
  .redgrid:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected){
              color:#fff;
              background-color: #e83636;
      }

  .greegrid:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected){
          color:#fff;
          background-color: #01DF2A;
  }

  .yellow:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected){
          color:#fff;
          background-color: #FFD800;
  }



  </style>
@endsection

@section('content')
  <!---AQUI VIENE EL TITULO--->
  <div class="container-fluid">
      <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h4 class="page-title">Inicio</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                  <li><a href="#">Variables</a></li>
                  <li class="active">Validar Datos</li>
              </ol>
          </div>
          <!-- /.col-lg-12 -->
      </div>


      <!---DESDE AQUI VIENE EL CONTENIDO--->
      <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="white-box">

                <div class="row">
                    <div class="col-lg-12 col-md-12">

                      <div class="form-group">
                        <h4 class="page-title">Variables Estadiscas</h4>
                        <select id="variable_sel" class="form-control m-b select2" name="nivel_sel" style="width:100%;" tabindex="4">
                              <option value="">Seleccionar</option>
                              @foreach($variables as $variable)
                                  <option value="{{$variable->id_variable_estadistica}}">
                                    {{$variable->nombre_variable_estadistica}}
                                 </option>
                              @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                      <table class="table-striped" style="width: 100%;border-collapse:collapse;margin: 2px;">
                        <thead>
                          <tr>
                              <th>Variable </th>
                              <th>Atributo </th>
                              <th>Action</th>
                          </tr>
                          </thead>
                          <tbody id="lt-dimensiones">

                          </tbody>
                        </table>
                    </div>
                    <div class="col-lg-7 col-md-7">
                      <div id="menuauxcontenido" class="row-fluid" style="visibility: hidden;">
                        <div id='jqxMenu'>
                          <ul>
                            <li><a href="#">+<img alt=":" title="Dashboard" src="/assets_admin_three/img/gear.png" style="height: 25px;" align="absmiddle"/>Validador</a>
                                <ul style='width: 250px;'>
                                    <li style="text-align: left;"><a id="v_observacion" class="" href="javascript:void(0)" style="width: 100px; font-size: 8.5px;padding: 7px 95px 7px 3px;">Ver Observacion</a>
                                    </li>
                                    <li style="text-align: left;"><a id="v_relacionar" class="" href="javascript:void(0)" style="width: 100px; font-size: 8.5px;padding: 7px 95px 7px 3px;">Corregir Relacion </a>
                                    </li>
                                    <li style="text-align: left;"><a id="v_mantener" class="" href="javascript:void(0)" style="width: 100px; font-size: 8.5px;padding: 7px 95px 7px 3px;">Mantener dato origen </a>
                                    </li>
                                    <!--li style="text-align: left;"><a id="v_guardar_aplicar" class="" href="javascript:void(0)" style="width: 100px; font-size: 8.5px;padding: 7px 80px 7px 3px;">Guardar y Aplicar Validacion</a>
                                    </li-->

                                </ul>
                            </li>
                            <li><a id="v_guardar_aplicar"  href="#">+<img alt=":" title="Dashboard" src="/assets_admin_three/img/upload.png" style="height: 25px;" align="absmiddle"/>Guardar y Aplicar Validacion</a>
                            </li>

                          </ul>
                        </div>
                      </div>
                      <div id="jqxgrid"></div>
                      <div id="ordersGrid"></div>
                    </div>
                </div>
              </div>
          </div>
      </div>

  </div>

  <div id="window" style="display:none;">
      <div id="customWindowHeader">
          <span id="captureContainer" style="float: left">Seleccione Clasificador </span>
      </div>
      <div id="customWindowContent" style="overflow: hidden">
        <form role="fromValidatos" id="fromValidatos" method="POST">
        {{ csrf_field() }}

          <input type="hidden" id="var_estadisica_sel" name="var_estadisica_sel">
          <input type="hidden" id="dimension_campo_sel" name="dimension_campo_sel">

          <div style="margin: 10px">
              Validando : <label id="campo" for=""></label>
              <br/>
              Descripcion : <label id="info" for=""></label>
              <br/>
              Clasificador :

              {{-- <input type="text" style="width: 175px; border: 1px solid #aaa" id="searchTextInput" /> --}}

              <select id="clasificador_sel" name="clasificador_sel" >
                    <option value=""></option>
                    @foreach($validadores as $val)
                        <option value="{{$val->nombre_clasificador}}">{{$val->titulo}}
                       </option>
                    @endforeach
                    {{-- <option value="clasificador_entidades">Clasificador_Entidades</option>
                    <option value="clasificador_departamentos">Clasificador_Departamentos</option>
                    <option value="clasificador_provincias">Clasificador_Provincias</option>
                    <option value="clasificador_municipios">Clasificador_Municipios</option> --}}
              </select>
              <div style="float: right">
                  <input type="button" value="Iniciar" style="margin-bottom: 5px;" id="searchTextButton" /><br />
                  <input type="button" value="Salir" id="cancelButton" />
              </div>
          </div>
          </form>

      </div>
  </div>
  <!-- /.container-fluid -->

@endsection

@push('script-head')
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxcore.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxwindow.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxbuttons.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxcheckbox.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxscrollbar.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxlistbox.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxdropdownlist.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxcombobox.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxpanel.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxmenu.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.pager.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.edit.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.filter.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.selection.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.columnsresize.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxgrid.aggregates.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxdata.js"></script>


  <script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
  <script src="/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" ></script>
  <script type="text/javascript">
      function activarMenu(id,sub){
          $('#'+id).addClass('active');
      }
      $(document).ready(function(){
          activarMenu('home',0);
          $(".select2").select2().attr('style','display:block; position:absolute; bottom: 0; left: 0; clip:rect(0,0,0,0);');

          $('#variable_sel').on('change',function() {
            var id = $(this).val();
            $.ajax({
                url: "{{ url('/admindatabase/ajax/listadimensionesvarestadisica') }}",
                data: {'_token': $('input[name=_token]').val(),'id': id},
                type: "GET",
                dataType: 'json',
                success: function(data){
                  $("#lt-dimensiones").html('');

                  $.each(data, function(index,d) {
                      //alert(d.id_dimension);
                      var html ='<tr>'+
                                  '<td>'+d.nombre_dimension+'</td>'+
                                  '<td>'+d.atributo_tabla_origen+'</td>';
                      html +='<td><button id="validador" onclick="validarconf('+d.id_variable_estadistica+','+d.id_dimension+',\''+d.atributo_tabla_origen+'\',\''+d.nombre_dimension+'\')" class="btn btn-success btn-xs" type="button"><i class="fa fa-upload"></i></button></td></tr>';

                      $("#lt-dimensiones").append(html);
                  });


                }
            });
          });



          function createElements() {
              var jqxWidget = $('#variable_sel');
              var offset = jqxWidget.offset();
              $('#window').jqxWindow({
                  position: { x: offset.left + 50, y: offset.top + 50 },
                  resizable: false,
                  isModal: true,
                  autoOpen: false,
                  cancelButton: $('#cancelButton'),
                  width: 450,
                  height: 140,
                  minWidth: 200,
                  minHeight: 110,
                  modalOpacity: 0.01,
                  initContent: function () {
                        $('#searchTextButton').jqxButton({ width: '80px', disabled: true });
                        $('#cancelButton').jqxButton({ width: '80px', disabled: false });
                 }
              });
              $('#window').jqxWindow('focus');
          }
          createElements();
          $("#jqxMenu").jqxMenu({
            width: '100%',
            height: '35px'
          });

          ////otras funciones
          $('#clasificador_sel').change(function(){
            if ($('#clasificador_sel').val() !== '') {
                $('#searchTextButton').jqxButton('disabled', false);
            } else {
                $('#searchTextButton').jqxButton('disabled', true);
            }
          });


          //////fin otras funciones

          $('#searchTextButton').on('click',function() {
            var dimension_campo_sel = $('#dimension_campo_sel').val();
            var var_estadisica_sel = $('#var_estadisica_sel').val();
            var clasificador_sel = $('#clasificador_sel').val();

            var campo_referencial_2 = "";
            var campo_referencial_1 = "";

            //PARA AGRUPAR POR DATOS REFERENCIALES
            if(clasificador_sel == 'clasificador_provincias'){
              campo_referencial_1 = "r_departamento";
            }else if (clasificador_sel == 'clasificador_municipios') {
              campo_referencial_1 = "r_departamento";
              campo_referencial_2 = "r_provincia";
            }
              var source =
              {
                  datatype: "json",
                  datafields: [
                      { name: 'id_valor', type: 'int' },
                      { name: 'origen_referencia', type: 'string' },
                      { name: 'campo_original', type: 'string' },
                      { name: 'campo_validado', type: 'string' },
                      { name: 'seleccion', type: 'int' },
                      { name: 'observaciones', type: 'string' },
                      { name: 'dimension', type: 'string' },
                      { name: 'variable', type: 'int'  },
                      { name: 'id_resultado', type: 'int' },
                      { name: 'nom_resultado', type: 'string' },
                      { name: 'clasificador', type: 'string' }

                  ],
                  id: 'id_valor',
                  url:'/admindatabase/ajax/validando_campo_var_estadistica',
                  data:{'dimension_campo_sel':dimension_campo_sel,'var_estadisica_sel':var_estadisica_sel,'clasificador':clasificador_sel,'campo_referencial_2':campo_referencial_2,'campo_referencial_1':campo_referencial_1}
              };
              var dataAdapter = new $.jqx.dataAdapter(source);

              $("#menuauxcontenido").css('visibility', 'visible');
              var cellclass = function (row, columnfield, value) {
                    var cumplio = $('#jqxgrid').jqxGrid('getcellvalue', row, "campo_validado");
                    var ob = $('#jqxgrid').jqxGrid('getcellvalue', row, "observaciones");

                    if (ob == "Existe mas de una coincidencia") {
                        return "yellow";
                    }
                    if (cumplio == "SI") {
                        return "greegrid";
                    }
                    if (cumplio == "NO") {
                        return "redgrid";
                    }

                }


              $("#jqxgrid").jqxGrid(
              {
                  width: '100%',
                  //autoheight: true,
                  //autorowheight:true,
                  columnsresize:true,
                  source: dataAdapter,
                  columnsresize: true,
                  showstatusbar: true,
                  showaggregates: true,
                  filterable: true,
                  showfilterrow: true,

                  columns: [
                    { text: 'ID', datafield: 'id_valor',aggregates: ["count"],width: 70 },
                    { text: 'Dato referencial Origen', datafield: 'origen_referencia',width: 200 },
                    { text: 'Valor Origen', datafield: 'campo_original',width: 300 },
                    { text: 'Valido', datafield: 'campo_validado',filtertype: 'checkedlist',width: 75,cellclassname: cellclass },
                    { text: 'Observaciones', datafield: 'observaciones',filtertype: 'checkedlist',width: 200  },
                    { text: 'Valor Oficial Clasificador', datafield: 'nom_resultado',width: 300},
                    { text: 'IdResultadoSel', datafield: 'id_resultado',hidden: true},
                    { text: 'sel', datafield: 'seleccion',hidden: true }
                ]
              });


              $("#ordersGrid").jqxGrid(
              {
                  width: '100%',
                  height: 300,
                  showstatusbar: true,
                  statusbarheight: 37,
                  showaggregates: true,
                  keyboardnavigation: true,
                  altrows: true,
                  enabletooltips: true,
                  columns: [
                      {text: '#',datafield: 'suma', width: 25},
                      {text: 'VALOR SINONIMO',datafield: 'nombre_sinonimo', width: 300},
                      {text: 'VALOR OFICIAL CLASIFICADOR.', datafield: 'nombre_oficial', width: 300},
                      {text: 'DATOS REFERENCIALES.', datafield: 'referencia', width: 300}
                  ]
              });



          });


          $('#v_observacion').click(function() {
            var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
            if (rowindex > -1){
              var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
              var campo = dataRecord.campo_original;
              var clasif = dataRecord.clasificador;
                  var source =
                          {
                            datatype: "json",
                            datafields: [
                                {name: 'id_oficial'},
                                {name: 'nombre_oficial',type:'string'},
                                {name: 'nombre_sinonimo',type:'string'},
                                {name: 'referencia',type:'string'}

                            ],
                            id: 'id',
                            url: '/admindatabase/ajax/corrector_campo_var_estadistica',
                            data: {'campo':campo,'clasificador':clasif}
                          };
                  var adapter = new $.jqx.dataAdapter(source);
                  // update data source.
                  $("#ordersGrid").jqxGrid({source: adapter});
                  $("#ordersGrid").jqxGrid('clearselection');
            }else{
                  alert("Seleccione valor para corregir.");
            }
          });

          $('#v_relacionar').click(function() {

            var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
            var rows = $("#jqxgrid").jqxGrid('selectedrowindexes');

            if (rowindex > -1){

              if(rows.length == 1){//verificamos si validara mas de un registro------por si solo afectara uno -----por no afectara los registros seleccionados(esto para caundo se habilite la funcion de chequeado)

                      var rowindexO = $('#ordersGrid').jqxGrid('getselectedrowindex');
                      if (rowindexO > -1){
                         var dataRecordO = $("#ordersGrid").jqxGrid('getrowdata', rowindexO);
                         $("#jqxgrid").jqxGrid('setcellvalue', rowindex, 'campo_validado','SI' );
                         $("#jqxgrid").jqxGrid('setcellvalue', rowindex, 'observaciones','Se relaciono correctamente' );
                         $("#jqxgrid").jqxGrid('setcellvalue', rowindex, 'nom_resultado', dataRecordO.nombre_sinonimo );
                         $("#jqxgrid").jqxGrid('setcellvalue', rowindex, 'id_resultado', dataRecordO.id_oficial);
                         $("#jqxgrid").jqxGrid('clearselection');
                         $("#ordersGrid").jqxGrid("clear");
                      }else{
                            alert("Seleccione el valor que relacionara.");
                      }

              }else{
                    var rowindexO = $('#ordersGrid').jqxGrid('getselectedrowindex');
                    if (rowindexO > -1){
                       var dataRecordO = $("#ordersGrid").jqxGrid('getrowdata', rowindexO);
                      var rows = $("#jqxgrid").jqxGrid('selectedrowindexes');
                       for (var m = 0; m < rows.length; m++) {
                           //var row = $("#jqxgrid").jqxGrid('getrowdata', rows[m]);
                           $("#jqxgrid").jqxGrid('setcellvalue', rows[m], 'campo_validado','SI' );
                           $("#jqxgrid").jqxGrid('setcellvalue', rows[m], 'observaciones','Se relaciono correctamente' );
                           $("#jqxgrid").jqxGrid('setcellvalue', rows[m], 'nom_resultado', dataRecordO.nombre_sinonimo);
                           $("#jqxgrid").jqxGrid('setcellvalue', rows[m], 'id_resultado', dataRecordO.id_oficial);
                      }
                      $("#jqxgrid").jqxGrid('clearselection');
                      $("#ordersGrid").jqxGrid("clear");
                    }else{
                          alert("Seleccione el valor que relacionara.");
                    }
              }
            }else{
                  alert("Seleccione valor para corregir.");
            }
          });




          $('#v_guardar_aplicar').click(function() {


            swal({
              title: "Está seguro de aplicar los cambios?",
              text: "Se actualizara la información con los datos del panel!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Si, aplicar!",
              closeOnConfirm: false
            }, function(){
                        var rows = $('#jqxgrid').jqxGrid('getrows');
                        var res = {};
                        $.each(rows, function(i, e) {
                            res[e.campo_original] = e.nom_resultado;
                        });

                        var dataV = $('#jqxgrid').jqxGrid('getrowdata', 0);

                        $.ajax({
                            url: "{{ url('/admindatabase/ajax/guardar_validacion') }}",
                            data: { '_token': $('input[name=_token]').val(),'data': res,'dimension':dataV.dimension,'variable':dataV.variable },
                            type: "POST",
                            dataType: 'json',
                            success: function(data){
                              //commit(true);

                              $("#jqxgrid").jqxGrid('clear');
                              $("#ordersGrid").jqxGrid("clear");
                              swal("Modificado!", "Se ha aplicado los cambios.", "success");

                            },
                            error:function(data){
                              alert("Error al guardar los datos.");

                            }
                        });

            });


          });


          $('#v_mantener').click(function() {
            var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
            var rows = $("#jqxgrid").jqxGrid('selectedrowindexes');

            if (rowindex > -1){
              var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rows);
              $("#jqxgrid").jqxGrid('setcellvalue', rowindex, 'campo_validado','NO' );
              $("#jqxgrid").jqxGrid('setcellvalue', rowindex, 'observaciones','Manteniendo dato Origen' );
              $("#jqxgrid").jqxGrid('setcellvalue', rowindex, 'nom_resultado', dataRecord.campo_original );
              //$("#jqxgrid").jqxGrid('setcellvalue', rowindex, 'id_resultado', dataRecord.id_oficial);

            }else{
                  alert("Seleccione un registro.");
            }

          });

      });

      function validarconf(v,d,c,i){
        //alert(v+d+c);
        $('#campo').text(c);
        $('#info').text(i);


        $('#var_estadisica_sel').val(v);
        $('#dimension_campo_sel').val(c);

        $("#clasificador_sel").val("");
        $('#searchTextButton').jqxButton('disabled', true);
        $('#window').jqxWindow('open');
      }
    </script>
@endpush
