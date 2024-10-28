@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
    {!! HTML::style('/Sistema/Pointex/Modulo/GestionProducto/css/producto.css') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">{{ $titleMsg }}</div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card" style="min-height: 324.475px;">

                <div class="card-content">
                    {!! $frmInsert !!}
                    {!! $tbl !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {!! HTML::script('/Sistema/Pointex/Modulo/GestionProducto/js/supply.js') !!}
    <script>
        var cmbMarca = "{{base64_encode($cmbMarca)}}";
        var cmbEstadoProducto = "{{base64_encode($cmbEstadoProducto)}}";
        var cmbTipoPresentacion = "{{base64_encode($cmbTipoPresentacion)}}";
        addItemSelected($(".codeCrearItem"), false);
        function b64_to_utf8( str ) {
            return decodeURIComponent(escape(window.atob( str )));
        }
        function addItemSelected(selector) {
            selector.on('click', function () {
                var idCmb = $(this).data("id_cmb");
                var titulo = $(this).data("titulo");
                var modelo = $(this).data("modelo");
                var campomarca = $(this).data("campomarca");
                var campoPresentacion = $(this).data("campopresentacion");
                var campoTipoPresentacion = $(this).data("campotipopresentacion");
                var campoEstado = $(this).data("campoestado");
                var campoSKU = $(this).data("camposku");
                addNewOptionSelected(idCmb, titulo, modelo,campomarca,campoPresentacion,campoTipoPresentacion,campoEstado,campoSKU);
            });
        }
        function addNewOptionSelected(idCmb, titulo, modelo, campomarca,campoPresentacion,campoTipoPresentacion,campoEstado,campoSKU) {
            swal({
                title: titulo,
                html: b64_to_utf8(cmbMarca) +
                    '<input id="swal-SKU" class="swal2-input" placeholder="SKU Padre"> '+
                    '<input id="swal-Presentacion" class="swal2-input" placeholder="Presentacion">' +
                    b64_to_utf8(cmbTipoPresentacion)+
                    '<br>' +
                    b64_to_utf8(cmbEstadoProducto),

                input: 'hidden',
                inputAttributes:{ id : 'Marca' , name: campomarca},
                inputPlaceholder: 'Seleccione Marca..',
                showCancelButton: true,
                confirmButtonText: 'Enviar',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                focusConfirm: false,
                customClass: 'swal-wide',
                onOpen: function () {
                    $('.cmbMarca').select2({
                        minimumResultsForSearch: 15,
                        width: '100%',
                        placeholder: "Seleccione Marca",
                        language: "it",
                        dropdownParent: $('.swal2-container')
                    });
                }
            }).then(function (result) {
                var marcavalor = $('.swal2-modal  .cmbMarca option:selected').val();
                var Estadovalor = $('.swal2-modal  .cmbEstadoProducto option:selected').val();
                var Tipovalor = $('.swal2-modal  .cmbTipoPresentacion option:selected').val();
                var Presentacionvalor = document.getElementById('swal-Presentacion').value;
                var SKUvalor = document.getElementById('swal-SKU').value;
                if (!Presentacionvalor || !marcavalor || !Estadovalor || !SKUvalor || !Tipovalor) {
                    mensaje = "¡Todos los campos son requeridos!";
                    errorMsg();
                } else {
                    cargando(1);
                    var dataFrm = {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        tabla: modelo.trim(),
                        marca: campomarca.trim(),
                        marcavalor: marcavalor,
                        presentacion: campoPresentacion.trim(),
                        presentacionvalor: Presentacionvalor,
                        estado: campoEstado.trim(),
                        estadovalor: Estadovalor,
                        sku: campoSKU.trim(),
                        skuvalor: SKUvalor,
                        tipopresentacion: campoTipoPresentacion.trim(),
                        tipopresentacionvalor: Tipovalor,
                    };
                    $.post("/pointex/gestion/producto/supply/save", dataFrm, function (resp) {
                        console.log(resp)
                        if (resp.STATUS == "OK") {
                            mensaje = "Datos guardados con exito";
                            successMsg();
                        } else {
                            mensaje = resp.DATA;
                            errorMsg()
                        }
                        cargando(2);
                    })
                }
            })
        }

    </script>
@endsection
