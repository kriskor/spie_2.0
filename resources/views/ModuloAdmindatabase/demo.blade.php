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
                  <h3 class="box-title">DATOS</h3>
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
