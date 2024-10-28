@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
@endsection

@section('content')
    <form role="search" class="navbar-form navbar-right mt-1" id="frmEncabezado">
        <div class="position-relative has-icon-right">
            <input type="month" placeholder="{{ date("Y-m") }}" class="form-control round" min="2017-01"
                   max="{{ date("Y-m") }}" onchange="inputFecha(this.value, 'txtFecha')" id="txtFechaInicio"
                   name="txtFechaInicio"
                   value="{{ $request->txtFechaInicio ? $request->txtFechaInicio : date("Y-m") }}" required>
            <div class="form-control-position" id="dvEnviaForm"><i class="ft-search"></i></div>
        </div>
    </form>
    <div class="row">
        <div class="col-sm-6">
            <div class="content-header">{{ $titleMsg }}</div>
        </div>
    </div>
    @include("Sistema.Pointex.Modulo.BI.Ventas.Bonificaciones._subvistasCarga._seccion")
    @include("Sistema.Pointex.Modulo.BI.Ventas.Bonificaciones._subvistasCarga._modal")

@stop
@section('js')
    {!! HTML::script('/Sistema/Pointex/Modulo/Finanzas/js/universales.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    <script type="text/javascript">
        function inputFecha(valor, id) {
            $("#" + id).val(valor)
        }
        var libre = parseInt({{ $libre->count() }})
        var btnGuardaBonificados = $("#btnGuardaBonificados");
        var btnGuardaVentaModal = $("#btnGuardaVentaModal");

        if (libre > 0) {
            btnGuardaBonificados.prop('disabled', true);
        } else {
            btnGuardaBonificados.on("click", function () {
                $(".select2_single").select2({
                    width: '200px',
                    placeholder: "Seleccione Opción",
                    allowClear: true,
                    dropdownParent: $('#bootstrap')
                });
            });
            btnGuardaVentaModal.on("click", function () {
                $("#frmBonificadosFiltrada").submit();
            })
        }
        validate_espaniol();
        $(document).ready(function () {
            $("#dvEnviaForm").on("click", function () {
                $("#frmEncabezado").submit();
            });
            $("#txtFechaInicio").trigger("change");
            $(".select2_single").select2({
                width: '200px',
                placeholder: "Seleccione Opción",
                allowClear: true
            });
            JsonDatatableViews.paging = false;
            JsonDatatableViews.scrollY = "400px";
            var datatablePointerUnic = $(".datatablePointerUnic");
            if (datatablePointerUnic.length) {
                datatableViews = datatablePointerUnic.DataTable(JsonDatatableViews);
            }
            $(".clearCache").on("click", function () {
                datatableViews.state.clear();
                location.reload(true);
            });
            $("#modalTpost").val($("#cmbTPos").val())
        });
    </script>
@endsection
