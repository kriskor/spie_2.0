@extends('layouts.SubsistemaPlanificacion')

@section('header')
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.darkblue.css" type="text/css" />
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


  .block {
    margin-bottom: 30px;
    background-color: #fff;
    -webkit-box-shadow: 0 2px rgba(0, 0, 0, 0.01);
    box-shadow: 0 2px rgba(0, 0, 0, 0.01);
  }
  .block .block,
  .side-content .block {
    -webkit-box-shadow: none;
    box-shadow: none;
  }
  .block.block-opt-refresh {
    position: relative;
  }
  .block.block-opt-refresh > .block-header {
    opacity: .25;
  }
  .block.block-opt-refresh > .block-content {
    opacity: .15;
  }
  .block.block-opt-refresh:before {
    position: absolute;
    display: block;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1;
    content: " ";
  }
  .block.block-opt-refresh:after {
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -20px 0 0 -20px;
    width: 40px;
    height: 40px;
    line-height: 40px;
    color: #646464;
    font-family: Simple-Line-Icons;
    font-size: 18px;
    text-align: center;
    z-index: 2;
    content: "\e09a";
    -webkit-animation: fa-spin 2s infinite linear;
    animation: fa-spin 2s infinite linear;
  }

  </style>
@endsection

@section('content')

  <div class="container-fluid">



      <div id="planes_articulacion" class="">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Articulación</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Articulacion</a></li>
                    <li class="active">PDES-PTDI</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
      <div  class="row">
          <div class="col-md-12">
              <div class="white-box">
                  <h3 class="box-title">Detalle de la articulación</h3>
                  <div id="menuauxcontenido" class="row-fluid" style="visibility: hidden;">
                      <div id='jqxMenu'>
                                  <ul>
                                      <li><a href="javascript:void(0)">+ a) Articulación al PDES</a>
                                          <ul style='width: 250px;'>
                                             <li style="text-align: left;"><a id="nueva_articulacion" class="" href="javascript:void(0)"  style="width: 100px; font-size: 10px;bold;padding: 7px 95px 7px 3px;">Agregar articulación</a></li>
                                              <li style="text-align: left;"><a id="eliminar_articulacion" class="" href="javascript:void(0)" style="width: 100px; font-size: 10px;bold;padding: 7px 95px 7px 3px;">Eliminar articulación</a></li>
                                          </ul>
                                      </li>
                                      <li><a href="javascript:void(0)">+ b) PLANES</a>
                                          <ul style='width: 250px;'>
                                              <li style="text-align: left;"><a class="" onclick="nuevoPlan(5,'Programa')" style="width: 100px; font-size: 10px;padding: 7px 95px 7px 3px;">Programa</a></li>
                                              <li style="text-align: left;"><a class="" onclick="nuevoPlan(6,'Inversion')" style="width: 100px; font-size: 10px;padding: 7px 95px 7px 3px;">Inversion</a></li>
                                              <li style="text-align: left;"><a class="" onclick="nuevoPlan(7,'Preinversion')" style="width: 100px; font-size: 10px;padding: 7px 95px 7px 3px;">Preinversion</a></li>
                                              <li style="text-align: left;"><a class="" onclick="nuevoPlan(8,'Fortalecimiento')" style="width: 100px; font-size: 10px;padding: 7px 95px 7px 3px;">Fortalecimiento</a></li>

                                              <li style="text-align: left;"><a class="" onclick="nuevoPlan(12,'Actividad')" style="width: 100px; font-size: 10px;padding: 7px 95px 7px 3px;">Actividad</a></li>
                                              <li style="text-align: left;"><a class="" onclick="nuevoPlan(9,'Funcionamiento')" style="width: 100px; font-size: 10px;padding: 7px 95px 7px 3px;">Funcionamiento</a></li>
                                              <li style="text-align: left;"><a class="" onclick="nuevoPlan(10,'Transferencias')" style="width: 100px; font-size: 10px;padding: 7px 95px 7px 3px;">Transferencias</a></li>
                                              <li style="text-align: left;"><a class="" onclick="nuevoPlan(11,'Gastos por ley')" style="width: 100px; font-size: 10px;padding: 7px 95px 7px 3px;">Gastos por ley</a></li>
                                          </ul>
                                      </li>

                                  </ul>
                      </div>
                  </div>
                  <div id="jqxgrid"> </div>

              </div>
          </div>
      </div>
      <input type="hidden" id="plan_sel">
      <div class="row">
          <div id="nivel_1" class="col-md-12 hidden">
              <div class="white-box">
                <div id="contenido_n1" class="row">



                </div>
              </div>
          </div>
          <div id="nivel_2" class="col-md-12 hidden" >
              <div class="white-box">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                      <button id="activar_n1" type="button" class="btn btn-success btn-circle btn-lg"><i class="fa fa-arrow-left"></i></button>
                      Programa: <strong id="detalle_programa">Nombre Producto</strong>
                      <hr/>
                  </div>
                </div>
                <div id="contenido_n2" class="row">


                </div>
              </div>
          </div>
      </div>

      </div>
      <div id="planes_detalle" class="hidden">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
               <button id="activar_planes_articulacion" type="button" class="btn btn-success btn-circle" style="float:left;"><i class="fa fa-arrow-left"></i></button>
                <h4 class="page-title" id="titulo_plan_detalle" style="float:left;"></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Detalle</a></li>
                    <li class="active">Plan</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div  class="row">
            <div class="col-md-12">
                <div id="contenido_detalle"class="white-box block">

                <div class="block-content">
                  <section class="m-t-5">
                      <div class="sttabs tabs-style-linemove">
                          <nav>
                              <ul>
                                  <li><a href="#section-flip-1" class="sticon ti-settings"><span>Datos generales</span></a></li>
                                  <li><a href="#section-flip-4" class="sticon fa fa-money"><span>Presupuesto</span></a></li>
                                  <li><a href="#section-flip-2" class="sticon ti-trash"><span>-</span></a></li>
                                  <li><a href="#section-flip-3" class="sticon ti-trash"><span>-</span></a></li>
                                  <li><a href="#section-flip-5" class="sticon ti-trash"><span>-</span></a></li>


                              </ul>
                          </nav>
                          <div class="content-wrap">

                              <section id="section-flip-1">
                                <form role="formnmodPlanGeneral" id="formnmodPlanGeneral" action="javascript:modificarPlanGeneral();"  method="POST"  data-toggle="validator" class="form">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_plan">

                                <p class="text-right">
                                  <label class="control-label">TIPO PLAN: <span class="text-danger" id="tipo_plan_general"></span></label>
                                </p>
                                <div class="form-group">
                                  <label class="control-label">Nombre del Plan</label>
                                  <textarea class="form-control" placeholder="Nombre del Plan" rows="2" name="nombre_plan" required></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label class="control-label">Monto total (Bs.)</label>
                                        <input type="text" placeholder="Ingresar monto total" class="form-control money" name="monto_total_plan">
                                      </div>
                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                   <button type="submit" class="btn btn-danger waves-effect waves-light left">Guardar</button>
                                 </div>
                                </form>

                              </section>
                              <section id="section-flip-2">
                                <form role="formnmodPlanPresupuesto" id="formnmodPlanPresupuesto" action="javascript:modificarPlanPresupuesto();"  method="POST"  data-toggle="validator" class="form">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_plan">
                                <div class="row">
                                    <div class="col-md-6">
                                          <table class="table">
                                              <thead>
                                                  <tr>
                                                      <th>Gestion</th>
                                                      <th class="text-right">Monto</th>
                                                  </tr>
                                              </thead>
                                              <tbody id="plan_presupuesto">


                                              </tbody>
                                          </table>
                                    </div>
                                  </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-danger waves-effect waves-light left">Guardar</button>
                                    </div>

                                </form>
                              </section>
                              <section id="section-flip-3">
                                  <h2>Tabbing 3</h2>
                              </section>
                              <section id="section-flip-4">
                                  <h2>Tabbing 4</h2>
                              </section>
                              <section id="section-flip-5">
                                  <h2>Tabbing 5</h2>
                              </section>


                          </div>
                          <!-- /content -->
                      </div>
                      <!-- /tabs -->




                  </section>
                 </div>



                </div>
            </div>
        </div>
      </div>

      <div id="window" style="display: none;">
          <div>
            <section>Nueva articulación al PDES</section>
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
            <section id="titulo_plan"></section>
          </div>
          <div>
              <div>
                <section id="contenidodoc">
                  <form role="formnewPlan" id="formnewPlan" action="javascript:guardarPlan();"  method="POST"  data-toggle="validator" class="form">
                  {{ csrf_field() }}

                   <input type="hidden" id="tipo_plan" name="tipo_plan">
                   <input type="hidden" id="id_padre" name="id_padre">
                   <input type="hidden" id="id_articulacion" name="id_articulacion">
                   <div class="form-group">
                     <label class="control-label">Nombre</label>
                     <textarea id="nombre_plan" class="form-control" placeholder="Ingrese nombre" rows="3" name="nombre_plan" required></textarea>
                   </div>


                    <div class="modal-footer">
                      <button id="cerrar_modal_planes" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    </form>
                </section>
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
  <script src="/js/jquery.mask.js"></script>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" ></script>
  <script src="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.js" type="text/javascript"></script>
  <script type="text/javascript">
      function activarMenu(id,sub){
          $('#'+id).addClass('active');
      }
      function detectarBoton(event,ele){
        if (event.button==2)//derecho  y 1 es la bolita
          $('#plan_sel').val(ele.name);
        else if(event.button==0)//izquierdo
          $('#plan_sel').val(ele.name);
      }
      ///////////////////////MENU CONTEXTO PARA planes
              $.contextMenu({
                  selector: '.context-menu-one',
                  callback: function(key, options) {
                      var m = "clicked: " + key;

                      if(key == "delete"){

                        swal({
                          title: "Está seguro?",
                          text: "No podrá recuperar este registro!",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "Si, eliminar!",
                          closeOnConfirm: false
                        }, function(){
                          $.ajax({
                                type: "POST",
                                url: "{{ url('/subsistemaplanificacion/ajax/eliminarplan') }}",
                                dataType: 'json',
                                data: {id:$('#plan_sel').val(),'_token': $('input[name=_token]').val()} , // Adjuntar los campos del formulario enviado.
                                success: function(data){

                                  if ($('#nivel_2').hasClass('hidden')){
                                    actualizar_planes(data);
                                  }else{
                                    actualizar_planes_hijos(data);
                                  }
                                  swal("Eliminado!", "Se ha eliminado tu registro.", "success");
                                },
                                error:function(data){
                                  alert('No se elimino el registro.')

                                }
                            });

                        });
                      }

                      if(key == "edit"){
                        detallar_plan($('#plan_sel').val());
                      }
                      //window.console && console.log(m) || alert(m);
                  },
                  items: {
                      "edit": {name: "Detalle", icon: "edit"},
                      "delete": {name: "Eliminar", icon: "delete"},
                      "sep1": "---------",
                      "quit": {name: "Salir de menu", icon: function(){
                          return 'context-menu-icon context-menu-icon-quit';
                      }}
                  }
              });
              /////////////////////MENU CONTEXTO PARA PROGRAMAS
              $.contextMenu({
                  selector: '.context-menu-dos',
                  callback: function(key, options) {
                      var m = "clicked: " + key;

                      if(key == "delete"){

                        swal({
                          title: "Está seguro?",
                          text: "No podrá recuperar este registro!",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "Si, eliminar!",
                          closeOnConfirm: false
                        }, function(){
                          $.ajax({
                                type: "POST",
                                url: "{{ url('/subsistemaplanificacion/ajax/eliminarplan') }}",
                                dataType: 'json',
                                data: {id:$('#plan_sel').val(),'_token': $('input[name=_token]').val()} , // Adjuntar los campos del formulario enviado.
                                success: function(data){
                                  actualizar_planes(data);
                                  swal("Eliminado!", "Se ha eliminado tu registro.", "success");
                                },
                                error:function(data){
                                  alert('No se elimino el registro.')

                                }
                            });

                        });
                      }
                      if(key == "edit"){
                        detallar_plan($('#plan_sel').val());
                      }
                      //window.console && console.log(m) || alert(m);
                  },
                  items: {
                      "delete": {name: "Eliminar", icon: "delete"},
                      "sep1": "---------",
                      "quit": {name: "Salir de menu", icon: function(){
                          return 'context-menu-icon context-menu-icon-quit';
                      }}
                  }
              });
      $(document).ready(function(){
        //$('.money').mask('000.000.000.000.000,00', {reverse: true});
        $('.money').mask("#.##0,00", {reverse: true});

        // $('.context-menu-one').on('click', function(e){
        //     alert('clicked', this);
        // })




        ////
          activarMenu('home',0);

          var theme = 'darkblue';
          var source =
          {
              dataType: "json",
              dataFields: [
                { name: 'id',type: 'number' },
                { name: 'cod_p', type: 'string' },
                { name: 'pilar', type: 'string' },
                { name: 'desc_p', type: 'string' },
                { name: 'cod_m', type: 'string' },
                { name: 'meta', type: 'string' },
                { name: 'vcp', type: 'string' },
                { name: 'desc_m', type: 'string' },
                { name: 'cod_r', type: 'string' },
                { name: 'resultado', type: 'string' },
                { name: 'desc_r', type: 'string' },
                { name: 'cod_a', type: 'string' },
                { name: 'accion', type: 'string' },
                { name: 'desc_a', type: 'string' },
                { name: 'codigo', type: 'string' }
              ],
              id: 'id',
              data: {entidad: '{{ $entidad }}'},
              url: "{{ url('/subsistemaplanificacion/ajax/listaarticulacion') }}"
          };
          var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                height: 350,
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
                  { text: '#', datafield: 'id',  width: 50,hidden:true },
                  { text: 'CODIGO P-M-R-A', datafield: 'codigo',  width: 150 },
                  { text: 'ACCION', datafield: 'desc_a' }
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



        function createElements1() {
            $('#window').jqxWindow({
                resizable: false,
                isModal: true,
                autoOpen: false,
                width: 'auto',
                height: 'auto',
                minWidth: 300,
                //minHeight: 350,
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
        createElements1();
        createElements2();

        //ACCION DE LOS MENuS
        $('#nueva_articulacion').click(function() {
                $("#window").css('visibility', 'visible');
                $('#window').jqxWindow('open');
                $('#window').jqxWindow('focus');
        });

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
        $('#cerrar_modal_planes').click(function() {
             $('#window2').jqxWindow('close');
        });

        $('#activar_n1').click(function() {
           $('#nivel_1').removeClass('hidden');
           //$('#nivel_1').addClass('show');
           $('#nivel_2').removeClass('show');
           $('#nivel_2').addClass('hidden');
           $("#id_padre").val('');
        });
        $('#activar_planes_articulacion').click(function() {
           $('#planes_articulacion').removeClass('hidden');
           //$('#nivel_1').addClass('show');
           $('#planes_detalle').removeClass('hidden');
           $('#planes_detalle').addClass('hidden');
        });

        $("#jqxgrid").on('rowclick', function (event) {
              $("#contenido_n1").html('');
              $("#id_padre").val('');
              var args = event.args;
              var row = args.rowindex;
              var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
              var id = dataRecord.id;
              $('#nivel_1').removeClass('hidden');
              $('#nivel_2').removeClass('show');
              $('#nivel_2').addClass('hidden');

              $.ajax({
                    type: "POST",
                    url: "{{ url('/subsistemaplanificacion/ajax/listaplanesarticulacion') }}",
                    dataType: 'json',
                    data: {id_entidad:{{ $entidad }},id_articulacion: id,'_token': $('input[name=_token]').val()} , // Adjuntar los campos del formulario enviado.
                    success: function(data){
                        //$("#jqxgrid").jqxGrid("updatebounddata");
                      $("#contenido_n1").html(data);

                    },
                    error:function(data){
                      alert('No se pudo recuperar los planes.')

                    }
             });


              //location.href = "/subsistemaplanificacion/articulacion/" + dataRecord.id;

        });








      });



      function guardarArticulacion(){

        if($("#acciones").jqxComboBox('getSelectedItem')){
          var item = $("#acciones").jqxComboBox('getSelectedItem');
              $.ajax({
                    type: "POST",
                    url: "{{ url('/subsistemaplanificacion/ajax/guardararticulacion') }}",
                    dataType: 'json',
                    data: {'accion': item.value,'entidad': {{ $entidad }},'_token': $('input[name=_token]').val()} ,
                    success: function(data){
                        $("#jqxgrid").jqxGrid("updatebounddata");
                        $("#jqxgrid").jqxGrid("clearselection");
                        $("#id_padre").val('');
                        $("#contenido_n1").html('');
                        $("#contenido_n2").html('');
                    },
                    error:function(data){
                      alert('No se pudo guardar la articulación.')

                    }
             });
       }else{
          alert("Selecciones una accion");
       }

      }

      $('#eliminar_articulacion').click(function() {

        var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
        if (rowindex > -1)
        {

          swal({
            title: "Está seguro?",
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
                        url: "{{ url('/subsistemaplanificacion/ajax/eliminararticulacion') }}",
                        dataType: 'json',
                        data: {'articulacion': dataRecord.id,'_token': $('input[name=_token]').val()},
                        success: function(data){
                            $("#jqxgrid").jqxGrid("updatebounddata");
                            swal("Eliminado!", "Se ha eliminado tu registro.", "success");
                        },
                        error:function(data){
                          alert('No se pudo eliminar la articulación.')

                        }
                 });
          });



        }else{
               alert("Seleccione un registro para eliminar.");
        }

      });


      function explorar(id){
        $("#contenido_n2").html('');
        $('#nivel_2').removeClass('hidden');
        //$('#nivel_1').addClass('show');
        $('#nivel_1').removeClass('show');
        $('#nivel_1').addClass('hidden');

        $("#id_padre").val(id);

        var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
        var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);

        $.ajax({
              type: "POST",
              url: "{{ url('/subsistemaplanificacion/ajax/listaplanesarticulacionhijos') }}",
              dataType: 'json',
              data: {id_entidad:{{ $entidad }},id_articulacion: dataRecord.id ,id_padre: id, '_token': $('input[name=_token]').val()} , // Adjuntar los campos del formulario enviado.
              success: function(data){
                  //$("#jqxgrid").jqxGrid("updatebounddata");
                $("#detalle_programa").html(data.titulo);
                $("#contenido_n2").html(data.html);

              },
              error:function(data){
                alert('No se pudo recuperar los planes.')

              }
       });


      }

      function nuevoPlan(ele,desc){
        var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
        if (rowindex > -1)
           {
             var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
             if(ele == 5){
                if($("#id_padre").val() == ""){
                    $("#titulo_plan").html('Nuevo:'+ desc);
                    $("#formnewPlan")[0].reset();
                    $("#id_articulacion").val(dataRecord.id);
                    $("#tipo_plan").val(ele);
                    $("#window2").css('visibility', 'visible');
                    $('#window2').jqxWindow('open');
                    $('#window2').jqxWindow('focus');
                }else{
                  alert('No puede crear un programa estando dentro un programa.');
                }
             }else{
                 $("#titulo_plan").html('Nuevo:'+ desc);
                 $("#formnewPlan")[0].reset();
                 $("#id_articulacion").val(dataRecord.id);
                 $("#tipo_plan").val(ele);
                 $("#window2").css('visibility', 'visible');
                 $('#window2').jqxWindow('open');
                 $('#window2').jqxWindow('focus');
             }





           }else{
               alert("Seleccione una articulacion para crear su plan.");
           }

      }
      function actualizar_planes(id){

          $.ajax({
                type: "POST",
                url: "{{ url('/subsistemaplanificacion/ajax/listaplanesarticulacion') }}",
                dataType: 'json',
                data: {id_entidad:{{ $entidad }},id_articulacion: id,'_token': $('input[name=_token]').val()} , // Adjuntar los campos del formulario enviado.
                success: function(data){
                    //$("#jqxgrid").jqxGrid("updatebounddata");
                  $("#contenido_n1").html(data);

                },
                error:function(data){
                  alert('No se pudo recuperar los planes.')

                }
         });

      }

      function actualizar_planes_hijos(id){

          $.ajax({
                type: "POST",
                url: "{{ url('/subsistemaplanificacion/ajax/listaplanesarticulacionhijos') }}",
                dataType: 'json',
                data: {id_entidad:{{ $entidad }},id_articulacion: id ,id_padre: $("#id_padre").val(), '_token': $('input[name=_token]').val()} , // Adjuntar los campos del formulario enviado.
                success: function(data){
                    //$("#jqxgrid").jqxGrid("updatebounddata");
                  $("#detalle_programa").html(data.titulo);
                  $("#contenido_n2").html(data.html);

                },
                error:function(data){
                  alert('No se pudo recuperar los planes.')

                }
         });

      }
      function guardarPlan(){

        var item = $("#acciones").jqxComboBox('getSelectedItem');
            $.ajax({
                  type: "POST",
                  url: "{{ url('/subsistemaplanificacion/ajax/guardararplan') }}",
                  dataType: 'json',
                  data: $("#formnewPlan").serialize() , // Adjuntar los campos del formulario enviado.
                  success: function(data){
                      $('#window2').jqxWindow('close');

                      if ($('#nivel_2').hasClass('hidden')){
                        actualizar_planes(data);
                      }else{
                        actualizar_planes_hijos(data);
                      }



                  },
                  error:function(data){
                    alert('No se pudo guardar la articulación.')

                  }
           });


      }

      function detallar_plan(id){

        $('#planes_articulacion').addClass('hidden');
        $('#planes_detalle').removeClass('hidden');
        $('#titulo_plan_detalle').html('Atras');

        $('#contenido_detalle').toggleClass('block-opt-refresh');
        $('input[name="id_plan"]').val(id);
        //-------------------------
        actualziarPlanGeneral(id);
        actualziarPlanPresupuesto(id);

        // Return block to normal state if the demostration mode is on in the refresh option button - data-action-mode="demo"
        setTimeout(function(){
           $('#contenido_detalle').removeClass('block-opt-refresh');
        }, 2000);


      }

      function modificarPlanGeneral(){
        $.ajax({
              type: "POST",
              url: "{{ url('/subsistemaplanificacion/ajax/modificaplangeneral') }}",
              dataType: 'json',
              data: $("#formnmodPlanGeneral").serialize() , // Adjuntar los campos del formulario enviado.
              success: function(data){
                  $('#name_'+data.id).html(data.nombre_plan);
                  alert("Datos generales actualizados");
              },
              error:function(data){
                alert('No se pudo actualizar los datos.')

              }
          });


      }

      function modificarPlanPresupuesto(){
        $.ajax({
              type: "POST",
              url: "{{ url('/subsistemaplanificacion/ajax/modificarPlanPresupuesto') }}",
              dataType: 'json',
              data: $("#formnmodPlanPresupuesto").serialize() , // Adjuntar los campos del formulario enviado.
              success: function(data){

                  alert("Datos presupuesto actualizados");
              },
              error:function(data){
                alert('No se pudo actualizar los datos.')

              }
          });


      }







      function actualziarPlanGeneral(id){

          $.ajax({
                type: "POST",
                url: "{{ url('/subsistemaplanificacion/ajax/mostrarPlanGeneral') }}",
                dataType: 'json',
                data: {id: id, '_token': $('input[name=_token]').val()} , // Adjuntar los campos del formulario enviado.
                success: function(data){
                    //$("#jqxgrid").jqxGrid("updatebounddata");
                  $('textarea[name="nombre_plan"]').val(data.nombre_plan);
                  $('input[name="monto_total_plan"]').val(data.monto_total_plan);
                  $('#tipo_plan_general').html(data.tipo_plan);
                },
                error:function(data){
                  alert('No se pudo recuperar los planes.')

                }
         });

      }
      function actualziarPlanPresupuesto(id){

          $.ajax({
                type: "POST",
                url: "{{ url('/subsistemaplanificacion/ajax/mostrarPlanPresupuesto') }}",
                dataType: 'json',
                data: {id: id, '_token': $('input[name=_token]').val()} , // Adjuntar los campos del formulario enviado.
                success: function(data){

                  $('#plan_presupuesto').html(data);
                },
                error:function(data){
                  alert('No se pudo recuperar los planes.')

                }
         });

      }


    </script>
@endpush
