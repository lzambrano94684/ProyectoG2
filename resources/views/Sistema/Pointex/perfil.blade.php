@extends('Sistema.Pointex.LayOuts.layout')
@section('content')

    <input type="hidden" id="hdIdUsuario"
           value=" @if(isset($usuario['usuario']->Id)) {{$usuario['usuario']->Id}}@endif">

    <section class="basic-elements">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">@if(isset($titleMsg)){{$titleMsg}}@endif</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <label class="primary">Detalle del usuario: </label><label
                                class="font-large-1 warning">&nbsp; @if(isset($usuario['usuario']->Usuario)) {{$usuario['usuario']->Usuario}}@endif</label>
                    </div>
                    <div class="card-content">
                        <div class="col-lg-10 offset-lg-1 ">
                            <div class="card card-inverse bg-primary ">
                                <div class="card-content justify-content-center" id="divPerfil">
                                    <div class="card-img overlap text-center">
                                        <img src="{{asset('Sistema/Pointex/Modulo/img/usuarioPerfil.png')}}"
                                             alt="element 06" width="190" class="mb-1">
                                    </div>
                                    @if(isset($usuario['usuario']->persona))
                                        <div class="row justify-content-center" style="margin: 2%;">
                                            <div class="col-lg-6">

                                                <label for="txtNombres" class="label">Nombres:</label>
                                                <input readonly class="form-control text-info" type="text"
                                                       name="txtNombres" id="txtNombres"
                                                       value="{{$usuario['usuario']->persona->Nombres}}"
                                                       placeholder="Nombres del Usuario">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="txtApellidos" class="label">Apellidos:</label>
                                                <input readonly class="form-control text-info" type="text"
                                                       name="txtApellidos" id="txtApellidos"
                                                       value="{{$usuario['usuario']->persona->Apellidos}}"
                                                       placeholder="Nombres del Usuario">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center" style="margin: 2%;">

                                            <div class="col-lg-6">
                                                <label for="txtGenero" class="label">Género:</label><br>
                                                <input class="form-control text-info" type="text" name="txtGenero"
                                                       id="txtGenero" value="{{$usuario['usuario']->persona->Genero}}"
                                                       required readonly>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="txtEnt" class="label">Entidad:</label><br>
                                                <input class="form-control text-info" type="text" name="txtEnt"
                                                       id="txtEnt"
                                                       value="{{isset($usuario['usuario']->persona->entidad) ? $usuario['usuario']->persona->entidad->Nombre : null}}"
                                                       readonly required>
                                            </div>
                                        </div>

                                    @endif

                                    @if(isset($usuario['usuario']->persona->persona_identidad[0]))

                                        <div class="row justify-content-center" style="margin: 2%;">
                                            <div class="col-lg-6">

                                                <label for="txtCui" class="label">CUI:</label>
                                                <input readonly class="form-control text-info" type="text" name="txtCui"
                                                       id="txtCui"
                                                       value="{{$usuario['usuario']->persona->persona_identidad[0]->CUI}}"
                                                       placeholder="CUI del Usuario">
                                            </div>
                                            <div class="col-lg-6">

                                                <label for="txtNit" class="label">NIT:</label>
                                                <input readonly class="form-control text-info" type="text" name="txtNit"
                                                       id="txtNit"
                                                       value="{{$usuario['usuario']->persona->persona_identidad[0]->NIT}}"
                                                       placeholder="NIT del Usuario">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center" style="margin: 2%;">
                                            <div class="col-lg-6">

                                                <label for="txtIgss" class="label">IGSS:</label>
                                                <input readonly class="form-control text-info" type="text"
                                                       name="txtIgss" id="txtIgss"
                                                       value="{{$usuario['usuario']->persona->persona_identidad[0]->IGSS}}"
                                                       placeholder="Seguro Social del Usuario">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="txtPasaporte" class="label">Pasaporte:</label>
                                                <input readonly class="form-control text-info" type="text"
                                                       name="txtPasaporte" id="txtPasaporte"
                                                       value="{{$usuario['usuario']->persona->persona_identidad[0]->Pasaporte}}"
                                                       placeholder="Pasaporte del Usuario">


                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($usuario['usuario']->persona->persona_contacto[0]))

                                        <div class="row justify-content-center" style="margin: 2%;">
                                            <div class="col-lg-6">

                                                <label for="txtDir" class="label">Dirección:</label>
                                                <input class="form-control text-info" type="text" name="txtDir"
                                                       id="txtDir"
                                                       value="{{$usuario['usuario']->persona->persona_contacto[0]->Direccion}}"
                                                       placeholder="Dirección del Usuario">
                                            </div>
                                            <div class="col-lg-6">

                                                <label for="txtCorreo" class="label">Correo:</label>
                                                <input class="form-control text-info" type="email" name="txtCorreo"
                                                       id="txtCorreo"
                                                       value="{{$usuario['usuario']->persona->persona_contacto[0]->Correo}}"
                                                       placeholder="Correo del Usuario">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center" style="margin: 2%;">
                                            <div class="col-lg-6">

                                                <label for="txtTel" class="label">Teléfono:</label>
                                                <input class="form-control text-info" type="text" name="txtTel"
                                                       id="txtTel"
                                                       value="{{$usuario['usuario']->persona->persona_contacto[0]->Telefono}}"
                                                       placeholder="Teléfono del Usuario">
                                            </div>
                                            <div class="col-lg-6">

                                                <label for="txtTel" class="label">País Residencia:</label>
                                                <select class="form-control select2_single text-info" name="slcPais" id="slcPais">
                                                    <option value="">Seleccione Pais</option>
                                                    @if(isset($paises))
                                                        @foreach($paises as $pais)
                                                            <option value="{{$pais->Id}}"
                                                                    @if($pais->Id==$usuario['usuario']->persona->persona_contacto[0]->IdPais) selected @endif>{{$pais->Nombre}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>


                                            </div>
                                        </div>
                                    @endif

                                    <div class="row justify-content-center" style="margin: 2%;">

                                        <div class="col-lg-12 text-center">
                                            <button class="btn btn-primary" onclick="addForm('modalPass')"><i
                                                        class="fas fa-key fa-lg"></i> Contraseña
                                            </button>
                                            <button class="btn btn-primary" onclick="limpiar('divPerfil')"><i
                                                        class="fas fa-eraser fa-lg"></i> Limpiar
                                            </button>
                                            <button class="btn btn-primary" onclick="modPerfil();"><i
                                                        class="fas fa-save fa-lg"></i> Modificar
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="modal fade text-left" id="modalPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Modificar Contraseña </h4>&nbsp;&nbsp;
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <fieldset class="fieldset-marco">
                        <legend class="fieldset-marco">
                            Usuario: @if(isset($usuario['usuario']->Usuario)) {{$usuario['usuario']->Usuario}}@endif</legend>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-info" for="mod_pswClaveAnt">Contraseña Anterior</label>
                                    <input type="password" class="form-control" id="mod_pswClaveAnt"
                                           name="mod_pswClaveAnt" placeholder="Anterior" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-info" for="mod_pswClaveNew">Contraseña Nueva</label>
                                    <input type="password" class="form-control" id="mod_pswClaveNew"
                                           name="mod_pswClaveNew" placeholder="Nueva" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-info" for="mod_pswClaveNewConfirm">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="mod_pswClaveNewConfirm"
                                           name="mod_pswClaveNewConfirm" placeholder="Confirmación" required>
                                </div>
                            </div>
                        </div>

                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="modClave();" class="btn btn-outline-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>




@stop

@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/perfil.js') !!}
@stop
