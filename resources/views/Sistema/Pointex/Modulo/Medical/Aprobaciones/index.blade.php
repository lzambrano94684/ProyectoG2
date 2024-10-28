@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
    <style>
        /*.subrayado {*/
        /*    border-bottom: 1px solid #000000;*/
        /*    padding-bottom: 3px;*/
        /*}*/
        .linea {
            border-top: 1px solid black;
            height: 2px;
            max-width: 200px;
            padding: 0;
            margin: 50px auto 0 auto;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">{{ $titleMsg  }}</div>
        </div>
    </div>
    @if($modelAprobaciones)
        <div class="col-md-12 col-sm-12 text-right">
            <button type="button" class="btn btn-success pull-right text-white"
                    onclick="Aprobaciones({{ $modelAprobaciones->Id }}, '', 2,'fa fa-check', 'Aceptar',1)"
                    title="Aceptar el documento">
                <i class="fa fa-check"></i> Aceptar
            </button>
            <button type="button" class="btn btn-danger pull-right text-white"
                    onclick="Aprobaciones({{ $modelAprobaciones->Id }}, '', 3,'fa fa-times', 'Rechazar',1)"
                    title="Rechazar PDF del documento">
                <i class="fa fa-times"></i> Rechazar
            </button>
        </div>
    @endif
{{--    <iframe src='/pointex/medical/eventos/evento/{{ $id }}' style='width:100%; min-height:800px'--}}
{{--            type='application/pdf'></iframe>--}}
    @include("Sistema.Pointex.Modulo.Medical.SolicitudFormulario.subVista._PdfDatos")

@stop

@section('js')
    {!! HTML::script('/Sistema/Pointex/Modulo/Medical/js/aprobaciones.js') !!}
@endsection
