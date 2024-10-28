<a href="/pointex/bi/ventas/transitos" class="btn btn-flat btn-warning">
    <i class="fas fa-long-arrow-alt-left"></i> Regresar
</a>
<section class="basic-select">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-content">
                    <div class="px-3">
                        <form class="form form-horizontal" method="post" action="/pointex/bi/ventas/guarda_factura" id="frmFac" name="frmFac">
                            @csrf
                            <input type="hidden" id="IdFactura" name="IdFactura" value="{{ $id }}">
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-file-text"></i> Datos de la factura en Transito
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="cmbFac">Factura: </label>
                                    <div class="col-md-9">
                                        {!! $cmbFac !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="txtPaisF">País: </label>
                                    <div class="col-md-9">
                                        <input name="IdPaisDespacho" id="txtIdPaisF" type="text"
                                               class="form-control" value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="txtCleinteF">Cliente: </label>
                                    <div class="col-md-9">
                                        <input name="NPedidoCliente" id="txtCleinteF" type="text"
                                               class="form-control" value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="txtFechaF">Fecha de Factura: </label>
                                    <div class="col-md-9">
                                        <input name="txtFechaF" id="txtFechaF" type="text"
                                               class="form-control" value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="FechaDespacho">Fecha de
                                        Despacho: </label>
                                    <div class="col-md-9">
                                        <input name="FechaDespacho" id="FechaDespacho" type="date" class="form-control"
                                               maxlength=""
                                               value="{!!$modelEncabezado ? $modelEncabezado->FechaDespacho: null !!}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control"
                                           for="FechaIngresoBodega">Fecha de Ingreso a Bodega: </label>
                                    <div class="col-md-9">
                                        <input name="FechaIngresoBodega" id="FechaIngresoBodega" type="date"
                                               class="form-control" maxlength="" min=""
                                               value="{!! $modelEncabezado ?$modelEncabezado->FechaIngresoBodega: null !!}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control"
                                           for="FechaIngresoSistema">Fecha de Ingreso a Sistema: </label>
                                    <div class="col-md-9">
                                        <input name="FechaIngresoSistema" id="FechaIngresoSistema" type="date"
                                               class="form-control" maxlength=""
                                               value="{!! $modelEncabezado ?$modelEncabezado->FechaIngresoSistema: null !!}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-content">
                    <div class="px-3">
                        <form class="form form-horizontal" method="post"
                              action="/pointex/bi/ventas/guarda_transito" id="frmInsert"
                              novalidate="novalidate">
                            @csrf
                            <input type="hidden" id="Id" name="Id" value="{{ $id }}">
                            <input type="hidden" id="IdFact" name="IdFact" value="">
                            <input name="txtIdPais" id="txtIdPais" type="hidden" class="form-control" value="">
                            <input name="txtCleinte" id="txtCleinte" type="hidden" class="form-control" value="">
                            <input name="txtFecha" id="txtFecha" type="hidden" class="form-control" value="">

                            <div class="form-body">
                                    <h4 class="form-section"><i class="ft-file-text"></i> Datos de la factura en Transito, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Sigue en Transito {{ $modelEncabezado ? $modelEncabezado->Transito == 1 ? "SI" : "NO"  : null}} <input type="checkbox" name="switchery" id="switchery0" class="switchery" {{ $modelEncabezado ? $modelEncabezado->Transito == 1 ? "checked" : ""  : null}}/>
                                    </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="cmbPaisDespacho">Pais de
                                        Despacho: </label>
                                    <div class="col-md-9">
                                        {!! $cmbPaisDespacho !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="NPedidoCliente">No. de Pedido: </label>
                                    <div class="col-md-9">
                                        <input name="NPedidoCliente" id="NPedidoCliente" type="text"
                                               class="form-control" maxlength="50"
                                               value="{{$modelTransito ? $modelTransito->NPedidoCliente : null}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="Comentarios">Comentarios: </label>
                                    <div class="col-md-9">
                                        <textarea name="Comentarios" id="Comentarios" class="form-control"
                                                  rows="2">{!! $modelTransito ?trim($modelTransito->Comentarios): null !!}</textarea>
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
</section>
