@php
    $urlCrearNueva = "/pointex/gestion/marca/crear_listar?".base64_encode("crear=1");
    $urlVerTodas =  "/pointex/gestion/marca/crear_listar?".base64_encode("listar=1");
    $arrayColores = [
        0=>"primary",
        1=>"info",
        2=>"warning",
        3=>"success",
    ];
@endphp
<section id="content-types">
    <div class="row">
        <div class="col-12 mt-3 mb-1">
            <p class="content-sub-header">Bienvenido a la gestión de marcas por favor elija una de las siguientes
                opciones.</p>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-img">
                        @if(count($archivos)>0)
                            <ol class="carousel-indicators">
                                @foreach($archivos as $k => $va)
                                    @php
                                        $path = $va;
                                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                                    @endphp
                                    @if($ext != "pdf")
                                        <li data-target="#carousel-example-generic" data-slide-to="{{ $k }}"
                                            class=" "></li>
                                    @endif
                                @endforeach
                            </ol>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    @foreach($archivos as $k => $va)
                                        @php
                                            $path = $va;
                                            $ext = pathinfo($path, PATHINFO_EXTENSION);
                                        @endphp
                                        @if($ext != "pdf")
                                            <div class="carousel-item {{ $k == 0 ? 'active' : null }} card-img-top img-fluid">
                                                <center  style="height: 275px;  background: #b1b1b1; padding: 10px 10px 10px 10px">
                                                <img src="{{"/pointex/getArchivo?ruta=$va" }}" class=""
                                                     style="max-width:100%;max-height:100%;" alt="">
                                                </center>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                                <a class="carousel-control-prev" href="#carousel-example-generic" role="button"
                                   data-slide="prev">
                                    <span class="fa fa-angle-left icon-prev" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-example-generic" role="button"
                                   data-slide="next">
                                    <span class="fa fa-angle-right icon-next" aria-hidden="true"></span>
                                    <span class="sr-only">Siguiente</span>
                                </a>
                            </div>
                        @endif
                        <a href="{{ $urlCrearNueva }}" class="btn btn-floating halfway-fab btn-large gradient-blackberry"><i
                                    class="ft-plus"></i></a>
                    </div>
                    <div class="card-body mt-3">
                        <h4 class="card-title">Creación de Nuevo Producto</h4>
                        <p class="card-text">Para iniciar el proceso de creación por favor dar click en el botón
                            Nuevo</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Lista de Marcas Creadas</h4>
                    <p class="card-text">Listado de las creadas, para ver todas las marcas creadas de
                        click
                        <a class="danger" data-toggle="tooltip">Aquí</a></p>
                </div>
                @if($modelMarca->count() > 0)
                    <div class="card-content">
                        <ul class="list-group">
                            @foreach($modelMarca as $kmm => $vmm)
                                <li class="list-group-item titleTooltop"
                                    title="Editar este Producto">
                                    <span class="badge bg-{{$arrayColores[$kmm]}} float-right"> {{ $vmm->producto_count }}</span> {{ $vmm->Nombre }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card-body">
                        <a href="{{ $urlVerTodas }}" class="btn btn-raised gradient-blackberry py-2 px-4 white mr-2">Ver
                            Todo</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

</section>