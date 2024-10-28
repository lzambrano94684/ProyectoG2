
{{--Modal para el gift cargando--}}
<div id="divCargando" class="">
    <button id="buttonRC">X</button>
</div>
{{--Token--}}
<input type="hidden" id="_token" value="{{csrf_token()}}">
@if(!isset($request->form))
    <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block">
        <a class="customizer-close"><i class="ft-x font-medium-3"></i></a>

        <a id="customizer-toggle-icon" class="customizer-toggle bg-danger">
            <i class="ft-settings font-medium-4 fa fa-spin white align-middle"></i>
        </a>
        <div class="customizer-content p-3 ps-container ps-theme-dark">
            <h4 class="text-uppercase mb-0 text-bold-400">Acciones </h4>
            <hr>
            <!-- Layout Options-->
            <h6 class="text-center text-bold-500 mb-3 text-uppercase" style="cursor: pointer"
                onclick="window.location.href='{{url("pointex/perfil")}}'"><i class="fas fa-user-edit"></i> Perfil</h6>
            <hr>
            <h6 class="text-center text-bold-500 mb-3 text-uppercase" style="cursor: pointer"
                onclick="window.location.href='{{url("pointex/ayuda")}}'"><i class="fas fa-life-ring"></i> Ayuda</h6>
            <hr>
            <h6 class="text-center text-bold-500 mb-3 text-uppercase" style="cursor: pointer"
                onclick="window.location.href='{{url("/salir")}}'"><i class="fas fa-sign-out-alt"></i> Salir</h6>
            <hr>
            <a id="navbar-fullscreen" title="Pantalla Completa" href="javascript:;"
               class="nav-link apptogglefullscreen"><i
                    class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                <p class="d-none">Pantalla Completa</p></a>
        </div>
    </div>
@endif

<div class="modal fade text-left" id="keyboard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">


            <div class="modal-header">
                <div class="row">
                    <div id="accordion">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <i class="fa fa-paperclip" aria-hidden="true"></i> Adjuntos
                        </button>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div id="imgDetalle">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-header">
                <h5 id="headerDoc" class="text-danger"></h5>

                <button type="button" class="btn btn-raised btn-dark round btn-min-width mr-1 mb-1"
                        id="btnAnteriorCode"><i class="ft-arrow-left"></i></button>
                <a type="button" class="btn btn-raised btn-info round btn-min-width mr-1 mb-1"
                   id="detalleModal" target="_blank"><i class="ft-list"></i></a>
                <button type="button" class="btn btn-raised btn-dark round btn-min-width mr-1 mb-1"
                        id="btnSiguieteCode"><i class="ft-arrow-right"></i></button>
                @if($idEstado == 1)
                    <button type="button" class="btn btn-danger" id="btnRechazar"
                            onclick="Aprobaciones(this.getAttribute('idAp'), this.getAttribute('codDoc'), 3, 'fa fa-check', 'Rechazar')">
                        Rechazar
                    </button>
                    <button type="button" class="btn btn-success" id="btnAprobar"
                            onclick="Aprobaciones(this.getAttribute('idAp'), this.getAttribute('codDoc'), 2, 'fa fa-times', 'Aprobar')">
                        Aprobar
                    </button>
                @endif

            </div>

            <div class="modal-body" id="modalContent">
            </div>
        </div>
    </div>
</div>

