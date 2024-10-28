<fieldset>
    <div id="grupoPresentacion0" class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label>Presentación 1</label>
                <input type="text" class="form-control txtPresentacion" id="txtPresentacion0" name="txtPresentacion[0]"
                       maxlength="50" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Tipo Presentación 1</label>
                <div class="custom-control custom-checkbox m-0">
                    <input type="checkbox" class="custom-control-input txtTipoPresentacion" id="txtTipoPresentacion00"
                           name="txtTipoPresentacion[0][]" value="Venta">
                    <label class="custom-control-label primary" for="txtTipoPresentacion00">Venta</label>
                </div>

                <div class="custom-control custom-checkbox m-0">
                    <input type="checkbox" class="custom-control-input txtTipoPresentacion" id="txtTipoPresentacion01"
                           name="txtTipoPresentacion[0][]" value="Muestra Médica">
                    <label class="custom-control-label primary" for="txtTipoPresentacion01">Muestra Médica</label>
                </div>
            </div>
        </div>
    </div>
    <div id="addPresentacion"></div>
    <div class="row">
        <a href="javascript:void(0)"
           class="btn btn-flat btn-success"
           id="agregarPresentacion"
           data-toggle="tooltip"
           title="Agregar una Presentación Extra"
           data-placement="top">
            Agregar <i class="ft-plus-circle"></i>
        </a>

        <a href="javascript:void(0)"
           class="btn btn-flat btn-danger"
           id="removerPresentacion"
           data-toggle="tooltip"
           title="Remover una Presentación"
           data-placement="top">
            Quitar <i class="ft-minus-circle"></i>
        </a>
    </div>
</fieldset>