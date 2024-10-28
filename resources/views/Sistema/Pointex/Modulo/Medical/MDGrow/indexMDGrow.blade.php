@extends('Sistema.Pointex.LayOuts.layout')

@section("css")
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
                        <a href="/pointex/medical/mdgrow?{{ base64_encode("crear=!") }}"
                           class="form-control text-white btn btn-primary float-lg-right" title="Agregar nuevo">
                            <i class="icon-plus"></i> Agregar
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="px-3">
                            <form class="form" id="IdFormCapex" method="post"
                                  action="{{url("/pointex/finanzas/presupuesto/capex")}}">
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
    <!--vista -->
    @include("Sistema.Pointex.Modulo.Medical.MDGrow.tblMDGrow")


@stop
@section('js')
    <script>

    </script>
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/toastr.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Medical/js/MDGrow.js') !!}

@stop
