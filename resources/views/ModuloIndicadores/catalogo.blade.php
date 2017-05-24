@extends('layouts.ModuloIndicadores')

@section('header')
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.light.css" type="text/css" />
  <link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

<style media="screen">
.tab-pane{
  height:300px;
  overflow-y:scroll;
}
.jqx-grid-content
    {
        cursor: pointer;
    }
</style>
@endsection

@section('content')

  <div class="container-fluid">
      <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h4 class="page-title">Catalogo</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                  <li><a href="#">Indicadores</a></li>
                  <li class="active">Catalogo</li>
              </ol>
          </div>
          <!-- /.col-lg-12              well tab-pane -->
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="white-box">

                        <div class="row">
                          <div id="filtros" class="col-sm-3 ">
                            <h3 class="box-title panel panel-default"><i class="ti-settings"></i> Filtros </h3>
                              <div class="well">








                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                  <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                      <h5 class="mb-0">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          Por Priorización
                                        </a>
                                      </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                      <div class="card-block">
                                          <div class="form-group">
                                              <label for="metas">Resultados</label>
                                              <div id="resultados_priorizados"></div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="card-header" role="tab" id="headingTwo">
                                      <h5 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                          Por Clasificacion
                                        </a>
                                      </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                      <div class="card-block">
                                          <div class="form-group">
                                              <label for="metas">Clasificacion</label>
                                              <div id="clasificacion_all"></div>
                                          </div>
                                          <div class="form-group">
                                              <label for="metas">Resultados PDES</label>
                                              <div id="resultados_all"></div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="card-header" role="tab" id="headingThree">
                                      <h5 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                          Por PDES
                                        </a>
                                      </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                      <div class="card-block">
                                          <div class="form-group">
                                              <label for="pilares">Pilares</label>
                                              <div id="pilares"></div>
                                          </div>
                                          <div class="form-group">
                                              <label for="metas">Metas</label>
                                              <div id="metas"></div>
                                          </div>
                                          <div class="form-group">
                                              <label for="resultado">Resultados</label>
                                              <div id="resultados"></div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>










                              </div>
                          </div>
                          <div class="col-sm-9 ">
                            <h3 class="box-title panel panel-default"><i class="ti-settings"></i> Datos generales </h3>
                              <div class="well">
                                  <div class="row">
                                      <div class="col-lg-5 col-sm-5 col-xs-12 m-t-10">
                                          <h3 class="box-title m-b-0 m-t-5 text-success"><i class="fa fa-caret-right text-danger"></i>Descripcion PDES</h3>
                                          <div class="col-lg-12 col-sm-12 col-xs-12 m-t-10">
                                              <h3 id="tit_pilar" class="m-b-0 box-title">Pilar</h3>
                                              <p id="desc_pilar" class="text-muted">...</p>
                                          </div>
                                          <div class="col-lg-12 col-sm-12 col-xs-12 m-t-10">
                                              <h3 id="tit_meta" class="m-b-0 box-title">Meta</h3>
                                              <p id="desc_meta" class="text-muted">...</p>
                                          </div>
                                          <div class="col-lg-12 col-sm-12 col-xs-12 m-t-10" style="background-color: #f7fafc">
                                              <h3 id="tit_resultado" class="m-b-0 box-title">Resultado</h3>
                                              <p  class="text-danger"><b id="desc_resultado">...</b></p>
                                              <input type="hidden" name="id_sel_resultado">
                                          </div>

                                     </div>

                                     <div class="col-lg-3 col-sm-3 col-xs-12 m-t-10" style="background-color: #f7fafc">
                                       <h3 class="box-title m-b-0 m-t-5 text-success"><i class="fa fa-caret-right text-danger"></i>Datos de Resultado</h3>
                                       <div class="col-lg-12 col-sm-12 col-xs-12 m-t-10">
                                           <p id="tipo_resultado" class="text-muted"><b>:</b></p>
                                       </div>
                                       <div class="col-lg-12 col-sm-12 col-xs-12 m-t-10">
                                           <p id="desc_prioridad" class="text-muted"><b>: </b></p>
                                       </div>
                                       <div class="col-lg-12 col-sm-12 col-xs-12 m-t-10">
                                           <p id="desc_sectores" class="text-muted"><b>: </b></p>
                                       </div>
                                       <div class="col-lg-12 col-sm-12 col-xs-12 m-t-10">
                                           <p id="desc_nivel" class="text-muted"><b>:</b></p>
                                       </div>




                                     </div>
                                     <div class="col-lg-4 col-sm-4 col-xs-12 m-t-10" style="background-color: #f7fafc">
                                            <div id="grafica_medida_resultado" style=" height: 200px; width: 100%; margin: 0 auto"></div>
                                      </div>
                                  </div>



                              </div>
                          </div>
                          <div class="col-lg-12 s-t-10">
                              <hr/>
                          </div>
                          <div class="col-sm-12 ">
                                <h3 class="box-title panel panel-default"><i class="ti-settings"></i> Indicadores del Resultado </h3>
                              <div class="well">
                                  <div class="row">
                                      <div class="col-lg-12 col-sm-12 col-xs-12 m-t-10">

                                        <div class="button-box" style="background: rgb(241, 241, 241) none repeat scroll 0% 0%; padding-top: 5px; padding-left: 5px;">
                                            <button id="agregar" data-toggle="modal" data-target=".modal_nuevo_indicador"  class="fcbtn btn btn-success btn-outline btn-sm waves-effect disabled" disabled="true"><i class="ti-plus"></i>Agregar</button>
                                            <button id="modificar" data-toggle="modal" data-target=".modal_modificar_indicador" class="fcbtn btn btn-warning btn-outline btn-sm waves-effect disabled" disabled="true"><i class="ti-pencil"></i>Detallar</button>
                                            <button id="eliminar" class="fcbtn btn btn-danger btn-outline btn-sm waves-effect disabled" disabled="true"><i class="ti-trash"></i>Eliminar</button>
                                            <button id="limpiarfiltros" class="fcbtn btn btn-info btn-outline btn-sm waves-effect"><i class="ti-settings"></i>Quitar Filtros</button>
                                        </div>
                                        <div id="jqxgrid"></div>
                                      </div>

                                  </div>



                              </div>
                          </div>

                        </div>
              </div>
          </div>
      </div>

  </div>
  <!-- /.container-fluid -->



  <div id="modalNuevoIndicador" class="modal fade modal_nuevo_indicador" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static">
    <!-- sample modal content -->
    <form role="formnewIndicador" id="formnewIndicador" action="javascript:guardarIndicador();"  method="POST"  data-toggle="validator" class="form">
    {{ csrf_field() }}
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">Nuevo Indicador</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">


                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active nav-item"><a href="#datos_indicador" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Datos generales</span></a></li>
                                <li role="presentation" class="nav-item"><a href="#linea_base" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Linea Base</span></a></li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="datos_indicador">
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                      <div class="form-group row" style="background:#F7FAFC;">
                                          <label class="control-label col-sm-3" >Resultado relacionado</label>
                                          <div class="col-sm-9">
                                            <select name="resultado_asignado" class="form-control" required>
                                                <option value="">Ninguno</option>
                                                @foreach($resultados as $r)
                                                      <option value="{{$r->id}}">{{$r->nombre}} </option>
                                                @endforeach
                                            </select>
                                          </div>
                                      </div>

                                      <div class="form-group row" style="background:#F7FAFC;">
                                          <label class="control-label col-sm-3">Nombre de Indicador</label>
                                          <div class="col-sm-9">
                                            <textarea class="form-control" placeholder="Nombre del indicador" rows="2" name="indicador_nombre" required></textarea>
                                          </div>
                                      </div>

                                      <div class="form-group row" style="background:#F7FAFC;">
                                          <label class="control-label col-sm-3">Etapa</label>
                                          <div class="col-sm-9">
                                            <select name="etapa_indicador" class="form-control" required>
                                                <option value="">Ninguno</option>
                                                <option value="Proceso">Proceso</option>
                                                <option value="Producto">Producto</option>
                                                <option value="Resultado">Resultado</option>
                                            </select>
                                          </div>
                                      </div>

                                      <div class="form-group row" style="background:#F7FAFC;">
                                          <label class="control-label col-sm-3">Fuente de informacion</label>
                                          <div class="col-sm-9">
                                              <textarea name="fuente_informacion" class="form-control" placeholder="Fuente de informacion" rows="2" ></textarea>
                                          </div>
                                      </div>


                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="linea_base">
                                    <div class="col-md-12">
                                      <div class="form-group row">
                                          <label for="example-url-input" class="col-2 col-form-label">Tiempo</label>
                                          <div class="col-10">
                                              <input class="form-control" type="text"  placeholder="Tiempo" id="" name="">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label for="example-url-input" class="col-2 col-form-label">Valor</label>
                                          <div class="col-10">
                                              <input class="form-control" type="text"  placeholder="Valor"id="" name="">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label for="example-url-input" class="col-2 col-form-label">Unidad de Medida</label>
                                          <div class="col-10">
                                              <input class="form-control" type="text" placeholder="Unidad de Medida" id="" name="">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label for="example-url-input" class="col-2 col-form-label">Tipo</label>
                                          <div class="col-10">
                                              <input class="form-control" type="text" placeholder="Tipo" id="" name="">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div>




                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button id="reset_modal1" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                <!--button type="button" class="btn btn-danger waves-effect waves-light">Guardar</button-->
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
      </form>
  </div>
















  <div class="modal fade modal_modificar_indicador" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static">
    <!-- sample modal content -->
    <form role="formModIndicador" id="formModIndicador" action="javascript:modificarIndicador();"  method="POST"  data-toggle="validator" class="form">
    {{ csrf_field() }}
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">Datos de Indicador</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">


                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active nav-item"><a href="#mod_datos_indicador" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Datos generales</span></a></li>
                                <li role="presentation" class="nav-item"><a href="#mod_linea_base" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Linea Base</span></a></li>

                            </ul>

                            <!-- Tab panes -->
                            <input type="hidden" name="mod_id_indicador">
                            <input type="hidden" name="mod_id_resultado_indicador">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="mod_datos_indicador">
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                      <div class="form-group row" style="background:#F7FAFC;">
                                          <label class="control-label col-sm-3">Resultado relacionado</label>
                                          <div class="col-sm-9">
                                            <select name="mod_resultado_asignado" class="form-control" required>
                                                <option value="">Ninguno</option>
                                                @foreach($resultados as $r)
                                                      <option value="{{$r->id}}">{{$r->nombre}} </option>
                                                @endforeach
                                            </select>
                                          </div>
                                      </div>

                                      <div class="form-group row" style="background:#F7FAFC;">
                                          <label class="control-label col-sm-3">Nombre de Indicador</label>
                                          <div class="col-sm-9">
                                            <textarea class="form-control" placeholder="Nombre del indicador" rows="2" name="mod_indicador_nombre" required></textarea>
                                          </div>
                                      </div>

                                      <div class="form-group row" style="background:#F7FAFC;">
                                          <label class="control-label col-sm-3">Etapa</label>
                                          <div class="col-sm-9">
                                            <select name="mod_etapa_indicador" class="form-control" required>
                                                <option value="">Ninguno</option>
                                                <option value="Proceso">Proceso</option>
                                                <option value="Producto">Producto</option>
                                                <option value="Resultado">Resultado</option>
                                            </select>
                                          </div>
                                      </div>

                                      <div class="form-group row" style="background:#F7FAFC;">
                                          <label class="control-label col-sm-3">Fuente de informacion</label>
                                          <div class="col-sm-9">
                                              <textarea name="mod_fuente_informacion" class="form-control" placeholder="Fuente de informacion" rows="2" ></textarea>
                                          </div>
                                      </div>


                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="mod_linea_base">
                                    <div class="col-md-12">
                                      <div class="form-group row">
                                          <label for="example-url-input" class="col-2 col-form-label">Tiempo</label>
                                          <div class="col-10">
                                              <input class="form-control" type="text"  placeholder="Tiempo" id="" name="">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label for="example-url-input" class="col-2 col-form-label">Valor</label>
                                          <div class="col-10">
                                              <input class="form-control" type="text"  placeholder="Valor"id="" name="">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label for="example-url-input" class="col-2 col-form-label">Unidad de Medida</label>
                                          <div class="col-10">
                                              <input class="form-control" type="text" placeholder="Unidad de Medida" id="" name="">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label for="example-url-input" class="col-2 col-form-label">Tipo</label>
                                          <div class="col-10">
                                              <input class="form-control" type="text" placeholder="Tipo" id="" name="">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div>




                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button id="reset_modal1" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                <!--button type="button" class="btn btn-danger waves-effect waves-light">Guardar</button-->
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
      </form>
  </div>


  <!-- /.modal -->

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


  <!-- Sweet-Alert  -->
  <script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
  <script src="/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" ></script>




  <script type="text/javascript">
      function activarMenu(id,sub){
          $('#'+id).addClass('active');
      }

      $(document).ready(function(){

          activarMenu('mp_indicadores',0);
          //$('.modal-dialog').draggable();
              // prepare the data
          		var pilaresSource =
          		{
          		  dataType: "json",
          			dataFields: [
          				{ name: 'nombre'},
          				{ name: 'id'}
          			],
                url: '{{ url('/moduloindicadores/ajax/listarpilares') }}',
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
            			url:  '{{ url('/moduloindicadores/ajax/listarmetas') }}',
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
            			url:  '{{ url('/moduloindicadores/ajax/listarresultados') }}'
          		};
          		var resultadosAdapter = new $.jqx.dataAdapter(resultadosSource);

          		$("#resultados").jqxComboBox(
          		{

          		  width: '100%',
          			height: 25,
          			disabled: true,
          			promptText: "Seleccionar resultado...",
          			displayMember: 'nombre',
          			valueMember: 'id'
          		});













          		$("#pilares").bind('select', function(event)
          		{
                $('#agregar').attr("disabled", true);
                $('#agregar').addClass('disabled');

                $('#modificar').attr("disabled", true);
                $('#modificar').addClass('disabled');

                $('#eliminar').attr("disabled", true);
                $('#eliminar').addClass('disabled');



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

                      $.ajax({
                              url: "{{ url('/moduloindicadores/ajax/datospilar') }}",
                              data: { 'pilar': value },
                              type: "GET",
                              dataType: 'json',
                              success: function(data){
                                $("#tit_pilar").html(data.nombre);
                                $("#desc_pilar").html(data.descripcion);

                                //limpiamos los demas campos

                                $("#tit_meta").html('META');
                                $("#desc_meta").html('');

                                $("#tit_resultado").html('RESULTADO');
                                $("#desc_resultado").html('');

                                $("#desc_prioridad").html('');
                                $("#desc_sectores").html('');
                                $("#desc_nivel").html('');
                                $("#tipo_resultado").html('');

                              },
                              error:function(data){
                                alert("Error recuperar los datos.");
                              }
                          });
              			}
          		});



              $("#metas").bind('select', function(event)
          		{
                $('#agregar').attr("disabled", true);
                $('#agregar').addClass('disabled');
                $('#modificar').attr("disabled", true);
                $('#modificar').addClass('disabled');
                $('#eliminar').attr("disabled", true);
                $('#eliminar').addClass('disabled');

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
              				$("#resultados").jqxComboBox({ source: resultadosAdapter, autoDropDownHeight: resultadosAdapter.records.length > 10 ? false : true});
                      $.ajax({
                              url: "{{ url('/moduloindicadores/ajax/datosmeta') }}",
                              data: { 'meta': value },
                              type: "GET",
                              dataType: 'json',
                              success: function(data){
                                $("#tit_meta").html(data.nombre);
                                $("#desc_meta").html(data.descripcion);
                                //limpiamos los demas campos
                                $("#tit_resultado").html('RESULTADO');
                                $("#desc_resultado").html('');

                                $("#desc_prioridad").html('');
                                $("#desc_sectores").html('');
                                $("#desc_nivel").html('');
                                $("#tipo_resultado").html('');

                              },
                              error:function(data){
                                alert("Error recuperar los datos.");
                              }
                          });




              			}
          		});

              $("#resultados").bind('select', function(event)
          		{
                var value = event.args.item.value;
                //$('select[name="resultado_asignado"]').val(value);
                $('input[name="id_sel_resultado"]').val(value);
                $('#agregar').attr("disabled", false);
                $('#agregar').removeClass('disabled');
                $('#modificar').attr("disabled", true);
                $('#modificar').addClass('disabled');
                $('#eliminar').attr("disabled", true);
                $('#eliminar').addClass('disabled');
                $("#jqxgrid").jqxGrid('clearselection');

                $.ajax({
                        url: "{{ url('/moduloindicadores/ajax/datosresultado') }}",
                        data: { 'resultado': value },
                        type: "GET",
                        dataType: 'json',
                        success: function(date){
                          $.each(date, function(i, data) {
                                  $("#tit_resultado").html(data.nombre);
                                  $("#desc_resultado").html(data.descripcion);  //<b>Estado Priorizado: </b>


                                  //detalle datos de resultado/
                                  $("#desc_prioridad").html('<b>Estado Priorizado: </b>'+ (data.priorizado == 1 ? '<span class="label label-red label-rounded">SI</span>':'<span class="label label-info label-rounded">NO</span>') );
                                  $("#desc_sectores").html('<b>Sectores vinculados: </b>'+ (data.sector != null ? data.sector : "SIN SECTOR" ) );
                                  $("#desc_nivel").html('<b>Macro sector: </b>'+ (data.macro_sector != "" ? data.macro_sector:'SIN MACRO SECTOR') );
                                  $("#tipo_resultado").html('<b>Clasificación: </b>'+ (data.clasificacion != "" ? '<b class="text-info">'+data.clasificacion+'</b>':'SIN CLASIFICACION'));
                                  var source =
                                  {
                                      dataType: "json",
                                      dataFields: [
                                        { name: 'id_indicador',type: 'number' },
                                        { name: 'id_resultado_indicador',type: 'number' },
                                        { name: 'nombre', type: 'string' },
                                        { name: 'punto_medicion', type: 'string' }
                                      ],
                                      id: 'id_resultado_indicador',
                                      data:{'resultado': data.id},
                                      url: "{{ url('/moduloindicadores/ajax/listaindicadores') }}"
                                  };
                                  var dataAdapter = new $.jqx.dataAdapter(source);
                                  $("#jqxgrid").jqxGrid({source: dataAdapter});

                                  $.ajax({
                                      url: "{{ url('/moduloindicadores/ajax/listaresultadomedidasindicador') }}",
                                      data: { '_token': $('input[name=_token]').val(),'resultado': data.id },
                                      type: "POST",
                                      dataType: 'json',
                                      success: function (data) {
                                        options.series[0].name = "Indicadores";
                                        options.series[0].data = data;//[{ 'name': 'Proceso', 'y': 8 },{ name: 'Producto', y: 24.03 },{ name: 'Resultado', y: 10.38 }];
                                        var chart = new Highcharts.Chart(options);

                                      }
                                  });
                          });
                        },
                        error:function(data){
                          alert("Error recuperar los datos.");
                        }
                    });
              });



              var resultadosPriorizadosSource =
          		{
          		    dataType: "json",
            			dataFields: [
                    { name: 'nombre'},
                    { name: 'meta'},
            				{ name: 'id'}
            			],
            			url:  '{{ url('/moduloindicadores/ajax/listarresultadospriorizados') }}'
          		};
          		var resultadosPriorizadosAdapter = new $.jqx.dataAdapter(resultadosPriorizadosSource);

          		$("#resultados_priorizados").jqxComboBox(
          		{

          		  width: '100%',
                source: resultadosPriorizadosAdapter,
          			height: 25,
          			disabled: false,
          			promptText: "Seleccionar resultado...",
          			displayMember: 'nombre',
          			valueMember: 'id'
          		});
              $("#resultados_priorizados").bind('select', function(event)
          		{

                var value = event.args.item.value;

                 //$('select[name="resultado_asignado"]').val(value);
                 $('input[name="id_sel_resultado"]').val(value);
                 $('#agregar').attr("disabled", false);
                 $('#agregar').removeClass('disabled');
                 $('#modificar').attr("disabled", true);
                 $('#modificar').addClass('disabled');

                 $('#eliminar').attr("disabled", true);
                 $('#eliminar').addClass('disabled');
                 $("#jqxgrid").jqxGrid('clearselection');
                $.ajax({
                        url: "{{ url('/moduloindicadores/ajax/datosresultado') }}",
                        data: { 'resultado': value },
                        type: "GET",
                        dataType: 'json',
                        success: function(date){

                              $.each(date, function(i, data) {
                                $("#tit_pilar").html(data.pilar_nombre);
                                $("#desc_pilar").html(data.pilar_desc);
                                $("#tit_meta").html(data.meta_nombre);
                                $("#desc_meta").html(data.meta_desc);

                                  $("#tit_resultado").html(data.nombre);
                                  $("#desc_resultado").html(data.descripcion);  //<b>Estado Priorizado: </b>


                                  //detalle datos de resultado/
                                  $("#desc_prioridad").html('<b>Estado Priorizado: </b>'+ (data.priorizado == 1 ? '<span class="label label-red label-rounded">SI</span>':'<span class="label label-info label-rounded">NO</span>') );
                                  $("#desc_sectores").html('<b>Sectores vinculados: </b>'+ (data.sector != null ? data.sector : "SIN SECTOR" ) );
                                  $("#desc_nivel").html('<b>Macro sector: </b>'+ (data.macro_sector != "" ? data.macro_sector:'SIN MACRO SECTOR') );
                                  $("#tipo_resultado").html('<b>Clasificación: </b>'+ (data.clasificacion != "" ? '<b class="text-info">'+data.clasificacion+'</b>':'SIN CLASIFICACION'));

                                  var source =
                                  {
                                      dataType: "json",
                                      dataFields: [
                                        { name: 'id_indicador',type: 'number' },
                                        { name: 'id_resultado_indicador',type: 'number' },
                                        { name: 'nombre', type: 'string' },
                                        { name: 'punto_medicion', type: 'string' }
                                      ],
                                      id: 'id_resultado_indicador',
                                      data:{'resultado': data.id},
                                      url: "{{ url('/moduloindicadores/ajax/listaindicadores') }}"
                                  };
                                  var dataAdapter = new $.jqx.dataAdapter(source);
                                  $("#jqxgrid").jqxGrid({source: dataAdapter});

                                  $.ajax({
                                      url: "{{ url('/moduloindicadores/ajax/listaresultadomedidasindicador') }}",
                                      data: { '_token': $('input[name=_token]').val(),'resultado': data.id },
                                      type: "POST",
                                      dataType: 'json',
                                      success: function (data) {
                                        options.series[0].name = "Indicadores";
                                        options.series[0].data = data;//[{ 'name': 'Proceso', 'y': 8 },{ name: 'Producto', y: 24.03 },{ name: 'Resultado', y: 10.38 }];
                                        var chart = new Highcharts.Chart(options);

                                      }
                                  });
                            });

                        },
                        error:function(data){
                          alert("Error recuperar los datos.");
                        }
                    });
          		});


              var resultadosAllSource =
          		{
          		    dataType: "json",
            			dataFields: [
                    { name: 'nombre'},
                    { name: 'meta'},
                    { name: 'clasificacion'},
            				{ name: 'id'}
            			],
            			url:  '{{ url('/moduloindicadores/ajax/listarresultadosall') }}'
          		};
          		var resultadosAllAdapter = new $.jqx.dataAdapter(resultadosAllSource);

          		$("#resultados_all").jqxComboBox(
          		{

          		  width: '100%',
                source: resultadosAllAdapter,
          			height: 25,
          			disabled: false,
          			promptText: "Seleccionar resultado...",
          			displayMember: 'nombre',
          			valueMember: 'id'
          		});

              $("#resultados_all").bind('select', function(event)
          		{

                var value = event.args.item.value;
                //$('select[name="resultado_asignado"]').val(value);
                $('input[name="id_sel_resultado"]').val(value);
                $('#agregar').attr("disabled", false);
                $('#agregar').removeClass('disabled');
                $('#modificar').attr("disabled", true);
                $('#modificar').addClass('disabled');

                $('#eliminar').attr("disabled", true);
                $('#eliminar').addClass('disabled');
                $("#jqxgrid").jqxGrid('clearselection');
                $.ajax({
                        url: "{{ url('/moduloindicadores/ajax/datosresultado') }}",
                        data: { 'resultado': value },
                        type: "GET",
                        dataType: 'json',
                        success: function(date){

                          $.each(date, function(i, data) {

                            $("#tit_pilar").html(data.pilar_nombre);
                            $("#desc_pilar").html(data.pilar_desc);
                            $("#tit_meta").html(data.meta_nombre);
                            $("#desc_meta").html(data.meta_desc);


                                $("#tit_resultado").html(data.nombre);
                                $("#desc_resultado").html(data.descripcion);  //<b>Estado Priorizado: </b>


                                //detalle datos de resultado/
                                $("#desc_prioridad").html('<b>Estado Priorizado: </b>'+ (data.priorizado == 1 ? '<span class="label label-red label-rounded">SI</span>':'<span class="label label-info label-rounded">NO</span>') );
                                $("#desc_sectores").html('<b>Sectores vinculados: </b>'+ (data.sector != null ? data.sector : "SIN SECTOR" ) );
                                $("#desc_nivel").html('<b>Macro sector: </b>'+ (data.macro_sector != "" ? data.macro_sector:'SIN MACRO SECTOR') );
                                $("#tipo_resultado").html('<b>Clasificación: </b>'+ (data.clasificacion != "" ? '<b class="text-info">'+data.clasificacion+'</b>':'SIN CLASIFICACION'));

                                var source =
                                {
                                    dataType: "json",
                                    dataFields: [
                                      { name: 'id_resultado_indicador',type: 'number' },
                                      { name: 'id_indicador',type: 'number' },
                                      { name: 'nombre', type: 'string' },
                                      { name: 'punto_medicion', type: 'string' }
                                    ],
                                    id: 'id_resultado_indicador',
                                    data:{'resultado': data.id},
                                    url: "{{ url('/moduloindicadores/ajax/listaindicadores') }}"
                                };
                                var dataAdapter = new $.jqx.dataAdapter(source);
                                $("#jqxgrid").jqxGrid({source: dataAdapter});

                                $.ajax({
                                    url: "{{ url('/moduloindicadores/ajax/listaresultadomedidasindicador') }}",
                                    data: { '_token': $('input[name=_token]').val(),'resultado': data.id },
                                    type: "POST",
                                    dataType: 'json',
                                    success: function (data) {
                                      options.series[0].name = "Indicadores";
                                      options.series[0].data = data;//[{ 'name': 'Proceso', 'y': 8 },{ name: 'Producto', y: 24.03 },{ name: 'Resultado', y: 10.38 }];
                                      var chart = new Highcharts.Chart(options);

                                    }
                                });
                          });

                        },
                        error:function(data){
                          alert("Error recuperar los datos.");
                        }
                    });
          		});

              var clasificacionResultadoSource =
              {
                  dataType: "json",
                  dataFields: [
                    { name: 'clasificacion'}
                  ],
                  url:  '{{ url('/moduloindicadores/ajax/listaclasificacionresultado') }}'
              };
              var clasificacionResultadoAdapter = new $.jqx.dataAdapter(clasificacionResultadoSource);

              $("#clasificacion_all").jqxComboBox(
              {

                width: '100%',
                source: clasificacionResultadoAdapter,
                height: 25,
                disabled: false,
                selectedIndex: 0,
                promptText: "Seleccionar clasificacion...",
                displayMember: 'clasificacion',
                valueMember: 'clasificacion'
              });


              $("#clasificacion_all").bind('select', function(event)
          		{
                $('#agregar').attr("disabled", true);
                $('#agregar').addClass('disabled');

                $('#modificar').attr("disabled", true);
                $('#modificar').addClass('disabled');

                $('#eliminar').attr("disabled", true);
                $('#eliminar').addClass('disabled');

                $("#jqxgrid").jqxGrid('clear');

                if (event.args)
              			{

                      $("#tit_pilar").html('PILAR');
                      $("#desc_pilar").html('');
                      $("#tit_meta").html('META');
                      $("#desc_meta").html('');

                      $("#tit_resultado").html('RESULTADO');
                      $("#desc_resultado").html('');

                      $("#desc_prioridad").html('');
                      $("#desc_sectores").html('');
                      $("#desc_nivel").html('');
                      $("#tipo_resultado").html('');

                      var resultadosAllSource =
                  		{
                  		    dataType: "json",
                    			dataFields: [
                            { name: 'nombre'},
                            { name: 'meta'},
                            { name: 'clasificacion'},
                    				{ name: 'id'}
                    			],
                    			url:  '{{ url('/moduloindicadores/ajax/listarresultadosallclasificados') }}',
                          data: {'clasificacion': event.args.item.value}
                  		};
                  		var resultadosAllAdapter = new $.jqx.dataAdapter(resultadosAllSource);
              				$("#resultados_all").jqxComboBox({ source: resultadosAllAdapter });

                      options.series[0].data = null;//[{ 'name': 'Proceso', 'y': 8 },{ name: 'Producto', y: 24.03 },{ name: 'Resultado', y: 10.38 }];
                      var chart = new Highcharts.Chart(options);


              			}
          		});



          var theme = 'light';
          $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                //autoheight: true,
                height: 400,
                theme: theme,

                groupable: true,
                //
                //showfilterrow: true,
                filterable: true,
                filtermode: 'excel',
                pageable: true,
                pagermode: 'simple',
                pagesize: 50,
                autorowheight:true,
                columnsresize:true,

                //autoheight: true,
                columns: [
                  { text: '#', datafield: 'id_indicador',  width: 50 },
                  { text: 'Tipo', datafield: 'punto_medicion', width: 130},
                  { text: 'Nombre Indicador', datafield: 'nombre', columntype: 'textbox',width: 900}

                ]
            });
            $("#jqxgrid").bind('rowselect', function(event) {
                $('#modificar').attr("disabled", false);
                $('#modificar').removeClass('disabled');
                $('#eliminar').attr("disabled", false);
                $('#eliminar').removeClass('disabled');
            });

            // $("#jqxgrid").bind('rowunselect', function(event) {
            //     $('#modificar').attr("disabled", true);
            //     $('#modificar').addClass('disabled');
            //     $('#eliminar').attr("disabled", true);
            //     $('#eliminar').addClass('disabled');
            // });

            //apertura de modal



            //ABM INDICADORES
            $('#agregar').click(function() {
                  $('select[name="resultado_asignado"]').val($('input[name="id_sel_resultado"]').val() );
            });

            $('#modificar').click(function() {
              var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
              if (rowindex > -1)
              {
                 var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
                $.ajax({
                        url: "{{ url('/moduloindicadores/ajax/datosindicador') }}",
                        data: { '_token': $('input[name=_token]').val(),'indicador': dataRecord.id_indicador,'resultado': $('input[name="id_sel_resultado"]').val() },
                        type: "post",
                        dataType: 'json',
                        success: function(date){
                          $.each(date, function(i, data) {

                              $('input[name="mod_id_indicador"]').val(data.id_indicador);
                              $('input[name="mod_id_resultado_indicador"]').val(data.id_resultado_indicador);
                              $('select[name="mod_resultado_asignado"]').val(data.id_resultado);
                              $('textarea[name="mod_indicador_nombre"]').val(data.nombre);
                              $('select[name="mod_etapa_indicador"]').val(data.punto_medicion);
                              $('textarea[name="mod_fuente_informacion"]').val(data.fuente_informacion);
                          });
                        },
                        error:function(data){
                          alert("Error recuperar los datos.");
                        }
                    });
              }else {
                    alert("Seleccione un indicador.");
              }

            });


            $('#eliminar').click(function() {
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
                           url: "{{ url('/moduloindicadores/ajax/eliminarindicador') }}",
                           data: { '_token': $('input[name=_token]').val(),'indicador': dataRecord.id_indicador },
                           type: "delete",
                           dataType: 'json',
                           success: function(date){
                               $("#jqxgrid").jqxGrid("updatebounddata");
                               swal("Eliminado!", "Se ha eliminado tu registro.", "success");
                           },
                           error:function(data){
                             alert("Error recuperar los datos.");
                           }
                       });
                });

              }else {
                    alert("Seleccione un indicador.");
              }

            });

            $('#reset_modal1').click(function() {
                $("#formnewIndicador")[0].reset();
            });
            $('#limpiarfiltros').click(function () {
                $("#jqxgrid").jqxGrid('clearfilters');
            });






      });


      function guardarIndicador(){
        $.ajax({
              type: "POST",
              url: "{{ url('/moduloindicadores/ajax/guardarindicador') }}",
              dataType: 'json',
              data: $("#formnewIndicador").serialize() , // Adjuntar los campos del formulario enviado.
              success: function(data){
                  $('#modalNuevoIndicador').modal('hide');
                  $("#formnewIndicador")[0].reset();
                  $("#jqxgrid").jqxGrid("updatebounddata");
              }
          });


      }

      function modificarIndicador(){
        $.ajax({
              type: "POST",
              url: "{{ url('/moduloindicadores/ajax/modificarindicador') }}",
              dataType: 'json',
              data: $("#formModIndicador").serialize() , // Adjuntar los campos del formulario enviado.
              success: function(data){
                  $('.modal_modificar_indicador').modal('hide');
                  $("#formModIndicador")[0].reset();
                  $("#jqxgrid").jqxGrid("updatebounddata");
              }
          });


      }


      ///////GRAFICAAAAAA

      var options = {
          chart: {
              renderTo: 'grafica_medida_resultado',
              type: 'column'
          },
          xAxis: {
            type: 'category',
             labels: {
                 style: {
                     fontSize: '11px',
                     fontFamily: 'Verdana, sans-serif'

                 }
             }
          },
          yAxis: {
            min: 0,
            title: {
                text: 'Cantidad de indicadores'
            }
          },
          title:false,
          tooltip: {
              pointFormat: '{series.name}: <b>{point.y:.f}</b>'
          },

          credits: {
               enabled: false
          },
          legend: {
              enabled: false
          },
          series:[{
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
                x: 15,
                y: -10, // 10 pixels down from the top
                style: {
                    fontSize: '10px',
                    fontWeight: "bold",
                    fontFamily: 'Verdana, sans-serif'
                }
            }
          }]
     };



    </script>
@endpush
