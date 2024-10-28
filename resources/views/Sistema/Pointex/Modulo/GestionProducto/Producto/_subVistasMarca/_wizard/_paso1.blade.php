<fieldset>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                @if($request->listar)
                    <label for="txtMarca">Marca</label>
                    <input type="text" class="form-control" id="txtMarca" name="txtMarca">
                @else
                    <label for="cmbMarca">Marca
                        <code style="cursor: pointer"
                              class="codeCrearItem"
                              data-toggle="tooltip"
                              title="Si no existe puede agregar uno nuevo"
                              data-placement="top"
                              data-titulo="Crear Nueva Marca"
                              data-modelo="PX_GP_Marca"
                              data-campo="Nombre"
                              data-desc="Descripcion"
                              data-id_cmb="cmbMarca">Agregar Nuevo</code>
                    </label>
                    {!! $cmbMarca !!}
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cmbPatologia">Patología
                    <code style="cursor: pointer"
                          class="codeCrearItem"
                          data-toggle="tooltip"
                          title="Si no existe puede agregar uno nuevo"
                          data-placement="top"
                          data-titulo="Crear Nueva Patología"
                          data-modelo="PX_GP_Patologia"
                          data-campo="Nombre"
                          data-desc="Descripcion"
                          data-id_cmb="cmbPatologia">Agregar Nuevo</code>
                </label>
                {!! $cmbPatologia !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="cmbGrupoTerapeutico">Grupo Terapéutico
                    <code style="cursor: pointer"
                          class="codeCrearItem"
                          data-toggle="tooltip"
                          title="Si no existe puede agregar uno nuevo"
                          data-placement="top"
                          data-titulo="Crear Nuevo Grupo Terapéutico"
                          data-modelo="PX_GP_GrupoTerapeutico"
                          data-campo="Nombre"
                          data-desc="Descripcion"
                          data-id_cmb="cmbGrupoTerapeutico">Agregar Nuevo</code>
                </label>
                {!! $cmbGrupoTerapeutico !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cmbFranquiciaMarca">Franquicia
                    <code style="cursor: pointer"
                          class="codeCrearItem"
                          data-toggle="tooltip"
                          title="Si no existe puede agregar uno nuevo"
                          data-placement="top"
                          data-titulo="Crear Franquicia"
                          data-modelo="PX_GP_Franquicia"
                          data-placeholder="Ingrese Nombre"
                          data-campo="Nombre"
                          data-desc="Franquicia"
                          data-id_cmb="cmbFranquiciaMarca">Agregar Nuevo</code></label>
                {!! $cmbFranquicia !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cmbPrincipioActivo">Principios Activos
                    <code style="cursor: pointer"
                          class="codeCrearItem"
                          data-toggle="tooltip"
                          title="Si no existe puede agregar uno nuevo"
                          data-placement="top"
                          data-titulo="Crear Principio Activo"
                          data-modelo="PX_GP_PrincipioActivo"
                          data-placeholder="Ingrese Nombre"
                          data-campo="Nombre"
                          data-desc="Descripcion"
                          data-id_cmb="cmbPrincipioActivo">Agregar Nuevo</code></label>
                {!! $cmbPrincipioActivo !!}
            </div>
            <div class="form-group">
                <label for="txtDescripcion">Descripción</label>
                <textarea maxlength="300" name="txtDescripcion" id="txtDescripcion" rows="1"
                          class="form-control">{{ $request->txtDescripcion }}</textarea>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="dropzone dropzone-previews" id="my-awesome-dropzone"></div>
                <input type="hidden" id="dpz-btn-select-files">
                <input type="hidden" id="select-files">
                <input type="hidden" id="bse64ArchivoMarca" name="bse64ArchivoMarca"
                       value="">
            </div>
        </div>
    </div>

</fieldset>