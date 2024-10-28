@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
    {!! HTML::style('/Sistema/Pointex/Modulo/GestionProducto/css/producto.css') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">{{ $titleMsg }}</div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card" style="min-height: 324.475px;">

                <div class="card-content">
                    <div class="card-body">
                        {!! $vista !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/supply.js') !!}
@endsection