<!-- modal -->
<div class="modal fade text-left" id="AsigarPerfil" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel16"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered dtr-modal-display modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header bg-dark white">

                    <div id="IdAddCapex">

                    </div>

                    <button type="button" class="btn btn-raised btn-icon btn-dark" data-dismiss="modal"><i
                                class="ft-x"></i>
                    </button>

                </div>
                <!-- id user perfil-->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="IdUserPerfil" id="IdUserPerfil"
                                   value="">
                        </div>
                    </div>
                </div>

                <div class="modal-body">

                    <h4 class="form-section"><i class="ft-user-plus"> Asignar Perfiles</i></h4>

                    <form id="formCrearUser" name="formCrearUser" method="POST"
                          action="/pointex/administracion/accesos/asignar_perfil/crear">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="txtIdUsuario" id="txtIdUsuario">

                        <div class="form-group">
                            <label class="text-info" for="mod_slcUsuario">Usuario:</label>
                            <select class="form-control select2Modal" id="mod_slcUsuario" name="mod_slcUsuario">
                                <option value="">Seleccione</option>

                                @foreach($users as $user)
                                    <option value="{{$user->Id}}">{{$user->Usuario}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="text-info" for="mod_slcPerfil">Perfil:</label>
                            <select class="form-control select2Modal" multiple="multiple" id="mod_slcPerfil"
                                    name="mod_slcPerfil[]">
                                <option value="">Seleccione</option>
                                @foreach($perfiles as $perfil)
                                    <option value="{{$perfil->Id}}">{{$perfil->Nombre}}</option>
                                @endforeach

                            </select>
                        </div>


                        <div class="fg-actions d-flex justify-content-center">
                            <div class="modal-footer">

                                <button type="button" class="btn btn-raised btn-raised btn-warning mr-1"
                                        data-dismiss="modal">
                                    <i class="ft-x"></i> Cancelar
                                </button>

                                <button type="button" id="btn-perfil" onclick="guardarUP()"
                                        class="btn btn-outline-primary">
                                    <i class="ft-save"></i> Guardar


                                </button>


                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>