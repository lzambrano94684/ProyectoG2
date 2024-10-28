<section id="simple-table">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Listado de Productos Tercerizados</h4>
                    <br>
                    <div class="row">
{{--                        <div id="btnadd" class="col-md-6 text-right">--}}
{{--                            <a href="/pointex/gestion/tercerizados?{{ base64_encode("aprobar=01-$mes-$anio") }}"--}}
{{--                               class="form-control text-white btn btn-primary float-lg-right" title="Agregar nuevo">--}}
{{--                                <i class="far fa-share-square"></i> Enviar a Probar--}}
{{--                            </a>--}}
{{--                        </div>--}}
                        <div id="btnadd" class="col-md-6 text-right">
                            <a href="/pointex/gestion/tercerizados?{{ base64_encode("crear=!") }}"
                               class="form-control text-white btn btn-primary float-lg-right" title="Agregar nuevo">
                                <i class="icon-plus"></i> Agregar
                            </a>
                        </div>
                        <div id="btnadd" class="col-md-6 text-right">
                            <a href="/pointex/gestion/tercerizados?{{ base64_encode("notificar=01-$mes-$anio") }}"
                               class="form-control text-white btn btn-primary float-lg-right" title="Agregar nuevo">
                                <i class="fas fa-envelope-square"></i> Notificar el cierre de productos
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($data->count()>0)
{{--                            <div class="tabbable boxed parentTabs p-4">--}}
{{--                                <ul class="nav nav-tabs">--}}
{{--                                    <li class="active"><a href="#set1" id="psub" class="nav-link">Productos Tercerizados</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="active"><a href="#set2" id="psubd" class="nav-link" onmousemove="datatableViews.draw();">Cambiar Producto</a>--}}
{{--                                    </li>--}}
{{--                                    <li><a href="#set3" class="nav-link">Productos no tercerizados</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <div class="tab-content">--}}
{{--                                    <div class="tab-pane fade active in" id="set1">--}}
{{--                                        @include("Sistema.Pointex.Modulo.GestionProducto.Producto.Tercerizados._subVistasTercerizados._extrasTblTercerizados.Tercerizados.index")--}}
{{--                                    </div>--}}
{{--                                    <div class="tab-pane fade" id="set2">--}}
{{--                                        @include("Sistema.Pointex.Modulo.GestionProducto.Producto.Tercerizados._subVistasTercerizados._extrasTblTercerizados.CambiarTercerizado.index")--}}
{{--                                    </div>--}}
{{--                                    <div class="tab-pane fade" id="set3">--}}
{{--                                        @include("Sistema.Pointex.Modulo.GestionProducto.Producto.Tercerizados._subVistasTercerizados._extrasTblTercerizados.NoTercerizados.index")--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="tabbable boxed parentTabs p-4">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#set1" id="psub" class="nav-link">Productos Tercerizados</a>
                                    </li>
                                    <li class="active"><a href="#set2" id="psubd" class="nav-link" onmousemove="datatableViews.draw();">Productos no tercerizados</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="set1">
                                        @include("Sistema.Pointex.Modulo.GestionProducto.Producto.Tercerizados._subVistasTercerizados._extrasTblTercerizados.CambiarTercerizado._tblCambiar")
                                    </div>
                                    <div class="tab-pane fade" id="set2">
                                        @include("Sistema.Pointex.Modulo.GestionProducto.Producto.Tercerizados._subVistasTercerizados._extrasTblTercerizados.NoTercerizados._tblCreados")
                                    </div>
                                </div>
                            </div>
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
</section>

