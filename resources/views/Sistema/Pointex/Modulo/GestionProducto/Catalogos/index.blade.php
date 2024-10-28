
@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
@endsection

@section('content')
    @if(!isset($request->form))
    <div class="row" style="display: {{ $titleVisible ? 'none' : 'block'}}">
        <div class="col-sm-12">
            <div class="content-header">
                <a href="/pointex/gestion/catalogos/{{ base64_encode($table) }}" style="color: black">
                    {!! $titleMsg !!}
                </a>
            </div>
        </div>
    </div>
    @endif
    {!! $vista !!}
    @if(isset($dataTableView))
        @include("Sistema.Pointex.Modulo.GestionProducto.Catalogos._extenciones._tblUniversal", $dataTableView)
    @endif
@stop

@section('js')
    {!! $javaScript !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/GP_Catalogo.js') !!}
    @if($request->crear || $request->editar || $request->ver || $request->form)
        {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
        @if(!$request->ver)
            {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
        @endif
        {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/_catalogoComplementos/_frm.js') !!}
    @else
        {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/_catalogoComplementos/_tbl.js') !!}
    @endif
@endsection
