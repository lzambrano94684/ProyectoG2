<section class="basic-select">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Filtro de Búsqueda</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" id="frmBuscar">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <fieldset class="form-group">
                                            <label for="mes">Mes</label>
                                            <input type="number" min="1" max="12" class="form-control" name="mes"
                                                   placeholder="Mes" value="{{ $mes }}" id="mes">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <fieldset class="form-group">
                                            <label for="txtAnio">Año</label>
                                            <input type="number" class="form-control groupAlmenosUno" id="txtAnio"
                                                   name="txtAnio"
                                                   placeholder="Año del documento" value="{{ $anio }}"
                                                   min="2017" max="{{ date("Y") }}">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <fieldset class="form-group">
                                            <label for="cmbPais">País</label>
                                            {!! $cmbPaises !!}
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <fieldset class="form-group">
                                            <label for="cmbEntidad">Cleinte</label>
                                            {!! $cmbEntidad !!}
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <fieldset class="form-group">
                                            <label for="cmbProducto">Producto</label>
                                            {!! $cmbProducto !!}
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-2 col-lg-3 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="countrySelect">&nbsp;</label>
                                            <button class="form-control text-white btn btn-success" id="btnBuscar">
                                                Buscar
                                            </button>
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="countrySelect">&nbsp;</label>
                                            <a class="form-control text-white btn btn-danger"
                                               href="{{ request()->url()  }}">
                                                Limpiar
                                            </a>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>