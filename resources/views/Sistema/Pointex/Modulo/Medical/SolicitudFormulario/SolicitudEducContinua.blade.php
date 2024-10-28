@extends('Sistema.Pointex.LayOuts.layout')
@section('title',$titleMsg)

@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/pickadate/pickadate.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/datetime-picker/bootstrap-datetimepicker.min.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/dropzone.min.css') !!}
    {!! HTML::style('/Sistema/Pointex/Modulo/Finanzas/css/requisiciones.css') !!}
    <style>
        .has-success {
            border-color: #1cf46f !important;
        }
    </style>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <section class="basic-elements">
                        <div class="row">
                            <div class="col-sm-12">
                                <div align="center"
                                     class="content-header">@if(isset($titleMsg)){{$titleMsg}}@endif</div>
                                <br>
                                <div
                                     class="">A continuación un listado de los eventos cread@s, si deseas crear más favor dar click <a href="/pointex/medical/eventos/educ">Aquí</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="feather-icons overflow-hidden">
                            <!-- SEARCH-->
                            @include("Sistema.Pointex.Modulo.Medical.SolicitudFormulario.subVista.table")
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jquery.steps.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datetime-picker/bootstrap-datetimepicker.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.date.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.time.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/legacy.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Medical/js/Medical.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Medical/js/pdfMedicall.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Finanzas/js/universales.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Finanzas/js/requisiciones.js') !!}
        <script>
        var dataCuentas = "{{ base64_encode($evento) }}";
        @if(session()->get('msg.0'))
        @php($description = session()->get('msg.0.Descripcion'))
        @switch(session()->get('msg.0.Tipo'))
        @case("error")
        swal({
            title: "Error",
            html: "{{ $description }}",
            icon: "error",
            buttons: false,
            dangerMode: false,
        })
        @break
        @endswitch
        @endif

        function enviarRegistro(id) {
            swal({
                title: '<i class="far fa-share-square fa-7x warning"></i><br>¿Deseas Enviar al árbol de aprobaciones <b class="text-danger">Enviar</b>?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deseo Enviar!',
                cancelButtonText: 'No',
            }).then(function (isConfirm) {
                if (isConfirm) {
                    url = "/pointex/medical/eventos/correo/"+id;
                    redirect()
                }
            });
        }
        function deleteRegistro(id, nombre) {
            swal({
                title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información <b class="text-danger">' + nombre + '</b>?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deseo Eliminarlo!',
                cancelButtonText: 'No',
            }).then(function (isConfirm) {
                if (isConfirm) {
                    url = '/pointex/medical/eventos/eliminar/'+id;
                    redirect()
                }
            });
        }
    </script>
@stop
