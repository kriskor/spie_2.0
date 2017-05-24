@extends('layouts.ModuloAdmindatabase')

@section('header')
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.darkblue.css" type="text/css" />
  <link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

@endsection

@section('content')
  <!---AQUI VIENE EL TITULO--->
  <div class="container-fluid">
      <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h4 class="page-title">Clasificador de Entidades</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                  <li><a href="#">Clasificadores</a></li>
                  <li class="active">Entidades</li>
              </ol>
          </div>
          <!-- /.col-lg-12 -->
      </div>


      <!---DESDE AQUI VIENE EL CONTENIDO--->
      <div class="row">
          <div class="col-md-12">
              <div class="white-box">
                    <div class="button-box" style="background: rgb(241, 241, 241) none repeat scroll 0% 0%; padding-top: 5px; padding-left: 5px;">
                        <button data-toggle="modal" data-target=".modNuevaEntidad"  class="fcbtn btn btn-success btn-outline btn-sm waves-effect"><i class="ti-plus"></i>Agregar</button>
                        <button id="modificar" data-toggle="modal" data-target=".modModificaEntidad" class="fcbtn btn btn-warning btn-outline btn-sm waves-effect"><i class="ti-pencil"></i>Detallar</button>
                        <button id="eliminar" class="fcbtn btn btn-danger btn-outline btn-sm waves-effect"><i class="ti-trash"></i>Eliminar</button>
                        <button id="limpiarfiltros" class="fcbtn btn btn-info btn-outline btn-sm waves-effect"><i class="ti-settings"></i>Limpiar Filtros</button>
                    </div>
                    <div id="jqxgrid">
                    </div>
                    <div class="row bg-title">
                        <div class="col-lg-8 col-md-8 col-sm-4 col-xs-12">
                            <div id="table"></div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-8 col-xs-12">

                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
              </div>
          </div>
      </div>

    </div>
  <!-- /.container-fluid -->


  <!-- sample modal content -->
  <div class="modal fade modNuevaEntidad" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static">
    <form role="formnewEntidad" id="formnewEntidad" action="javascript:guardarEntidad();"  method="POST"  data-toggle="validator" class="form">
    {{ csrf_field() }}
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myLargeModalLabel">Nueva entidad</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                          <div class="white-box">

                                <div class="form-group">
                                  <label class="control-label">Nombre entidad</label>
                                  <textarea class="form-control" placeholder="Ingrese nombre de la entidad" rows="2" name="nombre" required></textarea>
                                </div>

                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Sigla</label>
                                      <input type="text" placeholder="Ingresar sigla" class="form-control" name="sigla" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label">Código MEF</label>
                                     <input type="text" placeholder="Ingresar codigo" class="form-control" name="codigo_mef" required>
                                   </div>
                                </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label>Fecha creacion de la entidad</label>
                                     <input class="form-control" data-mask="99/99/9999" placeholder="" type="text" name="fecha_creacion">
                                   </div>
                                </div>

                                </div>

                                <div class="form-group">
                                  <label>Normativa de creacion</label>
                                  <textarea class="form-control" placeholder="Ingrese datos de la normativa de creacion" rows="2" name="normativa_creacion"></textarea>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Página web</label>
                                  <input type="text" placeholder="Ingresar sigla" class="form-control" name="url_web">
                                </div>


                                <div class="form-group">
                                  <div class="select2-wrapper">
                                    <label class="control-label">Ubicacion</label>
                                    <select placeholder="Ingresar sigla" class="form-control" name="id_region" required='required'>
                                              <option value="">Ninguno</option>
                                        @foreach($regiones as $region)
                                              <option value="{{$region->id}}">
                                                  {{$region->departamento}}
                                                  @if ($region->provincia != "")->@endif
                                                  {{$region->provincia}}
                                                  @if ($region->municipio != "")->@endif
                                                  {{$region->municipio}}
                                              </option>
                                        @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label>Relacion de la entidad</label>
                                    <div class="">
                                      <input type="radio" value="tuicion" name="tipo_relacion" >
                                      Entidad bajo Tuicion
                                      <input type="radio" value="dependiente" name="tipo_relacion">
                                      Entidad dependiente
                                      <input type="radio" value="ninguno" name="tipo_relacion" checked="">
                                      Ninguno
                                    </div>

                                </div>

                                <div id="_relacion" class="form-group" style="display: none;">
                                  <div class="select2-wrapper">
                                      <label class="control-label">Identifique la entidad Padre</label><br/>
                                      <select placeholder="Ingresar sigla" class="form-control" name="id_relacion">
                                         <option value="">Ninguno</option>
                                          @foreach($entidades as $entidad)
                                            <option value="{{$entidad->id}}">{{$entidad->nombre}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                </div>

                          </div>

                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
    </form>
      <!-- /.modal-dialog -->
  </div>





  <div class="modal fade modModificaEntidad" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static">
    <form role="formmodEntidad" id="formmodEntidad" action="javascript:modificarEntidad();"  method="POST"  data-toggle="validator" class="form">
    {{ csrf_field() }}
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">Detalle entidad</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                          <div class="white-box">

                                <div class="form-group">
                                  <label class="control-label">Nombre entidad</label>
                                  <<input type="hidden" name="mod_id_entidad">
                                  <textarea class="form-control" placeholder="Ingrese nombre de la entidad" rows="2" name="mod_nombre" required></textarea>
                                </div>

                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Sigla</label>
                                      <input type="text" placeholder="Ingresar sigla" class="form-control" name="mod_sigla" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label">Código MEF</label>
                                     <input type="text" placeholder="Ingresar codigo" class="form-control" name="mod_codigo_mef" required>
                                   </div>
                                </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label>Fecha creacion de la entidad</label>
                                     <input class="form-control" data-mask="99/99/9999" placeholder="" type="date" name="mod_fecha_creacion">
                                   </div>
                                </div>

                                </div>

                                <div class="form-group">
                                  <label>Normativa de creacion</label>
                                  <textarea class="form-control" placeholder="Ingrese datos de la normativa de creacion" rows="2" name="mod_normativa_creacion"></textarea>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Página web</label>
                                  <input type="text" placeholder="Ingresar sigla" class="form-control" name="mod_url_web">
                                </div>


                                <div class="form-group">
                                  <div class="select2-wrapper">
                                    <label class="control-label">Ubicacion</label>
                                    <select placeholder="Ingresar sigla" class="form-control" name="mod_id_region" required='required'>
                                              <option value="">Ninguno</option>
                                        @foreach($regiones as $region)
                                              <option value="{{$region->id}}">
                                                  {{$region->departamento}}
                                                  @if ($region->provincia != "")->@endif
                                                  {{$region->provincia}}
                                                  @if ($region->municipio != "")->@endif
                                                  {{$region->municipio}}
                                              </option>
                                        @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label>Relacion de la entidad</label>
                                    <div class="">
                                      <input type="radio" value="tuicion" name="mod_tipo_relacion" >
                                      Entidad bajo Tuicion
                                      <input type="radio" value="dependiente" name="mod_tipo_relacion">
                                      Entidad dependiente
                                      <input type="radio" value="ninguno" name="mod_tipo_relacion">
                                      Ninguno
                                    </div>

                                </div>

                                <div id="mod_relacion" class="form-group" style="display: none;">
                                  <div class="select2-wrapper">
                                      <label class="control-label">Identifique la entidad Padre</label><br/>
                                      <select placeholder="Ingresar sigla" class="form-control" name="mod_id_relacion">
                                         <option value="">Ninguno</option>
                                          @foreach($entidades as $entidad)
                                            <option value="{{$entidad->id}}">{{$entidad->nombre}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                </div>

                          </div>

                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
    </form>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


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
    <!-- Sweet-Alert  -->
    <script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" ></script>

  <script type="text/javascript">
      function activarMenu(id,sub){
          $('#'+id).addClass('active');
      }
      $(document).ready(function(){
          activarMenu('home',0);

          /*OTRAS FUNCIONES*/
          $("input[name$='tipo_relacion']").click(function() {
              var test = $(this).val();
               if(test != "ninguno"){
                  $("#_relacion").show();
                  $('select[name="id_relacion"]').attr('required','required');
               }
               else{

                 $("#_relacion").hide();
                 $('select[name="id_relacion"]').removeAttr("required");
                 $('select[name=id_relacion]').val('').trigger('change.select2');

               }
          });

          $("input[name$='mod_tipo_relacion']").click(function() {
              var test = $(this).val();
               if(test != "ninguno"){
                  $("#mod_relacion").show();
                  $('select[name="mod_id_relacion"]').attr('required','required');
               }
               else{

                 $("#mod_relacion").hide();
                 $('select[name="mod_id_relacion"]').removeAttr("required");
                 $('select[name=mod_id_relacion]').val('').trigger('change.select2');

               }
          });



            ///////fin otras funciones
          $("#formnewEntidad select").select2().attr('style','display:block; position:absolute; bottom: 0; left: 0; clip:rect(0,0,0,0);');
          $("#formmodEntidad select").select2().attr('style','display:block; position:absolute; bottom: 0; left: 0; clip:rect(0,0,0,0);');

            $('.modal-dialog').draggable();



          //VENTANAS MODALES//



          //FIN VENTANAS MODADES



          var theme = 'darkblue';
          var source =
          {
              dataType: "json",
              dataFields: [
                { name: 'id',type: 'number' },
                { name: 'nombre', type: 'string' },
                { name: 'sigla', type: 'string' },
                { name: 'tipo_relacion', type: 'string' },
                { name: 'fecha_creacion', type: 'date' },
                { name: 'normativa_creacion', type: 'string' },
                { name: 'url_web', type: 'string' },
                { name: 'codigo_mef', type: 'string' },
                { name: 'region', type: 'string' },
                { name: 'id_relacion', type: 'number'}
              ],
              id: 'id',
              url: "{{ url('/admindatabase/ajax/listaentidades') }}"
          };
          var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                height: 400,
                //height: '100%',
                theme: theme,
                source: dataAdapter,
                filterable: true,
                showfilterrow: true,
                pageable: true,
                pagermode: 'simple',
                autorowheight:true,
                columnsresize:true,
                //autoheight: true,
                columns: [
                  { text: '#', datafield: 'id',  width: 50 },
                  { text: 'Nombre Entidad', datafield: 'nombre',  width: 600 },
                  { text: 'Sigla', datafield: 'sigla', width: 160 },
                  { text: 'Codigo MEF', datafield: 'codigo_mef', width: 110 },
                  { text: 'Relacion', datafield: 'tipo_relacion', width: 110 },
                  { text: 'Pagina Web', datafield: 'url_web', width: 300 },
                  { text: 'Ubicacion', datafield: 'region',cellsalign: 'left',width: 300 },
                  { text: 'Total Sinonimos', cellsalign: 'right', cellsformat: 'c2', hidden:true }
                ]
            });

            $("#jqxgrid").on('rowclick', function (event) {

                  var args = event.args;
                  var row = args.rowindex;
                  var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
                  var id = dataRecord.id;

                  var ordersSource =
                  {
                      dataType: "json",
                      dataFields: [
                          { name: 'id'},
                          { name: 'sinonimo', type: 'string' },
                          { name: 'id_entidad'}
                      ],
                      id: 'id',
                      url: "/admindatabase/ajax/listasinonimosentidad?id="+id,
                      addRow: function (rowID, rowData, position, commit) {
                        $.ajax({
                            url: "{{ url('/admindatabase/ajax/addsinonimo') }}",
                            data: {'_token': $('input[name=_token]').val(),'id_entidad': id },
                            type: "POST",
                            dataType: 'json',
                            success: function(data){
                              commit(true,data);
                            }
                        });

                      },
                      updateRow: function (rowID, rowData, commit) {
                        $.ajax({
                            url: "{{ url('/admindatabase/ajax/updatesinonimo') }}",
                            data: {'_token': $('input[name=_token]').val(),'id': rowID,'id_entidad': id,'sinonimo': rowData.sinonimo },
                            type: "PUT",
                            dataType: 'json',
                            success: function(data){
                              commit(true);
                              $("#table").jqxDataTable("updateBoundData");

                            }
                        });

                      },
                      deleteRow: function (rowID, commit) {
                        swal({
                            title: "Estás seguro?",
                            text: "No podrá recuperar este registro!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Si, eliminar!",
                            closeOnConfirm: false
                        }, function(){
                            $.ajax({
                                url: "{{ url('/admindatabase/ajax/deletesinonimo') }}",
                                data: {'_token': $('input[name=_token]').val(),'id': rowID },
                                type: "DELETE",
                                dataType: 'json',
                                success: function(data){
                                    commit(true);
                                    swal("Eliminado!", "Se ha eliminado tu registro.", "success");
                                }
                            });

                        });

                      }
                  };

                  var dataAdapter = new $.jqx.dataAdapter(ordersSource);
                  $("#table").jqxDataTable({source: dataAdapter});
            });

            $("#table").jqxDataTable(
            {
                width: '100%',
                height: 400,
                theme:theme,
                pageable: true,
                editable: true,
                showToolbar: true,
                altRows: true,
                pagerButtonsCount: 8,
                toolbarHeight: 35,
                renderToolbar: function(toolBar)
                {
                    var toTheme = function (className) {
                        if (theme == "") return className;
                        return className + " " + className + "-" + theme;
                    }
                    // appends buttons to the status bar.
                    var container = $("<div style='overflow: hidden; position: relative; height: 100%; width: 100%;'></div>");
                    var buttonTemplate = "<div style='float: left; padding: 3px; margin: 2px;'><div style='margin: 4px; width: 16px; height: 16px;'></div></div>";
                    var addButton = $(buttonTemplate);
                    var editButton = $(buttonTemplate);
                    var deleteButton = $(buttonTemplate);
                    var cancelButton = $(buttonTemplate);
                    var updateButton = $(buttonTemplate);
                    container.append(addButton);
                    container.append(editButton);
                    container.append(deleteButton);
                    container.append(cancelButton);
                    container.append(updateButton);
                    toolBar.append(container);
                    addButton.jqxButton({cursor: "pointer",  enableDefault: false,  height: 25, width: 25 });
                    addButton.find('div:first').addClass(toTheme('jqx-icon-plus'));
                    addButton.jqxTooltip({ position: 'bottom', content: "Agregar"});
                    editButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    editButton.find('div:first').addClass(toTheme('jqx-icon-edit'));
                    editButton.jqxTooltip({ position: 'bottom', content: "Modificar"});
                    deleteButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    deleteButton.find('div:first').addClass(toTheme('jqx-icon-delete'));
                    deleteButton.jqxTooltip({ position: 'bottom', content: "Eliminar"});
                    updateButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    updateButton.find('div:first').addClass(toTheme('jqx-icon-save'));
                    updateButton.jqxTooltip({ position: 'bottom', content: "Guardar"});
                    cancelButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    cancelButton.find('div:first').addClass(toTheme('jqx-icon-cancel'));
                    cancelButton.jqxTooltip({ position: 'bottom', content: "Cancelar"});
                    var updateButtons = function (action) {
                        switch (action) {
                            case "Select":
                                addButton.jqxButton({ disabled: false });
                                deleteButton.jqxButton({ disabled: false });
                                editButton.jqxButton({ disabled: false });
                                cancelButton.jqxButton({ disabled: true });
                                updateButton.jqxButton({ disabled: true });
                                break;
                            case "Unselect":
                                addButton.jqxButton({ disabled: false });
                                deleteButton.jqxButton({ disabled: true });
                                editButton.jqxButton({ disabled: true });
                                cancelButton.jqxButton({ disabled: true });
                                updateButton.jqxButton({ disabled: true });
                                break;
                            case "Edit":
                                addButton.jqxButton({ disabled: true });
                                deleteButton.jqxButton({ disabled: true });
                                editButton.jqxButton({ disabled: true });
                                cancelButton.jqxButton({ disabled: false });
                                updateButton.jqxButton({ disabled: false });
                                break;
                            case "End Edit":
                                addButton.jqxButton({ disabled: false });
                                deleteButton.jqxButton({ disabled: false });
                                editButton.jqxButton({ disabled: false });
                                cancelButton.jqxButton({ disabled: true });
                                updateButton.jqxButton({ disabled: true });
                                break;
                        }
                    }
                    var rowIndex = null;
                    $("#table").on('rowSelect', function (event) {
                        var args = event.args;
                        rowIndex = args.index;
                        updateButtons('Select');
                    });
                    $("#table").on('rowUnselect', function (event) {
                        updateButtons('Unselect');
                    });
                    $("#table").on('rowEndEdit', function (event) {
                        updateButtons('End Edit');
                    });
                    $("#table").on('rowBeginEdit', function (event) {
                        updateButtons('Edit');
                    });
                    addButton.click(function (event) {
                        if (!addButton.jqxButton('disabled')) {
                            $("#table").jqxDataTable('goToPage', 0);
                            // add new empty row.
                            $("#table").jqxDataTable('addRow','-', {}, 'first');
                            // select the first row and clear the selection.
                            $("#table").jqxDataTable('clearSelection');
                            //$("#table").jqxDataTable('selectRow', 0);
                            // edit the new row.
                            //$("#table").jqxDataTable('beginRowEdit', 0);
                        }
                    });
                    cancelButton.click(function (event) {
                        if (!cancelButton.jqxButton('disabled')) {
                            // cancel changes.
                            $("#table").jqxDataTable('endRowEdit', rowIndex, true);
                        }
                    });
                    updateButton.click(function (event) {
                        if (!updateButton.jqxButton('disabled')) {
                            // save changes.
                            $("#table").jqxDataTable('endRowEdit', rowIndex, false);
                        }
                    });
                    editButton.click(function () {
                        if (!editButton.jqxButton('disabled')) {
                            $("#table").jqxDataTable('beginRowEdit', rowIndex);
                            //updateButtons('edit');
                        }
                    });
                    deleteButton.click(function () {
                        if (!deleteButton.jqxButton('disabled')) {
                            $("#table").jqxDataTable('deleteRow', rowIndex);
                            //updateButtons('delete');
                        }
                    });
                },
                columns: [
                  { text: '#', editable: false, dataField: 'id', width: 50 },
                  { text: 'id_entidad', editable: false, dataField: 'id_entidad', width: 50,hidden: true },
                  { text: 'Sinonimo', dataField: 'sinonimo', cellsAlign: 'left', align: 'center'}
                ]
            });




            $('#agregar').click(function() {
                $('#window').jqxWindow('open');
            });

            $('#modificar').click(function() {
              $("#formmodEntidad")[0].reset();
              $("#formmodEntidad select").select2("val", "");
              var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
              if (rowindex > -1)
              {
                 var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
                $.ajax({
                        url: "{{ url('/admindatabase/ajax/detalleentidad') }}",
                        data: { '_token': $('input[name=_token]').val(),'entidad': dataRecord.id},
                        type: "post",
                        dataType: 'json',
                        success: function(data){
                          //$.each(date, function(i, data) {
                              $('input[name="mod_id_entidad"]').val(data.id);
                              $('textarea[name="mod_nombre"]').val(data.nombre);
                              $('input[name="mod_sigla"]').val(data.sigla);
                              $('input[name="mod_codigo_mef"]').val(data.codigo_mef);
                              $('input[name="mod_fecha_creacion"]').val(convertDateFormat(data.fecha_creacion));
                              $('textarea[name="mod_normativa_creacion"]').val(data.normativa_creacion);
                              $('input[name="mod_url_web"]').val(data.url_web);

                              $('select[name=mod_id_region]').val(data.id_region).trigger('change.select2');
                              $('input[name="mod_tipo_relacion"][value='+data.tipo_relacion+']').attr('checked', true);

                              var test = data.tipo_relacion;
                               if(test != "ninguno"){
                                  $("#mod_relacion").show();
                                  $('select[name="mod_id_relacion"]').attr('required','required');
                               }
                               else{

                                 $("#mod_relacion").hide();
                                 $('select[name="mod_id_relacion"]').removeAttr("required");
                                 $('select[name=mod_id_relacion]').val('').trigger('change.select2');

                               }
                              $('select[name=mod_id_relacion]').val(data.id_relacion).trigger('change.select2');

                          //});
                        },
                        error:function(date){
                          alert("Error recuperar los datos.");
                        }
                    });
              }else {
                    alert("Seleccione una entidad para ver los detalles.");
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
                           url: "{{ url('/admindatabase/ajax/eliminarentidad') }}",
                           data: { '_token': $('input[name=_token]').val(),'entidad': dataRecord.id },
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

            $('#limpiarfiltros').click(function () {
                $("#jqxgrid").jqxGrid('clearfilters');
            });



            function convertDateFormat(string) {
                var info = string.split('-').reverse().join('/');
                return info;
           }



      });

      function guardarEntidad(){
        $.ajax({
              type: "POST",
              url: "{{ url('/admindatabase/ajax/guardarEntidad') }}",
              dataType: 'json',
              data: $("#formnewEntidad").serialize() , // Adjuntar los campos del formulario enviado.
              success: function(data){
                  $("#jqxgrid").jqxGrid("updatebounddata");
                  $('.modNuevaEntidad').modal('hide');
                  $("#formnewEntidad")[0].reset();
                  $("#formnewEntidad select").select2("val", "");
                  $("#_relacion").hide();
                  $('select[name="id_relacion"]').removeAttr("required");
                  $("#table").jqxDataTable("clear");
              },
              error:function(data){
                alert("Error recuperar los datos.");
              }
          });


      }

      function modificarEntidad(){
        $.ajax({
              type: "POST",
              url: "{{ url('/admindatabase/ajax/modificarentidad') }}",
              dataType: 'json',
              data: $("#formmodEntidad").serialize() , // Adjuntar los campos del formulario enviado.
              success: function(data){
                  $("#jqxgrid").jqxGrid("updatebounddata");
                  $('.modModificaEntidad').modal('hide');
                  $("#formmodEntidad")[0].reset();
                  $("#formmodEntidad select").select2("val", "");
                  $("#mod_relacion").hide();
                  $('select[name="mod_id_relacion"]').removeAttr("required");
                  $("#table").jqxDataTable("clear");
              }
          });


      }
    </script>
@endpush
