@extends('layouts.ModuloPdes')

@section('header')
<style>
.bg-pilar {
    background: #2d4d6a none repeat scroll 0 0;
}
.bg-meta {
    background: #8DB4E2 none repeat scroll 0 0;
}

.text-0 {
  color: #fff;
}
</style>
@endsection

@section('content')
  {{-- Titulo --}}
<div class="row bg-title p-t-0 p-b-0 m-b-5">

</div>
<!-- .row eta configuracion esta buena-->
{{-- <div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info bg-pilar fon p-10">

          <div class="row text-0">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <i data-icon="E" class="linea-icon linea-basic"></i>
                <h5 class="text-0 vb">TOTAL PILARES</h5>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <h1 class="text-0 counter text-right m-t-0 m-b-0">13</h1>
            </div>

          </div>

        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info bg-meta p-10">
          <div class="row text-0">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <i data-icon="E" class="linea-icon linea-basic"></i>
                <h5 class="text-0 vb">TOTAL METAS</h5>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h1 class="counter text-right text-0 m-t-0 m-b-0">64</h1>
            </div>

          </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info bg-theme p-10">
          <div class="row text-0">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <i data-icon="E" class="linea-icon linea-basic"></i>
                <h5 class="text-0 vb">TOTAL RESULTADOS</h5>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h1 class="counter text-right text-0 m-t-0 m-b-0"> 341 </h1>
            </div>

          </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info  p-10">
          <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <i data-icon="E" class="linea-icon linea-basic"></i>
                <h5 class="vb">TOTAL PRESUPUESTO ($us)</h5>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <h2 class="counter text-right m-t-0 m-b-0"> 42.394.670.970,00 </h2>
            </div>
          </div>
        </div>
    </div>
</div> --}}
<!--/.row -->
@endsection


@push('script-head')

@endpush
