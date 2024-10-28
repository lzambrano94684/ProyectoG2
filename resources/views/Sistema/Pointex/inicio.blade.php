@extends('Sistema.Pointex.LayOuts.layout')
@section('content')
    <div class="content-wrapper">
        <div class="card card-coming-soon box-shadow-0 border-0">
            <div class="card-header text-center">
                <h4 class="card-title text-dark">
                    BIENVENIDO
                </h4>
            </div>
            <br>
            <div class="card-content text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <img alt="avtar" class="img-fluid img-cs mb-2"
                             src="{{url("Sistema/Pointex/Modulo/img/Logo_visita.png")}}" width="350">
                    </div>
                </div>
                <small>Visita Médica</small>
            </div>
        </div>
    </div>

@stop

@section('js')
    {{--{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/prism.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jquery.matchHeight-min.js') !!}--}}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jquery.countdown.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/coming-soon.js') !!}
    <script type="text/javascript">
        $(".btnLlamar").on("click", function () {
            setTimeout(function () {   //calls click event after a certain time
                cargando(0);
            }, 100);

        });
    </script>
@stop
