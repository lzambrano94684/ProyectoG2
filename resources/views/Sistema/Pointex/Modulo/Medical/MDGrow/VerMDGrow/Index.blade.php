@extends('Sistema.Pointex.LayOuts.layout')

@section("css")
    {!! HTML::style('/Sistema/Pointex/Modulo/Administracion/css/administracion.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/dropzone.min.css') !!}
@stop

@section('content')

    <section class="basic-elements">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">@if(isset($titleMsg)){{$titleMsg}}@endif</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                </div>
            </div>
        </div>
    </section>
    <!--vista -->
    @include("Sistema.Pointex.Modulo.Medical.MDGrow.VerMDGrow._tblMDGrowFull")

@stop
@section('js')
    <script>

    </script>
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/toastr.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/numeric/jquery.numeric.js') !!}



@stop
