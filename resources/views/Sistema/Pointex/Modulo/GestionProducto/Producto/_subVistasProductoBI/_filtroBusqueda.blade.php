<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">{{ $titleMsg }}</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Filtros de Búsqueda</h4>
                </div>
                <div class="card-content">
                    <div class="px-3">
                        <form class="form" id="frmFiltro">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset class="form-group">
                                            <label for="cmbMarca">Seleccione Marca</label>
                                            {!! $cmbMarca !!}
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