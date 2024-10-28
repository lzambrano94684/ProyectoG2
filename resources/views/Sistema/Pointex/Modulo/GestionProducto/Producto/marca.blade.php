@php
    $subTitulo = "";
    $url = '';
@endphp
@extends('Sistema.Pointex.LayOuts.layout')

@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/wizard.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/dropzone.min.css') !!}
    {!! HTML::style('/Sistema/Pointex/Modulo/GestionProducto/css/marca.css') !!}
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">
                <a href="/pointex/gestion/marca/crear_listar" style="color: black">
                    {!! $titleMsg !!}
                </a>
            </div>
        </div>
    </div>
    @if($request->crear)
        @php($subTitulo = "Crear")
        @php($url = "crear=1")
        @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._wizardNewMarca")
    @elseif($request->listar)
        @php($subTitulo = "Listado")
        @php($url = "listar=1")
        @if($request->idMarca)
            @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._tblProducto")
        @else
            @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._filtroBusqueda")
            @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._tbl_view_data")
        @endif
        @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._mdl")
    @else
        @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._ptInicial")
    @endif
@stop
@php($titleMsg = "$titleMsg - $subTitulo")
@section('title', $titleMsg)

@section('js')
    <script> var urlActual = "{{ $url }}"; </script>
    <script> var idMarca = "{{ $request->idMarca ? $request->idMarca : $request->cmbMarca }}"; </script>
    {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/marca.js') !!}
    @if($request->crear)
        {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/dropzone.min.js') !!}
        {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/dropzone.js') !!}
        {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
        {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jquery.steps.min.js') !!}
        {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/_marcaComplementos/conferencistaMedical.js') !!}
    @elseif($request->listar)
        <script> var dataProducto = null; </script>
        @if($request->idMarca)
            <script>
                var dataProducto = "{{ base64_encode($dataProductosJson) }}";
                var nombreMarca = "{{ $nombreMarca }}";
            </script>
            {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/dataTables.rowsGroup.js') !!}
        @endif
        {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/dropzone.min.js') !!}
        {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/dropzone.js') !!}
        {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/_marcaComplementos/_listar.js') !!}
    @endif
@endsection
