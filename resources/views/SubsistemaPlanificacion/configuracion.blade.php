@extends('layouts.SubsistemaPlanificacion')

@section('header')
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.light.css" type="text/css" />
  <link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
  <link href="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.css" rel="stylesheet" type="text/css" />
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
              <h4 class="page-title">Programas MEF</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                  <li><a href="#">Configuracion</a></li>
                  <li class="active">Programas MEF - PDES</li>
              </ol>
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="white-box">
                <h3 class="box-title m-t-0 m-b-0">Lista de programas MEF</h3>
                <div id="menuauxcontenido" class="row-fluid" style="visibility: hidden;">
                    <div id='jqxMenu'>
                                <ul>
                                  <li><a href="javascript:void(0)">+ Nuevo</a>
                                      <ul style='width: 250px;'>
                                         <li style="text-align: left;"><a id="nuevo_programa" class="" href="javascript:void(0)"  style="width: 100px; font-size: 10px;bold;padding: 7px 95px 7px 3px;"> Nuevo Programa</a></li>
                                          <li style="text-align: left;"><a id="alinear_programa" class="" href="javascript:void(0)" style="width: 100px; font-size: 10px;bold;padding: 7px 95px 7px 3px;"> Alinear al PDES</a></li>
                                      </ul>
                                  </li>
                                  <li><a id="modificar_programa" href="javascript:void(0)">+ Modificar Programa</a></li>
                                  <li><a href="javascript:void(0)">+ Eliminar</a>
                                      <ul style='width: 250px;'>
                                         <li style="text-align: left;"><a id="eliminar_programa" class="" href="javascript:void(0)"  style="width: 100px; font-size: 10px;bold;padding: 7px 95px 7px 3px;"> Eliminar Programa</a></li>
                                          <li style="text-align: left;"><a id="eliminar_alineacion" class="" href="javascript:void(0)" style="width: 100px; font-size: 10px;bold;padding: 7px 95px 7px 3px;">Eliminar Alineacion</a></li>
                                      </ul>
                                  </li>


                                </ul>
                    </div>
                </div>
                  <div id="jqxgrid"> </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="white-box">
                <h3 class="box-title m-t-0 m-b-0">Lista acciones PDES</h3>
                <div id="childjqxgrid"></div>
              </div>
          </div>
      </div>

  </div>


    <!-- /.container-fluid -->

  <div id="window" style="display: none;">
      <div>
        <section>Nueva alineacion al PDES</section>
      </div>
      <div>
          <div>
            <section id="contenidodoc">
              <form role="formnewArticulacion" id="formnewArticulacion" action="javascript:guardarArticulacion();"  method="POST"  data-toggle="validator" class="form">
              {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label" for="pilares">Pilares</label>
                    <div  id="pilares"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="metas">Metas</label>
                    <div id="metas"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="resultado">Resultados</label>
                    <div id="resultados"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="acciones">Acciones</label>
                    <div id="acciones" required></div>
                </div>
                <div class="modal-footer">
                  <button id="clear_filtro_pdes" type="button" class="btn btn-info btn-circle"><i class="fa ti-reload"></i></button>
                  <button id="cerrar_modal_articulacion" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </section>
          </div>
      </div>
  </div>

  <div id="window2" style="display: none;">
      <div>
        <section>Nuevo Programa</section>
      </div>
      <div>
          <div>
            <section id="contenidodoc">
              <form role="formnewPrograma" id="formnewPrograma" action="javascript:guardarnuevoPrograma();"  method="POST"  data-toggle="validator" class="form">
              {{ csrf_field() }}

               <div class="form-group">
                 <label class="control-label">Nombre Programa</label>
                 <textarea class="form-control" placeholder="Ingrese nombre" rows="3" name="nombre_programa" required></textarea>
               </div>
               <div class="form-group">
                 <label class="control-label">Codigo MEF</label>
                <input type="text" placeholder="Ingresar codigo" class="form-control" name="codigo_mef" required>
               </div>


                <div class="modal-footer">
                  <button id="cerrar_modal_new_programa" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </section>
          </div>
      </div>
  </div>

  <div id="window3" style="display: none;">
      <div>
        <section>Nuevo Programa</section>
      </div>
      <div>
          <div>
            <section id="contenidodoc">
              <form role="formmodPrograma" id="formmodPrograma" action="javascript:modificarPrograma();"  method="POST"  data-toggle="validator" class="form">
                  {{ csrf_field() }}

                  <input type="hidden" id="id_programa" name="id_programa">
                   <div class="form-group">
                     <label class="control-label">Nombre Programa</label>
                     <textarea id="nombre_programa_mod" class="form-control" placeholder="Ingrese nombre" rows="3" name="nombre_programa_mod" required></textarea>
                   </div>
                   <div class="form-group">
                     <label class="control-label">Codigo MEF</label>
                    <input id="codigo_mef_mod" type="text" placeholder="Ingresar codigo" class="form-control" name="codigo_mef_mod" required>
                   </div>


                    <div class="modal-footer">
                      <button id="cerrar_modal_mod_programa" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </section>
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
  <script src="/js/jquery.mask.js"></script>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" ></script>
  <script src="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.js" type="text/javascript"></script>
  <script type="text/javascript">
      function activarMenu(id,sub){
          $('#'+id).addClass('active');
      }
      $(document).ready(function(){
        activarMenu(3,0);
        var theme = 'light';
        var source =
        {
            dataType: "json",
            dataFields: [
              { name: 'id'},
              { name: 'descripcion', type: 'string' },
              { name: 'codigo_mef', type: 'int'}
            ],
            id: 'id',
            url: "/subsistemaplanificacion/ajax/listaProgramasMef"
        };
        var dataAdapter = new $.jqx.dataAdapter(source);

          $("#jqxgrid").jqxGrid(
          {
              width: '100%',
              height: 250,
              //height: '100%',
              theme: theme,
              source: dataAdapter,
              //filterable: true,
              //showfilterrow: true,
              pageable: true,
              pagesize: 500,
              pagermode: 'simple',
              autorowheight:true,
              columnsresize:true,
              //autoheight: true,
              columns: [
                { text: 'id', editable: false, dataField: 'id', width: 50 },
                { text: 'Descripcion', dataField: 'descripcion', align:'center', width: 650},
                { text: 'Codigo MEF', dataField: 'codigo_mef', cellsAlign: 'left', align: 'center'}
              ]
          });

          $("#jqxgrid").on('rowclick', function (event) {
                var args = event.args;
                var row = args.rowindex;
                var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
                var id = dataRecord.id;

                var source =
                {
                    dataType: "json",
                    dataFields: [
                      { name: 'id'},
                      { name: 'codigo', type: 'string' },
                      { name: 'desc_a', type: 'int'}
                    ],
                    id: 'id',
                    data:{programa:id},
                    url: "/subsistemaplanificacion/ajax/listaalineacionprogramas"
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#childjqxgrid").jqxGrid({source: dataAdapter});
                $("#childjqxgrid").jqxGrid('clearselection');
          });

          $("#childjqxgrid").jqxGrid(
          {
              width: '100%',
              height: 250,
              theme: theme,
              pageable: true,
              pagesize: 500,
              pagermode: 'simple',
              autorowheight:true,
              columnsresize:true,
              columns: [
                { text: 'Codigo', dataField: 'codigo', width: 150 },
                { text: 'Accion', dataField: 'desc_a'}
              ]
          });


          $("#jqxMenu").jqxMenu({
              width: '100%',
              height: '35px',
              theme:theme,
              autoOpen: false,
              autoCloseOnMouseLeave: false,
              showTopLevelArrows: true
            });

              var centerItems = function () {
                  var firstItem = $($("#jqxMenu ul:first").children()[0]);
                  firstItem.css('margin-left', 0);
                  var width = 0;
                  var borderOffset = 2;
                  $.each($("#jqxMenu ul:first").children(), function () {
                      width += $(this).outerWidth(true) + borderOffset;
                  });
                  var menuWidth = $("#jqxMenu").outerWidth();
                  firstItem.css('margin-left', (menuWidth / 2 ) - (width / 2));
              }
              // centerItems();
              // $(window).resize(function () {
              //     centerItems();
              // });
          $("#menuauxcontenido").css('visibility', 'visible');


          function createElements1() {
              $('#window').jqxWindow({
                  resizable: false,
                  isModal: true,
                  autoOpen: false,
                  width: 'auto',
                  height: 'auto',
                  minWidth: 300,
                  minHeight: 390,
                  //cancelButton: $("#Cancel"),
                  modalOpacity: 0.01
              });
              var offset = $("#jqxgrid").offset();
              $("#window").jqxWindow({ position: { x: parseInt(offset.left) + 25, y: parseInt(offset.top) + (-5) } });
              $('#window').jqxWindow('focus');
          }
          function createElements2() {
              $('#window2').jqxWindow({
                  resizable: false,
                  isModal: true,
                  autoOpen: false,
                  width: 'auto',
                  height: 'auto',
                  minWidth: 400,
                  minHeight: 230,
                  //cancelButton: $("#Cancel"),
                  modalOpacity: 0.01
              });
              var offset = $("#jqxgrid").offset();
              $("#window2").jqxWindow({ position: { x: parseInt(offset.left) + 25, y: parseInt(offset.top) + (-5) } });
              $('#window2').jqxWindow('focus');
          }
          function createElements3() {
              $('#window3').jqxWindow({
                  resizable: false,
                  isModal: true,
                  autoOpen: false,
                  width: 'auto',
                  height: 'auto',
                  minWidth: 400,
                  minHeight: 230,
                  //cancelButton: $("#Cancel"),
                  modalOpacity: 0.01
              });
              var offset = $("#jqxgrid").offset();
              $("#window3").jqxWindow({ position: { x: parseInt(offset.left) + 25, y: parseInt(offset.top) + (-5) } });
              $('#window3').jqxWindow('focus');
          }
          createElements1();
          createElements2();
          createElements3();








          /*RECURSOSSSSSSSSSSSS*/
          //Combo PDES
          var pilaresSource =
          {
            dataType: "json",
            dataFields: [
              { name: 'nombre'},
              { name: 'id'}
            ],
            url: '{{ url('/subsistemaplanificacion/ajax/listarpilares') }}',
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
              url:  '{{ url('/subsistemaplanificacion/ajax/listarmetas') }}',
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
              url:  '{{ url('/subsistemaplanificacion/ajax/listarresultados') }}'
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


          var accionesSource =
          {
              dataType: "json",
              dataFields: [
                { name: 'nombre'},
                { name: 'resultado'},
                { name: 'id'}
              ],
              url:  '{{ url('/subsistemaplanificacion/ajax/listaracciones') }}'
          };
          var accionesAdapter = new $.jqx.dataAdapter(accionesSource);

          $("#acciones").jqxComboBox(
          {

            width: '100%',
            height: 25,
            disabled: true,
            promptText: "Seleccionar accion...",
            displayMember: 'nombre',
            valueMember: 'id'
          });


          $("#pilares").bind('select', function(event)
          {
            if (event.args)
                {
                  $("#metas").jqxComboBox({ disabled: false});
                  $("#resultados").jqxComboBox({ disabled: true});
                  $("#acciones").jqxComboBox({ disabled: true});
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

          $("#resultados").bind('select', function(event)
          {

            if (event.args)
                {
                  $("#acciones").jqxComboBox({ disabled: false});
                  var value = event.args.item.value;
                  accionesSource.data = {resultado: value};
                  accionesAdapter = new $.jqx.dataAdapter(accionesSource, {
                      beforeLoadComplete: function (records) {
                          var filteredRecords = new Array();
                          for (var i = 0; i < records.length; i++) {
                              if (records[i].resultado == value)
                                  filteredRecords.push(records[i]);
                          }
                          return filteredRecords;
                      }
                  });
                  $("#acciones").jqxComboBox({ source: accionesAdapter, autoDropDownHeight: accionesAdapter.records.length > 10 ? false : true});
                }

          });

          /*********OPCIONES DE MENUS*////
          $('#clear_filtro_pdes').click(function() {
                  var pilaresSource =
                  {
                    dataType: "json",
                    dataFields: [
                      { name: 'nombre'},
                      { name: 'id'}
                    ],
                    url: '{{ url('/subsistemaplanificacion/ajax/listarpilares') }}',
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
                      url:  '{{ url('/subsistemaplanificacion/ajax/listarresultados') }}'
                  };
                  var resultadosAdapter = new $.jqx.dataAdapter(resultadosSource);
                  $("#resultados").jqxComboBox({ source: resultadosAdapter, disabled: false, autoDropDownHeight:false });
                  $("#acciones").jqxComboBox('clearSelection');
                  $("#acciones").jqxComboBox({ disabled: true });
          });
          $('#cerrar_modal_articulacion').click(function() {
               $('#window').jqxWindow('close');
          });
          $('#cerrar_modal_new_programa').click(function() {
               $('#window2').jqxWindow('close');
          });
          $('#cerrar_modal_mod_programa').click(function() {
               $('#window3').jqxWindow('close');
          });
          $('#alinear_programa').click(function() {
            var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
            if (rowindex > -1)
            {
                  $("#window").css('visibility', 'visible');
                  $('#window').jqxWindow('open');
                  $('#window').jqxWindow('focus');
            }else{
                alert("Seleccione un programa de la lista.");
            }
          });
          $('#nuevo_programa').click(function() {
                  $("#window2").css('visibility', 'visible');
                  $('#window2').jqxWindow('open');
                  $('#window2').jqxWindow('focus');
          });
          $('#modificar_programa').click(function() {
            var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
            if (rowindex > -1)
            {
                  var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
                  $.ajax({
                        type: "POST",
                        url: "{{ url('/subsistemaplanificacion/ajax/datosprogramamef') }}",
                        dataType: 'json',
                        data: {'programa': dataRecord.id,'_token': $('input[name=_token]').val()} ,
                        success: function(data){
                            $("#nombre_programa_mod").val(data.descripcion);
                            $("#codigo_mef_mod").val(data.codigo_mef);
                            $("#id_programa").val(data.id);
                        },
                        error:function(data){
                          alert('No se pudo guardar la articulación.')

                        }
                 });
                  $("#window3").css('visibility', 'visible');
                  $('#window3').jqxWindow('open');
                  $('#window3').jqxWindow('focus');
            }else{
                alert("Seleccione un programa de la lista.");
            }
          });

          $('#eliminar_programa').click(function() {

            var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
            if (rowindex > -1)
            {

              swal({
                title: "Está seguo de eliminar el programa?",
                text: "No podrá recuperar este registro!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar!",
                closeOnConfirm: false
              }, function(){
                      var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
                      $.ajax({
                            type: "delete",
                            url: "{{ url('/subsistemaplanificacion/ajax/eliminarprogramamef') }}",
                            dataType: 'json',
                            data: {'programa': dataRecord.id,'_token': $('input[name=_token]').val()},
                            success: function(data){
                                $("#jqxgrid").jqxGrid("updatebounddata");

                                swal("Eliminado!", "Se ha eliminado tu registro.", "success");
                            },
                            error:function(data){
                              alert('No se pudo eliminar el programa.')

                            }
                     });
              });



            }else{
                   alert("Seleccione un registro para eliminar.");
            }

          });

          $('#eliminar_alineacion').click(function() {

            var rowindex = $('#childjqxgrid').jqxGrid('getselectedrowindex');
            if (rowindex > -1)
            {

              swal({
                title: "Está seguro de eliminar alineacion?",
                text: "No podrá recuperar este registro!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar!",
                closeOnConfirm: false
              }, function(){
                      var dataRecord = $("#childjqxgrid").jqxGrid('getrowdata', rowindex);
                      $.ajax({
                            type: "delete",
                            url: "{{ url('/subsistemaplanificacion/ajax/eliminararticulacionprogramapdes') }}",
                            dataType: 'json',
                            data: {'alineacion': dataRecord.id,'_token': $('input[name=_token]').val()},
                            success: function(data){
                                $("#childjqxgrid").jqxGrid("updatebounddata");
                                swal("Eliminado!", "Se ha eliminado tu registro.", "success");
                            },
                            error:function(data){
                              alert('No se pudo eliminar el programa.')

                            }
                     });
              });



            }else{
                   alert("Seleccione una alineacion para eliminar.");
            }

          });


      });
      function guardarArticulacion(){

        if($("#acciones").jqxComboBox('getSelectedItem')){

          var item = $("#acciones").jqxComboBox('getSelectedItem');

          var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
          var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
              $.ajax({
                    type: "POST",
                    url: "{{ url('/subsistemaplanificacion/ajax/guardararticulacionprograma') }}",
                    dataType: 'json',
                    data: {'accion': item.value,'programa':dataRecord.id,'_token': $('input[name=_token]').val()} ,
                    success: function(data){
                        $("#childjqxgrid").jqxGrid("updatebounddata");

                    },
                    error:function(data){
                      alert('No se pudo guardar la articulación.')

                    }
             });


       }else{
          alert("Selecciones una accion");
       }

      }


      function guardarnuevoPrograma(){


            $.ajax({
                  type: "POST",
                  url: "{{ url('/subsistemaplanificacion/ajax/guardararnuevoprograma') }}",
                  dataType: 'json',
                  data: $("#formnewPrograma").serialize() , // Adjuntar los campos del formulario enviado.
                  success: function(data){
                      $("#jqxgrid").jqxGrid("updatebounddata");
                      $('#window2').jqxWindow('close');
                  },
                  error:function(data){
                    alert('No se pudo guardar el programa.')

                  }
           });


      }
      function modificarPrograma(){


            $.ajax({
                  type: "POST",
                  url: "{{ url('/subsistemaplanificacion/ajax/modificarprograma') }}",
                  dataType: 'json',
                  data: $("#formmodPrograma").serialize() , // Adjuntar los campos del formulario enviado.
                  success: function(data){
                      $("#jqxgrid").jqxGrid("updatebounddata");
                      $('#window3').jqxWindow('close');
                  },
                  error:function(data){
                    alert('No se pudo guardar el programa.')

                  }
           });


      }
    </script>
@endpush
