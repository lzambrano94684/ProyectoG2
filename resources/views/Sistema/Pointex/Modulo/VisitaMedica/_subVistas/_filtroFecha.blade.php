<section class="basic-elements">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ $titleMsg }}</h4>
                </div>
                <div class="card-content">
                    <div class="px-3">
                        <div class="form-body">
                            <form type="get" id="buscarFichero">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="txtFiltro">Seleccione Día de Visita</label>
                                        <fieldset>
                                            <div class="input-group">
                                                <input type="date" id="txtFiltro" class="form-control"
                                                       name="txtFiltro"
                                                       value="{{ $fecha }}"
                                                       placeholder="Fecha" required aria-describedby="button-addon2" onchange="buscar('buscarFichero');">
{{--                                                <div class="input-group-append">--}}
{{--                                                    <button class="btn btn-raised btn-primary" type="submit">Buscar--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
