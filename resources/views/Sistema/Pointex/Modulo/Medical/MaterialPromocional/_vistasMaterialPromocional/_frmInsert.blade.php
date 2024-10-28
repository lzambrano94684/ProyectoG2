
@section("css")
    {!! HTML::style('/Sistema/Pointex/Modulo/Administracion/css/administracion.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/dropzone.min.css') !!}
@stop

@section('content')

    <div class="card-content">
        <div class="card-body">

            @if($ver && $aprobar && $modelAprobaciones)

                <div class="col-md-12 col-sm-12 text-right">
                    <button type="button" class="btn btn-success pull-right text-white"
                            onclick="Aprobaciones({{ $modelAprobaciones->Id }}, 'Material Promocional', 2,'fa fa-check', 'Aceptar')"
                            title="Aceptar el documento">
                        <i class="fa fa-check"></i> Aceptar
                    </button>
                    <button type="button" class="btn btn-danger pull-right text-white"
                            onclick="Aprobaciones({{ $modelAprobaciones->Id }}, 'Material Promoiconal', 3,'fa fa-times', 'Rechazar')"
                            title="Rechazar el documento">
                        <i class="fa fa-times"></i> Rechazar
                    </button>
                </div>

            @endif
    <section class="basic-elements">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <legend class="fieldset-marco text-muted"><h4 class="form-section"><i
                                        class="icon-picture"></i> @if(isset($titleMsg)){{$titleMsg}}@endif</h4></legend>
                            <form id="formMaterialPromocional" name="formMaterialPromocional" method="POST"
                                  action="/pointex/medical/material/promocional/crear" enctype="multipart/form-data">
                                <input type="hidden" id="txtIdSolicitud" name="txtIdSolicitud" value="{{$id}}">
                                @csrf
                                <section id="form-action-layouts">
                                    <div class="row match-height">
                                        <div class="col-md-6">
                                            @include("Sistema.Pointex.Modulo.Medical.MaterialPromocional._vistasMaterialPromocional._frmIzquierda")
                                        </div>

                                        <div class="col-md-6">
                                            @include("Sistema.Pointex.Modulo.Medical.MaterialPromocional._vistasMaterialPromocional._frmDerecha")
                                        </div>

                                    </div>

                                </section>

                                <!-- detalle-->
                                <div class="form-actions">

                                    <a type="button" class="btn btn-raised btn-warning mr-1"
                                       href="{{  url()->current() }}">
                                        <i class="ft-arrow-left"></i> Regresar
                                    </a>

                                    <button type="submit" class="btn btn-raised btn-primary" id="Idbtn">
                                        <i class="ft-save"></i> Guardar
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('js')

    <script type="text/javascript">
        var dataMarcas = "{{ base64_encode($Marcas) }}";
        var validarVer = "{{$ver}}";
        var TiempoDuracion = "{{$modelSolicitudMateriales->DuracionMaterial?$modelSolicitudMateriales->DuracionMaterial:0}}";
        var IdMarca = "{{$modelSolicitudMateriales->IdMarca?$modelSolicitudMateriales->IdMarca:0}}";
        var Cod = "{{base64_encode($modelSolicitudMateriales->Codigo?$modelSolicitudMateriales->Codigo:0)}}";

    </script>

    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Medical/js/validarMaterialPromocional.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Medical/js/MaterialPromocional.js') !!}
@stop
