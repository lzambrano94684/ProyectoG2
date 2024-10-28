@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
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
    {!!$vistaTbl!!}
@endsection

@section('js')
    <script>
        var trigger = {{ $trigger }};
        var Distribuidor = {{ $cmbDistribuidor }};
        var Farmacia = {{ $cmbFarmacia }};

        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#MarketAccess thead tr').clone(true).appendTo( '#MarketAccess thead' );
            $('#MarketAccess thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                if (i) {
                    $(this).html( '<input type="text" id="txtSearch'+i+'" placeholder="Buscar '+title+'" />' );
                }else {
                    $(this).html( '' );

                }

                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
            var table = $('#MarketAccess').DataTable( JsonDatatableViews);
            $(".clearCache").on("click",function () {
                table.state.clear();
                location.reload(true);
            });
            var state = table.state.loaded();
            if (state)
            {
                $.each(state.columns, function (k, v){
                    if (v.search.search)
                    {
                        $("#txtSearch"+k).val(v.search.search);
                    }
                })
            }
        } );

        if (trigger) {
            cargando(1)
            $('#cmbDistribuidor').empty();
            $.get("/pointex/gestion/market_access_inst/get_distribuidor/" + $('#cmbPais').val(), function (data) {
                if (Distribuidor == 0) {
                    $('#cmbDistribuidor').append('<option selected="true">Seleccione</option>');
                }
                Object.values(data).forEach(function (elemento, indice, array) {
                    if (Distribuidor == elemento.Id) {
                        $('#cmbDistribuidor').append('<option value="' + elemento.Id + '" selected="selected">' + elemento.NombreBI + '</option>');
                    } else {
                        $('#cmbDistribuidor').append('<option value="' + elemento.Id + '">' + elemento.NombreBI + '</option>');
                    }
                });
            });

            $('#cmbFarmacia').empty();
            $.get("/pointex/gestion/market_access_inst/get_farmacia/" + Distribuidor, function (data) {
                if (Farmacia == 0) {
                    $('#cmbFarmacia').append('<option selected="true">Seleccione</option>');
                }
                Object.values(data).forEach(function (elemento, indice, array) {
                    if (Farmacia == elemento.Id) {
                        $('#cmbFarmacia').append('<option value="' + elemento.Id + '" selected="selected">' + elemento.Farmacia + '</option>');
                    } else {
                        $('#cmbFarmacia').append('<option value="' + elemento.Id + '">' + elemento.Farmacia + '</option>');
                    }
                });
            });

            if (Distribuidor) {
                $.get("/pointex/gestion/market_access_inst/get_cod_entidad/" + Distribuidor, function (data) {
                    $("#txtDistribuidor").val(data)
                });
            } else {
                $("#txtDistribuidor").val(null)
            }

            if (Farmacia) {
                $.get("/pointex/gestion/market_access_inst/get_cod_farmacia/" + Farmacia, function (data) {
                    $("#txtFarmacia").val(data)
                });
            } else {
                $("#txtFarmacia").val(null)
            }
            cargando(0)
        }

        $(".select2_single").select2({
            width: '100%'
        });
        $("#cmbPais").on("change", function () {
            cargando(1)
            var fillSecondary = function () {
                $('#cmbDistribuidor').empty();
                $.get("/pointex/gestion/market_access_inst/get_distribuidor/" + $('#cmbPais').val(), function (data) {
                    $('#cmbDistribuidor').append('<option selected="true">Seleccione</option>');
                    Object.values(data).forEach(function (elemento, indice, array) {
                        $('#cmbDistribuidor').append('<option value="' + elemento.Id + '">' + elemento.NombreBI + '</option>');
                    });
                });
            }
            $('#cmbPais').change(fillSecondary);
            fillSecondary();

            $.get("/pointex/gestion/market_access_inst/get_cod_pais/" + $('#cmbPais').val(), function (data) {
                $("#txtCodPais").val(data)
            });
            cargando(0)
        });
        $("#cmbDistribuidor").on("change", function () {
            cargando(1)
            var fillSecondary = function () {
                $('#cmbFarmacia').empty();
                $.get("/pointex/gestion/market_access_inst/get_farmacia/" + $('#cmbDistribuidor').val(), function (data) {
                    $('#cmbFarmacia').append('<option selected="true">Seleccione</option>');
                    Object.values(data).forEach(function (elemento, indice, array) {
                        $('#cmbFarmacia').append('<option value="' + elemento.Id + '">' + elemento.Farmacia + '</option>');
                    });
                });
            }
            $('#cmbDistribuidor').change(fillSecondary);
            fillSecondary();

            $.get("/pointex/gestion/market_access_inst/get_cod_entidad/" + $('#cmbDistribuidor').val(), function (data) {
                $("#txtDistribuidor").val(data)
            });
            cargando(0)
        });
        $("#cmbFarmacia").on("change", function () {
            $.get("/pointex/gestion/market_access_inst/get_cod_farmacia/" + $('#cmbFarmacia').val(), function (data) {
                $("#txtFarmacia").val(data)
            });
        });

        var cmbPais = $("#cmbPais"), cmbDistribuidor = $("#cmbDistribuidor"), cmbFarmacia = $("#cmbFarmacia"),
            cmbMeses = $("#cmbMeses"), txtAnio = $("#txtAnio");
        $("#cmbPais, #cmbFarmacia, #cmbDistribuidor, #cmbMeses, #txtAnio").on("change", function () {
            var inputEncabezado = [
                cmbPais.val(),
                cmbMeses.val(),
                txtAnio.val()
            ];
            if ($.inArray("", inputEncabezado) == -1) {
                frmBuscar.submit();
            }
        });

        function UpdateTipo(id,tipo){
            var datos = {
                _token: $("#_token").val(),
                idDaf :id,
                tipoVenta:tipo
            };
            $.post("/pointex/gestion/market_access_inst/save_tipo_venta", datos, function (res) {
                console.log(res)
                if (res.ESTADO === "OK") {
                    $("#"+res.ID).text(res.TIPO);
                    cargando(2);
                    swal(
                        'Modificado!',
                        'Arbol modificado!!',
                        'success'
                    );
                } else {
                    cargando(2);
                    swal(
                        'Error!',
                        res,
                        'error'
                    );
                }
            });
        }
    </script>
@endsection
