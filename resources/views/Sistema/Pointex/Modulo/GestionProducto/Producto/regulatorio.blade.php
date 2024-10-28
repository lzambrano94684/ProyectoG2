@php
    $url = '';
@endphp
@extends('Sistema.Pointex.LayOuts.layout')

@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/wizard.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/dropzone.min.css') !!}
    {!! HTML::style('/Sistema/Pointex/Modulo/GestionProducto/css/registroSanitario.css') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">
                <a href="/pointex/gestion/regulatorio/crear_listar" @if($request->txtMarca)  style="color: rgb(128, 128, 128);" @else style="color: black" @endif>
                    {!! $titleMsg !!}
                </a>
                {!! $parrafo !!}
            </div>
        </div>
    </div>
    {!! $vista !!}
@stop
@php($titleMsg = "$titleMsg - $subTitulo")
@section('title', $titleMsg)
@section('js')
    <script>
        var urlActual = "{{ $url }}";
        var verRegMarca = true;
        var verRegSanitario = true;
    </script>
    {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/regulatorio.js') !!}
    @if($request->registroMarca)
        @if($request->crear || $request->editar || $request->ver)
            @if(!$request->ver)
                <script> verRegMarca = false </script>
                {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/dropzone.min.js') !!}
                {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/dropzone.js') !!}
            @endif
            {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
            {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/_regulatorioComplementos/_frmRegistroMarca.js') !!}
        @else
            {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/_regulatorioComplementos/_tblRegistroMarca.js') !!}
        @endif
    @elseif($request->registroSanitario)
        @if($request->crear || $request->editar || $request->ver)
            @if(!$request->ver)
                <script> verRegSanitario = false </script>
                {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/dropzone.min.js') !!}
                {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/dropzone.js') !!}
            @endif
            {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
            {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/_regulatorioComplementos/_frmRegistroSanitario.js') !!}
        @else
            {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/_regulatorioComplementos/_tblRegistroSanitario.js') !!}
        @endif
    @endif

@endsection