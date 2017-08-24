@extends('layouts.ModuloPdes')

@section('header')
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.light.css" type="text/css" />
  <link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

<style>
.ribbon-pilar {
    background: #2d4d6a none repeat scroll 0 0;
}
.ribbon-meta {
    background: #9CC2E5 none repeat scroll 0 0;
}
</style>
@endsection

@section('content')
  {{-- Titulo --}}
<div class="row bg-title p-t-0 p-b-0 m-b-5">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Tablero PDES</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active">Tablero PDES</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
          {{-- Primer Panel --}}
          <div id="descripcion_pdes" class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading p-t-10 p-b-10" data-perform="panel-collapse">Detalle PDES
                        <div class="panel-action">
                          <a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                          <div class="row well m-b-0 p-0 p-t-10">
                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                  <div class="ribbon-wrapper well p-l-10">
                                      <div class="ribbon ribbon-pilar">Pilar</div>
                                      <p class="ribbon-content">
                                      <b class="text-default"><span id="pilar_cod">:</span></b>
                                      <span id="pilar_desc"></span>
                                      </p>
                                  </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                  <div class="ribbon-wrapper well p-l-10">
                                      <div class="ribbon ribbon-meta">Meta</div>
                                      <p class="ribbon-content">
                                        <b class="text-default"><span id="meta_cod">:</span></b>
                                        <span id="meta_desc"></span>
                                      </p>
                                  </div>
                              </div>
                              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                  <div class="ribbon-wrapper well p-l-10">
                                      <div class="ribbon ribbon-danger">Resultado</div>
                                      <p class="ribbon-content">
                                        <b class="text-default"><span id="resultado_cod">:</span></b>
                                        <span id="resultado_desc"></span>
                                        <input type="hidden" name="id_sel_resultado">
                                      </p>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
              </div>
          </div>
          {{--  SEgundo Panel --}}
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading p-t-10 p-b-10" data-perform="panel-collapse">Datos articulados al Resultado
                        <div class="panel-action">
                          <a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                      <div class="well m-b-0 p-0 p-t-10">

                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <div class="white-box p-10 ">
                                    <div class="row row-in">
                                        <div class="col-lg-3 col-md-6  col-sm-6 row-in-br">
                                            <div class="col-in row p-10">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    {{-- <i data-icon="E" class="linea-icon linea-basic"></i> --}}
                                                    <h5 class="text-muted vb">Tipo Clasificacion:</h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <h5 id="clasificacion_res" class="counter text-left text-danger"></h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    {{-- <i data-icon="E" class="linea-icon linea-basic"></i> --}}
                                                    <h5 class="text-muted vb">Estado Priorizado:</h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <h5 id="priorizado_res" class="counter text-left text-danger"></h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    {{-- <i data-icon="E" class="linea-icon linea-basic"></i> --}}
                                                    <h5 class="text-muted vb">Sectores Vinculados:</h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <h5 id="sector_res" class="counter text-left text-danger"></h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    {{-- <i data-icon="E" class="linea-icon linea-basic"></i> --}}
                                                    <h5 class="text-muted vb">Macro Sector:</h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <h5 id="macrosector_res"class="counter text-left text-danger"></h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-sm-6 row-in-br">
                                            <div class="col-in row">
                                                <div class="col-md-6 col-sm-6 col-xs-6"> <i class="fa fa-bar-chart-o"></i>
                                                    <h5 class="text-muted vb">Total Indicadores del resultado</h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <h3 id="total_indicadores" class="counter text-right m-t-15 text-primary"></h3>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"> <span class="sr-only"></span> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-sm-6 row-in-br  b-r-none">
                                            <div class="col-in row">
                                                <div class="col-md-6 col-sm-6 col-xs-6"> <i class=" fa fa-folder-o"></i>
                                                    <h5 class="text-muted vb">Total Proyectos alineados al resultado</h5>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <h3 id="total_proyectos" class="counter text-right m-t-15 text-megna"></h3>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"> <span class="sr-only"></span> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-3 col-md-6 col-sm-6  b-0">
                                            <div id="grafica_medida_resultado" style=" height: 200px; width: 100%; margin: 0 auto"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>

                    </div>
                </div>
              </div>
          </div>



          {{-- Tercer Panel --}}
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading p-t-10 p-b-10" data-perform="panel-collapse">Tabla de contenidos
                        <div class="panel-action">
                          <a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                          <div class="row well m-b-0 p-0 p-t-10">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div id='jqxTabs'>
                                  <ul style='margin-left: 20px;'>
                                      <li>Lista de indicadores</li>
                                      <li>Lista de Proyectos</li>
                                  </ul>
                                  <div>
                                    <div class="button-box" style="background: rgb(241, 241, 241) none repeat scroll 0% 0%; padding-top: 5px; padding-left: 5px;">
                                        <button id="agregar" data-toggle="modal" data-target=".modal_nuevo_indicador"  class="fcbtn btn btn-success btn-outline btn-sm waves-effect disabled" disabled="true"><i class="ti-plus"></i>Agregar</button>
                                        <button id="modificar" data-toggle="modal" data-target=".modal_modificar_indicador" class="fcbtn btn btn-warning btn-outline btn-sm waves-effect disabled" disabled="true"><i class="ti-pencil"></i>Detallar</button>
                                        <button id="eliminar" class="fcbtn btn btn-danger btn-outline btn-sm waves-effect disabled" disabled="true"><i class="ti-trash"></i>Eliminar</button>
                                        <button id="limpiarfiltros" class="fcbtn btn btn-info btn-outline btn-sm waves-effect"><i class="ti-settings"></i>Quitar Filtros</button>
                                    </div>
                                      <div id="jqxgrid"></div>
                                  </div>
                                  <div>Content 2</div>
                                </div>

                              </div>
                          </div>
                    </div>
                </div>
              </div>
          </div>







        </div>
    </div>
</div>

<!-- /.modal bootstrap -->
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
                                          <input name="sel_indicador" type="checkbox"/>Buscar indicador existente
                                          <textarea id="indicador_nombre" class="form-control" placeholder="Nombre del indicador" rows="2" name="indicador_nombre" required></textarea>
                                          <div id='indicador_nombre_sel' style='float: left; margin-top: 10px;' ></div>
                                          {{-- <textarea id="indicador_nombre_sel"  class="form-control" placeholder="Buscar indicador" rows="2" name="indicador_nombre_sel" required></textarea> --}}
                                          <input type="hidden" name="id_indicador_sel">
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
                                        <label for="example-url-input" class="col-2 col-form-label">gestion</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text"  placeholder="Gestión" id="linea_base_gestion" name="linea_base_gestion">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-2 col-form-label">Valor</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text"  placeholder="Valor" id="linea_base_valor" name="linea_base_valor">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-2 col-form-label">Unidad de Medida</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="Unidad de Medida" id="linea_base_unidad" name="linea_base_unidad">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-2 col-form-label">Descripcion</label>
                                        <div class="col-10">
                                            <textarea class="form-control" placeholder="Descripcion de linea base" rows="2" id="linea_base_descripcion" name="linea_base_descripcion"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-2 col-form-label">Fuente de datos alternativa</label>
                                        <div class="col-10">
                                            <textarea class="form-control" placeholder="Fuente de datos alternativa" rows="2" id="linea_base_fuente_alternativa" name="linea_base_fuente_alternativa"></textarea>
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
                              <li role="presentation" class="active nav-item"><a href="#mod_datos_indicador" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Datos generales</span></a>
                              </li>
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
                                        <label for="example-url-input" class="col-2 col-form-label">gestion</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text"  placeholder="Gestión" id="mod_linea_base_gestion" name="mod_linea_base_gestion">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-2 col-form-label">Valor</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text"  placeholder="Valor" id="mod_linea_base_valor" name="mod_linea_base_valor">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-2 col-form-label">Unidad de Medida</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="Unidad de Medida" id="mod_linea_base_unidad" name="mod_linea_base_unidad">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-2 col-form-label">Descripcion</label>
                                        <div class="col-10">
                                            <textarea class="form-control" placeholder="Descripcion de linea base" rows="2" id="mod_linea_base_descripcion" name="mod_linea_base_descripcion"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-2 col-form-label">Fuente de datos alternativa</label>
                                        <div class="col-10">
                                            <textarea class="form-control" placeholder="Fuente de datos alternativa" rows="2" id="mod_linea_base_fuente_alternativa" name="mod_linea_base_fuente_alternativa"></textarea>
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


<!-- /.modal bootstrap -->

{{--  Modales jqwidgets--}}
<div id="window" style="display: none;">
    <div>
      <section>Filtro PDES</section>
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
              <div class="modal-footer">
                <button id="clear_filtro_pdes" type="button" class="btn btn-info btn-circle"><i class="fa ti-reload"></i></button>
                <button id="cerrar_filtro_pdes" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Salir</button>
              </div>
              </form>
          </section>
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

  <!-- Sweet-Alert  -->
  <script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
  <script src="/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" ></script>

  <script type="text/javascript">
    $(document).ready(function(){
      //Configuracion para control al precionar botones de funcion (F4)

      $(document).keydown(function(e) {
        if(e.which == 115){
          $('#filtro_pdes').trigger('click');
        }


      });



      //Configuraciones
      $('#indicador_nombre_sel').hide();
      $('#jqxTabs').jqxTabs({
           width: '100%',
           theme: 'energyblue',
           height: 'auto',
           scrollPosition: 'both'
      });
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
      var theme = 'light';
      $("#jqxgrid").jqxGrid(
        {
            width: '99%',
            height: 400,
            theme: theme,
            groupable: true,
            filterable: true,
            filtermode: 'excel',
            pageable: true,
            pagermode: 'simple',
            pagesize: 50,
            autorowheight:true,
            columnsresize:true,
            ready: function () {
                  $("#jqxgrid").jqxGrid('localizestrings', localizationobj);
            },
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


        // COnfiguraciones para el Modal jqwidgetsfunction createElements1() {
        function createElements1() {
            $('#window').jqxWindow({
                resizable: false,
                isModal: true,
                autoOpen: false,
                width: 'auto',
                height: 320,
                minWidth: 300,
                //minHeight: 350,
                //cancelButton: $("#Cancel"),
                modalOpacity: 0.01
            });
            var offset = $("#side-menu").offset();
            $("#window").jqxWindow({ position: { x: parseInt(offset.left) + 25, y: parseInt(offset.top) + (-5) } });
            $('#window').jqxWindow('focus');
        }
        createElements1();

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

        });

        $('#cerrar_filtro_pdes').click(function() {
             $('#window').jqxWindow('close');
        });

        //Accion del menu de Herramientas (FILTROs)
        $('#filtro_pdes').click(function() {
                $("#window").css('visibility', 'visible');
                $('#window').jqxWindow('open');
                $('#window').jqxWindow('focus');
        });

        //Combos de los filtros
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

        $("#pilares").bind('select', function(event)
        {
          $('#agregar').attr("disabled", true);
          $('#agregar').addClass('disabled');

          $('#modificar').attr("disabled", true);
          $('#modificar').addClass('disabled');

          $('#eliminar').attr("disabled", true);
          $('#eliminar').addClass('disabled');
          //limpiamos los datos extras del resultado
          $("#clasificacion_res").html("");
          $("#priorizado_res").html("");
          $("#sector_res").html("");
          $("#macrosector_res").html("");
          $("#total_indicadores").html("");
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
                          $("#pilar_cod").html(data.nombre + ": ");
                          $("#pilar_desc").html(data.descripcion);

                          //limpiamos los demas campos

                          $("#meta_cod").html('');
                          $("#meta_desc").html('');

                          $("#resultado_cod").html('');
                          $("#resultado_desc").html('');
                          //
                          // $("#desc_prioridad").html('');
                          // $("#desc_sectores").html('');
                          // $("#desc_nivel").html('');
                          // $("#tipo_resultado").html('');

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
          //limpiamos los datos extras del resultado
          $("#clasificacion_res").html("");
          $("#priorizado_res").html("");
          $("#sector_res").html("");
          $("#macrosector_res").html("");
          $("#total_indicadores").html("");

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
                $.ajax({
                        url: "{{ url('/moduloindicadores/ajax/datosmeta') }}",
                        data: { 'meta': value },
                        type: "GET",
                        dataType: 'json',
                        success: function(data){
                          $("#meta_cod").html(data.nombre +": ");
                          $("#meta_desc").html(data.descripcion);
                          //limpiamos los demas campos
                          $("#resultado_cod").html('');
                          $("#resultado_desc").html('');

                          // $("#desc_prioridad").html('');
                          // $("#desc_sectores").html('');
                          // $("#desc_nivel").html('');
                          // $("#tipo_resultado").html('');

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
                          $("#pilar_cod").html(data.pilar_nombre+": ");
                          $("#pilar_desc").html(data.pilar_desc);
                          $("#meta_cod").html(data.meta_nombre+": ");
                          $("#meta_desc").html(data.meta_desc);

                          $("#resultado_cod").html(data.nombre+": ");
                          $("#resultado_desc").html(data.descripcion);  //<b>Estado Priorizado: </b>
                          //datos extras del resultado
                          $("#clasificacion_res").html((data.clasificacion != "" ? '<b class="text-info">'+data.clasificacion+'</b>':'SIN CLASIFICACION'));
                          $("#priorizado_res").html((data.priorizado == 1 ? '<span class="label label-red label-rounded">SI</span>':'<span class="label label-info label-rounded">NO</span>'));
                          $("#sector_res").html((data.sector != null ? data.sector : "SIN SECTOR" ));
                          $("#macrosector_res").html((data.macro_sector != "" ? data.macro_sector:'SIN MACRO SECTOR'));

                            //Actuaizamos el listdo de indicadores del resultado
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
                            var dataAdapter = new $.jqx.dataAdapter(source, {
                                      loadComplete: function () {
                                          var length = dataAdapter.records.length;
                                          $("#total_indicadores").html(length);
                                      }
                            });
                            $("#jqxgrid").jqxGrid({source: dataAdapter});

                            //GEneramos la grafica de barras por tipo de indicador relacionado al resultado
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



        //ABM INDICADORES
        $('#agregar').click(function() {
              $('#indicador_nombre_sel').hide();
              $('#indicador_nombre').show();
              $('select[name="resultado_asignado"]').val($('input[name="id_sel_resultado"]').val() );
        });

        $('#modificar').click(function() {
          var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
          if (rowindex > -1)
          {
             var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
            $.ajax({
                    url: "{{ url('/moduloindicadores/ajax/datosindicador') }}",
                    data: { '_token': $('input[name=_token]').val(),'indicador_resultado': dataRecord.id_resultado_indicador },
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

                          $('input[name="mod_linea_base_gestion"]').val(data.linea_base_gestion);
                          $('input[name="mod_linea_base_valor"]').val(data.linea_base_valor);
                          $('input[name="mod_linea_base_unidad"]').val(data.linea_base_unidad);

                          $('textarea[name="mod_linea_base_descripcion"]').val(data.linea_base_descripcion);
                          $('textarea[name="mod_linea_base_fuente_alternativa"]').val(data.linea_base_fuente_alternativa);
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
                       data: { '_token': $('input[name=_token]').val(),'indicador_resultado': dataRecord.id_resultado_indicador },
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


        var sourceAUT =
          {
              datatype: "json",
              datafields: [
                  { name: 'id_indicador' },
                  { name: 'nombre' }
              ],
              url:  '{{ url('/moduloindicadores/ajax/autocompletarindicadores') }}',
              async: false
          };
        var dataAdapterAUT = new $.jqx.dataAdapter(sourceAUT);

        $("#indicador_nombre_sel").jqxComboBox({
          source: dataAdapterAUT,
          displayMember: "nombre",
          valueMember: "id_indicador",
          selectedIndex: 0,
          width: '100%',
          height: '50',
          searchMode:'containsignorecase',
         autoComplete:true

        });

        $("#indicador_nombre_sel").on('select', function (event) {
          if (event.args) {
                  var item = event.args.item;
                  if (item) {
                    $('input[name="id_indicador_sel"]').val(item.value);//item.label

                    $.ajax({
                            url: "{{ url('/moduloindicadores/ajax/datoscatalogoindicador') }}",
                            data: { '_token': $('input[name=_token]').val(),'indicador': item.value },
                            type: "post",
                            dataType: 'json',
                            success: function(date){
                              $.each(date, function(i, data) {
                                  //$('textarea[name="indicador_nombre"]').val(data.nombre);
                                  $('textarea[name="fuente_informacion"]').val(data.fuente_informacion);
                              });
                            },
                            error:function(data){
                              alert("Error recuperar los datos.");
                            }
                        });
                  }
              }
        });



        ///CHECK HABILITAMOS LA BUSQUEDA PARA INDIcADOR EXISTENTE

        $('input[name="sel_indicador"]').change(function(){
            if($(this).prop("checked")) {

              $('#indicador_nombre_sel').show();
              $('#indicador_nombre').hide();

              $('#indicador_nombre_sel').val('');
              $('#id_indicador_sel').val('');
              //$('input[name="indicador_nombre"]').addClass('hide');
              $('#indicador_nombre').removeAttr("required");

            } else {
              $('#indicador_nombre_sel').hide();
              $('#indicador_nombre').show();
              $('#indicador_nombre').prop("required", true);
              $('textarea[name="fuente_informacion"]').val('');
            }
          });


        ///CHECK HABILITAMOS LA BUSQUEDA PARA INDIcADOR EXISTENTE


    });

    //fUNCIONES PARA GUARDAR DATOS en la base de DATOS
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


    ///////GRAFICAAAAAAs

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
