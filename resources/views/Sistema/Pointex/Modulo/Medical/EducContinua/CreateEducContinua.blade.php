@extends('Sistema.Pointex.LayOuts.layout')
@section('title',$title)

@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/pickadate/pickadate.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/datetime-picker/bootstrap-datetimepicker.min.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/wizard.css') !!}

    <style>
        .has-success {
            border-color: #1cf46f !important;
        }
    </style>
@stop
@section('content')
    <div id="print"></div>
    <section class="basic-elements">
        @if($request->search)
            <a href="{{ url()->current() }}" class="btn btn-raised btn-warning mr-1">
                <i class="fas fa-refresh"> Regresar</i>
            </a>
            <div id="dialog-pdf" title="pdf" stye="display:none;">
                <div id="editor">
                </div>
                <a href="#" onclick="saveDiv('contenido','evento')">Generar PDF</a>
            </div>
        @endif
        <section id="icon-tabs">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <legend class="fieldset-marco text-muted"><h4 class="form-section"><i
                                    class="icon-screen-desktop"></i> Requerimientos</h4></legend>
                        <div align="center"
                             class="content-header">@if(isset($titleMsg)){{$titleMsg}}@endif</div>
                        <div class="card-header">
                            @if($sumaPresupuesto == 0)
                                <form class="form form-horizontal" id="form" method="post"
                                      action="/pointex/medical/eventos/educ/monto"
                                      novalidate="novalidate">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{--            <div class="form-group">--}}
                                            {{--                <label for="CodReg">Código&nbsp;de&nbsp;Evento:</label>--}}
                                            {{--                <input type="text" class="form-control " id="txtCodReg"--}}
                                            {{--                       name="txtCodReg" readonly value="{{ $modelEvento->CodReg }}">--}}
                                            {{--            </div>--}}
{{--                                            <input type="hidden" id="txtIdArbol" name="txtIdArbol" value="{{$IdArbol}}">--}}
                                            <div class="form-group col-9">
                                                <label for="slcFranquicia">Seleccione Franquícia:</label>
                                                <select required class=" select2_single form-control" id="slcFranquicia"
                                                        name="slcFranquicia">
                                                    <option value="">Seleccione Franquicia</option>
                                                    @foreach($franquicias as $franquicia)
                                                        <option
                                                            {{ $modelEvento->IdFranquicia == $franquicia->Id ? 'selected' : null }}
                                                            @if($franquicia->Codigo)
                                                            codigo={{ $franquicia->Codigo }}
                                                            @endif
                                                                value="{{$franquicia->Id}}">{{$franquicia->Nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-9">
                                                <label for="slcPais">Seleccione País:</label>
                                                {!! $slcPais !!}
                                            </div>
                                            <div class="form-group col-9">
                                                <label for="slcTipo">Seleccione Tipo:</label>
                                                {!! $slcTipo !!}
                                            </div>
                                            <div class="form-group col-9">
                                                <label for="slcPais">Seleccione Arbol:</label>
                                                {!! $slcArbol !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group  col-9">
                                                <label for="slcMes">Seleccione Mes:</label>
                                                {!! $slcMes !!}
                                            </div>
                                            <div class="form-group col-9">
                                                <label for="slcProducto">Seleccione Producto:</label>
                                                <select required
                                                        class="custom-select select2_single form-control col-9"
                                                        id="slcProducto"
                                                        name="slcProducto[]" multiple="multiple"
{{--                                                        size="3"--}}
                                                >
                                                    <option value="">Seleccione Producto</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-9">
                                                <label for="slcTipo">Seleccione Sociedad:</label>
                                                {!! $slcSociedad !!}
                                            </div>
                                        </div>
                                    </div>
                                    <a type="button" class="btn btn-raised btn-warning mr-1"
                                       href="/pointex/medical/eventos/solicitud">
                                        <i class="ft-arrow-left"></i>Regresar
                                    </a>
                                    <button class="btn btn-raised btn-primary eventoClickGuardar">
                                        <i class="ft-save"></i> Guardar
                                    </button>
                                </form>
                            @endif
                        </div>
                        @if($sumaPresupuesto)
                            <div class="card-content">
                                <div class="card-body" id="contenido" style="background: #FFFFFF">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 align="center"
                                                class="card-title mb-0">@if(isset($titleMsg2)){{$titleMsg2}}@endif</h4>
                                        </div>
                                    </div>
                                    <form class="icons-tab-steps wizard-circle" #f="ngForm" id="formEventoMedical"
                                          name="formEventoMedical"
                                          method="POST"
                                          action="/pointex/medical/eventos/educ/crear">
                                        @csrf
                                        <input type="hidden" id="txIdEvento" name="txIdEvento"
                                               value="{{$id}}">
                                        <input type="hidden" id="txtUsuario" name="txtUsuario"
                                               value="{{$usuario->Persona->Id}}">
                                        <input type="hidden" id="txtUsuarioInicial" value="{{$UserInicial}}">
                                        <input type="hidden" id="txtIdArbol" name="txtIdArbol" value="{{$IdArbol}}">
                                        <input type="hidden" id="txtsumaPresupuesto" name="txtxsumaPresupuesto"
                                               value="{{$sumaPresupuesto}}">
                                        <input type="hidden" id="txtfranquicia" name="txtxfranquicia"
                                               value="{{$franquicia}}">
                                        <input type="hidden" id="txtMes" name="txtxMes" value="{{$Mes}}">
                                        <input type="hidden" id="slcTipo" name="slcTipo" value="{{$TipoEvento}}">
                                        <!-- Step 1 -->
                                        <h6><strong>Datos del Lugar</strong></h6>
                                        @include("Sistema.Pointex.Modulo.Medical.EducContinua.pasos.paso1")
                                    <!-- Step 2 -->
                                        <h6><strong>Datos Financieros</strong></h6>
                                        @include("Sistema.Pointex.Modulo.Medical.EducContinua.pasos.paso2")
                                    </form>
                                </div>
                            </div>
<<<<<<< HEAD
{{--                        @else--}}
{{--                            <div class="card-content">--}}
{{--                                <div class="card-body" id="contenido" style="background: #FFFFFF">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-12">--}}
{{--                                            <h4 align="center"--}}
{{--                                                class="card-title mb-0">@if(isset($titleMsg2)){{$titleMsg2}}@endif</h4>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <form class="icons-tab-steps wizard-circle" #f="ngForm" id="formEventoMedical"--}}
{{--                                          name="formEventoMedical"--}}
{{--                                          method="POST"--}}
{{--                                          action="">--}}
{{--                                    @csrf--}}
{{--                                    <!-- Step 1 -->--}}
{{--                                        <h6><strong>Datos del Lugar</strong></h6>--}}
{{--                                        <fieldset>--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="txtPlataforma">Nombre de la Plataforma:</label>--}}
{{--                                                        <input type="text" class="form-control" id="txtCiudad"--}}
{{--                                                               name="txtPlataforma" readonly>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group" id="Ubicacion">--}}
{{--                                                        <label for="txtUbuciacionEvento">Ubicación del Evento--}}
{{--                                                            (Restaurante/Hotel):</label>--}}
{{--                                                        <input type="text" class="form-control" id="txtUbuciacionEvento"--}}
{{--                                                               name="txtUbuciacionEvento" readonly>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="txtTituloEvento">Título del Evento:</label>--}}
{{--                                                        <input type="text" class="form-control" id="txtTituloEvento"--}}
{{--                                                               name="txtTituloEvento" readonly>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div class="col-md-6">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="txtObjetivo">Objetivos del Evento:</label>--}}
{{--                                                        <input name="txtObjetivo" id="txtObjetivo" rows="2"--}}
{{--                                                               class="form-control" readonly>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="txtFecha">Fecha del Evento:</label>--}}
{{--                                                        <input type="date" id="txtFecha" class="form-control"--}}
{{--                                                               name="txtFecha" data-toggle="tooltip"--}}
{{--                                                               data-trigger="hover" data-placement="top"--}}
{{--                                                               data-title="Date Opened"--}}
{{--                                                               value="{{ $modelEvento->convertDate("fecha")->first()}}"--}}
{{--                                                               readonly>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="txtHora">Hora del Evento:</label>--}}
{{--                                                        <div class="position-relative has-icon-left">--}}
{{--                                                            <input type="time" id="txtHora" class="form-control"--}}
{{--                                                                   name="txtHora"--}}
{{--                                                                   value="{{ $modelEvento->convertDate("hora")->last() }}"--}}
{{--                                                                   readonly>--}}
{{--                                                            <div class="form-control-position">--}}
{{--                                                                <i class="ft-clock"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </fieldset>--}}
{{--                                        <!-- Step 2 -->--}}
{{--                                        <h6><strong>Datos Financieros</strong></h6>--}}
{{--                                        <fieldset>--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="txtMontoHonorario">Ingrese Precio--}}
{{--                                                            Honorarios:</label>--}}
{{--                                                        <div class="input-group">--}}
{{--                                                            <div class="input-group-prepend">--}}
{{--                                                                <span class="input-group-text">$</span>--}}
{{--                                                            </div>--}}
{{--                                                            <input type="text" class="form-control square decimal"--}}
{{--                                                                   id="txtMontoHonorario"--}}
{{--                                                                   name="txtMontoHonorario" placeholder="$00.00"--}}
{{--                                                                   maxlength="5" size="5" readonly>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group" id="MontoHospedaje">--}}
{{--                                                        <label for="txtMontoHospedaje">Ingrese Precio Hospedaje:</label>--}}
{{--                                                        <div class="input-group">--}}
{{--                                                            <div class="input-group-prepend">--}}
{{--                                                                <span class="input-group-text">$</span>--}}
{{--                                                            </div>--}}
{{--                                                            <input type="text" class="form-control square decimal"--}}
{{--                                                                   id="txtMontoHospedaje"--}}
{{--                                                                   name="txtMontoHospedaje" placeholder="$00.00"--}}
{{--                                                                   maxlength="5" size="5" readonly>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group" id="CantInvidados">--}}
{{--                                                        <label for="txtCantInvidados">Ingrese Cantidad--}}
{{--                                                            Invitados:</label>--}}
{{--                                                        <input type="text" class="form-control entero"--}}
{{--                                                               id="txtCantInvidados" name="txtCantInvidados"--}}
{{--                                                               placeholder="Cantidad" size="2" readonly>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group" id="CantStaff">--}}
{{--                                                        <label for="txtCantidadStaff">Ingrese Cantidad Staff:</label>--}}
{{--                                                        <input type="text" class="form-control entero" id="txtCantStaff"--}}
{{--                                                               name="txtCantStaff" maxlength="1"--}}
{{--                                                               size="1" placeholder="Cantidad" max="2" readonly required>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-4">--}}
{{--                                                    <div class="form-group" id="TotalComida">--}}
{{--                                                        <label for="meetingName2">Total Alimentación:</label>--}}
{{--                                                        <input type="text" class="form-control" id="txtTotalComida"--}}
{{--                                                               readonly>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="meetingName2">Total Evento:</label>--}}
{{--                                                        <input type="text" class="form-control" id="txtTotalEvento"--}}
{{--                                                               readonly>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="">Total Presupuestado:</label>--}}
{{--                                                        <input type="hidden" class="form-control"--}}
{{--                                                               name="txtTotalPresupuesto" id="txtTotalPresupueto">--}}
{{--                                                        <input type="text" class="form-control" id="txtPresupueto"--}}
{{--                                                               readonly>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="meetingName2">Desviación:</label>--}}
{{--                                                        <input type="text" class="form-control" id="txtDesviacion"--}}
{{--                                                               readonly>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </fieldset>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
=======
>>>>>>> e0f43a52a69da4ac1686b508b1a5f347145c0767
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- Wizard Ends -->
    </section>
    <div id="dataPDF" hidden></div>
@stop
@section('js')

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jspdf.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/html2canvas.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jquery.steps.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datetime-picker/bootstrap-datetimepicker.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.date.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.time.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/legacy.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Medical/js/Medical.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Medical/js/conferencistaMedical.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/numeric/jquery.numeric.js') !!}
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>--}}
    <script>
        // $(document).ready(function(){
        //     $("#slcTipo option[value='2']").attr("selected",true);
        // });

        // $(document).ready(function () {}
        // function ShowSelected() {
            /* Para obtener el valor */
            // var cod = document.getElementById("slcTipo").value;
            // /* Para obtener el texto */
            // var combo = document.getElementById("slcTipo");
            // var selected = combo.options[combo.selectedIndex].text;
        $(document).ready(function () {
            var Tipo = document.getElementById("slcTipo").value;
            if (Tipo == "Virtual") {
                $("#MontoHospedaje").hide();
                $("#CantInvidados").hide();
                $("#CantStaff").hide();
                $("#MontoComida").hide();
                $("#TotalComida").hide();
                $("#Ubicacion").hide();
                $("#txtCiudad").hide();
                $("#txtMetodoPago").hide();
                document.formEventoMedical.txtMontoHospedaje.value = 0;
                document.formEventoMedical.txtCantInvidados.value = 0;
                document.formEventoMedical.txtCantStaff.value = 0;
                document.formEventoMedical.txtMontoComida.value = 0;
                document.formEventoMedical.txtTotalComida.value = 0;
                document.formEventoMedical.txtUbuciacionEvento.value = " ";
            } else if (Tipo == "Presencial") {
                $("#MontoHospedaje").show();
                $("#CantInvidados").show();
                $("#CantStaff").show();
                $("#MontoComida").show();
                $("#TotalComida").show();
                $("#Ubicacion").show();
                $("#txtCiudad").show();
                $("#txtMetodoPago").show();
                $("#txtPlataforma").hide();
            }
        });

        const pdfWidth = 614;  // 8.5 inches width
        const pdfHeight = 1944;  // 27 inches height
        function saveDiv(content, title) {
            console.log($("#contenido")[0])
            var pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'pt',
                format: [pdfWidth, pdfHeight]
            });
            pdf.addHTML($("#contenido")[0], 0, 0, function () {
                ps_filename = title;
                pdf.save(ps_filename + '.pdf');
            });
        }


        $(document).ready(function () {

            $(document).ready(function () {
                $('.decimal').numeric({decimal: ".", negative: false, scale: 3});
                $('.Monto').numeric({decimal: ".", negative: false, scale: 3});
                $('.entero').numeric({negative: false});
                jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');


            })
            var tablePDF = '<table>';


            $("#formEventoMedical input, label, select, textarea, input:radio:checked").each(function (k, v) {
                // console.log(v,k,  $(this).is("label"));
                tablePDF += '        <tr>\n';
                if ($(this).is("label")) {
                    var label = $(this).text().replace("Seleccione", "");
                    var text = "";
                    if ($(this).next().is("input")) {
                        text = $(this).next().val().replace("Seleccione", "");
                        ;
                    } else if ($(this).next().is("textarea")) {
                        text = $(this).next().html().replace("Seleccione", "");
                        ;
                    }
                    tablePDF += '            <td> <b>' + label + '</b></td>\n' +
                        '            <td>' + text + ' </td>\n';
                }
                tablePDF += '        </tr>';
            })
            tablePDF += '</table>';
            $("#dataPDF").html(tablePDF)


            var doc = new jsPDF();

// We'll make our own renderer to skip this editor
            var specialElementHandlers = {
                '#editor': function (element, renderer) {
                    return true;
                }
            };

            $('#cmd').click(function () {
                doc.fromHTML($('#dataPDF').get(0), 15, 15, {
                    'width': 170,
                    'elementHandlers': specialElementHandlers
                });
                doc.save('{{ $request->search }}.pdf');
            });
        });
        changeFranquicia('{{$modelEvento->IdFranquicia}}', '{{$arrayMarca}}')

        var Id = "{{$request->search}}"


        if (Id === "") {

        } else {

            $("#formEventoMedical").removeClass("icons-tab-steps");
            $("#formEventoMedical").removeClass("wizard-circle");

            $(":input").attr('readonly', true);
            $('select').prop("disabled", true);
            $(':radio:not(:checked)').attr('disabled', true);

        }


        $(document).ready(function () {
            $('.select2_single ').select2();

            $(document).ready(function () {
                $("#form").validate();
            });
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
                    "slcFranquicia": {
                        required: true,
                    },
                    "slcProducto": {
                        required: true,
                    },
                    "slcMes": {
                        required: true,
                    },
                    "slcPais[]": {
                        required: true,
                    }
                },
                messages: {
                    "slcFranquicia": {
                        required: "Seleccione una Franquicia",
                    },
                    "slcProducto": {
                        required: "Seleccione el Producto",
                    },
                    "slcMes": {
                        required: "Seleccione el Mes",
                    },
                    "slcPais[]": {
                        required: "Seleccione el Pais",
                    }
                }
            });
            $("#form:input:selected").change(function () {
                isValid = form.valid();
                console.log(isValid)
            });
            form.on("submit", function () {
                pivote = 1;
            });
        });
    </script>
@stop
