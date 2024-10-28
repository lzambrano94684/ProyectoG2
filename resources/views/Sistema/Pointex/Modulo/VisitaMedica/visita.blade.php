@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
    <style>
    .ocultar{
        display: none;
    }

    .mostrar {
        display: inline; /* Cambia el valor de "display" según sea necesario, como "inline" o "block" */
    }
    </style>
@endsection

@section('content')
    <div class="mb-12">
        <a href="javascript:void(0)"  class="btn btn-raised gradient-purple-bliss white shadow-z-1-hover btn-block">
            <h2 style="animation: scroll-right 10s linear infinite">{{ $mensajeInfo }}</h2>
        </a>
    </div>
    {!! $vista !!}
@stop
@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}

    <script type="text/javascript">
        var idvisita = $("#txtIdVisita").val();
        console.log(idvisita)
        if (idvisita == 0)
        {
            $(".select2_single").select2({
                width: '100%',
                placeholder: "Seleccione Opción",
                allowClear: true
            });
            $.getJSON("https://ipgeolocation.abstractapi.com/v1?api_key=1e4d8050db084065ba719fc9975ed081", function(data) {
                $("#txtLatitud").val(data.latitude);
                $("#txtLongitud").val(data.longitude);
            })
        }

        function Confirmar(id,status,campo){
            var datos = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id,
                estado: status,
                campo: campo
            };
            console.log(datos);
            $.post("/pointex/visita_medica/visita/update_status", datos, function (res) {
                console.log(res);
                if (res== "OK") {
                    cargando(2);
                    swal(
                        'Visita!',
                        'Actualizada correctamente!!',
                        'success'
                    ).then(function (isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });
                } else {
                    cargando(2);
                    swal(
                        'Error!',
                        res.DESCRIPCION,
                        'error'
                    ).then(function (isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });


                }
            });
        }

        function Update(id){
            var datos = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id,
                horaInicio: $("#HoraInicio"+id).val(),
                Horafin: $("#HoraFin"+id).val(),
            };
            console.log(datos);
            $.post("/pointex/visita_medica/update_planificacion", datos, function (res) {
                if (res== "OK") {
                    cargando(2);
                    swal(
                        'Planificacion!',
                        'Actualizada correctamente!!',
                        'success'
                    ).then(function (isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });
                } else {
                    cargando(2);
                    swal(
                        'Error!',
                        res.DESCRIPCION,
                        'error'
                    ).then(function (isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });


                }
            });
        }

        function enviaMuestra (id){
            var cantidad = $("#"+id).val();
            if (cantidad < 0 ){
                $("#"+id).val(0);
            }
            var idVisita  = $("#txtIdVisita").val();
            var data = {
                _token : '{{ csrf_token() }}'
                , txtIdVisita : idVisita
                , cmbMM : id.replace("-txtCantidadMM", "")
                , txtCantidad : cantidad
            };
            cargando(1)
            $.post("/pointex/visita_medica/visita/guarda_mm", data, function (){
                cargando(0)
            });
        }
        function cambiaMuestra (tipo, id){
            var campo = $("#"+id);
            var actual = parseInt(campo.val());
            var nuevo = tipo == 1 ? actual+1 : actual-1;
            campo.val(nuevo < 0 ? 0 : nuevo);
            campo.trigger("change");
        }

        function cambiaPromocion (id, promociono){
            var cantidad = $("#"+id).val();

            var idVisita  = $("#txtIdVisita").val();
            var data = {
                _token : '{{ csrf_token() }}'
                , txtIdVisita : idVisita
                , cmbtxtDescripcion : id.replace("-txtPromociones", "")
                , txtPromociono : promociono
            };

            cargando(1)
            $.post("/pointex/visita_medica/visita/guarda_promo", data, function (){
                cargando(0)
            });
        }
        function buscar(frm){
            $("#"+frm).submit();
        }
    </script>


    @yield('jsExtras')
@endsection

