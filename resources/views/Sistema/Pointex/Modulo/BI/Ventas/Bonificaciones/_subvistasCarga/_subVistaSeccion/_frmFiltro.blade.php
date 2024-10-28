<form action="/pointex/bi/bonificados/save_filtro" method="post" id="frmFiltro">
    @csrf
    <div class="row">
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-warning btn-block" id="btnGuardaBonificados"
                    data-toggle="modal"
                    data-target="#bootstrap">
                <i class="fas fa-save"></i> Guardar Bonificados
            </button>
        </div>
        <div class="col-md-6 text-center">
            <butto type="button" class="btn btn-info mr-1 mb-1">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                        <span class="font-medium-2">Bonificados</span>
                        <h3 class="font-large-2 mt-1">{{ number_format($dataTable->sum("Ctd_facturada"), 2, '.', ',') }}
                            <span class="font-medium-1 text-bold-400">USD</span>
                        </h3>
                    </font>
                </font>
            </butto>
        </div>
    </div>
</form>
