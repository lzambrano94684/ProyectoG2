@extends('Sistema.Pointex.LayOuts.layout')
@section('title',$titleMsg)
@section("css")
    {!! HTML::style('/Sistema/Pointex/Modulo/Administracion/css/administracion.css') !!}

    <style>

        @page {
            margin-top: .20cm;
            margin-left: 1.90cm;
            margin-right: 1.83cm;
            font-family: Vegur, 'PT Sans', Verdana, sans-serif;
            font-size: x-small;
        }

        .centrar {
            text-align: center;
        }

        #wrap {
            width: 600px;
            margin: 0 auto;
        }

        #left_col {
            float: left;
            width: 300px;
        }

        #right_col {
            float: right;
            width: 200px;
        }

        #header {
            position: fixed;
            left: 0px;
            top: -180px;
            right: 0px;
            height: 150px;
            background-color: orange;
            text-align: center;
        }
        .subrayado {
            border-bottom: 1px solid #000000;
            padding-bottom: 3px;
        }
        .linea {
            border-top: 1px solid black;
            height: 2px;
            max-width: 200px;
            padding: 0;
            margin: 50px auto 0 auto;
        }

    </style>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <a type="button" class="btn btn-raised btn-warning mr-1"
               href="/pointex/medical/eventos/solicitud">
                <i class="ft-arrow-left"></i>Regresar
            </a>
            <button type="button" class="btn btn-danger pull-right" id="btnPdf" title="Generar PDF del documento">
                <i class="far fa-file-pdf"></i> Exportar
            </button>
        </div>
        @include("Sistema.Pointex.Modulo.Medical.SolicitudFormulario.subVista._PdfDatos")
        @endsection
        @section("js")
            <script type="text/javascript">
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
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/html2canvas.min`js') !!}
@endsection


