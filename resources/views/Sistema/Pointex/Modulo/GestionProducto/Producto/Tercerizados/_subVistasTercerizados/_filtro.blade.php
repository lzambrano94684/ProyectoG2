<br>
<div class="row">
    <div id="btnadd" class="col-md-6 text-right">
        <a href="/pointex/gestion/tercerizados?{{ base64_encode("crear=!") }}"
           class="form-control text-white btn btn-primary float-lg-right" title="Agregar nuevo">
            <i class="icon-plus"></i> Agregar
        </a>
    </div>
</div>
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
                                    <div class="col-xl-3 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="cmbMeses">Mes</label>
                                            {!! $cmbMeses !!}
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-2 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="txtAnio">Año</label>
                                            <input type="number" class="form-control groupAlmenosUno" id="txtAnio"
                                                   name="txtAnio"
                                                   placeholder="Año" value="{{ $request->txtAnio }}"
                                                   {{--                                                   min="{{ date("Y") }}" --}}
                                                   max="{{ date("Y") }}">
                                        </fieldset>
                                    </div>
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
