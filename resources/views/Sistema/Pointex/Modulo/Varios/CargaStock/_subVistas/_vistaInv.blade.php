<section class="basic-elements">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            <button type="button"
                                    class="btn btn-raised btn-primary round btn-min-width mr-1 mb-1 pull-right"
                                    id="subirInv">
                                <i class="ft-upload"></i> Cargar
                            </button>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="card-content">
                    <div class="px-3">
                        <div class="row">

                            @include("Sistema.Pointex.Modulo.Varios.CargaStock._subVistas._subVistaInventario._frmCarga")
                            @include("Sistema.Pointex.Modulo.Varios.CargaStock._subVistas._subVistaInventario._tbl")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

