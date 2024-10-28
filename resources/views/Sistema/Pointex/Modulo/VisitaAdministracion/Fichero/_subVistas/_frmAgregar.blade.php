<form class="form form-horizontal" method="post" action="/pointex/visita_medica/paneles/save_doc"
      novalidate="novalidate" id="form">
    <input type="hidden" name="txtIdRep" value="{{ $id }}">
    @csrf
    <div class="form-body">
        <h4 class="form-section"><i class="ft-file-text"></i> Requerimientos</h4>
        <div class="form-group row">
            <label class="col-md-2 label-control">Nombre:</label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" id="txtPrimerNombre" name="txtPrimerNombre" class="form-control"
                               placeholder="Primero" value="">
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="txtSegundoNombre" name="txtSegundoNombre" class="form-control"
                               placeholder="Segundo" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 label-control">Apellido:</label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" id="txtPrimerApellido" name="txtPrimerApellido" class="form-control"
                               placeholder="Primero" value="">
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="txtSegundoApellido" name="txtSegundoApellido" class="form-control"
                               placeholder="Segundo" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 label-control">-</label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-4">
                        <label class="label-control">No. Colegiado:</label>
                        <br>
                         <input type="number" id="txtNoColegiado" name="txtNoColegiado" class="form-control"
                               placeholder="17838"
                               value="">
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Esp:</label>
                        <br>
                        {!! $cmbEspecialidad !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 label-control">-</label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-4">
                        <label class="label-control">Region:</label>
                        <br>
                        {!! $cmbRegion !!}
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Dpto:</label>
                        <br>
                        <input type="text" id="txtDepto" name="txtDepto" class="form-control"
                                       placeholder="Santa Rosa de Lima"
                                       value="">
                    </div>
                    <div class="col-md-3">
                        <label class=" label-control">Loc:</label>
                        <br>
                        {!! $cmbLocalidad !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 label-control">-</label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-4">
                        <label class="label-control">Municipio:</label>
                        <br>
                         <input type="text" id="txtMunicipio" name="txtMunicipio" class="form-control"
                               placeholder="Santa Rosa de Lima" value="">
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Dir:</label>
                        <br>
                         <input type="text" id="txtDireccion" name="txtDireccion" class="form-control"
                                       placeholder="BARRIO EL CENTRO 4A. AV. SUR CASA No.7 SAN MARTIN SANTA ROSA"
                                       value="">
                    </div>
                    <div class="col-md-3">
                        <label class=" label-control">Tipo:</label><br>
                        <select class="select2_single form-control" id="cmbTipoDomicilio"
                                        name="cmbTipoDomicilio">
                                    <option value="">Seleccione</option>
                                    <option value="Consultorio">Consultorio</option>
                                    <option value="Hospital">Hospital</option>
                                </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 label-control">-</label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-4">
                        <label class="label-control">Teléfono:</label>
                        <br>
                        <input type="text" id="txtTelefono" name="txtTelefono" class="form-control"
                               placeholder="71403473"
                               value="">
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Correo:</label>
                        <br>
                        <input type="text" id="txtCorreo" name="txtCorreo" class="form-control"
                               placeholder="mariagarcias@yahoo.com" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 label-control">-</label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-4">
                        <label class="label-control">Frecuencia de Visita:</label>
                        <br>
                        <input type="number" id="txtFrecuencia" name="txtFrecuencia" class="form-control"
                               placeholder="1"
                               value="" required>
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Perfil</label>
                        <br>
                        <select class="select2_single form-control" id="cmbPerfilActitudinal"
                                name="cmbPerfilActitudinal">
                            <option value="">Seleccione</option>
                            <option value="Sociable">Sociable</option>
                            <option value="Independiente">Independiente</option>
                            <option value="Científico">Científico</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 label-control">-</label>
            <div class="col-md-10">
                <label class="label-control">Justificacion para la creacion de la cuenta</label>
                <input type="text" id="txtJustificacion" name="txtJustificacion" class="form-control" placeholder=""
                       value="" required>
            </div>
        </div>
        <div class="form-actions">
            <a type="button" class="btn btn-raised btn-warning mr-1" href="/pointex/visita_medica/paneles/asignar">
                <i class="ft-arrow-left"></i>Regresar
            </a>
            <button class="btn btn-raised btn-primary eventoClickGuardar">
                <i class="ft-save"></i> Guardar
            </button>
        </div>
    </div>
</form>

