@extends('layouts.ModuloPdes')

@section('header')

@endsection

@section('content')
<div class="row bg-title p-t-0 p-b-0">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Inicio</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active">Inicio</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Blank Starter page</h3>
        </div>
    </div>
</div>
@endsection


@push('script-head')

@endpush
