@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")

    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/pickadate/pickadate.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/wizard.css') !!}
    {!! HTML::style('/Sistema/Pointex/Modulo/Administracion/css/administracion.css') !!}
    {!! HTML::style('/Sistema/Pointex/Modulo/GestionProducto/css/registroSanitario.css') !!}

    <style>
        .swal-text {
            text-align: center;
        }
    </style>
@stop

@section('content')
    <section class="basic-elements">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">{{$titleMsg}}</div>
            </div>
        </div>
    </section>
    {!!$filtro!!}
    {!!$vista!!}
@endsection

@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/cat.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/toastr.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/numeric/jquery.numeric.js') !!}

    {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/tercerizado/correo.js') !!}

    {!! HTML::script('/Sistema/Pointex/Modulo/Finanzas/js/universales.js') !!}
    {{--    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/datatable/dataTableLanguaje.js') !!}--}}
    <script>
        function enviaFecha(id,val,tipo){
            location.href = '/pointex/gestion/descontinuados/edit_fecha/' + id + '/'+val+ '/'+tipo;
        }

        $("ul.nav-tabs a").click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $(".select2_single").select2({
            width: '100%'
        });
        $(".eventoClickElimina").on("click", function () {
            var getNo = this.id;
            swal({
                title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deseo Eliminarlo!',
                cancelButtonText: 'No',
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = '/pointex/gestion/descontinuados/destroy/' + getNo
                }
            });
        });

        $(".cambiar").on("click", function () {
            var getNo = this.id;
            swal({
                title: '<i class="fas fa-retweet fa-7x danger"></i><br>¿Cambiar el producto a no descontinuado ?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = '/pointex/gestion/descontinuados?' + getNo
                }
            });
        });

        $(".cambiarActivar").on("click", function () {
            var getNo = this.id;
            swal({
                title: '<i class="fas fa-retweet fa-7x danger"></i><br>¿Cambiar el producto a descontinuado ?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = '/pointex/gestion/descontinuados?' + getNo
                }
            });
        });

        function validar() {
            if (!document.querySelector('input[name="txtNotificar"]:checked')) {
                swal("advertencia!", "Seleccione si el correo es sobre la creacion de productos descontinuados *si/no!", "warning")
                hasError = true;
            } else {
                document.formCorreo.submit()
            }
        }

        function notificar(opcion) {
            var divNotificar = $('#divNotificar');
            if (opcion) {
                $("#txtCorreoTercerizado").val(1);
                $("#txtTitulo").val('Productos Descontinuado');
                $("#txtDescripcion").val('Buenos días,\n' +
                    '\n' +
                    'Se les informa que los siguientes productos ahora serán descontinuados.\n' +
                    '\n' +
                    'Saludos.');
            } else {
                $("#txtCorreoTercerizado").val(0);
                $("#txtTitulo").val('Productos no Descontinuado');
                $("#txtDescripcion").val('Buenos días,\n' +
                    '\n' +
                    'Se les informa que los siguientes productos dejaran de ser descontinuados.\n' +
                    '\n' +
                    'Saludos.');
            }
        }

        $(document).ready(function () {
            $('.nav-tabs a[href="#set1"]').tab('show');
            $('.nav-tabs a[href="#sub11"]').tab('show');
            $("#formNotaSalesExpenses").validate();
        });

        var form = $("#formNotaSalesExpenses");
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
            }
        });
        form.validate({
            rules: {
                "cmbProducto[]": {
                    required: true,
                },
                "txtAnio": {
                    required: true,
                },
                "cmbPais": {
                    required: true,
                },
                "cmbDistribuidor": {
                    required: true,
                },
                "cmbMes": {
                    required: true,
                }
            },
            messages: {
                "cmbProducto[]": {
                    required: "Seleccione los Productos",
                },
                "txtAnio": {
                    required: "Ingrese el Año",
                },
                "cmbPais": {
                    required: "Seleccione el Pais",
                },
                "cmbDistribuidor": {
                    required: "Seleccione el Distribuidor",
                },
                "cmbMes": {
                    required: "Seleccione el Mes",
                }
            }
        });

        $("#form :input:selected").change(function () {
            isValid = form.valid();
        });

        form.on("submit", function () {
            pivote = 1;
        });


        $("#cmbPais").on("change", function () {
            var fillSecondary = function () {
                $('#cmbDistribuidor').empty();
                $.get("/pointex/gestion/descontinuados/get_cliente/" + $('#cmbPais').val(), null, function (data) {
                    $('#cmbDistribuidor').append('<option selected="true">Seleccione</option>');
                    Object.values(data).forEach(function (elemento, indice, array) {
                        $('#cmbDistribuidor').append('<option value="' + elemento.Id + '">' + elemento.NombreBI + '</option>');
                    });
                });
            }
            $('#cmbPais').change(fillSecondary);
            fillSecondary();
        });

        $("#cmbDistribuidor").on("change", function () {
            var fillSecondary = function () {
                $('#cmbProducto').empty();
                $.get("/pointex/gestion/descontinuados/get_producto/" + $('#cmbDistribuidor').val(), null, function (data) {
                    // $('#cmbProducto').append('<option selected="true">Seleccione</option>');
                    Object.values(data).forEach(function (elemento, indice, array) {
                        $('#cmbProducto').append('<option value="' + elemento.Id + '">' + elemento.DescripcionSap + '</option>');
                    });
                });
            }
            $('#cmbDistribuidor').change(fillSecondary);
            fillSecondary();
        });

        function ShowSelected() {
            /* Para obtener el valor */
            // var cod = document.getElementById("cmbDistribuidor").value;
            // alert(cod);

            /* Para obtener el texto */
            var combo = document.getElementById("cmbDistribuidor");
            var selected = combo.options[combo.selectedIndex].text;
            if (selected == "Seleccione") {
                swal("advertencia!", "Seleccione el distribuidor campo obligatorio!", "warning")
                hasError = true;
            }
        }
    </script>
    @if(session()->get('msg.0'))
        @php($description = session()->get('msg.0.Descripcion'))
        <script>
            @switch(session()->get('msg.0.Tipo'))
            @case("error")
            swal({
                title: "Error!",
                html: "{{ $description }}",
                icon: "error",
                buttons: true,
                dangerMode: true,
            })
            @break
            @endswitch
        </script>
    @endif
@endsection
