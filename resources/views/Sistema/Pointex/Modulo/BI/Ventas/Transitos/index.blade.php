@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")

@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="content-header">{{ $titleMsg }}</div>
        </div>
    </div>
    {!! $vista !!}
@stop
@section('js')
    {!! HTML::script('/Sistema/Pointex/Modulo/Finanzas/js/universales.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}

    <script>
        {{--var arraypais = '{{ base64_encode($arrayPais) }}';--}}
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#FechaDespacho").on('change', function () {
                var FechaDespacho = new $('#FechaDespacho').val();
                $("#FechaIngresoBodega").attr("min", FechaDespacho);
            });

            // var pais = JSON.parse(atob(arraypais));
            $("#cmbPais").trigger("change");
            $("#cmbFac").trigger("change").attr('disabled', 'disabled');
            // $("#cmbPaisDespacho").attr('disabled', 'disabled');

            // Setup - add a text input to each footer cell
            $('#example thead tr').clone(true).appendTo('#example thead');
            $('#example thead tr:eq(1) th').each(function (i) {
                var title = $(this).text();
                if (i) {
                    $(this).html('<input type="text" id="txtSearch' + i + '" placeholder="Buscar ' + title + '" />');
                } else {
                    $(this).html('');
                }
                $('input', this).on('keyup change', function () {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });
            var table = $('#example').DataTable(JsonDatatableViews);
            $(".clearCache").on("click", function () {
                table.state.clear();
                location.reload(true);
            });
            var state = table.state.loaded();
            if (state) {
                $.each(state.columns, function (k, v) {
                    if (v.search.search) {
                        $("#txtSearch" + k).val(v.search.search);
                    }
                })
            }

        });
        var cliente = {{ $Cliente }}
        $("#cmbPais").on("change", function () {
            var strlOptions = "";
            if ($('#cmbPais').val().length > 0) {
                $.get("/pointex/bi/ventas/transitos/get_cliente/" + $('#cmbPais').val(), null, function (data) {
                    console.log(cliente)
                    var selected = '';
                    $.each(data, function (k, v) {
                        selected = cliente == k ? "selected" : null;
                        strlOptions += '<option value="' + k + '"  ' + selected + '>' + v + '</option>';
                    });
                    $('#cmbCliente').html(strlOptions);
                    cliente = null;
                });
            }
        });


        $("#cmbFac").on("change", function () {
            $.get("/pointex/bi/ventas/get_data_fac/" + this.value, function (response) {
                $("#IdFact").val(response.Id)
                $("#txtIdPaisF").val(response.Pais)
                $("#txtIdPais").val(response.Pais)
                $("#txtCleinteF").val(response.Dist)
                $("#txtCleinte").val(response.Dist)
                $("#txtFacF").val(response.Referencia)
                $("#txtFelF").val(response.Factura)
                $("#txtFechaF").val(response.FechaFactura)
                $("#txtFecha").val(response.FechaFactura)
                console.log(response)
            })
        })

        $("#cmbPais").select2({width: '100%'});
        $("#cmbCliente").select2({width: '100%'});

        var count = 0;
        $("form").validate({
            errorPlacement: function (error, element) {
                if (count === 0) {
                    var idInput = $("#" + element[0].id)
                    idInput.addClass("has-error");
                    idInput.focus();
                    var labelInput = $("label[for='" + element[0].id + "']").text().replace("Agregar Nuevo", "");
                    mensaje = error.text().replace("Este campo", labelInput.trim());
                    errorMsg();
                }
                count++;
            },
            invalidHandler: function (form, validator) {
                count = 0;
            }
        })

        $.extend($.validator.messages, {
            required: "Este campo es obligatorio.",
            remote: "Por favor, completá este campo.",
            email: "Por favor, escribí una dirección de correo válida.",
            url: "Por favor, escribí una URL válida.",
            date: "Por favor, escribí una fecha válida.",
            dateISO: "Por favor, escribí una fecha (ISO) válida.",
            number: "Por favor, escribí un número entero válido.",
            digits: "Por favor, escribí sólo dígitos.",
            creditcard: "Por favor, escribí un número de tarjeta válido.",
            equalTo: "Por favor, escribí el mismo valor de nuevo.",
            extension: "Por favor, escribí un valor con una extensión aceptada.",
            maxlength: $.validator.format("Por favor, no escribas más de {0} caracteres."),
            minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
            rangelength: $.validator.format("Por favor, escribí un valor entre {0} y {1} caracteres."),
            range: $.validator.format("Por favor, escribí un valor entre {0} y {1}."),
            max: $.validator.format("Por favor, escribí un valor menor o igual a {0}."),
            min: $.validator.format("Por favor, escribí un valor mayor o igual a {0}."),
            nifES: "Por favor, escribí un NIF válido.",
            nieES: "Por favor, escribí un NIE válido.",
            cifES: "Por favor, escribí un CIF válido."
        });

        function Eliminar(id) {
            swal({
                title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deseo Eliminarlo!',
                cancelButtonText: 'No',
            }).then(function (isConfirm) {
                if (isConfirm) {
                    url = '/pointex/bi/ventas/destroy_factura/' + id;
                    redirect()
                }
            });
        }

        function Confirmar() {
            swal({
                title: '<i class="fas fa-check fa-7x success"></i></i><br>¿Deseas Finalizar los Transitos?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
            }).then(function (isConfirm) {
                if (isConfirm) {
                    url = '/pointex/bi/ventas/transitos/confirmar';
                    redirect()
                }
            });
        }

        $(document).ready(function () {
            $("#frmInsert").validate();
        });

        var form = $("#frmInsert");
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
                        dangerMode: false,
                    })
                }
                pivote = 0;
            }
        });
        form.validate({
            rules: {
                "cmbPaisDespacho": {
                    required: true,
                },
                "NPedidoCliente": {
                    required: true,
                }
            },
            messages: {
                "cmbPaisDespacho": {
                    required: "Seleccione el pais de despacho",
                },
                "NPedidoCliente": {
                    required: "Ingrese el N.Pedido del Cliente",
                }
            }
        });

        $("#form :input:selected").change(function () {
            isValid = form.valid();
        });

        form.on("submit", function () {
            pivote = 1;
        });

        var IdFactura = $("#IdFactura"), FechaDespacho = $("#FechaDespacho"),
            FechaIngresoBodega = $("#FechaIngresoBodega"), FechaIngresoSistema = $("#FechaIngresoSistema");

        $("#FechaDespacho, #FechaIngresoBodega, #FechaIngresoSistema").on("change", function () {
            var input = [IdFactura.val(), FechaDespacho.val(), FechaIngresoBodega.val(), FechaIngresoSistema.val()];
            if ($.inArray("", input) == -1) {
                envia_formulario(IdFactura, frmFac)
            }
        });

        function envia_formulario(viene, frmFac) {
            swal({
                title: '<i class="far fa-question-circle fa-7x warning"></i><br>¿Deseas Guardar la información?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deseo Guardarlo!',
                cancelButtonText: 'No',
            }).then(function () {
                frmFac.submit();
            }, function (dismiss) {
                location.reload(true);
            }).done();
        }

        $('.switchery').on('click', function () {
            var Transito;
            var id;
            var chek = $(".switchery").is(':checked');

            if (chek){Transito = 1;}else{Transito = 0;}
            id = $("#Id").val();

            swal({
                title: 'Activar/Desactivar Transito',
                text: "Desea modificar el estado del Transito?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0CC27E',
                cancelButtonColor: '#FF586B',
                confirmButtonText: 'Cambiar',
                cancelButtonText: "No, Cancelar"
            }).then(function (isConfirm) {
                if (isConfirm) {
                    cargando(1);
                    var datos = {
                        _token: $("#_token").val(),
                        transito: Transito
                    };
                    $.post("/pointex/bi/ventas/cambia_estatus_activo/" + id, datos, function (res) {
                        if (res === "OK") {
                            cargando(2);
                            location.reload();
                            // swal(
                            //     'Modificado!',
                            //     'Transito modificado!!',
                            //     'success'
                            // );
                        } else {
                            cargando(2);
                            swal(
                                'Error!',
                                'No fue posible realizar la modificación!!',
                                'error'
                            );
                        }
                    });
                }
            }).catch(swal.noop);
        });
    </script>

@endsection
