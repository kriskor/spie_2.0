@extends('layouts.ModuloAdmindatabase')

@section('header')

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
              <h3>Nuevo validador</h3>
              <form role="formnewValidador" id="formnewValidador" action="{{ url('/admindatabase/guardarvalidador') }}"  method="POST"  data-toggle="validator" class="form">
                {{ csrf_field() }}
                <div class="form-group">
                  <div class="select2-wrapper">
                    <label class="control-label">Clasificador</label>
                    <select placeholder="Ingresar sigla" class="form-control" name="nombre_clasificador" required='required'>
                        <option value="">Ninguno</option>
                        @foreach($otros as $co)
                          <option value="{{$co->descripcion}}">{{$co->descripcion}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>


               <div class="form-group">
                 <label>Titulo de Clasificador</label>
                 <textarea class="form-control" placeholder="Ingrese datos de la normativa de creacion" rows="2" name="titulo" required='required'></textarea>
               </div>

               <div class="form-group">
                 <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
               </div>




              </form>


            <hr/>
            <h3>Listado de Validadores</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre Clasificador</th>
                                <th>Vista Clasificador</th>
                                <th>Titulo</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clasificadores as $c)
                            <tr>
                                <td>{{ $c->nombre_clasificador }}</td>
                                <td>{{ $c->nombre_vista }}</td>
                                <td>{{ $c->titulo }}</td>
                                <td class="text-nowrap">
                                    {{-- <a href="#" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> --}}
                                    <a href="{{ url('/admindatabase/eliminarvalidador/'.$c->id ) }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
              </div>
          </div>
      </div>

  </div>
  <!-- /.container-fluid -->

@endsection

@push('script-head')
  <script type="text/javascript">
      function activarMenu(id,sub){
          $('#'+id).addClass('active');
      }
      $(document).ready(function(){
          activarMenu('home',0);



      });
    </script>
@endpush
