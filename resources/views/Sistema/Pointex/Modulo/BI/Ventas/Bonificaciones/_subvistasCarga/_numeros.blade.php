<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header text-center pb-0">
                <span class="font-medium-2 primary">Bonificados</span>
                <h3 class="font-large-2 mt-1">{{ number_format($dataTable->sum("Ctd_facturada"), 2, '.', ',') }}
                    <span class="font-medium-1 grey darken-1 text-bold-400">USD</span>
                </h3>
            </div>
        </div>
    </div>
</div>
