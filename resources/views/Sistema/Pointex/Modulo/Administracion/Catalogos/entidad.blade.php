@extends('Sistema.Pointex.LayOuts.layout')

@section("css")
@stop
@section('content')


    <section class="basic-elements">
        <!-- se asígna título a la web -->
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">@if(isset($titleMsg)){{$titleMsg}}@endif</div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">Catálogo de Entidades</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title mb-0">Catálogo de Entidades</h4>

                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <fieldset class="fieldset-marco">
                                <input type="hidden" id="_token" value="{{csrf_token()}}">

                                <legend class="fieldset-marco text-muted">Catálogo de Entidades</legend>
                                <!-- mandar a llamar modal para crear pais -->
                                <button class="btn btn-primary float-lg-right" onclick="addForm('modalEntidad')">Agregar
                                    Entidad <i class="fas fa-folder-plus fa-lg"></i></button>

                                @if(isset($entidades)&& count($entidades)>0)

                                    <div class="table-responsive">
                                    <table id="datatable-entidad" class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer align='left'"
                                           cellspacing="0" style="width: 100%;">
                                        <thead class="thead-dark">
                                        <tr class="headings">
                                            <th class="column-title no-link last"
                                                style="text-align: center"><span
                                                        class="nobr">ACCIONES</span>
                                            </th>

                                            <th class="column-title">NOMBRE</th>
                                            <th class="column-title">DESCRIPCIÓN</th>
                                            <th class="column-title">RAZON SOCIAL</th>
                                            <th class="column-title">REPRESENTANTE</th>
                                            <th class="column-title">PAIS</th>
                                            <th class="column-title">DIRECCIÓN</th>
                                            <th class="column-title">TELÉFONO</th>
                                            <th class="column-title">E-MAIL</th>
                                            <th class="column-title">RELACIÓN</th>
                                            <th class="column-title">FABRICANTE</th>
                                            <th class="column-title">FECHA CREACIÓN</th>
                                            <th class="column-title">ESTADO</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($entidades as $entidad)


                                            <?php $fecha = new \Carbon\Carbon($entidad->FechaCreacion); ?>


                                            <tr class="">
                                                <td class="last" align="center">
                                                    <!-- acciones de los registros -->
                                                    @if($entidad->Estado=="A")
                                                        <a href="JavaScript:Void(0);"   title="Desactivar Entidad"
                                                           data-placement="top"
                                                           onclick="estadoEntidad({{$entidad->Id}})"><i
                                                                    class="fas fa-toggle-on fa-lg"></i></a>
                                                        <a href="JavaScript:Void(0);"   title="Modificar Entidad"
                                                           data-placement="top"
                                                           onclick="showModEntidad('{{ base64_encode(json_encode($entidad))}}')"><i
                                                                    class="fas fa-pencil-alt fa-lg"></i></a>
                                                    @else
                                                        <a href="JavaScript:Void(0);" title="Activar Entidad"
                                                           onclick="estadoEntidad({{$entidad->Id}})"><i
                                                                    class="fas fa-toggle-off fa-lg"></i></a>
                                                    @endif


                                                </td>

                                                <td class=" ">{{$entidad->Nombre}}</td>
                                                <td class=" ">{{$entidad->Descripcion}}</td>
                                                <td class=" ">{{$entidad->RazonSocial}}</td>
                                                <td class=" ">{{$entidad->Representante}}</td>

                                                <td class=" ">{{$entidad->Direccion}}</td>
                                                <td class=" ">{{$entidad->Telefono}}</td>
                                                <td class=" ">{{$entidad->Correo}}</td>



                                            </tr>


                                        @endforeach

                                        </tbody>

                                    </table>


                                @else
                                    <div class="alert alert-warning alert-dismissible fade show"
                                         role="alert" id="tableUsers">

                                        <div class="text"><i class="fa fa-database"></i> La consulta no gener&oacute;
                                            resultados.
                                        </div>

                                    </div>
                                @endif
                            </fieldset>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{--Modal para modificar los datos del tipo de usuario--}}
    <div class="modal fade text-left" id="modalEntidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark white">

                    <h4 class="modal-title text-bold-600" id="myModalLabel16">Modificar/Crear Datos De Entidad </h4>&nbsp;&nbsp;


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-info" for="mod_txtEntidadNombre">Nombre:</label>
                                <input type="text" class="form-control" id="txtEntidadNombre" name="txtEntidadNombre"
                                       placeholder="Nombre" required>
                                <input class="form-control" type="hidden" name="txtIdEntidad" id="txtIdEntidad"
                                       value="">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="custom-control custom-switch text-left">
                                    <label class="text-info">Relación Entidad</label>
                                    <input type="checkbox" class="custom-control-input" id="chkRelacion" value="I" checked>
                                    <label class="custom-control-label" for="chkRelacion">Interna?</label>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="custom-control custom-switch text-left">
                                    <label class="text-info">Entidad Fabricante</label>
                                    <input type="checkbox" class="custom-control-input" id="chkFabricante" value="S" checked>
                                    <label class="custom-control-label" for="chkFabricante">SI?</label>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-info" for="mod_txtEntidadRazonSocial">Razón Social:</label>
                                <input type="text" class="form-control" id="txtEntidadRazonSocial"
                                       name="txtEntidadRazonSocial" placeholder="Razón Social" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-info" for="mod_txtEntidadRepresentante">Representante:</label>
                                <input type="text" class="form-control" id="txtEntidadRepresentante"
                                       name="txtEntidadReprensentante" placeholder="Representante" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-info" for="mod_slcPais">Pais</label>
                                <select class="form-control select2Modal" id="mod_slcPais" name="mod_slcPais">
                                    <option value="">Seleccione</option>
                                    @foreach($paises as $pais)
                                        <option value="{{$pais->Id}}">{{$pais->Nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-info" for="mod_txtEntidadDireccion">Dirección:</label>
                                <input type="text" class="form-control" id="txtEntidadDireccion"
                                       name="txtEntidadRDireccion" placeholder="Direccion" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-info" for="mod_txtEntidadTelefono">Teléfono:</label>
                                <input type="text" size="11" class="form-control" id="txtEntidadTelefono" onkeyup="ValNumero(this)"
                                       name="txtEntidadRTelefono" placeholder="Teléfono" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-info" for="mod_txtEntidadCorreo">Correo Electrónico:</label>
                                <input type="email" class="form-control" id="txtEntidadCorreo" onkeypress="validarEmail(this)" name="txtEntidadCorreo"
                                       placeholder="Correo Electrónico" required>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-info" for="mod_txtEntidadDescripcion">Descripcion:</label>
                                <input type="text" class="form-control" id="txtEntidadLocalidad" name="txtEntidadLocalidad"
                                       placeholder="Descripcion" required>
                            </div>
                        </div>


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="modEntidad();" class="btn btn-outline-primary">Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Vendor/Plantillas/Apex7app-assets/vendors/js/jqBootstrapValidation.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/cat.js') !!}
@stop