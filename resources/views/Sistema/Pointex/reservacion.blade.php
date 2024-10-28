@extends('Sistema.Pointex.LayOuts.layout')
@section('content')
    <iframe src="https://exeltisrooms.skedda.com/booking" name="myIFrame" style="border: solid #000000; width: 100%; height: 800px"></iframe>

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
