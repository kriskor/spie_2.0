@extends('layouts.home')

@section('header')

@endsection

@section('content')
<div class="content content-boxed">

          <!-- Products -->
          <div class="block block-rounded">
              <div class="block-header">
                  <ul class="block-options">
                      <li>
                          <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                      </li>
                  </ul>
                  <h3 class="block-title">Listado de subsistemas para su usuario:</h3>
              </div>
              <div class="block-content">
                  <div class="table-responsive">
                      <table class="table table-hover table-vcenter">
                          <tbody>
                            @foreach($modulos as $mod)
                              <tr onclick="$(location).attr('href','{{ url($mod->url) }}');">
                                  <td class="text-center" style="width: 200px;">
                                      <div style="width: 180px;">
                                          <img class="img-responsive" src="/assets_home/assets/img/iconos/{{ $mod->icono }}" alt="">
                                      </div>
                                  </td>
                                  <td>
                                      <h4>{{ $mod->titulo }}</h4>
                                      <p class="remove-margin-b">{{ $mod->descripcion }}</p>
                                      <a class="font-w600" href="javascript:void(0)"></a>
                                  </td>

                                  <td class="text-center">

                                      <p class="remove-margin-b">
                                          <button  class="btn btn-x btn-default" type="button">
                                                  <i class="fa fa-download push-5-r text-primary"></i>Ingresar
                                          </button>
                                      </p>

                                  </td>
                              </tr>
                            @endforeach



                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
          <!-- END Products -->
      </div>
@endsection

@push('script-head')
  <script type="text/javascript">
      function activarMenu(id,sub){
          // $('.menu').removeClass('active');
          // $('.submenuli').removeClass('active');
          // $('.submenuli').removeClass('menuActivado');
          // $('#'+id).addClass('active');
          // $('#'+id+'_'+sub).addClass('menuActivado');
          // $('.menu-icono').removeClass('fa-folder-open');
          // $('.menu-icono').addClass('fa-folder');
          // $('#icon-'+id).addClass('fa-folder-open');
          //if(sub < 0)
          //    $('#'+id+'_'+sub).addClass('active');
          $('#'+id).addClass('active');
      }
      $(document).ready(function(){
          activarMenu('home',0);


      });
    </script>
@endpush
