<section id="configuration">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="form-section">
                            <i class="fas fa-bullhorn text-danger"></i>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Enviar correo electrónico con motivo de creacion de  productos tercerizados</font>
                            </font>
                                <div class="custom-control custom-radio d-inline-block ml-1">
                                    <input type="radio" id="txtNotificar1" name="txtNotificar"
                                           value=""
                                           class="custom-control-input"
                                           onchange="notificar(1)">
                                    <label class="custom-control-label" for="txtNotificar1"
                                           style="vertical-align: baseline !important;">Si</label>
                                </div>
                                <div class="custom-control custom-radio d-inline-block ml-2">
                                    <input type="radio" id="txtNotificar2" name="txtNotificar" value="0"
                                           class="custom-control-input"
                                           onchange="notificar(0)">
                                    <label class="custom-control-label" for="txtNotificar2"
                                           style="vertical-align: baseline !important;">No</label>
                                </div>
                        </h4>
                        <hr>
                        <form id="form" name="formCorreo" method="post" action="/pointex/gestion/tercerizados/enviar_correo">
                            @csrf
                            <input type="hidden" name="fecha" id="fecha" value="{{$fecha}}">
                                <input type="hidden" id="txtCorreoTercerizado" class="form-control" name="txtCorreoTercerizado" value="">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="txtTitulo">Titulo: </label>
                                    <div class="col-md-9">
                                        <input type="text" id="txtTitulo" class="form-control" name="txtTitulo" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="txtDescripcion">Descripcion: </label>
                                    <div class="col-md-9">
                                        <textarea id="txtDescripcion" rows="5" class="form-control"
                                                  name="txtDescripcion"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="textarea">Avisar a: </label>
                                    <div class="col-md-9">
                                        <div id="textarea">
                                        </div>
                                        <input type="hidden" name="correos" id="correos" value="@foreach($correos as $kc){{$kc.";"}}@endforeach"/>
                                    </div>
                                </div>
                        </form>
                        <a type="button" class="btn btn-raised btn-warning mr-1"
                           href="/pointex/gestion/tercerizados">
                            <i class="ft-arrow-left"></i>Regresar
                        </a>
                        <button class="btn btn-info pull-right" onclick="validar();"
                                title="Enviar Correo">
                            <i class="fas fa-mail-bulk"></i> Notificar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
