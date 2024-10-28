@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")

@endsection

@section('content')


    <div class="mb-12">
        <a href="javascript:void(0)"  class="btn btn-raised gradient-purple-bliss white shadow-z-1-hover btn-block">
            <h2 style="animation: scroll-right 10s linear infinite">{{ $mensajeInfo }}</h2>
        </a>
    </div>

    @include("Sistema.Pointex.Modulo.VisitaMedica._subVistas._filtroFecha")
    @include("Sistema.Pointex.Modulo.VisitaMedica._subVistas._tblFichero")
@stop
@section('js')
    {!! HTML::script('/Sistema/Pointex/Modulo/Finanzas/js/universales.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}

    <script type="text/javascript">
        $(document).ready(function () {

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
        });
        function buscar(frm){
            $("#"+frm).submit();
        }
    </script>

@endsection

