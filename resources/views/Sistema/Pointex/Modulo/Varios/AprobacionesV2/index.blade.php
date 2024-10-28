@extends('Sistema.Pointex.Modulo.Varios.AprobacionesV2._layout.layout')
@section('title', $titleMsg)

@section("css")

@endsection

@section('estados')
    <style>
        .actionBTN {
            margin-bottom: -1rem !important;
        }

    </style>

    @if(in_array($tipoSelect,$arrayTipo))
        @include("Sistema.Pointex.Modulo.Varios.AprobacionesV2._estadosUniversales")
        @include("Sistema.Pointex.Modulo.Varios.AprobacionesV2._tableUniversal")
    @else
        @include("Sistema.Pointex.Modulo.Varios.AprobacionesV2._estados")
        @include("Sistema.Pointex.Modulo.Varios.AprobacionesV2._table")
    @endif


@stop
@section('scripts')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/EZView.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/draggable_2.js') !!}
    <script>

        function modalUniversal(url){
            $('.modal').on('shown.bs.modal',function(){
                $(this).find('iframe').attr('src',url+'&form=1')
            })
            $('.modal').modal({show:true})

            $('iframe').load(function() {
                $('.loading').hide();
            });
        }

        // Add delete action (Just to test purposes)
        $('.delete').click(function() {
            $(this).prev().hide().end().hide();
        });
        var idEstado = {{ $idEstado }};
        var columnsCods = {{ $columnsCods }};

        function restrictAlphas(e) {
            e.target.value = e.target.value.replace(/\/courses\/([^\/]*)\/.*/, "$1");
        }

        function Aprobaciones(id, codigo, estatus, Icono, mens) {
            swal({
                title: '<div class="' + mens + '"></div><br>¿Deseas ' + mens + ' <b class="text-danger">' + codigo + '</b>?',
                input: 'text',
                inputPlaceholder: 'Agregar Observaciones',
                inputAttributes: {
                    autocapitalize: 'off',
                    maxlength: 300,
                    value: 300,
                    required: 'false',
                    oninput: 'restrictAlphas(event)'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deseo ' + mens + '!',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
            }).then(function (inputValue) {
                inputValue = inputValue.replace("/", "-");
                var url = "/pointex/aprobaciones/canbia_estatus/" + id + "/" + estatus + "/|" + inputValue;
                cargando(1);
                $.get(url, function (respuesta) {
                    cargando(0);
                    swal("¡Listo!", respuesta.Descripcion, respuesta.Tipo);
                    $("#btnSiguieteCode").click();
                })
            });
        }

        function llenaModal(codigo, suma) {
            if (codigo !== undefined) {
                $.get("/pointex/aprobaciones/ver_doc/" + codigo, function (responde) {
                    //  cargando(0);
                    var id = $("#sExpres-" + codigo).data("idaprobacion");
                    $("#modalContent").html(responde.Vista);
                    $("#headerDoc").attr("TitleRequisicion", codigo);
                    $("#headerDoc").html(codigo);
                    console.log(codigo)
                    $("#detalleModal").attr("href", $("#url-" + codigo).attr("href"));
                    $("#btnRechazar").attr("idAp", id).attr("codDoc", codigo);
                    $("#btnAprobar").attr("idAp", id).attr("codDoc", codigo);
                    if (responde.Estatus == "1") {
                        $("#btnAprobar").removeAttr("disabled", "disabled");
                        $("#btnRechazar").removeAttr("disabled", "disabled");
                    } else {
                        $("#btnAprobar").attr("disabled", "");
                        $("#btnRechazar").attr("disabled", "");

                    }

                    $("#imgDetalle").html(responde.archivos);
                    if(responde.archivos.length > 0)
                    {
                        $('.gallery1').EZView();
                    }
                });
            } else {
                llenaModal($("#headerDoc").attr("titlerequisicion"), 1)
                alert("No hay mas registros");
            }
        }

        $('#keyboard').on('show.bs.modal', function (e) {
            var codigo = $(e.relatedTarget).data('codigo');
            llenaModal(codigo);
        });

        var sumaColML = {{ $sumaCol-1 }};
        var sumaCol = sumaColML+1;
        function nuevaUrl(url) {
            window.location = url;
        }

        function getCodenCuso(suma) {
            var codigoAct = $("#headerDoc").attr("titlerequisicion");
            var plainArray = datatableViews
                .column(columnsCods)
                .data()
                .toArray();
            var posicion = $.inArray(codigoAct, plainArray) + suma;
            var codigo = plainArray[posicion];
            llenaModal(codigo, suma);
        }

        function efectoSlider(orientacion) {
            $("#modalContent").toggle("slide", {
                direction: orientacion
            }, function () {
                $('#modalContent').removeClass('hide').css('display', 'inline-block');
            });
        }

        function enviaFiltro() {
            var tipoSelect = {{ $tipoSelect }};
            var anio = $("#txtAnio").val();
            var mes = $("#txtMes").val();
            var urlFiltro = "/pointex/aprobaciones?tipoSelect=" + tipoSelect + "&estado=" + idEstado + "&txtAnio=" + anio + "&txtMes=" + mes;
            window.location.href = urlFiltro;
        }

        $(document).ready(function () {


            $("#btnAnteriorCode").on("click", function (e) {
                efectoSlider("left")
                getCodenCuso(-1);
            });
            $("#btnSiguieteCode").on("click", function (e) {
                efectoSlider("right")
                getCodenCuso(1);
            });

            var datatablePointer = $(".datatablePointerUnic");

            //JsonDatatableViews.buttons= null;
            //delete JsonDatatableViews['buttons'];
            //delete JsonDatatableViews['dom'];
            delete JsonDatatableViews['order'];
            if(idEstado != 1) {
                JsonDatatableViews.buttons.push({
                    text: '<input type="number" placeholder="Año" style="width: 65px" min="2019"  max="{{ date("Y") }}" value="{{ $anio }}" class="txtHistorico" id="txtAnio" onchange="enviaFiltro()" >'

                }, {
                    text: '<input type="number" placeholder="Mes" style="width: 65px" min="1" max="12" value="{{ $mes }}"  class="txtHistorico" id="txtMes" onchange="enviaFiltro()">'

                });
            }
            function stringToFloat(cadena) {
                try {
                    var expresion = /[+-]?([0-9]+([.][0-9]*)?|[.][0-9]+)/gm;
                    var cadenaExpre = cadena.match(expresion);
                    return parseFloat(cadenaExpre.join(''));
                } catch (error) {
                    return 0;
                }

            }

            JsonDatatableViews.footerCallback = function (row, data, start, end, display) {
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                        stringToFloat(i) * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                var api = this.api();
                var totalSum = 0;

                // Total over this page
                pageTotal = api
                    .column(sumaCol, {page: 'current'})
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                pageTotalML = api
                    .column(sumaColML, {page: 'current'})
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(sumaColML-1).footer()).html(
                    parseFloat(pageTotalML).toLocaleString('en-US')
                );

                $(api.column(sumaCol-1).footer()).html(
                    parseFloat(pageTotal).toLocaleString('en-US')
                );
            }
            if (datatablePointer.length) {
                datatableViews = datatablePointer.DataTable(JsonDatatableViews);
            }
            $(".clearCache").on("click", function () {
                datatableViews.state.clear();
                location.reload(true);
            });
        });
        var format = function (num) {
            var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
            if (str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (var j = 0, len = str.length; j < len; j++) {
                if (str[j] != ",") {
                    output.push(str[j]);
                    if (i % 3 == 0 && j < (len - 1)) {
                        output.push(",");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return ("$" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };
        function Revertir(id, codigo, estatus, Icono, mens) {
            swal({
                title: '<div class="' + mens + '"></div><br>¿Deseas ' + mens + ' <b class="text-danger">' + codigo + '</b>?',
                input: 'text',
                inputPlaceholder: 'Agregar Observaciones',
                inputAttributes: {
                    autocapitalize: 'off',
                    maxlength: 300,
                    value: 300,
                    required: 'false',
                    oninput: 'restrictAlphas(event)'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deseo ' + mens + '!',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
            }).then(function (inputValue) {
                inputValue = inputValue.replace("/", "-");
                var url = "/pointex/aprobaciones/canbia_estatus/" + id + "/" + estatus + "/|" + inputValue+"?revertir=1";
                cargando(1);
                $.get(url, function (respuesta) {
                    cargando(0);
                    swal("¡Listo!", respuesta.Descripcion, respuesta.Tipo);
                    location.reload();
                })

            });
        }
    </script>

@endsection
