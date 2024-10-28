<section id="simple-table">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Solicitud de Material Promocional</h4>
                    <p></p>
                </div>
                <div class="card-content">

                    <div class="card-body">
                        @if($Solicitud->count()>0)
                            <table class="table table-sm table-condensed table-borderless nowrap datatablePointer"
                                   style="width: 100% !important;">
                                <thead class="thead-inverse thead-dark">
                                <tr>
                                    <th><strong>Acciones</strong></th>
                                    <th><strong>Código</strong></th>
                                    <th><strong>Duración</strong></th>
                                    <th><strong>País</strong></th>
                                    <th><strong>Franquícia</strong></th>
                                    <th><strong>Marca</strong></th>
                                    <th><strong>Solicitante</strong></th>
                                    <th><strong>Estado</strong></th>

                                </tr>
                                </thead>
                                <tbody>
                            @foreach($Solicitud as $k => $dataSolicitud)
                                    <tr>
                                        @if($dataSolicitud->IdEstado ==1)
                                            <td>
                                                <a class="success p-0" data-original-title="Actualizar"
                                                   href="/pointex/medical/material/promocional?{{ base64_encode("edit=$dataSolicitud->Id") }}">

                                                    <i class="ft-edit-2 font-medium-3 mr-2"> </i>
                                                </a>
                                                <a href="/pointex/medical/material/promocional?{{ base64_encode("ver=$dataSolicitud->Id") }}"
                                                   class="btn btn-flat btn-success overOrange aActiveModal tooltip-per"
                                                   data-frm="marca">
                                                    <i class="ft-eye"></i>
                                                    <span class="tooltiptext">¿Ver todos los datos <b>{{ $dataSolicitud->Codigo }}</b>?</span>
                                                </a>
                                                <a href="JavaScript:void(0);" class="danger p-0" data-original-title="Eliminar"
                                                   title="" onclick="deleteMaterial('{{$dataSolicitud->Id}}','{{$dataSolicitud->Codigo}}')">
                                                    <i class="ft-x font-medium-3 mr-2"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                   class="btn btn-flat btn-info tooltip-per"
                                                   title="Enviar Solicitud"
                                                   onclick="enviarRegistro({{ $dataSolicitud->Id }}, '{{ $dataSolicitud->Codigo }}', 'AR')">
                                                    <i class="fas fa-share-square"></i>
                                                </a>
                                            </td>
                                            @elseif($dataSolicitud->IdEstado ==2 || $dataSolicitud->IdEstado ==3 || $dataSolicitud->IdEstado ==4)
                                            <td>
                                                <a href="/pointex/medical/material/promocional?{{ base64_encode("ver=$dataSolicitud->Id") }}"
                                                   class="btn btn-flat btn-success overOrange aActiveModal tooltip-per"
                                                   data-frm="marca">
                                                    <i class="ft-eye"></i>
                                                    <span class="tooltiptext">¿Ver todos los datos <b>{{ $dataSolicitud->Codigo }}</b>?</span>
                                                </a>
                                            </td>
                                            @endif
                                        <td>{{trim($dataSolicitud->Codigo)}}</td>
                                        @if($dataSolicitud->DuracionMaterial <2)
                                            <td>{{$dataSolicitud->DuracionMaterial." Mes"}}</td>
                                        @elseif($dataSolicitud->DuracionMaterial==12)
                                            <td>{{"1 Año"}}</td>
                                        @elseif($dataSolicitud->DuracionMaterial==24)
                                            <td>{{"2 Años"}}</td>
                                        @else
                                            <td>{{$dataSolicitud->DuracionMaterial." Meses"}}</td>
                                        @endif

                                        <td>{{$dataSolicitud->Pais}}</td>
                                        <td>{{$dataSolicitud->Franquicia}}</td>
                                        <td>{{$dataSolicitud->Marca}}</td>
                                        <td>{{$dataSolicitud->Nombres}}</td>
                                            @if($dataSolicitud->IdEstado==1)
                                                <td><h6><span class="badge badge-warning"><strong>{{$dataSolicitud->Estado}}</strong></span></h6></td>
                                                @elseif($dataSolicitud->IdEstado==2)
                                                <td><h6><span class="badge badge-primary"><strong>{{$dataSolicitud->Estado}}</strong></span></h6></td>
                                            @elseif($dataSolicitud->IdEstado==3)
                                                <td><h6><span class="badge badge-red"><strong>{{$dataSolicitud->Estado}}</strong></span></h6></td>
                                                @else
                                                <td><h6><span class="badge badge-info"><strong>{{$dataSolicitud->Estado}}</strong></span></h6></td>
                                                @endif
                                    </tr>
                            @endforeach
                            </tbody>
                            @else
                                <div class="alert alert-warning alert-dismissible fade show"
                                     role="alert" id="tableUsers">
                                    <div class="text"><i class="fa fa-database"></i> La consulta no gener&oacute;
                                        resultados.
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true" class="la la-close"></span>
                                    </button>
                                </div>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

