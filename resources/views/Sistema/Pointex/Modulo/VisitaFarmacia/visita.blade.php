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
    {!! $vista !!}
@stop
@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}

    <script type="text/javascript">
        $(".select2_single").select2({
            width: '100%',
            placeholder: "Seleccione Opción",
            allowClear: true
        });


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
    </script>

@endsection

