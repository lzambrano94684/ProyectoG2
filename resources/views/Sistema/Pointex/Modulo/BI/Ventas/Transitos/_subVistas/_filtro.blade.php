<section class="basic-select">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Filtro de Búsqueda</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" id="frmInsert">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="txtNumDoc">Fecha</label>
                                            <input type="month" class="form-control groupAlmenosUno" id="txtNumDoc"
                                                   name="fechaTxt"
                                                   min="2019-01"
                                                   max="{{ date("Y-m") }}"
                                                   placeholder="Decha de Ingreso al sistema"
                                                   value="{{ $fecha }}" required>
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
                                    <div class="col-xl-2 col-lg-3 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="countrySelect">&nbsp;</label>
                                            <a href="{{ url()->current() }}/documento/{{ base64_encode($fecha) }}"
                                               class="form-control text-white btn btn-primary">
                                                Notificar
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
