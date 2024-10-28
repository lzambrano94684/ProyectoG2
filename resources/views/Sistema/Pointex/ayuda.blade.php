@extends('Sistema.Pointex.LayOuts.layout')
@section('content')


    <div class="content-wrapper">

        <div class="card card-coming-soon box-shadow-0 border-0">
            <div class="card-header text-center">
                <h4 class="card-title text-dark">
                    Ayuda del Sistema
                </h4>
            </div>
            <br>
            <div class="card-content text-center">
                <div class="row justify-content-center">
                    <div class="col-10 text-center">
                        <img alt="avtar" class="img-fluid img-cs mb-2"
                             src="{{url("Sistema/Pointex/Modulo/img/Logo.png")}}" width="100">
                    </div>
                    <div class="col-10">
                        <div class="accordion" id="accordion">
                            <div class="card">
                                <div class="card-header" id="heading10">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed white-text" type="button" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="fa fa-book fa-lg white-text"></i> Pointex<small>  Manual de Usuario</small>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion">
                                    <div class="card-body">
                                        Sistema Modular para la gestión interna de nuestra empresa.
                                    </div>
                                    <div class="clearfix"></div>
                                    <iframe id="fred" style="border:1px solid #666CCC" title="Manual de usuario POINTEX" src="{{asset('/Sistema/Pointex/Documentos/Manual Pointex v1.0.pdf')}}#zoom=100" allowfullscreen="allowfullscreen" frameborder="1" scrolling="auto" height="400" width="100%" ></iframe>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop

@section('js')


@stop