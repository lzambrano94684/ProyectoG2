@php
    $urlPrincipal = "/pointex/gestion/regulatorio/crear_listar?";
    $urlModificarMarca = $urlPrincipal.base64_encode("actualiza_marca=1&actualiza_marca_lista=1");
    $urlCrudRegistroMarca =  $urlPrincipal.base64_encode("registroMarca=1");
    $urlCrudRegistroSanitario =  $urlPrincipal.base64_encode("registroSanitario=1");
    $urlBusqueda =  $urlPrincipal.base64_encode("search=2");
@endphp
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card" style="min-height: 324.475px;">

            <div class="card-content">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ !$request->reporte ? 'active' : null }}" id="base-tab1" aria-controls="tab1"
                               href="/pointex/gestion/regulatorio/crear_listar" aria-expanded="true">
                                Ingreso
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $request->reporte ? 'active' : null }}" id="base-tab2" aria-controls="tab2"
                               href="/pointex/gestion/regulatorio/crear_listar?reporte=1" aria-expanded="false">
                                Por vencer
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content px-1 pt-1">
                        <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
                            <section id="hover-effects" class="card">
                                <div class="card-content">
                                    <div class="card-body my-gallery" itemscope="" itemtype="http://schema.org/ImageGallery">
                                        <div class="grid-hover">

                                            <div class="row">
                                                <div class="col-md-4 col-sm-12" onclick="window.location.href='{{ $urlCrudRegistroMarca }}'">
                                                    <figure class="effect-layla mostarImagen"
                                                            url="">
                                                        <center style="margin-top: 75px; margin-bottom: 75px">
                                                            <i class="fas fa-registered fa-10x"></i>
                                                        </center>
                                                        <figcaption>
                                                            <h2>Marca</h2>
                                                            <p>Registro de Marca - Propiedad Intelectual</p>
                                                        </figcaption>
                                                    </figure>
                                                </div>

                                                <div class="col-md-4 col-sm-12" onclick="window.location.href='{{ $urlCrudRegistroSanitario }}'">
                                                    <figure class="effect-layla mostarImagen"
                                                            url="">
                                                        <center style="margin-top: 75px; margin-bottom: 75px">
                                                            <i class="fas fa-file-medical fa-10x"></i>
                                                        </center>
                                                        <figcaption>
                                                            <h2>Registro Sanitario</h2>
                                                            <p>Control de Registro Sanitario</p>
                                                        </figcaption>
                                                    </figure>
                                                </div>

                                                <div class="col-md-4 col-sm-12" onclick="window.location.href='{{ $urlBusqueda }}'">
                                                    <figure class="effect-layla mostarImagen"
                                                            url="">
                                                        <center style="margin-top: 75px; margin-bottom: 75px">
                                                            <i class="fas fa-american-sign-language-interpreting fa-10x"></i>
                                                        </center>
                                                        <figcaption>
                                                            <h2>SAP</h2>
                                                            <p>Registrar Productos SAP</p>
                                                        </figcaption>
                                                    </figure>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
