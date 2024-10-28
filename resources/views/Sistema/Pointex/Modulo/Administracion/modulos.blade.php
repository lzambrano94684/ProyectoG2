@extends('Sistema.Pointex.LayOuts.layout')
@section('content')


    <div class="content-wrapper">

        <div class="card card-coming-soon box-shadow-0 border-0">
            <div class="card-header text-center">
                <h4 class="card-title text-dark">
                    ESTAMOS POR EMPEZAR....!
                </h4>
            </div>
            <br>
            <div class="card-content text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <img alt="avtar" class="img-fluid img-cs mb-2"
                             src="{{url("Sistema/Pointex/Modulo/img/Logo.png")}}" width="100">
                    </div>

                    <div class="col-lg-8">
                        <div id="clockFlat" class="getting-started pt-1 mt-2" style="margin-left: 20%;">
                            <div class="px-3 py-3 mr-3 mb-3 d-inline-block"><span>60</span> <br>
                                <p class="lead mt-2 mb-0 text-dark"> Días </p>
                            </div>
                            <div class="px-3 py-3 mr-3 mb-3 d-inline-block"><span>00</span> <br>
                                <p class="lead mt-2 mb-0 text-dark"> Horas </p>
                            </div>
                            <div class="px-3 py-3 mr-3 mb-3 d-inline-block"><span>00</span> <br>
                                <p class="lead mt-2 mb-0 text-dark"> Minutos </p>
                            </div>
                            <div class="px-2 py-3 mr-3 mb-3 d-inline-block"><span>00</span> <br>
                                <p class="lead mt-2 mb-0 text-dark"> Segundos </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {{--{!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/prism.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jquery.matchHeight-min.js') !!}--}}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jquery.countdown.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/coming-soon.js') !!}
@stop