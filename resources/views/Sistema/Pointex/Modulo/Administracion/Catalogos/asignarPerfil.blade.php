@extends('Sistema.Pointex.LayOuts.layout')
@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/pickadate/pickadate.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/wizard.css') !!}
    {!! HTML::style('/Sistema/Pointex/Modulo/Administracion/css/administracion.css') !!}
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
                <div class="card">



                    <div class="card-content">
                        <div class="card-body">

                                <input type="hidden" id="_token" value="{{csrf_token()}}">


                                <button class="btn btn-primary float-md-right" onclick="addForm('AsigarPerfil')">Asignar
                                    Perfil <i class="fas fa-folder-plus fa-lg"></i></button>

                                @if(isset($roles)&& count($roles)>0)


                                    <div class="table-responsive">
                                        <table id="datatable-pais" class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer align='left'"
                                               cellspacing="0" style="width: 100%;">
                                            <thead class="thead-dark">
                                            <tr class="headings">
                                                <th class="column-title no-link last"
                                                    style="text-align: center"><span
                                                            class="nobr">ACCIONES</span>
                                                </th>

                                                <th class="column-title">NOMBRE</th>
                                                <th class="column-title">PERFIL</th>


                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach ($roles->groupBy('IdUsuario') as $krol => $vrol)

                                                <tr class="">
                                                    <td class="last" align="center">

                                                        <a href="JavaScript:;"
                                                           onclick="showModRoles('{{ base64_encode(json_encode($vrol))}}')"><i
                                                                    class="ft-edit-2 font-medium-3 mr-3"></i></a>
                                                        <a href="JavaScript:;"
                                                            class="danger"
                                                           onclick="deleteUsuarioPerfil('{{ $krol }}')" ><i
                                                                    class="ft-trash font-medium-3"></i></a>
                                                        <form id="formUsuarioPerfil{{ $krol }}" name="formUsuarioPerfil" method="POST" action="/pointex/administracion/accesos/asignar_perfil/delete_usuario" >
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$krol}}">
                                                        </form>

                                                    </td>

                                                    <td class="last" align="center">
                                                        {{ $vrol->first()->Usuario->Persona->Nombres.' '.$vrol->first()->Usuario->Persona->Apellidos}}
                                                    </td>
                                                    <td class="last" align="center">
                                                       <strong> {{ $vrol->pluck("Perfil.Nombre")->join(', ', ' y ') }}</strong>
                                                    </td>

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
                                    </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>

    <!-- modal -->
    <div class="modal fade text-left" id="AsigarPerfil" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel16"
         aria-hidden="true" blac>
        <div class="modal-dialog modal-md modal-dialog-centered dtr-modal-display" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark white">

                    <h4 class="modal-title text-bold-400" id="myModalLabel16">Guardar/Modificar
                         </h4>&nbsp;&nbsp;

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="IdUserPerfil" id="IdUserPerfil"
                                   value="">
                        </div>
                    </div>
                </div>
                <div class="modal-body">

                    <form id="formCrearUser" name="formCrearUser" method="POST" action="/pointex/administracion/accesos/asignar_perfil/crear">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="txtIdUsuario" id="txtIdUsuario">
                        <h4 class="form-section"><i class="ft-user-plus"> Asignar Perfiles</i></h4>
                        <div class="form-group">

                            <label class="text-info" for="mod_slcUsuario">Usuario</label>
                            <select class="form-control select2Modal" id="mod_slcUsuario" name="mod_slcUsuario">
                                <option value="">Seleccione</option>
                                @foreach($users as $user)
                                    <option value="{{$user->Id}}">{{$user->Usuario}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-info" for="mod_slcPerfil">Perfil</label>
                            <select class="form-control select2Modal" multiple="multiple" id="mod_slcPerfil"
                                    name="mod_slcPerfil[]">
                                <option value="">Seleccione</option>
                                @foreach($perfiles as $perfil)
                                    <option value="{{$perfil->Id}}">{{$perfil->Nombre}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                            <button type="button" onclick="guardarUP()"  class="btn btn-outline-primary"><i class="fas fa-check"></i> Guardar</button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/jqBootstrapValidation.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/cat.js') !!}
@stop
