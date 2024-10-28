@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">{{ $titleMsg }}</div>
        </div>
    </div>
    @include("Sistema.Pointex.Modulo.Varios.Aprobaciones._extenciones._tbl")
@stop

@section('js')
@endsection
