<fieldset>
    <b class="danger">1</b>
    <div class="row">
        <div class="col-md-6 groupForma">
            <div class="form-group">
                <label for="cmbFormaFarmaceutica">Forma Farmacéutica</label>
                <code style="cursor: pointer"
                      class="codeCrearItem"
                      data-toggle="tooltip"
                      title="Si no existe puede agregar uno nuevo"
                      data-placement="top"
                      data-titulo="Crear Nueva Forma Farmacéutica"
                      data-modelo="PX_GP_FormaFarmaceutica"
                      data-campo="Nombre"
                      data-desc="Descripcion"
                      data-id_cmb="cmbFormaFarmaceutica">Agregar Nuevo</code>
                {!! $cmbFormaFarmaceutica !!}
            </div>
        </div>

        <div class="col-md-6 groupFormaTipo">
            <div class="form-group">
                <label for="cmbTipoFormaFarmaceutica">Concentración</label>
                <code style="cursor: pointer"
                      class="codeCrearItem"
                      data-toggle="tooltip"
                      title="Si no existe puede agregar uno nuevo"
                      data-placement="top"
                      data-titulo="Crear Nueva Tipo de Forma Farmacéutica"
                      data-modelo="PX_GP_FormaFarmaceuticaTipo"
                      data-campo="Nombre"
                      data-desc="Descripcion"
                      data-id_cmb="cmbTipoFormaFarmaceutica">Agregar Nuevo</code>
                {!! $cmbTipoFormaFarmaceutica !!}
            </div>
        </div>

        <div class="col-md-12 groupGrupoPresenteciones0">
            <div class="form-group">
                <label for="cmbIdProductos0">Elija las presentaciones para esta forma farmacéutica</label>
                <select name="cmbIdProductos[0][]" id="cmbIdProductos0"
                        class="form-control select2_single cmbIdProductos" multiple required>
                </select>
            </div>
        </div>
    </div>
    <div id="addProducto"></div>
    <div class="row">
        <a href="javascript:void(0)"
           class="btn btn-flat btn-success"
           id="agregar"
           data-toggle="tooltip"
           title="Agregar una forma farmacéutica"
           data-placement="top">
            Agregar <i class="ft-plus-circle"></i>
        </a>

        <a href="javascript:void(0)"
           class="btn btn-flat btn-danger"
           id="remover"
           data-toggle="tooltip"
           title="Remover una forma farmacéutica"
           data-placement="top">
            Quitar <i class="ft-minus-circle"></i>
        </a>
    </div>
</fieldset>