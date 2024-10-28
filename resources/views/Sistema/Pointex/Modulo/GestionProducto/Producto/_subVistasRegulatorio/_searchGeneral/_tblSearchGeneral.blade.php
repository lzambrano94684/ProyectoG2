@php($controllerRegulatorio =  new \App\Http\Controllers\Sistema\Pointex\Modulo\GestionProducto\RegulatorioController())
<section id="shopping-cart">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Resultado de la Búsqueda</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                                   href="#tab1" aria-expanded="true">
                                    Registro de Marca
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2"
                                   aria-expanded="false">
                                    Registro Sanitario
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content px-1 pt-1">
                            <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true"
                                 aria-labelledby="base-tab1">
                                @if($modelRegMarca->count()>0)
                                @foreach($modelRegMarca as $krm=> $vrm)
                                        <strong>Registro  {{ $krm+1 }}</strong>
                                        <hr>
                                        {!! $controllerRegulatorio->frmRegistroMarca($request, $vrm->Id, false) !!}
                                    @endforeach
                                @else
                                    <div class="alert alert-warning alert-dismissible fade show"
                                         role="alert" id="tableUsers">
                                        <div class="text"><i class="fa fa-database"></i> La consulta no gener&oacute;
                                            resultados.
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true" class="la la-close"></span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                                @if($modelRegSanitario->count()>0)
                                    @foreach($modelRegSanitario as $kvrs=>$vrs)
                                        <strong>Registro  {{ $kvrs+1 }}</strong>
                                        <hr>
                                        {!! $controllerRegulatorio->frmRegistroSanitario($request, $vrs->Id, false,true) !!}
                                    @endforeach
                                @else
                                    <div class="alert alert-warning alert-dismissible fade show"
                                         role="alert" id="tableUsers">
                                        <div class="text"><i class="fa fa-database"></i> La consulta no gener&oacute;
                                            resultados.
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true" class="la la-close"></span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>