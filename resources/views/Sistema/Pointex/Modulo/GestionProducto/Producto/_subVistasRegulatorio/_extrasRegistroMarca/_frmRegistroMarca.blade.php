@php($IdEstatus =  is_numeric($modelRegistroMarca->IdEstatus) ? (int)$modelRegistroMarca->IdEstatus : null)
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="horz-layout-basic">Registro de Marca</h4>
                <p class="mb-0">
                    @if($request->crear || $request->editar)
                        Por favor llenar los campos solicitados
                    @endif
                </p>
            </div>
            <div class="card-content">
                <div class="px-3">
                    <form class="form form-horizontal" method="post" id="frmIngresoMarca"
                          action="/pointex/gestion/regulatorio/crear_registro_marca">
                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" id="txtIdRegistroMarca" name="txtIdRegistroMarca" value="{{$idRegMarca}}">
                        <div class="form-body">
                            <h4 class="form-section"><i class="far fa-registered"></i>
                                @if($request->crear || $request->editar)
                                    Formulario de Ingreso de Registro de Marca
                                @endif
                            </h4>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="cmbMarca">Marca: </label>
                                <div class="col-md-9">
                                    {!! $cmbMarca !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="cmbEntidades">Titular:<br>
                                    <code style="cursor: pointer"
                                          class="codeCrearItem"
                                          data-toggle="tooltip"
                                          title="Si no existe puede agregar uno nuevo"
                                          data-placement="top"
                                          data-titulo="Crear Nuevo Titular"
                                          data-modelo="PX_SIS_Entidad"
                                          data-campo="Nombre"
                                          data-desc="Descripcion"
                                          data-id_cmb="cmbEntidades">Agregar Nuevo
                                    </code>
                                </label>
                                <div class="col-md-9">
                                    {!! $cmbTitular !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="cmbPaises">País:<br>
                                    <code style="cursor: pointer"
                                          class="codeCrearItem"
                                          data-toggle="tooltip"
                                          title="Si no existe puede agregar uno nuevo"
                                          data-placement="top"
                                          data-titulo="Crear Nuevo Pais"
                                          data-modelo="PX_SIS_Pais"
                                          data-campo="Nombre"
                                          data-desc="Codigo"
                                          data-id_cmb="cmbPaises">Agregar Nuevo
                                    </code>
                                </label>
                                <div class="col-md-9">
                                    {!! $cmbPaises !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="txtRegistro">Registro: </label>
                                <div class="col-md-9">
                                    <input type="text" id="txtRegistro" name="txtRegistro" class="form-control"
                                           value="{{ $modelRegistroMarca->NoRegistro }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="txtFolio">Folio: </label>
                                <div class="col-md-9">
                                    <input type="text" id="txtFolio" name="txtFolio" class="form-control"
                                           value="{{ $modelRegistroMarca->Folio }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="txtLibroTomo">Libro / Tomo: </label>
                                <div class="col-md-9">
                                    <input type="text" id="txtLibroTomo" name="txtLibroTomo" class="form-control"
                                           value="{{ $modelRegistroMarca->Libro_Tomo }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="txtDescripcion">Descripción: </label>
                                <div class="col-md-9">
                                    <textarea id="txtDescripcion" name="txtDescripcion" rows="2"
                                              class="form-control" maxlength="300">{{ trim($modelRegistroMarca->Descripcion) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="cmbRegistroMarcaEstatus">Estatus:<br>
                                    <code style="cursor: pointer"
                                          class="codeCrearItem"
                                          data-toggle="tooltip"
                                          title="Si no existe puede agregar uno nuevo"
                                          data-placement="top"
                                          data-titulo="Crear Nuevo Estatus"
                                          data-modelo="PX_GP_RegistroMarcaEstatus"
                                          data-campo="Nombre"
                                          data-desc="Descripcion"
                                          data-id_cmb="cmbRegistroMarcaEstatus">Agregar Nuevo
                                    </code>
                                </label>
                                <div class="col-md-9">
                                    {!! $cmbRegistroMarcaEstatus !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="txtDescripcion">Archivo: </label>
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
                                <label class="col-md-3 label-control" for="txtFechaVencimiento">Fecha de
                                    Vencimiento: </label>
                                <div class="col-md-9">
                                    <input type="date" id="txtFechaVencimiento" name="txtFechaVencimiento"
                                           value="{{ $modelRegistroMarca->FechaVencimiento }}"
                                           class="form-control" required>
                                </div>
                            </div>
                            <h4 class="form-section">
                                <i class="fas fa-bullhorn text-danger"></i>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;"> Recordar Antes de Vencer</font>
                                </font>
                                <div class="custom-control custom-radio d-inline-block ml-1" >
                                    <input type="radio" id="txtNotificar1" name="txtNotificar" value="{{ $modelRegistroMarca->IdNotificacion ? $modelRegistroMarca->IdNotificacion : 1 }}" class="custom-control-input" onchange="notificar(1)" {{ $modelRegistroMarca->IdNotificacion ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="txtNotificar1" style="vertical-align: baseline !important;">Si</label>
                                </div>
                                <div class="custom-control custom-radio d-inline-block ml-2" >
                                    <input type="radio" id="txtNotificar2" name="txtNotificar" value="0" class="custom-control-input" onchange="notificar(0)" {{ !$modelRegistroMarca->IdNotificacion ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="txtNotificar2" style="vertical-align: baseline !important;">No</label>
                                </div>
                            </h4>
                            <div id="divNotificar">
                                @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasNotificaciones._inputFormInsert")
                            </div>
                        </div>
                        @if($mostrarBtn)
                            <div class="form-actions">
                                <button type="button" class="btn btn-raised btn-warning mr-1" id="btnCancelar">
                                    <i class="ft-x"></i> Cancelar
                                </button>
                                <button type="submit" id="btnRegistroMarca" class="btn btn-raised btn-primary">
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
