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
              <h4 class="page-title">Clasificador de Paises</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                  <li><a href="#">Clasificadores</a></li>
                  <li class="active">Paises</li>
              </ol>
          </div>
          <!-- /.col-lg-12 -->
      </div>


      <!---DESDE AQUI VIENE EL CONTENIDO--->
      <div class="row">
          <div class="col-md-12">
              <div class="white-box">
                    <div class="button-box" style="background: rgb(241, 241, 241) none repeat scroll 0% 0%; padding-top: 5px; padding-left: 5px;">
                        <button data-toggle="modal" data-target=".modNuevoPais"  class="fcbtn btn btn-success btn-outline btn-sm waves-effect"><i class="ti-plus"></i>Agregar</button>
                        <button id="modificar" data-toggle="modal" data-target=".modModificaPais" class="fcbtn btn btn-warning btn-outline btn-sm waves-effect"><i class="ti-pencil"></i>Detallar</button>
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
  <div class="modal fade modNuevoPais" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static">
    <form role="formnewPais" id="formnewPais" action="javascript:guardarEntidad();"  method="POST"  data-toggle="validator" class="form">
    {{ csrf_field() }}
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myLargeModalLabel">Nuevo Pais</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                          <div class="white-box">

                                <div class="form-group">
                                  <label class="control-label">Nombre ISO-Oficial  Pais</label>
                                  <textarea class="form-control" placeholder="Ingrese nombre del Pais" rows="2" name="nombre_iso_oficial" required></textarea>
                                </div>

                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Codigo alfa 2</label>
                                      <input type="text" placeholder="Ingresar alfa2" class="form-control" name="codigo_alfa_2" >
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label">Codigo Alfa 3</label>
                                     <input type="text" placeholder="Ingresar alfa3" class="form-control" name="codigo_alfa_3" >
                                   </div>
                                </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label>Codigo Numérico</label>
                                     <input type="text" placeholder="Ingresar codigo" class="form-control" name="codigo_numerico" required>
                                   </div>
                                </div>

                                </div>



                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Nombre Comun</label>
                                      <input type="text" placeholder="Ingresar dato" class="form-control" name="nombre_comun">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Nombre en Ingles</label>
                                      <input type="text" placeholder="Ingresar dato" class="form-control" name="nombre_ingles">
                                    </div>
                                  </div>
                                </div>




                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Nombre en BD</label>
                                      <input type="text" placeholder="Ingresar dato" class="form-control" name="nombre_bd">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Capital</label>
                                      <input type="text" placeholder="Ingresar dato" class="form-control" name="capital">
                                    </div>
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Continente</label>
                                      <input type="text" placeholder="Ingresar dato" class="form-control" name="continente">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Sub-Clasificacion</label>
                                      <input type="text" placeholder="Ingresar dato" class="form-control" name="sub_clasificacion">
                                    </div>
                                  </div>
                                </div>



                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Latitud</label>
                                      <input type="text" placeholder="latitud" class="form-control" name="latitud">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Longitud</label>
                                      <input type="text" placeholder="longitud" class="form-control" name="longitud">
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label">Observaciones</label>
                                  <textarea class="form-control" placeholder="Ingrese nombre del Pais" rows="2" name="observaciones" ></textarea>
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





  <div class="modal fade modModificaPais" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static">
    <form role="formmodPais" id="formmodPais" action="javascript:modificarEntidad();"  method="POST"  data-toggle="validator" class="form">
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
                            <input type="hidden" name="id_pais" value="">

                            <div class="form-group">
                              <label class="control-label">Nombre ISO-Oficial  Pais</label>
                              <textarea class="form-control" placeholder="Ingrese nombre del Pais" rows="2" name="mod_nombre_iso_oficial" required></textarea>
                            </div>

                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="control-label">Codigo alfa 2</label>
                                  <input type="text" placeholder="Ingresar alfa2" class="form-control" name="mod_codigo_alfa_2" >
                                </div>
                             </div>
                             <div class="col-md-4">
                               <div class="form-group">
                                 <label class="control-label">Codigo Alfa 3</label>
                                 <input type="text" placeholder="Ingresar alfa3" class="form-control" name="mod_codigo_alfa_3" >
                               </div>
                            </div>
                             <div class="col-md-4">
                               <div class="form-group">
                                 <label>Codigo Numérico</label>
                                 <input type="text" placeholder="Ingresar codigo" class="form-control" name="mod_codigo_numerico" required>
                               </div>
                            </div>

                            </div>



                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Nombre Comun</label>
                                  <input type="text" placeholder="Ingresar dato" class="form-control" name="mod_nombre_comun">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Nombre en Ingles</label>
                                  <input type="text" placeholder="Ingresar dato" class="form-control" name="mod_nombre_ingles">
                                </div>
                              </div>
                            </div>




                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Nombre en BD</label>
                                  <input type="text" placeholder="Ingresar dato" class="form-control" name="mod_nombre_bd">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Capital</label>
                                  <input type="text" placeholder="Ingresar dato" class="form-control" name="mod_capital">
                                </div>
                              </div>
                            </div>


                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Continente</label>
                                  <input type="text" placeholder="Ingresar dato" class="form-control" name="mod_continente">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Sub-Clasificacion</label>
                                  <input type="text" placeholder="Ingresar dato" class="form-control" name="mod_sub_clasificacion">
                                </div>
                              </div>
                            </div>



                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Latitud</label>
                                  <input type="text" placeholder="latitud" class="form-control" name="mod_latitud">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Longitud</label>
                                  <input type="text" placeholder="longitud" class="form-control" name="mod_longitud">
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label">Observaciones</label>
                              <textarea class="form-control" placeholder="Ingrese nombre del Pais" rows="2" name="mod_observaciones" ></textarea>
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




            ///////fin otras funciones


            $('.modal-dialog').draggable();



          //VENTANAS MODALES//



          //FIN VENTANAS MODADES



          var theme = 'darkblue';
          var source =
          {
              dataType: "json",
              dataFields: [
                { name: 'id',type: 'number' },
                { name: 'nombre_comun', type: 'string' },
                { name: 'nombre_iso_oficial', type: 'string' },
                { name: 'nombre_ingles', type: 'string' },
                { name: 'nombre_bd', type: 'string' },
                { name: 'capital', type: 'string' },
                { name: 'continente', type: 'string' },
                { name: 'sub_clasificacion', type: 'string' },
                { name: 'latitud', type: 'number' },
                { name: 'longitud', type: 'number'},
                { name: 'codigo_alfa_2', type: 'number'},
                { name: 'codigo_alfa_3', type: 'number'},
                { name: 'codigo_numerico', type: 'number'},
                { name: 'observaciones', type: 'string'}
              ],
              id: 'id',
              url: "{{ url('/admindatabase/ajax/listapaises') }}"
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
                //pageSize: 500,
                pagermode: 'simple',
                autorowheight:true,
                columnsresize:true,
                //autoheight: true,
                columns: [
                  { text: '#', datafield: 'id',  width: 50 },
                  { text: 'Nombre Ofical ISO', datafield: 'nombre_iso_oficial',  width: 600 },
                  { text: 'Nombre Comun', datafield: 'nombre_comun', width: 160 },
                  { text: 'Nombre Ingles', datafield: 'nombre_ingles', width: 110 },
                  { text: 'Nombre BD', datafield: 'nombre_bd', width: 110 },
                  { text: 'Capital', datafield: 'capital', width: 300 },
                  { text: 'Continente', datafield: 'continente',cellsalign: 'left',width: 300 },
                  { text: 'Subclasificacion', datafield: 'sub_clasificacion',cellsalign: 'left',width: 300 },
                  { text: 'Latitud', datafield: 'latitud',cellsalign: 'left',width: 300 },
                  { text: 'Longitud', datafield: 'longitud',cellsalign: 'left',width: 300 },
                  { text: 'Codigo Alfa 2', datafield: 'codigo_alfa_2',cellsalign: 'left',width: 300 },
                  { text: 'Codigo Alfa 3', datafield: 'codigo_alfa_3',cellsalign: 'left',width: 300 },
                  { text: 'Codigo', datafield: 'codigo_numerico',cellsalign: 'left',width: 300 },
                  { text: 'Observaciones', datafield: 'observaciones',cellsalign: 'left',width: 300 }
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
                          { name: 'id_pais'}
                      ],
                      id: 'id',
                      url: "/admindatabase/ajax/listasinonimospais?id="+id,
                      addRow: function (rowID, rowData, position, commit) {
                        $.ajax({
                            url: "{{ url('/admindatabase/ajax/addsinonimo') }}",
                            data: {'_token': $('input[name=_token]').val(),'id_pais': id },
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
                            data: {'_token': $('input[name=_token]').val(),'id': rowID,'id_pais': id,'sinonimo': rowData.sinonimo },
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
              $("#formmodPais")[0].reset();
              var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
              if (rowindex > -1)
              {
                 var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
                $.ajax({
                        url: "{{ url('/admindatabase/ajax/detallepais') }}",
                        data: { '_token': $('input[name=_token]').val(),'pais': dataRecord.id},
                        type: "post",
                        dataType: 'json',
                        success: function(data){
                          //$.each(date, function(i, data) {
                              $('input[name="id_pais"]').val(data.id);
                              $('textarea[name="mod_nombre_iso_oficial"]').val(data.nombre_iso_oficial);
                              $('input[name="mod_codigo_alfa_2"]').val(data.codigo_alfa_2);
                              $('input[name="mod_codigo_alfa_3"]').val(data.codigo_alfa_3);
                              $('input[name="mod_codigo_numerico"]').val(data.codigo_numerico);
                              $('input[name="mod_nombre_comun"]').val(data.nombre_comun);
                              $('input[name="mod_nombre_ingles"]').val(data.nombre_ingles);
                              $('input[name="mod_nombre_bd"]').val(data.nombre_bd);
                              $('input[name="mod_capital"]').val(data.capital);
                              $('input[name="mod_continente"]').val(data.continente);
                              $('input[name="mod_sub_clasificacion"]').val(data.sub_clasificacion);
                              $('input[name="mod_latitud"]').val(data.latitud);
                              $('input[name="mod_longitud"]').val(data.longitud);
                              $('textarea[name="mod_observaciones"]').val(data.observaciones);
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
                           url: "{{ url('/admindatabase/ajax/eliminarpais') }}",
                           data: { '_token': $('input[name=_token]').val(),'pais': dataRecord.id },
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
              url: "{{ url('/admindatabase/ajax/guardarpais') }}",
              dataType: 'json',
              data: $("#formnewPais").serialize() , // Adjuntar los campos del formulario enviado.
              success: function(data){
                  $("#jqxgrid").jqxGrid("updatebounddata");
                  $('.modNuevoPais').modal('hide');
                  $("#formnewPais")[0].reset();
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
              url: "{{ url('/admindatabase/ajax/modificarpais') }}",
              dataType: 'json',
              data: $("#formmodPais").serialize() , // Adjuntar los campos del formulario enviado.
              success: function(data){
                  $("#jqxgrid").jqxGrid("updatebounddata");
                  $('.modModificaPais').modal('hide');
                  $("#formmodPais")[0].reset();
                  $("#table").jqxDataTable("clear");
              }
          });
      }
    </script>
@endpush
