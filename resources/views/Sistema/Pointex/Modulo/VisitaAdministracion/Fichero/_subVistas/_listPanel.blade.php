<div class="card-content">
    <div class="card-body card-dashboard table-responsive ">
        <table class="table zero-configuration datatablePointer" style="font-size: 10px">
            <thead>
            <tr class="headings darken-4 bg-dark">
                <th style="color: white;width: 50.75px" class="text-center">Activo</th>
                <th style="color: white;width: 50.75px" class="text-center">Acciones</th>
                <th style="color: white; width: 135.75px;">Esp.</th>
                <th style="color: white; width: 135.75px;">Médico</th>
                <th style="color: white; width: 135.75px;">Quintil</th>
                <th style="color: white; width: 135.75px;">Domicilio</th>
                <th style="color: white; width: 135.75px;">Teléfono</th>
                <th style="color: white; width: 135.75px;">Correo Electrónico</th>
                <th style="color: white; width: 135.75px;">Frecuencia de Visita</th>
                <th style="color: white;width: 50.75px" class="text-center">Ranking</th>
                <th style="color: white;width: 50.75px" class="text-center">Estatus</th>
            </tr>
            </thead>
            <tbody>
            @foreach($panel as $Key)
                @php($condition = $Key->Activo == 1 ? "checked":"")
                @php($estatusActual = $Key->Activo == 0 ? 1:0)
                <tr>
                    <td class="text-center">
                    <!--<label class="switch">
                            <input type="checkbox" onclick="Estatus({{$Key->Id}},{{$estatusActual}});" {{$condition}}>
                            <span class="slider round"></span>
                        </label>-->
                        @if($Key->Estado != "En proceso")
                            <code style="cursor: pointer;"
                                  class="codeCrearItem"
                                  data-toggle="tooltip"
                                  data-placement="top"
                                  data-titulo="Activar / Desactivar"
                                  data-id_cmb="{{$Key->Id}}"
                                  data-estado_cmb="{{$estatusActual}}"
                                  data-condition_cmb="{{$condition}}">
                                <label class="switch">
                                    <input id="check{{$Key->Id}}" type="checkbox" {{$condition}}>
                                    <span class="slider round"></span>
                                </label>
                            </code>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($Key->IdUniversoM)
                            <a href="{{ "/pointex/visita_medica/paneles/edit_panel?".base64_encode("editar=$Key->Id") }}">
                                <i class="ft-edit-2"></i>
                            </a>
                        @endif
                    </td>
                    <td class="">{{$Key->EspPromoRegilla}}</td>
                    <td class="">{{$Key->NombreLargo}}</td>
                    <td class="">{{$Key->Cat}}</td>
                    <td class="">{{$Key->Direccion}}</td>
                    <td class="">{{$Key->Telefono}}</td>
                    <td class="">{{$Key->Mail1}}</td>
                    <td class="">{{$Key->Frecuencia}}</td>
                    <td class="text-center">
                        @if($Key->CodCloseUp && $Key->Cruze)
                            <a class="btn btn-flat btn-info overOrange aActiveModal tooltip-per" data-toggle="modal"
                               data-target="#exampleModalLong"
                               onclick="GetDetalleProdMedico('{{$Key->CodCloseUp}}',0);">
                                <i class="fa fa-medkit warning" aria-hidden="true"></i>
                            </a>
                        @endif
                    </td>
                    <td id="">
                        <div id="tddiv{{$Key->Id}}">{{$Key->Estado}}</div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
