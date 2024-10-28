@extends('Sistema.Pointex.LayOuts.layout')

@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/pickadate/pickadate.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/wizard.css') !!}
    {!! HTML::style('/Sistema/Pointex/Modulo/Administracion/css/administracion.css') !!}
@stop
@section('content')

    <section class="basic-elements">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">@if(isset($titleMsg)){{$titleMsg}}@endif</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Filtros de Búsqueda</h4>
                    </div>
                    <div class="card-content">
                        <div class="px-3">
                            <form class="form" method="post" action="{{url("/pointex/administracion/usuarios")}}">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="txtNom">Nombres</label>
                                                <input type="text" class="form-control" value="@if(isset($data->txtNom)){{$data->txtNom}}@endif" id="txtNom" name="txtNom" placeholder="Búsqueda por Nombres">
                                            </fieldset>
                                        </div>

                                        <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="txtMail">Correo</label>
                                                <input type="text" class="form-control" value="@if(isset($data->txtMail)){{$data->txtMail}}@endif" id="txtMail" name="txtMail" placeholder="Búsqueda por Correo">
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="txtUser">Usuario</label>
                                                <input type="text" class="form-control" value="@if(isset($data->txtUser)){{$data->txtUser}}@endif" id="txtUser" name="txtUser" placeholder="Búsqueda por Usuario">
                                            </fieldset>
                                        </div>

                                        <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="slcEnt">Entidad</label>
                                                <select class="form-control select2_single" style="width: 100%;" name="slcEnt" id="slcEnt">
                                                    <option value="">Seleccione</option>
                                                    @foreach($entidad as $ent)
                                                        <option value="{{$ent->Id}}" @if(isset($data->slcEnt) && $data->slcEnt==$ent->Id) selected @endif>{{$ent->Nombre}}</option>
                                                    @endforeach
                                                </select>

                                            </fieldset>
                                        </div>

                                        <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="slcPaises">Pais</label>
                                                <select class="form-control select2_single" style="width: 100%;" name="slcPaises" id="slcPaises">
                                                    <option value="">Seleccione</option>
                                                    @foreach($paises as $pais)
                                                        <option value="{{$pais->Id}}" @if(isset($data->slcPaises) && $data->slcPaises==$pais->Id) selected @endif>{{$pais->Nombre}}</option>
                                                    @endforeach
                                                </select>

                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                            <button type="submit" onclick="cargando(1);" class="btn btn-info"><i class="fa fa-search"></i>  Buscar Usuarios</button>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a href="/pointex/administracion/usuarios?{{ base64_encode("crear=!") }}" class="form-control text-white btn btn-primary float-lg-right" title="Agregar uno nuevo">
                                                <i class="icon-plus"></i> Agregar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="basic-elements">
        <div class="row">
     <!--boton -->
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">
                            <fieldset class="fieldset-marco">
                                <legend class="fieldset-marco text-muted">Listado de Usuarios</legend>

                                @if(isset($personData)&& count($personData)>0)

                                    <table id="datatable-usuarios"
                                           class="table table-sm table-condensed table-borderless nowrap datatablePointer"
                                           style="width: 100% !important;">
                                        <thead class="thead-inverse thead-dark">
                                        <tr class="headings">
                                            <th class="column-title no-link last"
                                                style="text-align: center"><span
                                                        class="nobr">ACCIONES</span>
                                            </th>
                                            <th class="column-title">ID USUARIO</th>
                                            <th class="column-title">USUARIO</th>
                                            <th class="column-title">NOMBRES</th>
                                            <th class="column-title">APELLIDOS</th>
                                            <th class="column-title">CORREO</th>
                                            <th class="column-title">TELEFONO</th>
                                            <th class="column-title">ENTIDAD</th>
                                            <th class="column-title">FECHA CREACIÓN</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($personData as $person)
                                            <?php $fecha = new \Carbon\Carbon($person->fechaU); ?>

                                            <tr class="">
                                                <td class="last" align="center">
                                                    @if($person->estadoU=="A")
                                                        <a href="#" class="overRed" title="Desactivar Usuario" data-placement="top" onclick="estadoUsuario({{$person->idu}})"><i class="fas fa-toggle-on fa-lg"></i></a>
                                                    @else
                                                        <a href="#" class="overOrange" onclick="estadoUsuario({{$person->idu}})"><i class="fas fa-toggle-off fa-lg"></i></a>
                                                    @endif

                                                    @if($person->idu=="")
                                                        <a href="#" class="overOrange"  title="Crear Usuario" data-placement="top" onclick="crearUsuario({{$person->idp}})"><i class="fas fa-user-plus fa-lg"></i></a>
                                                    @else



                                                            <a class="success p-0 overOrange"  title="Modificar Usuario" data-placement="top" onclick="showModPersona({{$person->idu}})"><i class="ft-edit-2 font-medium-3 mr-2"></i></a>

                                                            <a href="#" class="primary p-0 overOrange "  title="Restablecer Clave" data-placement="top" onclick="restablecerClave({{$person->idu}})"><i class="fas fa-key"></i></a>
                                                    @endif


                                                </td>
                                                <td >{{$person->idu}}</td>
                                                <td >{{$person->Usuario}}</td>
                                                <td >{{$person->Nombres}}</td>
                                                <td >{{$person->Apellidos}}</td>
                                                <td >{{$person->Correo}}</td>
                                                <td >{{$person->Telefono}}</td>
                                                <td >{{$person->Entidad}}</td>
                                                <td class="a-right">{{$fecha->format('d-m-Y H:i:s')}}</td>
                                            </tr>


                                        @endforeach

                                        </tbody>
                                    </table>



                                @else
                                    <div class="alert alert-warning alert-dismissible fade show"
                                         role="alert" id="tableUsers">

                                        <div class="text"><i class="fa fa-database"></i> La consulta no gener&oacute; resultados.
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true" class="la la-close"></span>
                                        </button>
                                    </div>
                                @endif
                            </fieldset>
                        </div>
                    </div>





                </div>
            </div>
        </div>
    </section>
    <!-- Basic Inputs end -->


    {{--Modal para modificar los datos de la persona--}}
    <div class="modal fade text-left" id="modalPersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Modificar Datos Del Usuario </h4>&nbsp;&nbsp;


                    <form class="form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <div class="position-relative has-icon-right">
                                            <input type="text" name="mod_txtUsuario" id="mod_txtUsuario" placeholder="Usuario" class="form-control">
                                            <div class="form-control-position">
                                                <i id="iconUser" class="fas fa-toggle-on warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 400px !important; overflow: auto;">


                    <fieldset class="fieldset-marco">
                        <legend class="fieldset-marco">Persona</legend>
                        <input type="hidden" id="hdIdPersona" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="info" for="mod_txtNombres">Nombres</label>
                                    <input type="text" class="form-control" id="mod_txtNombres" name="mod_txtNombres" placeholder="Nombres" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtApellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="mod_txtApellidos" name="mod_txtApellidos" placeholder="Apellidos" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_slcGenero">Género</label>
                                    <select class="form-control" id="mod_slcGenero" name="mod_slcGenero">
                                        <option value="">Seleccione</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_slcEntidad">Entidad</label>
                                    <select class="form-control select2Modal" id="mod_slcEntidad" name="mod_slcEntidad">
                                        <option value="">Seleccione</option>
                                        @foreach($entidad as $ent)
                                            <option value="{{$ent->Id}}">{{$ent->Nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <hr>
                    <fieldset class="fieldset-marco">
                        <legend class="fieldset-marco">Identidad</legend>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtCui">CUI</label>
                                    <input type="text" class="form-control datos" id="mod_txtCui" name="mod_txtCui" placeholder="CUI" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtNit">NIT</label>
                                    <input type="text" class="form-control datos" id="mod_txtNit" name="mod_txtNit" placeholder="NIT" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtIgss">IGSS</label>
                                    <input type="text" class="form-control datos" id="mod_txtIgss" name="mod_txtIgss" placeholder="IGSS" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtPasaporte">Pasaporte</label>
                                    <input type="text" class="form-control" id="mod_txtPasaporte" name="mod_txtPasaporte" placeholder="Pasaporte" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <hr>
                    <fieldset class="fieldset-marco">
                        <legend class="fieldset-marco">Contacto</legend>
                        <div class="row">

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
                                    <label class="text-info" for="mod_txtDireccion">Dirección</label>
                                    <input type="text" class="form-control" id="mod_txtDireccion" name="mod_txtDireccion" placeholder="Dirección" required>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtCorreo">Correo</label>
                                    <input type="email" class="form-control" id="mod_txtCorreo" name="mod_txtCorreo" placeholder="Correo" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtTel" class="info" >Teléfono</label>
                                    <input type="text" class="form-control datos" id="mod_txtTel" name="mod_txtTel" placeholder="Teléfono" required>
                                </div>
                            </div>
                        </div>

                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="modPersona();" class="btn btn-outline-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade text-left" id="modalReporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Reporte de Roles </h4>&nbsp;&nbsp;
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div id="div-pdf">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <form method="post" action="{{url("pointex/administracion/accesos/roles")}}" id="frmRoles">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="idUsuario" value="" id="idUsuario">
    </form>

@stop

@section('js')

    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jquery.steps.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.date.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/picker.time.js') !!}

    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/pickadate/legacy.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/basic-inputs.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/administracion.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/numeric/jquery.numeric.js') !!}

    <script>

    </script>

@stop
