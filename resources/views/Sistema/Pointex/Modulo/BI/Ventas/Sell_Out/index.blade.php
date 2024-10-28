@php($layout = $conAcceso ? "layout" : "layoutSL")
@extends('Sistema.Pointex.LayOuts.'.$layout)

@section('title',$titleMsg )

@section("css")
    {!! HTML::style('/Sistema/Pointex/Modulo/Archivos/css/ver.css') !!}
@endsection

@section('content')
    <section id="hover-effects" class="card">
        <div class="card-content">
            <div class="card-body my-gallery" itemscope="" itemtype="http://schema.org/ImageGallery">
                <div class="grid-hover">
                    <h5 class="text-bold-400 text-uppercase">
                        @if(count($request->input()))
                            <button class="btn btn-flat btn-danger" onclick="window.history.back()"><i
                                    class="fas fa-arrow-left"></i> Regresar
                            </button>
                            Archivos Cargados
                        @elseif(count($directorios)>0)
                            Directorios Cargados
                        @endif
                    </h5>
                    <div class="row">
                        @if(count($archivos)>0)
                            @php(ksort($archivos))
                            @foreach($archivos as $vf)
                                @if(
                                "Pointex/Archivos/".$request->directorio."/".collect(explode("/",$vf))->last() == $vf ||
                                ("Pointex/Archivos/".collect(explode("/",$vf))->last() == $vf)
                                )
                                    <div class="col-md-6 col-12">
                                        <figure class="effect-layla mostarImagen"
                                                url="{{ $conAcceso ? "/pointex/getArchivo?ruta=$vf" :"/getArchivo?ruta=$vf" }}">
                                            <center style="margin-top: 75px; margin-bottom: 75px">
                                                <i class="fas fa-file-pdf fa-10x"></i>
                                            </center>
                                            <figcaption>
                                                <h2>{{ trim(collect(explode("/",$vf))->last()) }}
                                                </h2>
                                                <p></p>
                                                <a>Ver</a>
                                            </figcaption>
                                        </figure>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        @if(count($directorios)>0)
                            <?php
                            ksort($directorios);
                            foreach($directorios as $vf){
                            $lastDir = collect(explode("/", $vf))->last();
                            $slash = $request->directorio ? "$request->directorio/$lastDir" : "$lastDir";
                            $urlHref = $conAcceso ? "/pointex/archivos/ver?directorio=$slash" :
                                "/archivos/ver?directorio=$slash";
                            ?>
                            <div class="col-md-6 col-12"
                                 onclick="window.location.href='{{ $urlHref  }}'">
                                <figure class="effect-layla mostarImagen" style="background: #7BA8D5 !important;">
                                    <center style="margin-top: 75px; margin-bottom: 75px">
                                        <i class="far fa-folder-open fa-10x"></i>
                                    </center>
                                    <figcaption>
                                        <h2>{{ $lastDir }}
                                        </h2>
                                        <p></p>
                                        <a>Ver</a>
                                    </figcaption>
                                </figure>
                            </div>
                            <?php }?>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    {!! HTML::script('/Sistema/Pointex/Modulo/Archivos/js/ver.js') !!}
@endsection
