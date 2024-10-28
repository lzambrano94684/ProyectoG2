<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="horz-layout-basic">Producto Registrado</h4>
                <p class="mb-0">Para registrar un producto de SAP por favor llene el siguiente formulario.</p>
            </div>
            <div class="card-content">
                <div class="px-3">
                    <form class="form form-horizontal" method="post" action="/pointex/gestion/regulatorio/enlazar" id="frmInsertEnlzace" novalidate="novalidate">
                        @csrf
                        <div class="form-body">
                            <h4 class="form-section"><i class="ft-file-text"></i> Requerimientos</h4>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="CodigoSap">Producto Sap: </label>
                                <div class="col-md-9">
                                    {!! $cmbProducto !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="DescripcionSap">Producto Regulatorio: </label>
                                <div class="col-md-9">
                                    {!! $cmbRegistroSanitario !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-raised btn-primary" id="btnInserta">
                                <i class="ft-save"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>