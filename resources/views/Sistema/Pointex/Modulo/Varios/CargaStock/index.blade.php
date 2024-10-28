@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/dropzone.min.css') !!}
    <style type="text/css">
        .bg-blue {
            background-color: #1F487C !important;
        }

    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-6">
            <div class="content-header">{{ $titleMsg }}</div>
        </div>
        <div class="col-sm-6 text-right">
            <input id="project" class="position-right-0" placeholder="Buscar Cliente" tabindex="1"/>
        </div>
    </div>
    @if(isset($data))
        @include("Sistema.Pointex.Modulo.Varios.CargaStock._subVistas._vistaVenta")
    @endif
    @if(isset($dataInventario))
        @include("Sistema.Pointex.Modulo.Varios.CargaStock._subVistas._vistaInv")
    @endif
@stop

@section('js')
    <script type="text/javascript">
        var url = "";
        var mensaje = "";
        var jsonMessage = {};
        //Custom File Input
        $('.custom-file input').change(function (e) {
            $(this).next('.custom-file-label').html(e.target.files[0].name);
        });
        $(document).ready(function () {
            if ($(".tbError").length > 0) {
                $("#aguarda").html("error");
            } else {
                // Do something if class does not exist
            }
            $("#subir").on('click', function () {
                if (document.getElementById("fileInventario").files.length == 0) {
                    mensaje = "Por favor seleccione un archivo";
                    errorMsg();
                } else {
                    $("#saveFile").submit();
                }

            });

            $("#subirInv").on('click', function () {
                if (document.getElementById("fileInventarioInv").files.length == 0) {
                    mensaje = "Por favor seleccione un archivo";
                    errorMsg();
                } else {
                    $("#saveFileInv").submit();
                }

            });
        });

        function errorMsg() {
            swal(
                'Error!',
                mensaje,
                'error'
            );
            mensaje = "";
        }

        function successMsg() {
            swal(
                'Ok!',
                mensaje,
                'success'
            );
            mensaje = "";
        }

        function msgJson() {
            return swal(jsonMessage).catch(swal.noop);
        }

        function redirect() {
            location.href = url;
        }

        function deleteRegistro(id) {
            swal({
                title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información <b class="text-danger">' + id + '</b>?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deseo Eliminarlo!',
                cancelButtonText: 'No',
            }).then(function (isConfirm) {
                if (isConfirm) {
                    url = '/pointex/multiples/stock_borrar/' + id;
                    redirect()
                }
            });
        }


        $(document).ready(function () {

            JsonDatatableViews.paging = false;
            JsonDatatableViews.scrollY = "400px";
            var datatablePointerUnic = $(".datatablePointerUnic");
            if (datatablePointerUnic.length) {
                datatableViews = datatablePointerUnic.DataTable(JsonDatatableViews);
            }
            var datatablePointerUnic2 = $(".datatablePointerUnic2");
            if (datatablePointerUnic2.length) {
                datatableViews = datatablePointerUnic2.DataTable(JsonDatatableViews);
            }
            $(".clearCache").on("click", function () {
                datatableViews.state.clear();
                location.reload(true);
            });


        });


        $(function () {
            var projects = JSON.parse('{!! $distribuidores !!}');

            $("#project").focus();

            $("#project").autocomplete({
                minLength: 0,
                source: projects,
                focus: function (event, ui) {
                    $("#project").val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    window.location.href = ui.item.id
                    return false;
                }
            })
                .data("ui-autocomplete")._renderItem = function (ul, item) {
                return $("<div class='card-body'><ul class='list-group'><li >")
                    .append("<a id='" + item.id + "' class='list-group-item'>" + item.label + "<br>" + item.desc + "</a></li></ul></div>")
                    .appendTo(ul);
            };
        });
    </script>
    @if(isset($data))
        @if($dataVentas->Estado == "error")
            <script type="text/javascript">
                toastr.options.showMethod = 'slideDown';
                toastr.options.progressBar = true;
                toastr.error('{{"Ventas: $dataVentas->Mensaje"}}', 'Mensaje de Archivo Ventas!');
            </script>
        @endif
    @endif

    @if(isset($dataInventario))
        @if($dataInventario->Estado == "error")
            <script type="text/javascript">
                toastr.options.showMethod = 'slideDown';
                toastr.options.progressBar = true;
                toastr.error('{{"Inventario $dataInventario->Mensaje"}}', 'Mensaje de Archivo Inventario!');
            </script>
        @endif
    @endif
@endsection
