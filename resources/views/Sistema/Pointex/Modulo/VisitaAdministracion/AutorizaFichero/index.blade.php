@extends('Sistema.Pointex.LayOuts.layout')

@section('title',$titleMsg)

@section("css")
@endsection

@section("content")
    <section class="basic-elements">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">{{ $titleMsg }}</h4>
                        {!! $vista !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section("js")

    @yield('jsExtras')
    <script>


        function getJson(url) {
            return JSON.parse($.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                global: false,
                async: false,
                success: function (data) {
                    return data;
                }
            }).responseText);
        }
        function GetDetalleProdMedico(CodCloseUp, asignar) {
            var ProdTrim4 = getJson("/pointex/visita_medica/paneles/prod_medico/" + CodCloseUp + "/TRIM_4/" + asignar);
            var ProdTrim3 = getJson("/pointex/visita_medica/paneles/prod_medico/" + CodCloseUp + "/TRIM_3/" + asignar);
            var ProdTrim2 = getJson("/pointex/visita_medica/paneles/prod_medico/" + CodCloseUp + "/TRIM_2/" + asignar);
            var ProdTrim1 = getJson("/pointex/visita_medica/paneles/prod_medico/" + CodCloseUp + "/TRIM_1/" + asignar);

            var dibujaTablaHead = '';
            var dibujaTablaBody = '';
            var dibujaTablaFooter = '</tbody></table>';
            var posicion = 0;

            if (ProdTrim4) {
                // dibujaTablaHead = '<b><h5>Ranking Trim Actual</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                dibujaTablaHead = '<b><h5>TRIM MOV 02/23</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                $.each(ProdTrim4, function (k, v) {
                    posicion = posicion + 1;
                    dibujaTablaBody += '<tr><td class="text-left">' + posicion + '</td><td class="text-left">' + v.Mercado + '</td><td class="text-left">' + v.prod + '</td></tr>';
                });
                $("#tblTrim4").html("" + dibujaTablaHead + dibujaTablaBody + dibujaTablaFooter).val();
            } else {
                $("#tblTrim4").html("<h4>Sin Ranking</h4>").val();
            }

            if (ProdTrim3) {
                dibujaTablaHead = '';
                dibujaTablaBody = '';
                posicion = 0
                // dibujaTablaHead = '<b><h5>Ranking Trim 3</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                dibujaTablaHead = '<b><h5>TRIM MOV 11/22</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                $.each(ProdTrim3, function (k, v) {
                    posicion = posicion + 1;
                    dibujaTablaBody += '<tr><td class="text-left">' + posicion + '</td><td class="text-left">' + v.Mercado + '</td><td class="text-left">' + v.prod + '</td></tr>';
                });
                $("#tblTrim3").html("" + dibujaTablaHead + dibujaTablaBody + dibujaTablaFooter).val();
            } else {
                $("#tblTrim3").html("<h4>Sin Ranking</h4>").val();
            }

            if (ProdTrim2) {
                dibujaTablaHead = '';
                dibujaTablaBody = '';
                posicion = 0
                // dibujaTablaHead = '<b><h5>Ranking Trim 2</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                dibujaTablaHead = '<b><h5>TRIM MOV 08/22</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                $.each(ProdTrim2, function (k, v) {
                    posicion = posicion + 1;
                    dibujaTablaBody += '<tr><td class="text-left">' + posicion + '</td><td class="text-left">' + v.Mercado + '</td><td class="text-left">' + v.prod + '</td></tr>';
                });
                $("#tblTrim2").html("" + dibujaTablaHead + dibujaTablaBody + dibujaTablaFooter).val();
            } else {
                $("#tblTrim2").html("<h4>Sin Ranking</h4>").val();
            }

            if (ProdTrim1) {
                dibujaTablaHead = '';
                dibujaTablaBody = '';
                posicion = 0
                dibujaTablaHead = '<b><h5>TRIM MOV 05/22</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                $.each(ProdTrim1, function (k, v) {
                    posicion = posicion + 1;
                    dibujaTablaBody += '<tr><td class="text-left">' + posicion + '</td><td class="text-left">' + v.Mercado + '</td><td class="text-left">' + v.prod + '</td></tr>';
                });
                $("#tblTrim1").html("" + dibujaTablaHead + dibujaTablaBody + dibujaTablaFooter).val();
            } else {
                $("#tblTrim1").html("<h4>No cuenta</h4>").val();
            }

        }
        function AutorizaPanel(id,estatus,tipo,nombre,color) {
            var icon= '';
            if(tipo == "Aprobar"){
               icon= '<i class="fa fa-check fa-7x success"></i>';
            }else{
                icon= '<i class="fa fa-times fa-7x danger"></i>';
            }
            swal({
                title: icon+'<br>¿Deseas '+tipo+' la cuenta <b class="'+color+'">' + nombre + '</b>?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si!',
                cancelButtonText: 'No',
            }).then(function (isConfirm) {
                if (isConfirm) {
                    url = '/pointex/visita_medica/paneles/apr_autoriza/' + id +'/' + estatus +'/' + tipo;
                    redirect()
                }
            });
        }
        function redirect() {
            location.href = url;
        }
    </script>
@endsection
