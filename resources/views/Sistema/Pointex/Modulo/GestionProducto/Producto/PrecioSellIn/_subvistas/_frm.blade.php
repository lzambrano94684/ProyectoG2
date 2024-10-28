@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <section id="configuration">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">Sell In</h4>
                        <p class="mb-0">Por favor llenar los campos para hacer una creación a la base de datos.</p>
                    </div>
                    <div class="card-content">
                        <div class="px-3">
                            <form class="form form-horizontal" id="form" method="post"
                                  action="/pointex/gestion/sell_in/save"
                                  novalidate="novalidate" id="form">
                                <input type="hidden" name="Id" value="{{$datos->Id}}">
                                @csrf
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-file-text"></i> Requerimientos</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Seleccione el Nombre Sap:</label>
                                        <div class="col-md-9">
                                            {!! $cmbProductoCod !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Seleccione el Pais:</label>
                                        <div class="col-md-9">
                                            {!! $cmbPais !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Seleccione la Planta:</label>
                                        <div class="col-md-9">
                                            {!! $cmbPlanta !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Seleccione la Moneda:</label>
                                        <div class="col-md-9">
                                            {!! $cmbMoneda !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Seleccione Promocion:</label>
                                        <div class="col-md-9">
                                            {!! $cmbPromocionadp !!}
                                        </div>
                                    </div>
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-md-3 label-control">Seleccione Nombre Padre:</label>--}}
{{--                                        <div class="col-md-9">--}}
{{--                                            {!! $cmbProducto !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Seleccione el Incoterm:</label>
                                        <div class="col-md-9">
                                            {!! $cmbIncoterm !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Ingrese el Monto:</label>
                                        <div class="col-md-9">
                                            <input class="form-control" id="txtMonto" name="txtMonto" type="number"
                                                   value="{{$datos->Monto}}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <a type="button" class="btn btn-raised btn-warning mr-1"
                                           href="/pointex/gestion/sell_in">
                                            <i class="ft-arrow-left"></i> Regresar
                                        </a>
                                        <button class="btn btn-raised btn-primary eventoClickGuardar">
                                            <i class="ft-save"></i> Guardar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    <script>
        $(document).ready(function () {
            $('.cmbProductoCod').select2();
            $('.cmbPais').select2();
            $('.cmbPlanta').select2();
            $('.cmbMoneda').select2();
            $('.cmbProducto').select2();
            $('.cmbIncoterm').select2();

            var form = $("#form");
            var pivote = 0;
            var isValid = false;
            $.validator.setDefaults({
                showErrors: function (errorMap, errorList) {
                    var summary = "";
                    $.each(errorList, function () {
                        summary += this.message + "\n";
                    });
                    if (pivote && !isValid) {
                        swal({
                            title: "Error",
                            text: summary,
                            icon: "error",
                            buttons: true,
                            dangerMode: true,
                        })
                    }
                    pivote = 0;
                    console.log(isValid);
                }
            });

            form.validate({
                rules: {
                    "cmbProductoCod": {
                        required: true,
                    },
                    "cmbPais": {
                        required: true,
                    },
                    "cmbPlanta": {
                        required: true,
                    },
                    "cmbMoneda": {
                        required: true,
                    },
                    "cmbPromocionadp": {
                        required: true,
                    },
                    "cmbProducto": {
                        required: true,
                    },
                    "cmbIncoterm": {
                        required: true,
                    },
                    "txtMonto": {
                        required: true,
                    }
                },
                messages: {
                    "cmbProductoCod": {
                        required: "Ingrese el Nombre Sap",
                    },
                    "cmbPais": {
                        required: "seleccione el pais",
                    },
                    "cmbPlanta": {
                        required: "Seleccione la planta",
                    },
                    "cmbMoneda": {
                        required: "seleccione la moneda",
                    },
                    "cmbPromocionadp": {
                        required: "Seleccione si es promocionado o no promocionado",
                    },
                    "cmbProducto": {
                        required: "Seleccione el nombre padre",
                    },
                    "cmbIncoterm": {
                        required: "Seleccione el incoterm",
                    },
                    "txtMonto": {
                        required: "Ingrese el monto",
                    }
                }
            });
            $("#form :input:selected").change(function () {
                isValid = form.valid();
                console.log(isValid)
            });
            form.on("submit", function () {
                pivote = 1;
            });
        });
    </script>
@endsection
