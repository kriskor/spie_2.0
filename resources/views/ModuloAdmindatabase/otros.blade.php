@extends('layouts.ModuloAdmindatabase')

@section('header')
  <link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="/jqwidgets4.4.0/jqwidgets/styles/jqx.darkblue.css" type="text/css" />
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
                  <li><a href="#">Inicio</a></li>
                  <li class="active">Pagina principal</li>
              </ol>
          </div>
          <!-- /.col-lg-12 -->
      </div>


      <!---DESDE AQUI VIENE EL CONTENIDO--->
      <div class="row">
          <div class="col-md-12">
              <div class="white-box">
                <div id="padreGrid">
                </div>
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12">
              <div class="white-box">
                <div id="table"></div>
              </div>
              </div>
          </div>
      </div>

  </div>
  <!-- /.container-fluid -->

@endsection

@push('script-head')
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxcore.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxbuttons.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxscrollbar.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxdatatable.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxlistbox.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxdropdownlist.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxtreegrid.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxdata.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxtooltip.js"></script>
  <script type="text/javascript" src="/jqwidgets4.4.0/jqwidgets/jqxinput.js"></script>
  <script type="text/javascript">
      function activarMenu(id,sub){
          $('#'+id).addClass('active');
      }
      $(document).ready(function(){
          activarMenu('home',0);
          var theme = 'darkblue';
          var source =
          {
              dataType: "json",
              dataFields: [
                  { name: 'id'},
                  { name: 'nombre', type: 'string' },
                  { name: 'descripcion', type: 'string'}
              ],
              id: 'id',
              url: "/admindatabase/ajax/listaotros",
              addRow: function (rowID, rowData, position, commit) {
                $.ajax({
                    url: "{{ url('/admindatabase/ajax/addotro') }}",
                    data: {'_token': $('input[name=_token]').val()},
                    type: "POST",
                    dataType: 'json',
                    success: function(data){
                      commit(true,data);
                    }
                });

              },
              updateRow: function (rowID, rowData, commit) {
                $.ajax({
                    url: "{{ url('/admindatabase/ajax/updateotro') }}",
                    data: {'_token': $('input[name=_token]').val(),'id': rowID,'nombre': rowData.nombre,'descripcion': rowData.descripcion },
                    type: "PUT",
                    dataType: 'json',
                    success: function(data){
                      commit(true);
                      $("#padreGrid").jqxDataTable("updateBoundData");

                    }
                });

              },
              deleteRow: function (rowID, commit) {
                var res = confirm("Esta seguro de eliminar el registro?");
                if (res == true) {
                    $.ajax({
                        url: "{{ url('/admindatabase/ajax/deleteotro') }}",
                        data: {'_token': $('input[name=_token]').val(),'id': rowID },
                        type: "DELETE",
                        dataType: 'json',
                        success: function(data){
                          commit(true);
                        }
                    });
                }
              }
          };
          var dataAdapterP = new $.jqx.dataAdapter(source);
          // create Tree Grid
          $("#padreGrid").jqxDataTable(
            {
                width: '100%',
                height: 400,
                source: dataAdapterP,
                theme:theme,
                columnsResize: true,
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
                    var addButtonP = $(buttonTemplate);
                    var editButtonP = $(buttonTemplate);
                    var deleteButtonP = $(buttonTemplate);
                    var cancelButtonP = $(buttonTemplate);
                    var updateButtonP = $(buttonTemplate);
                    container.append(addButtonP);
                    container.append(editButtonP);
                    container.append(deleteButtonP);
                    container.append(cancelButtonP);
                    container.append(updateButtonP);
                    toolBar.append(container);
                    addButtonP.jqxButton({cursor: "pointer", enableDefault: false,  height: 25, width: 25 });
                    addButtonP.find('div:first').addClass(toTheme('jqx-icon-plus'));
                    addButtonP.jqxTooltip({ position: 'bottom', content: "Add"});
                    editButtonP.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    editButtonP.find('div:first').addClass(toTheme('jqx-icon-edit'));
                    editButtonP.jqxTooltip({ position: 'bottom', content: "Edit"});
                    deleteButtonP.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    deleteButtonP.find('div:first').addClass(toTheme('jqx-icon-delete'));
                    deleteButtonP.jqxTooltip({ position: 'bottom', content: "Delete"});
                    updateButtonP.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    updateButtonP.find('div:first').addClass(toTheme('jqx-icon-save'));
                    updateButtonP.jqxTooltip({ position: 'bottom', content: "Save Changes"});
                    cancelButtonP.jqxButton({ cursor: "pointer", disabled: true, enableDefault: false,  height: 25, width: 25 });
                    cancelButtonP.find('div:first').addClass(toTheme('jqx-icon-cancel'));
                    cancelButtonP.jqxTooltip({ position: 'bottom', content: "Cancel"});
                    var updateButtons = function (action) {
                        switch (action) {
                            case "Select":
                                addButtonP.jqxButton({ disabled: false });
                                deleteButtonP.jqxButton({ disabled: false });
                                editButtonP.jqxButton({ disabled: false });
                                cancelButtonP.jqxButton({ disabled: true });
                                updateButtonP.jqxButton({ disabled: true });
                                break;
                            case "Unselect":
                                addButtonP.jqxButton({ disabled: false });
                                deleteButtonP.jqxButton({ disabled: true });
                                editButtonP.jqxButton({ disabled: true });
                                cancelButtonP.jqxButton({ disabled: true });
                                updateButtonP.jqxButton({ disabled: true });
                                break;
                            case "Edit":
                                addButtonP.jqxButton({ disabled: true });
                                deleteButtonP.jqxButton({ disabled: true });
                                editButtonP.jqxButton({ disabled: true });
                                cancelButtonP.jqxButton({ disabled: false });
                                updateButtonP.jqxButton({ disabled: false });
                                break;
                            case "End Edit":
                                addButtonP.jqxButton({ disabled: false });
                                deleteButtonP.jqxButton({ disabled: false });
                                editButtonP.jqxButton({ disabled: false });
                                cancelButtonP.jqxButton({ disabled: true });
                                updateButtonP.jqxButton({ disabled: true });
                                break;
                        }
                    }
                    var rowIndex = null;
                    $("#padreGrid").on('rowSelect', function (event) {
                        var args = event.args;
                        rowIndex = args.index;
                        updateButtons('Select');
                    });
                    $("#padreGrid").on('rowUnselect', function (event) {
                        updateButtons('Unselect');
                    });
                    $("#padreGrid").on('rowEndEdit', function (event) {
                        updateButtons('End Edit');
                    });
                    $("#padreGrid").on('rowBeginEdit', function (event) {
                        updateButtons('Edit');
                    });
                    addButtonP.click(function (event) {
                        if (!addButtonP.jqxButton('disabled')) {
                            $("#padreGrid").jqxDataTable('goToPage', 0);
                            // add new empty row.
                            $("#padreGrid").jqxDataTable('addRow', null, {}, 'first');
                            // select the first row and clear the selection.
                            $("#padreGrid").jqxDataTable('clearSelection');
                            //$("#table").jqxDataTable('selectRow', 0);
                            // edit the new row.
                            //$("#table").jqxDataTable('beginRowEdit', 0);
                        }
                    });
                    cancelButtonP.click(function (event) {
                        if (!cancelButtonP.jqxButton('disabled')) {
                            // cancel changes.
                            $("#padreGrid").jqxDataTable('endRowEdit', rowIndex, true);
                        }
                    });
                    updateButtonP.click(function (event) {
                        if (!updateButtonP.jqxButton('disabled')) {
                            // save changes.
                            $("#padreGrid").jqxDataTable('endRowEdit', rowIndex, false);
                        }
                    });
                    editButtonP.click(function () {
                        if (!editButtonP.jqxButton('disabled')) {
                            $("#padreGrid").jqxDataTable('beginRowEdit', rowIndex);
                            //updateButtons('edit');
                        }
                    });
                    deleteButtonP.click(function () {
                        if (!deleteButtonP.jqxButton('disabled')) {
                            $("#padreGrid").jqxDataTable('deleteRow', rowIndex);
                            //updateButtons('delete');
                        }
                    });
                },
                columns: [
                  { text: 'id', editable: false, dataField: 'id', width: 50 },
                  { text: 'Nombre del clasificador', dataField: 'nombre', align:'center', width: 650},
                  { text: 'descripcion', dataField: 'descripcion', cellsAlign: 'left', align: 'center'}
                ]
            });
          $("#padreGrid").on('rowClick', function (event) {

              var args = event.args;
              var key = args.key;
              var row = args.row;//

              var ordersSource =
              {
                  dataType: "json",
                  dataFields: [
                      { name: 'id'},
                      { name: 'sinonimo', type: 'string' },
                      { name: 'id_otro'}
                  ],
                  id: 'id',
                  url: "/admindatabase/ajax/listasinonimosotro?id="+row.id,
                  addRow: function (rowID, rowData, position, commit) {
                    $.ajax({
                        url: "{{ url('/admindatabase/ajax/addsinonimootro') }}",
                        data: {'_token': $('input[name=_token]').val(),'id_otro': row.id },
                        type: "POST",
                        dataType: 'json',
                        success: function(data){
                          commit(true,data);
                        }
                    });

                  },
                  updateRow: function (rowID, rowData, commit) {
                    $.ajax({
                        url: "{{ url('/admindatabase/ajax/updatesinonimootro') }}",
                        data: {'_token': $('input[name=_token]').val(),'id': rowID,'id_otro': row.id,'sinonimo': rowData.sinonimo },
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
                        url: "{{ url('/admindatabase/ajax/deletesinonimootro') }}",
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
                { text: 'id_otro', editable: false,dataField: 'id_otro',width: 50,hidden: true },
                { text: 'Sinonimo', dataField: 'sinonimo', cellsAlign: 'left', align: 'center'}
              ]
          });

      });
    </script>
@endpush
