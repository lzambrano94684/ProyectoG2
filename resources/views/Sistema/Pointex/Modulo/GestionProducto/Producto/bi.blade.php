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
    {!! $frmInsert !!}
    {!! $tbl !!}
@stop

@section('js')
    {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/supply.js') !!}
@endsection