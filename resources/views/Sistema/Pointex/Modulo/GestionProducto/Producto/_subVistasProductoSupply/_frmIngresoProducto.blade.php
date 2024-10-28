<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="horz-layout-basic">Producto SAP</h4>
                <p class="mb-0">Administración de productos activos e inactivos si desea agregar uno nuevo por favor llene los datos del siguiente formulario.</p>
            </div>
            <div class="card-content">
                <div class="px-3">
                    <form class="form form-horizontal" method="post" action="/pointex/gestion/producto/supply" id="frmInsertCodigos">
                        @csrf
                        <input type="hidden" id="Id" name="Id" value="{{ $modelProductoCodigo->Id }}">
                        <div class="form-body">
                            <h4 class="form-section"><i class="ft-file-text"></i> Requerimientos</h4>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="Presentacion">
                                    <code style="cursor: pointer;"
                                          class="codeCrearItem"
                                          data-toggle="tooltip"
                                          data-placement="top"
                                          data-titulo="Agregar Producto"
                                          data-modelo="PX_GP_Producto"
                                          data-campomarca="IdMarca"
                                          data-campopresentacion="Presentacion"
                                          data-campotipopresentacion="TipoPresentacion"
                                          data-campoestado="Estado"
                                          data-camposku="SKU"
                                          data-id_cmb="">
                                        Agregar
                                    </code>
                                    <a href="/pointex/gestion/catalogos/UFhfR1BfUHJvZHVjdG8=" target="_blank">Editar</a>
                                    Presentacion:</label>
                                <div class="col-md-9">
                                    {!! $cmbPresentacion !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="CodigoSap">CodigoSap: </label>
                                <div class="col-md-9">
                                    <input name="CodigoSap" id="CodigoSap" type="text" class="form-control" maxlength="100" value="{{ $modelProductoCodigo->CodigoSap }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="DescripcionSap">DescripcionSap: </label>
                                <div class="col-md-9">
                                    <input name="DescripcionSap" id="DescripcionSap" type="text" class="form-control" maxlength="300" value="{{ $modelProductoCodigo->DescripcionSap }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="Estado">Estado: </label>
                                <div class="col-md-9">
                                    {!! $cmbEstado !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <a type="submit" class="btn btn-raised btn-danger" href="/pointex/gestion/producto/supply">
                                <i class="ft-refresh-ccw"></i> Limpiar
                            </a>
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
