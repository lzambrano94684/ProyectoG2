@extends('Sistema.Pointex.LayOuts.layout')
@section('title',$titleMsg)

@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/wizard.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/dropzone.min.css') !!}
    {!! HTML::style('/Sistema/Pointex/Modulo/GestionProducto/css/registroSanitario.css') !!}
@endsection

@section("content")
    {{--    @include("Correos.Facturacion")--}}
        <div class="row">
            <div class="col-sm-6">
                <div class="content-header">
                    Envió de Correo Electrónico
                </div>
            </div>
        </div>
            <div class="card">
                <div class="card-header">
                    <br>
                    <br>
                    <h4 class="text-center card-title" id="horz-layout-basic">
                        A continuación detalle de la facturación emitida en el mes de marzo 2021
                    </h4>
                </div>
                <section class="invoice-template">
                    <div class="row">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div id="invoice-template" class="card-header" style="background: #FFFFFF">
                                            <div class="row d-flex justify-content-center">
                                                <table class="table text-center datatablePointer">
                                                    <thead class="bg-info text-black">
                                                    <tr>
                                                        <th>Pais</th>
                                                        <th>Cliente</th>
                                                        <th>No.Factura</th>
                                                        <th>No.Factura FEL</th>
                                                        <th>Fecha Factura</th>
                                                        <th>Nº Pedido Cliente</th>
                                                        <th>Origen de Despacho</th>
                                                        <th>Ingreso a Bodega</th>
                                                        <th>Ingreso a Sistema</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($dataTransitos->count() > 0)
                                                        @foreach($dataTransitos as $kvv => $vvv)
                                                            <tr>
                                                                <td>{{ $vvv->Pais }}</td>
                                                                <td>{{ $vvv->Dist }}</td>
                                                                <td>{{ $vvv->Referencia }}</td>
                                                                <td>{{ $vvv->Factura }}</td>
                                                                <td>{{ $vvv->FechaFactura }}</td>
                                                                <td>{{ $vvv->NPedidoCliente }}</td>
                                                                <td>{{ $vvv->ODespacho }}</td>
                                                                <td>{{ $vvv->FechaIngresoBodega }}</td>
                                                                <td>{{ $vvv->FechaIngresoSistema }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br><br><br><br>
                                    <form id="form" method="post" action="/pointex/bi/ventas/transitos/enviar_correo">
                                        @csrf
                                        <input type="text" name="fecha" id="fecha" value="{{$fecha}}" hidden>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="cmbFac">Pais</label>
                                            <div class="col-md-6">
                                                {!! $cmbPais !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="cmbFac">Cliente</label>
                                            <div class="col-md-6">
                                                {!! $cmbEntidad !!}
                                            </div>
                                        </div>
                                        <label class="label-control" for="Correo">Enviar Correo Electrónico a:</label>
                                            <div id="textarea">
                                            </div>
                                            <input type="hidden" name="correos" id="correos" value="@foreach($getCorreos as $kc){{$kc->Correo.";"}}@endforeach"/>
{{--                                        {!! $cmbContacto !!}--}}
                                        <br>
                                        <label class="label-control" for="Descripcion">Descripcion</label>
                                        <textarea type="text" class="form-control" id="descripcion" name="descripcion"
                                                  placeholder="Descripcion" required></textarea>
                                        <br>
                                        <button type="submit" class="btn btn-info pull-right" id="btnCorreo"
                                                title="Enviar Correo">
                                            <i class="fas fa-mail-bulk"></i> Enviar Correo
                                        </button>
                                    </form>
                                    <a type="button" class="btn btn-raised btn-warning mr-1"
                                       href="/pointex/bi/ventas/transitos">
                                        <i class="ft-arrow-left"></i>Regresar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
@endsection
@section("js")
        <script type="text/javascript">
            $(".select2_single").select2({
                selectOnClose: true,
                placeholder: "Seleccione Opción",
                allowClear: true
            });

            function saveDiv(content, title) {
                var pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'pt',
                    format: [pdfWidth, pdfHeight]
                });
                pdf.addHTML(content, 0, 0, function () {
                    ps_filename = title;
                    pdf.save(ps_filename + '.pdf');
                });
            }

            $("#btnPdf").click(function () {
                saveDiv($("#invoice-template")[0], $("#txtCodigo").val());
            });
        </script>
        {!! HTML::script('/Sistema/Pointex/Modulo/Finanzas/js/universales.js') !!}
        {!! HTML::script('/Sistema/Pointex/Modulo/Finanzas/js/liquidaciongv.js') !!}
        {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jspdf.min.js') !!}
        {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/html2canvas.min.js') !!}
        {!! HTML::script('/Sistema/Pointex/Modulo/BI/transito.js') !!}
        {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
@endsection
