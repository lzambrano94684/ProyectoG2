<section id="shopping-cart">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $subTitle }}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($dataTable && $dataTable->count() > 0)
                            @include("Sistema.Pointex.Modulo.BI.Ventas.Sell_In._subvistasCarga._subVistaSeccion._frmFiltro")
                            @include("Sistema.Pointex.Modulo.BI.Ventas.Sell_In._subvistasCarga._subVistaSeccion._tblResumen")

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
