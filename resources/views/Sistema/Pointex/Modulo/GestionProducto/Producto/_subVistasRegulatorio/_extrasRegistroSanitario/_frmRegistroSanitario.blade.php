<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="horz-layout-basic">Registro Sanitario</h4>
                <p class="mb-0">
                    @if($request->crear || $request->editar)
                        Por favor llenar los campos solicitados
                    @endif
                </p>
            </div>
            <div class="card-content">
                <div class="px-3">
                    <form class="form form-horizontal" method="post" id="frmIngresoSanitario"
                          action="/pointex/gestion/regulatorio/crear_registro_sanitario">
                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" id="txtIdRegistroSanitario" name="txtIdRegistroSanitario" value="{{$idRegSanitario}}">
                        <div class="form-body">
                            <h4 class="form-section"><i class="ft-share-2"></i>
                                @if($request->crear || $request->editar)
                                    Formulario de Ingreso de Registro Sanitario
                                @endif
                            </h4>

                            <div class="{{ $request->ver ? 'row' : null}}">
                                <div class="{{ $request->ver ? 'col-md-6' : null}} ">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtNombreProducto">Nombre del
                                            Producto: </label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtNombreProducto" name="txtNombreProducto"
                                                   class="form-control"
                                                   value="{{ $modelRegistroSanitario->Nombre }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbPaises">País de Comercialización:</label>
                                        <div class="col-md-9">
                                            {!! $cmbPaises !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtRegistro">Registro Sanitario: </label>
                                        <div class="col-md-9">
                                            <input type="text" id="txtRegistro" name="txtRegistro" class="form-control"
                                                   value="{{ $modelRegistroSanitario->NoRegistroSanitario }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtFechaVencimiento">Fecha de
                                            Vencimiento: </label>
                                        <div class="col-md-9">
                                            <input type="date" id="txtFechaVencimiento" name="txtFechaVencimiento"
                                                   value="{{ $modelRegistroSanitario->FechaVencimiento }}"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbRegistroSanitarioEstatus">Estatus:<br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  title="Si no existe puede agregar uno nuevo"
                                                  data-placement="top"
                                                  data-titulo="Crear Nuevo Estatus"
                                                  data-modelo="PX_GP_RegistroSanitarioEstatus"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbRegistroSanitarioEstatus">Agregar Nuevo
                                            </code>
                                            <a href="/pointex/gestion/regulatorio/edit_estatus" target="_blank">Editar</a>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbRegistroSanitarioEstatus !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtEstimacionObtencion">Estimado Obtención: </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="number" id="txtEstimacionObtencion" name="txtEstimacionObtencion"
                                                       onkeypress="return isNumber(event)"
                                                       class="form-control"
                                                       value="{{ $modelRegistroSanitario->EstimadoObtencion }}" min="0">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Meses</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbPrincipioActivo">Principios Activos:<br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  title="Si no existe puede agregar uno nuevo"
                                                  data-placement="top"
                                                  data-titulo="Crear Nuevo Principio Activo"
                                                  data-modelo="PX_GP_PrincipioActivo"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbPrincipioActivo">Agregar Nuevo
                                            </code>
                                            <a href="/pointex/gestion/regulatorio/edit_principio_a" target="_blank">Editar</a>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbPrincipioActivo !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbFormaFarmaceutica">Forma Farmacéutica:<br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  title="Si no existe puede agregar uno nuevo"
                                                  data-placement="top"
                                                  data-titulo="Crear Nuevo Forma Farmacéutica"
                                                  data-modelo="PX_GP_FormaFarmaceutica"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbFormaFarmaceutica">Agregar Nuevo
                                            </code>
                                            <a href="/pointex/gestion/regulatorio/edit_farmaceutica" target="_blank">Editar</a>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbFormaFarmaceutica !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbTipoFormaFarmaceutica">Concentración:<br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  title="Si no existe puede agregar uno nuevo"
                                                  data-placement="top"
                                                  data-titulo="Crear Nuevo Concentración"
                                                  data-modelo="PX_GP_FormaFarmaceuticaTipo"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbTipoFormaFarmaceutica">Agregar Nuevo
                                            </code>
                                            <a href="/pointex/gestion/regulatorio/edit_concentracion" target="_blank">Editar</a>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbFormaFarmaceuticaTipo !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbViaAdministracion">Vía administración:<br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  title="Si no existe puede agregar uno nuevo"
                                                  data-placement="top"
                                                  data-titulo="Crear Nuevo Vía administración"
                                                  data-modelo="PX_GP_ViaAdministracion"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbViaAdministracion">Agregar Nuevo
                                            </code>
                                            <a href="/pointex/gestion/regulatorio/edit_via_administracion" target="_blank">Editar</a>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbViaAdministracion !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbPresentacion">Presentaciones Registradas:<br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  title="Si no existe puede agregar uno nuevo"
                                                  data-placement="top"
                                                  data-titulo="Crear Nueva Presentación"
                                                  data-modelo="PX_GP_PresentacionRegulatorio"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbPresentacion">Agregar Nuevo
                                            </code>
                                            <a href="/pointex/gestion/regulatorio/edit_presentacion" target="_blank">Editar</a>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbPresentacion !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbModalidadVenta">Modalidad de Venta:<br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  title="Si no existe puede agregar uno nuevo"
                                                  data-placement="top"
                                                  data-titulo="Crear Nueva Modalidad de Venta"
                                                  data-modelo="PX_GP_ProductoModalidadVenta"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbModalidadVenta">Agregar Nuevo
                                            </code>
                                            <a href="/pointex/gestion/regulatorio/edit_modalidad_venta" target="_blank">Editar</a>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbModalidadVenta !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtVidaUtil">Vida Útil: </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="number" id="txtVidaUtil" name="txtVidaUtil"
                                                       onkeypress="return isNumber(event)" class="form-control"
                                                       value="{{ $modelRegistroSanitario->VidaUtil }}" min="0">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Meses</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbTipoGrupoTerapeutico">Grupo
                                            Terapéutico:<br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  title="Si no existe puede agregar uno nuevo"
                                                  data-placement="top"
                                                  data-titulo="Crear Nuevo Grupo Terapéutico"
                                                  data-modelo="PX_GP_GrupoTerapeutico"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbGrupoTerapeutico">Agregar Nuevo
                                            </code>
                                            <a href="/pointex/gestion/regulatorio/edit_terapeutico" target="_blank">Editar</a>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbGrupoTerapeutico !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbFabricante">Fabricante:
                                            <br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  data-placement="top"
                                                  data-modelo="PX_GP_RegulatorioEntidad"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbFabricante">
                                                <a href="/pointex/gestion/regulatorio/edit_fabricante" target="_blank">Editar</a>
                                            </code>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbFabricante !!}
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbPaisFabricante">País Fabricante:</label>
                                        <div class="col-md-9">
                                            {!! $cmbPaisFabricante !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbAcondicionador">Acondicionador:
                                            <br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  data-placement="top"
                                                  data-modelo="PX_GP_RegulatorioEntidad"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbFabricante">
                                                <a href="/pointex/gestion/regulatorio/edit_fabricante" target="_blank">Editar</a>
                                            </code>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbAcondicionador !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbPaisAcondicionador">País
                                            Acondicionador:</label>
                                        <div class="col-md-9">
                                            {!! $cmbPaisAcondicionador !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbTitular">Titular:
                                            <br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  data-placement="top"
                                                  data-modelo="PX_GP_RegulatorioEntidad"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbFabricante">
                                                <a href="/pointex/gestion/regulatorio/edit_fabricante" target="_blank">Editar</a>
                                            </code>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbTitular !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbPaisTitular">País Titular:</label>
                                        <div class="col-md-9">
                                            {!! $cmbPaisTitular !!}
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbRepresentante">Representante en el país de Comercialización:
                                            <br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  data-placement="top"
                                                  data-modelo="PX_GP_RegulatorioEntidad"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbFabricante">
                                                <a href="/pointex/gestion/regulatorio/edit_fabricante" target="_blank">Editar</a>
                                            </code>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbRepresentante !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="cmbDistribuidores">Distribuidores Autorizados:<br>
                                            <code style="cursor: pointer"
                                                  class="codeCrearItem"
                                                  data-toggle="tooltip"
                                                  title="Si no existe puede agregar uno nuevo"
                                                  data-placement="top"
                                                  data-titulo="Crear Nuevo Distribuidor"
                                                  data-modelo="PX_GP_RegulatorioEntidad"
                                                  data-campo="Nombre"
                                                  data-desc="Descripcion"
                                                  data-id_cmb="cmbFabricante">Agregar Nuevo
                                                <a href="/pointex/gestion/regulatorio/edit_fabricante" target="_blank">Editar</a>
                                            </code>
                                        </label>
                                        <div class="col-md-9">
                                            {!! $cmbDistribuidores !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtLibroTomo">¿En trámite control estatal?: </label>
                                        <div class="custom-control custom-checkbox m-0">
                                            <input type="radio" name="IsTramiteControlEstatal" value="1" onclick="actionControlEstatal(1)"
                                                   class="custom-control-input"
                                                   id="cetSi" {{ $modelRegistroSanitario->TramiteControlEstatal === "1" ?  "checked" : null }} >
                                            <label class="custom-control-label" for="cetSi"><b>Si</b></label>
                                        </div>
                                        <div class="custom-control custom-checkbox m-0">
                                            <input type="radio" onclick="actionControlEstatal(0)"
                                                   name="IsTramiteControlEstatal" value="0"
                                                   class="custom-control-input"
                                                   id="cetNo" {{ $modelRegistroSanitario->TramiteControlEstatal === "0" ?  "checked" : null }}>
                                            <label class="custom-control-label" for="cetNo"><b>No</b></label>
                                        </div>

                                        <div class="custom-control custom-checkbox m-0">
                                            <input type="radio"
                                                   name="IsTramiteControlEstatal"
                                                   class="custom-control-input"
                                                   id="cetNA" {{ $modelRegistroSanitario->TramiteControlEstatal === null
                                           || $modelRegistroSanitario->TramiteControlEstatal === '' ?  "checked" : null }}>
                                            <label class="custom-control-label" for="cetNA"><b>N.A.</b></label>
                                        </div>
                                    </div>

                                    <div class="form-group row groupControlEstatal">
                                        <script>var groupControlEstatal = 0</script>
                                        @if($modelRegistroSanitario->FechaControlEstatal)
                                            <script> groupControlEstatal = 1</script>
                                        @endif
                                        <label class="col-md-3 label-control" for="txtFechaControlEstatal">Fecha de
                                            Control Estatal: </label>
                                        <div class="col-md-9">
                                            <input type="date" id="txtFechaControlEstatal" name="txtFechaControlEstatal"
                                                   value="{{ $modelRegistroSanitario->FechaControlEstatal }}"
                                                   class="form-control" required>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtPermiso">¿Permiso Comercialización?: </label>
                                        <div class="custom-control custom-checkbox m-0">
                                            <input type="radio" name="IsPermisoComercializacion" value="1"
                                                   onclick="actionPermizoCom(1)"
                                                   class="custom-control-input"
                                                   id="pcSi" {{ $modelRegistroSanitario->PermisoComercializacion === "1" ?  "checked" : null }} >
                                            <label class="custom-control-label" for="pcSi"><b>Si</b></label>
                                        </div>
                                        <div class="custom-control custom-checkbox m-0">
                                            <input type="radio"
                                                   onclick="actionPermizoCom(0)"
                                                   name="IsPermisoComercializacion" value="0"
                                                   class="custom-control-input"
                                                   id="pcNo" {{ $modelRegistroSanitario->PermisoComercializacion === "0" ?  "checked" : null }}>
                                            <label class="custom-control-label" for="pcNo"><b>No</b></label>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="groupPermizoCom">
                                        <script>var groupPermizoCom = 0</script>
                                        @if($modelRegistroSanitario->PermisoComercializacion)
                                            <script> groupPermizoCom = 1</script>
                                        @endif
                                        <label class="col-md-3 label-control" for="txtPermisoComercializacion">Justifique: </label>
                                        <div class="col-md-9">
                                    <textarea id="txtPermisoComercializacion" name="txtPermisoComercializacion" rows="2"
                                              class="form-control" maxlength="500" required>{{ trim($modelRegistroSanitario->PermisoComercializacionJust) }}</textarea>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtDescripcion">Certificado de Registro Sanitario: </label>
                                        <div class="col-md-9">
                                            @if($request->crear)
                                                @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasRegulatorio._archivoManagement._subeArchivo")
                                            @elseif($request->editar)
                                                <div class="nav-vertical">
                                                    <ul class="nav nav-tabs nav-left flex-column">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="base-tab1" data-toggle="tab"
                                                               aria-controls="tab1" href="#tab1"
                                                               aria-expanded="true"><i class="far fa-eye"></i> Ver</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="base-tab2" data-toggle="tab"
                                                               aria-controls="tab2"
                                                               href="#tab2" aria-expanded="false"> <i
                                                                        class="fas fa-cloud-upload-alt"></i> Cargar Nuevo</a>
                                                        </li>

                                                    </ul>
                                                    <div class="tab-content px-1 pt-1">
                                                        <div role="tabpanel" class="tab-pane active" id="tab1"
                                                             aria-expanded="true"
                                                             aria-labelledby="base-tab1">
                                                            <p>
                                                                @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasRegulatorio._archivoManagement._verArchivo")
                                                            </p>
                                                        </div>
                                                        <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                                                            <p>
                                                                @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasRegulatorio._archivoManagement._subeArchivo")
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasRegulatorio._archivoManagement._verArchivo")
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtDescripcion">Comentarios: </label>
                                        <div class="col-md-9">
                                    <textarea id="txtDescripcion" name="txtDescripcion" rows="2"
                                              class="form-control" maxlength="300">{{ trim($modelRegistroSanitario->Descripcion) }}</textarea>
                                        </div>
                                    </div>

                                    <h4 class="form-section">
                                        <i class="fas fa-bullhorn text-danger"></i>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"> Recordar Antes de Vencer</font>
                                        </font>
                                        <div class="custom-control custom-radio d-inline-block ml-1">
                                            <input type="radio" id="txtNotificar1" name="txtNotificar"
                                                   value="{{ $modelRegistroSanitario->IdNotificacion ? $modelRegistroSanitario->IdNotificacion : 1 }}"
                                                   class="custom-control-input"
                                                   onchange="notificar(1)" {{ $modelRegistroSanitario->IdNotificacion ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="txtNotificar1"
                                                   style="vertical-align: baseline !important;">Si</label>
                                        </div>
                                        <div class="custom-control custom-radio d-inline-block ml-2">
                                            <input type="radio" id="txtNotificar2" name="txtNotificar" value="0"
                                                   class="custom-control-input"
                                                   onchange="notificar(0)" {{ !$modelRegistroSanitario->IdNotificacion ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="txtNotificar2"
                                                   style="vertical-align: baseline !important;">No</label>
                                        </div>
                                    </h4>
                                    <div id="divNotificar">
                                        @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasNotificaciones._inputFormInsert")
                                    </div>
                                </div>
                            </div>


                        </div>
                        @if($mostrarBtn)
                            <div class="form-actions">
                                <a type="button" class="btn btn-raised btn-warning mr-1" href="{{ url()->previous(  ) }}">
                                    <i class="ft-x"></i> Regresar
                                </a>
                                <button type="submit" id="btnRegistroSanitario" class="btn btn-raised btn-primary">
                                    <i class="fa fa-check-square-o"></i> Guardar
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
