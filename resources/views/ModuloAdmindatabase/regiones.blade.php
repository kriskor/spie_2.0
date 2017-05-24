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
                        <button data-toggle="modal" data-target=".modNuevaRegion"  class="fcbtn btn btn-success btn-outline btn-sm waves-effect"><i class="ti-plus"></i>Agregar</button>
                        <button id="modificar" data-toggle="modal" data-target=".modModificaRegion" class="fcbtn btn btn-warning btn-outline btn-sm waves-effect"><i class="ti-pencil"></i>Detallar</button>
                        <button id="eliminar" class="fcbtn btn btn-danger btn-outline btn-sm waves-effect"><i class="ti-trash"></i>Eliminar</button>
                        <button id="limpiarfiltros" class="fcbtn btn btn-info btn-outline btn-sm waves-effect"><i class="ti-settings"></i>Limpiar Filtros</button>
                        <select id="nivel_sel" class="select2"  name="nivel_sel" multiple style="width:50%;" tabindex="4">
                                  <option value="NIVEL_0" selected="">NIVEL_0</option>
                                  <option value="NIVEL_1" selected="">NIVEL_1</option>
                                  <option value="NIVEL_2">NIVEL_2</option>
                                  <option value="NIVEL_3">NIVEL_3</option>
                                  <option value="NIVEL_4">NIVEL_4</option>
                        </select>
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
  <div class="modal fade modNuevaRegion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static">
    <form role="formnewRegion" id="formnewRegion" action="javascript:guardarRegion();"  method="POST"  data-toggle="validator" class="form">
    {{ csrf_field() }}
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myLargeModalLabel">Nueva Region</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                          <div class="white-box">

                                <div class="form-group">
                                  <label class="control-label">Nombre region</label>
                                  <textarea class="form-control" placeholder="Ingrese nombre de la region" rows="2" name="nombre_comun" required></textarea>
                                </div>

                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Codigo Alfa 2</label>
                                      <input type="text" placeholder="Ingresar sigla" class="form-control" name="codigo_alfa_2">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                     <label class="control-label">Codigo Alfa 2</label>
                                     <input type="text" placeholder="Ingresar codigo" class="form-control" name="codigo_alfa_3">
                                   </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="control-label">Codigo INE</label>
                                    <input type="text" placeholder="Ingresar codigo" class="form-control" name="codigo_numerico" required>
                                  </div>
                               </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="control-label">Nivel</label>
                                    <select class="form-control m-b " name="categoria" required>
                                        <option value="">Ninguno</option>
                                        <option value="NIVEL_0">NIVEL_0(Pais)</option>
                                        <option value="NIVEL_1">NIVEL_1(Departamento)</option>
                                        <option value="NIVEL_2">NIVEL_2(Provincia)</option>
                                        <option value="NIVEL_4">NIVEL_3(Municipio)</option>
                                        <option value="NIVEL_3">NIVEL_4(Comunidad)</option>
                                    </select>
                                  </div>
                               </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="control-label">Longitud</label>
                                    <input type="text" placeholder="Ingresar sigla" class="form-control" name="longitud">
                                  </div>
                               </div>
                               <div class="col-md-4">
                                 <div class="form-group">
                                   <label class="control-label">Latitud</label>
                                   <input type="text" placeholder="Ingresar codigo" class="form-control" name="latitud">
                                 </div>
                              </div>

                            </div>

                            <div class="form-group">
                              <label class="control-label">Nombre region padre</label>
                              <select placeholder="Ingresar sigla" class="form-control" name="id_padre" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0">Ninguno</option>
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





  <div class="modal fade modModificaRegion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static">
    <form role="formmodRegion" id="formmodRegion" action="javascript:modificarRegion();"  method="POST"  data-toggle="validator" class="form">
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
                              <label class="control-label">Nombre region</label>
                              <input type="hidden" name="mod_id_region">
                              <textarea class="form-control" placeholder="Ingrese nombre de la region" rows="2" name="mod_nombre_comun" required></textarea>
                            </div>

                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="control-label">Codigo Alfa 2</label>
                                  <input type="text" placeholder="Ingresar sigla" class="form-control" name="mod_codigo_alfa_2">
                                </div>
                             </div>
                             <div class="col-md-4">
                               <div class="form-group">
                                 <label class="control-label">Codigo Alfa 2</label>
                                 <input type="text" placeholder="Ingresar codigo" class="form-control" name="mod_codigo_alfa_3">
                               </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="control-label">Codigo INE</label>
                                <input type="text" placeholder="Ingresar codigo" class="form-control" name="mod_codigo_numerico" required>
                              </div>
                           </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="control-label">Nivel</label>
                                <select class="form-control m-b " name="mod_categoria" required>
                                    <option value="">Ninguno</option>
                                    <option value="NIVEL_0">NIVEL_0(Pais)</option>
                                    <option value="NIVEL_1">NIVEL_1(Departamento)</option>
                                    <option value="NIVEL_2">NIVEL_2(Provincia)</option>
                                    <option value="NIVEL_4">NIVEL_3(Municipio)</option>
                                    <option value="NIVEL_3">NIVEL_4(Comunidad)</option>
                                </select>
                              </div>
                           </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="control-label">Longitud</label>
                                <input type="text" placeholder="Ingresar sigla" class="form-control" name="mod_longitud">
                              </div>
                           </div>
                           <div class="col-md-4">
                             <div class="form-group">
                               <label class="control-label">Latitud</label>
                               <input type="text" placeholder="Ingresar codigo" class="form-control" name="mod_latitud">
                             </div>
                          </div>

                        </div>

                        <div class="form-group">
                          <label class="control-label">Nombre region padre</label>
                          <select placeholder="Ingresar sigla" class="form-control" name="mod_id_padre" required>
                                  <option value="">Seleccionar</option>
                                    <option value="0">Ninguno</option>
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
          $("#formnewRegion select").select2().attr('style','display:block; position:absolute; bottom: 0; left: 0; clip:rect(0,0,0,0);');
          $("#formmodRegion select").select2().attr('style','display:block; position:absolute; bottom: 0; left: 0; clip:rect(0,0,0,0);');

          $('.modal-dialog').draggable();
          $(".select2").select2();



          //VENTANAS MODALES//



          //FIN VENTANAS MODADES



          var theme = 'darkblue';
          var source =
          {
              dataType: "json",
              dataFields: [
                { name: 'id',type: 'number' },
                { name: 'label', type: 'string' },
                { name: 'nombre_comun', type: 'string' },
                { name: 'codigo_alfa_2', type: 'string' },
                { name: 'codigo_alfa_3', type: 'string' },
                { name: 'codigo_numerico', type: 'string' },
                { name: 'categoria', type: 'string' },
                { name: 'latitud', type: 'string' },
                { name: 'longitud', type: 'string' },
                { name: 'id_padre', type: 'string'},
                { name: 'expanded', type: 'bool'}
              ],
              id: 'id',
              url: "{{ url('/admindatabase/ajax/listaclasificadorregiones') }}"
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
                  { text: '#', datafield: 'id',width: 80,editable: false },
                  { text: 'Nivel', datafield: 'categoria',filtertype: 'checkedlist',width: 80, columntype: 'combobox'},
                  { text: 'Nombre Region', datafield: 'nombre_comun',width:500 },
                  { text: 'Codigo alfa 2', datafield: 'codigo_alfa_2',width: 100,cellsalign:'right' },
                  { text: 'Codigo alfa 3', datafield: 'codigo_alfa_3',width: 100,cellsalign:'right' },
                  { text: 'Codigo INE', datafield: 'codigo_numerico',width: 150,cellsalign:'center'},
                  { text: 'Latitud', datafield: 'latitud',width: 150 },
                  { text: 'Longitud', datafield: 'longitud',width: 150 },
                  { text: 'Padre', datafield: 'label', width: 500}
                ]
            });
            /*var regionesPadreSource =
            {
                 datatype: "json",
                 datafields: [
                     { name: 'label', type: 'string' },
                     { name: 'value', type: 'number' }
                 ],
                 //localdata: regionPadre
                 url: "/admindatabase/ajax/listaregionespadre"

            };
            var regionesPadreAdapter = new $.jqx.dataAdapter(regionesPadreSource, {
                autoBind: true,
                async : false
            });
            $("#jqxCombo").jqxComboBox({
              selectedIndex: 0,
              source: regionesPadreAdapter,
              displayMember: "label",
              valueMember: "value",
              width: "100%",
              height: 25
            });*/


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
                        { name: 'id_region'}
                    ],
                    id: 'id',
                    url: "/admindatabase/ajax/listasinonimosregion?id="+id,
                    addRow: function (rowID, rowData, position, commit) {
                      $.ajax({
                          url: "{{ url('admindatabase/ajax/addsinonimoregion') }}",
                          data: {'_token': $('input[name=_token]').val(),'id_region': id },
                          type: "POST",
                          dataType: 'json',
                          success: function(data){
                            commit(true,data);
                          }
                      });

                    },
                    updateRow: function (rowID, rowData, commit) {
                      $.ajax({
                          url: "{{ url('/admindatabase/ajax/updatesinonimoregion') }}",
                          data: {'_token': $('input[name=_token]').val(),'id': rowID,'id_region': id,'sinonimo': rowData.sinonimo },
                          type: "PUT",
                          dataType: 'json',
                          success: function(data){
                            commit(true);
                            $("#table").jqxDataTable("updateBoundData");

                          }
                      });

                    },
                    deleteRow: function (rowID, commit) {
                      $.ajax({
                          url: "{{ url('/admindatabase/ajax/deletesinonimoregion') }}",
                          data: {'_token': $('input[name=_token]').val(),'id': rowID },
                          type: "DELETE",
                          dataType: 'json',
                          success: function(data){
                            commit(true);
                          }
                      });
                    }
                };

                var dataAdapter = new $.jqx.dataAdapter(ordersSource, {
                    loadComplete: function () {

                    }
                });
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
                    addButton.jqxButton({cursor: "pointer", enableDefault: false,  height: 25, width: 25 });
                    addButton.find('div:first').addClass(toTheme('jqx-icon-plus'));
                    addButton.jqxTooltip({ position: 'bottom', content: "Add"});
                    editButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    editButton.find('div:first').addClass(toTheme('jqx-icon-edit'));
                    editButton.jqxTooltip({ position: 'bottom', content: "Edit"});
                    deleteButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    deleteButton.find('div:first').addClass(toTheme('jqx-icon-delete'));
                    deleteButton.jqxTooltip({ position: 'bottom', content: "Delete"});
                    updateButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    updateButton.find('div:first').addClass(toTheme('jqx-icon-save'));
                    updateButton.jqxTooltip({ position: 'bottom', content: "Save Changes"});
                    cancelButton.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    cancelButton.find('div:first').addClass(toTheme('jqx-icon-cancel'));
                    cancelButton.jqxTooltip({ position: 'bottom', content: "Cancel"});
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
                            $("#table").jqxDataTable('addRow', null, {}, 'first');
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
                  { text: 'id', editable: false, dataField: 'id', width: 50 },
                  { text: 'id_region', editable: false,dataField: 'id_region',width: 50,hidden: true },
                  { text: 'Sinonimo', dataField: 'sinonimo', cellsAlign: 'left', align: 'center'}
                ]
            });



            $('#nivel_sel').on('change',function() {
                  if(!$("#nivel_sel").val()){
                    $("#jqxgrid").jqxGrid('clear');
                  }else{


                    var source2 =
                    {
                        dataType: "json",
                        dataFields: [
                          { name: 'id',type: 'number' },
                          { name: 'label', type: 'string' },
                          { name: 'nombre_comun', type: 'string' },
                          { name: 'codigo_alfa_2', type: 'string' },
                          { name: 'codigo_alfa_3', type: 'string' },
                          { name: 'codigo_numerico', type: 'string' },
                          { name: 'categoria', type: 'string' },
                          { name: 'latitud', type: 'string' },
                          { name: 'longitud', type: 'string' },
                          { name: 'id_padre', type: 'string'},
                          { name: 'expanded', type: 'bool'}
                        ],
                        id: 'id',
                        url: "/admindatabase/ajax/regionesseleccionadas",
                        data:{'nivel_sel': $("#nivel_sel").val()},
                        updaterow: function (rowid, rowdata, commit) {

                            if(rowdata.id_padre != '' || rowdata.id_padre == 0){
                            $.ajax({
                                url: "{{ url('/ajax/updateregion') }}",
                                data: { '_token': $('input[name=_token]').val(),'id': rowdata.id,'categoria': rowdata.categoria,'nombre_comun': rowdata.nombre_comun,'codigo_alfa_2': rowdata.codigo_alfa_2,'codigo_alfa_3': rowdata.codigo_alfa_3,'codigo_numerico': rowdata.codigo_numerico,'latitud': rowdata.latitud,'longitud': rowdata.longitud,'id_padre': rowdata.id_padre  },
                                type: "PUT",
                                dataType: 'json',
                                success: function(data){
                                  //commit(true);
                                  $("#jqxgrid").jqxGrid("updatebounddata");

                                },
                                error:function(data){
                                  alert("Error al guardar los datos.");
                                  $("#jqxgrid").jqxGrid("updatebounddata");
                                }
                            });
                          }else{
                            $("#jqxgrid").jqxGrid("updatebounddata");
                            alert("No se puede guardar el registro porque no tiene un padre asignado");

                          }

                        }

                    };
                    var dataAdapter2 = new $.jqx.dataAdapter(source2);
                    $("#jqxgrid").jqxGrid({source: dataAdapter2});
              }


            });




            $('#agregar').click(function() {
              //$('#window').jqxWindow('open');
            });

            $('#modificar').click(function() {
              $("#formmodRegion")[0].reset();
              $("#formmodRegion select").select2("val", "");
              var rowindex = $('#jqxgrid').jqxGrid('getselectedrowindex');
              if (rowindex > -1)
              {
                 var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', rowindex);
                $.ajax({
                        url: "{{ url('/admindatabase/ajax/detalleregion') }}",
                        data: { '_token': $('input[name=_token]').val(),'region': dataRecord.id},
                        type: "post",
                        dataType: 'json',
                        success: function(data){
                          //$.each(date, function(i, data) {
                              $('input[name="mod_id_region"]').val(data.id);
                              $('textarea[name="mod_nombre_comun"]').val(data.nombre_comun);
                              $('input[name="mod_codigo_alfa_2"]').val(data.codigo_alfa_2);
                              $('input[name="mod_codigo_alfa_3"]').val(data.codigo_alfa_3);
                              $('input[name="mod_codigo_numerico"]').val(data.codigo_numerico);
                              $('select[name=mod_categoria]').val(data.categoria).trigger('change.select2');
                              $('input[name="mod_longitud"]').val(data.longitud);
                              $('input[name="mod_latitud"]').val(data.latitud);
                              $('select[name=mod_id_padre]').val(data.id_padre).trigger('change.select2');
                          //});
                        },
                        error:function(date){
                          alert("Error recuperar los datos.");
                        }
                    });
              }else {
                    alert("Seleccione una region para ver los detalles.");
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
                           url: "{{ url('/admindatabase/ajax/eliminarregion') }}",
                           data: { '_token': $('input[name=_token]').val(),'region': dataRecord.id },
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

      function guardarRegion(){
        $.ajax({
              type: "POST",
              url: "{{ url('/admindatabase/ajax/guardarRegion') }}",
              dataType: 'json',
              data: $("#formnewRegion").serialize() , // Adjuntar los campos del formulario enviado.
              success: function(data){
                  $("#jqxgrid").jqxGrid("updatebounddata");
                  $('.modNuevaRegion').modal('hide');
                  $("#formnewRegion")[0].reset();
                  $("#formnewRegion select").select2("val", "");
                  $("#table").jqxDataTable("clear");
              },
              error:function(data){
                alert("Error recuperar los datos.");
              }
          });


      }

      function modificarRegion(){
        $.ajax({
              type: "PUT",
              url: "{{ url('/admindatabase/ajax/modificarregion') }}",
              dataType: 'json',
              data: $("#formmodRegion").serialize() , // Adjuntar los campos del formulario enviado.
              success: function(data){
                  $("#jqxgrid").jqxGrid("updatebounddata");
                  $('.modModificaRegion').modal('hide');
                  $("#formmodRegion")[0].reset();
                  $("#formmodRegion select").select2("val", "");
                  $("#table").jqxDataTable("clear");
              }
          });


      }
    </script>
@endpush
