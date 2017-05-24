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
                  <h3 class="block-title">Modulos del SPIE habilitados para su usuario</h3>
              </div>
              <div class="block-content">
                  <div class="table-responsive">
                      <table class="table table-hover table-vcenter">
                          <tbody>
                              <tr>
                                  <td class="text-center" style="width: 200px;">
                                      <div style="width: 180px;">
                                          <img class="img-responsive" src="/assets_home/assets/img/iconos/ico_mod_indicadores.png" alt="">
                                      </div>
                                  </td>
                                  <td>
                                      <h4>Modulo -::- Catalogo de Indicadores</h4>
                                      <p class="remove-margin-b">Administracion de Indicadores</p>
                                      <a class="font-w600" href="javascript:void(0)"></a>
                                  </td>

                                  <td class="text-center">

                                      <p class="remove-margin-b">
                                          <button id="mod_indicadores" class="btn btn-x btn-default" type="button">
                                                  <i class="fa fa-download push-5-r text-primary"></i>Ingresar
                                          </button>
                                      </p>

                                  </td>
                              </tr>



                              <tr>
                                  <td class="text-center" style="width: 200px;">
                                      <div style="width: 180px;">
                                          <img class="img-responsive" src="/assets_home/assets/img/iconos/icono_adminbasedatos.jpg" alt="">
                                      </div>
                                  </td>
                                  <td>
                                      <h4>Modulo -::- Administración Base-Estadística</h4>
                                      <p class="remove-margin-b">Administracion y gestion de clasificadores de Regiones, variables estadisticas y otros.</p>
                                      <a class="font-w600" href="javascript:void(0)"></a>
                                  </td>

                                  <td class="text-center">

                                      <p class="remove-margin-b">
                                          <button id="mod_admindatabase" class="btn btn-x btn-default" type="button">
                                                  <i class="fa fa-download push-5-r text-primary"></i>Ingresar
                                          </button>
                                      </p>

                                  </td>
                              </tr>



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
      $(document).ready(function(){
          $('#modulos').addClass('active');
          $("#mod_indicadores").on('click', function () {
              $(location).attr('href','{{ url('/indicadores/dashboard') }}');
           });
           $("#mod_admindatabase").on('click', function () {
               $(location).attr('href','{{ url('/admindatabase/dashboard') }}');
            });



      });
    </script>
@endpush
