<br>
<div class="nav-vertical">
    <ul class="nav nav-tabs navbar-horizontal">
        <li class="nav-item">
            <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
               href="#tab1" aria-expanded="true">Altas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
               href="#tab2" aria-expanded="false">Bajas</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1" aria-labelledby="base-tab1">
            <div class="card-content">
                <div class="card-body card-dashboard table-responsive ">
                    <table class="table display nowrap table-striped table-bordered scroll-horizontal-vertical tblestra">
                        <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>Representante</th>
                            <th>Especialidad</th>
                            <th>Médico</th>
                            <th>Quintil</th>
                            <th>Frecuencia</th>
                            <th>Ranking</th>
                            <th>Justificación</th>
                            <th>Tipo de Solicitud</th>
                        </tr>
                        </thead>
                        <tbody id="">
                        @foreach($panel as $Key)
                            <tr>
                                <td class="text-center">
                                    <a title="Aprobar"
                                       onclick="AutorizaPanel('{{$Key->Id}}','{{$Key->SolicitudActivo}}','Aprobar','{{$Key->NombreLargo}}','text-success');">
                                        <i class="fa fa-check success" aria-hidden="true"></i>
                                    </a>&nbsp;&nbsp;
                                    <a title="Rechazar"
                                       onclick="AutorizaPanel('{{$Key->Id}}','{{$Key->SolicitudActivo}}','Rechazar','{{$Key->NombreLargo}}','text-danger');">
                                        <i class="fa fa-times danger" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="text-center">{{$Key->Representante}}</td>
                                <td class="">{{$Key->EspecialidadPrimaria}}</td>
                                <td class="">{{$Key->NombreLargo}}</td>
                                <td class="">{{$Key->Cat}}</td>
                                <td class="">{{$Key->Frecuencia}}</td>
                                <td class="text-center">
                                    @if($Key->CodCloseUp && $Key->Cruze)
                                        <a class="btn btn-flat btn-info overOrange aActiveModal tooltip-per"
                                           data-toggle="modal"
                                           data-target="#exampleModalLong"
                                           onclick="GetDetalleProdMedico('{{$Key->CodCloseUp}}',0);">
                                            <i class="fa fa-medkit warning" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </td>
                                <td id="">@if($Key->SolicitudActivo){{$Key->Justificacion}}@else {{$Key->JustificacionBaja}}@endif</td>
                                <td id="">@if($Key->SolicitudActivo) Activar cuenta @else Desactivar cuenta @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
            <div class="card-content">
                <div class="card-body card-dashboard table-responsive ">
                    <div class="card-body card-dashboard table-responsive">
                        <table class="table display nowrap table-striped table-bordered scroll-horizontal-vertical tblestra">
                            <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>Representante</th>
                                <th>Especialidad</th>
                                <th>Médico</th>
                                <th>Quintil</th>
                                <th>Frecuencia</th>
                                <th>Ranking</th>
                                <th>Justificación</th>
                                <th>Tipo de Solicitud</th>
                            </tr>
                            </thead>
                            <tbody id="">
                            @foreach($panelDesactivar as $Key)
                                <tr>
                                    <td class="text-center">
                                        <a title="Aprobar"
                                           onclick="AutorizaPanel('{{$Key->Id}}','{{$Key->SolicitudActivo}}','Aprobar','{{$Key->NombreLargo}}','text-success');">
                                            <i class="fa fa-check success" aria-hidden="true"></i>
                                        </a>&nbsp;&nbsp;
                                        <a title="Rechazar"
                                           onclick="AutorizaPanel('{{$Key->Id}}','{{$Key->SolicitudActivo}}','Rechazar','{{$Key->NombreLargo}}','text-danger');">
                                            <i class="fa fa-times danger" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">{{$Key->Representante}}</td>
                                    <td class="">{{$Key->EspecialidadPrimaria}}</td>
                                    <td class="">{{$Key->NombreLargo}}</td>
                                    <td class="">{{$Key->Cat}}</td>
                                    <td class="">{{$Key->Frecuencia}}</td>
                                    <td class="text-center">
                                        @if($Key->CodCloseUp && $Key->Cruze)
                                            <a class="btn btn-flat btn-info overOrange aActiveModal tooltip-per"
                                               data-toggle="modal"
                                               data-target="#exampleModalLong"
                                               onclick="GetDetalleProdMedico('{{$Key->CodCloseUp}}',0);">
                                                <i class="fa fa-medkit warning" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td id="">@if($Key->SolicitudActivo){{$Key->Justificacion}}@else {{$Key->JustificacionBaja}}@endif</td>
                                    <td id="">@if($Key->SolicitudActivo) Activar cuenta @else Desactivar
                                        cuenta @endif</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 1000px">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ranking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" Id="modal-body">
                <div class="container">
                    <div class="row col-12">
                        <div class="col-3">
                            <div id="tblTrim1"></div>
                        </div>
                        <div class="col-3">
                            <div id="tblTrim2"></div>
                        </div>
                        <div class="col-3">
                            <div id="tblTrim3"></div>
                        </div>
                        <div class="col-3">
                            <div id="tblTrim4"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="col-12">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@section('jsExtras')
    <script>
        $(document).ready(function () {
            $(".tblestra").DataTable();})
    </script>
@endsection
