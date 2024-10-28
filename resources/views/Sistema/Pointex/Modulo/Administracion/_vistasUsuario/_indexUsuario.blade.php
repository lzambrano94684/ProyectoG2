@extends('Sistema.Pointex.LayOuts.layout')

@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/pickadate/pickadate.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/wizard.css') !!}


    {!! HTML::style('/Sistema/Pointex/Modulo/Administracion/css/administracion.css') !!}
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
                        <div class="card-header">
                        </div>
                        <div id="btnadd" class="col-md-6 text-right">
                            <a href="/pointex/administracion/usuarios?{{ base64_encode("crear=!") }}"
                               class="form-control text-white btn btn-primary float-lg-right" title="Agregar uno nuevo">
                                <i class="icon-plus"></i> Agregar
                            </a>
                        </div>
                        <div class="card-content">

                            <div class="px-3">

                                <form class="form" id="IdFormCapex" method="post"
                                      action="{{url("/pointex/administracion/usuarios")}}">
                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                    <div class="form-body">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include("Sistema.Pointex.Modulo.Administracion._vistasUsuario._tablaUsuario")
@stop
@section('js')

    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/basic-inputs.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/administracion.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/numeric/jquery.numeric.js') !!}

@stop
