<table class="table table-sm table-condensed table-borderless nowrap datatablePointer"
       style="width: 100% !important;">
    <thead class="thead-inverse thead-dark">
    <tr>
        <th><strong>Acciones</strong></th>
        <th><strong>Código&nbsp;Formulario</strong></th>
        <th><strong>Responsable&nbsp;del&nbsp;Evento</strong></th>
        <th><strong>País&nbsp;</strong></th>
        <th><strong>Total&nbsp;de&nbsp;Evento</strong></th>
        <th><strong>Fecha&nbsp;de&nbsp;Creación</strong></th>
        <th><strong>Estado</strong></th>
    </tr>
    </thead>
    <tbody class="darken-4 bg-light text-dark">
    @if($consulta->count()>0)
        @foreach($consulta as $k => $dataEvento)
            <tr>
                @if($dataEvento->IdEstado==2)
                    <td>
                        <a href="javascript:void(0)" class="overOrange" data-toggle="tooltip"
                           data-placement="top" class="warning p-0"
                           data-toggle="modal" data-target="#modalCapex"
                           onclick="pdfMedicall('{{$dataEvento->IdEvento}}')">
                            <i class="ft-eye font-medium-2 mr-1"> </i>
                        </a>
                        {{--                        <a href="/pointex/medical/eventos/contrato/{{base64_encode($dataEvento->IdEvento)}}"  target="_blank" class="danger p-0" class="overOrange" data-toggle="tooltip" title="Contrato" data-placement="top" class="warning p-0"--}}
                        {{--                           title="" >--}}
                        {{--                            <i class="far fa-file-pdf font-medium-3 mr-2"></i>--}}
                        {{--                        </a>--}}
                        <a href="/pointex/medical/eventos/evento/{{base64_encode($dataEvento->IdEvento)}}"
                           target="_blank" class="danger p-0" class="overOrange" data-toggle="tooltip"
                           data-placement="top" class="warning p-0">
                            <i class="far fa-file-pdf font-medium-2 mr-1"></i>
                        </a>
                    </td>
                @elseif($dataEvento->IdEstado==4||3)
                    <td>
                        <a href="javascript:void(0)" class="overOrange  tooltip-per" data-toggle="tooltip"
                           {{--title="Info del Evento"--}}
                           data-placement="top" class="warning p-0"
                           data-toggle="modal" data-target="#modalCapex"
                           onclick="pdfMedicall('{{$dataEvento->IdEvento}}');">
                            <i class="ft-eye font-medium-2 mr-1"> </i>
                        </a>
                        @if($dataEvento->IdEstado==4)
                            <a href="javascript:void(0)"
                               class="btn btn-flat btn-danger tooltip-per"
                               title="Eliminar evento"
                               onclick="deleteRegistro({{ $dataEvento->IdEvento }})">
                                <i class="far fa-trash-alt font-medium-2 mr-1"></i>
                            </a>
                            <a href="javascript:void(0)"
                               class="btn btn-flat btn-info tooltip-per"
                               title="Enviar evento"
                               onclick="enviarRegistro({{$dataEvento->IdEvento}})">
                                <i class="fas fa-share-square font-medium-2 mr-1"></i>
                            </a>
                        @endif
                    </td>
                @endif
                <td>{{$dataEvento->CodReg}}</td>
                <td>{{$dataEvento->Nombres}}</td>
                <td>
                    @foreach($evento as $ke => $dataPais)
                        @foreach($dataPais as $kev => $values)
                            @if($dataEvento->IdEvento == $values->Id)
                                {{$values->Pais}},
                            @endif
                        @endforeach
                    @endforeach
                </td>
                <td align="right">
                    <strong>${{number_format($dataEvento->SubTotal+$dataEvento->SubTotalComida,2)}}</strong></td>
                <td>{{ Carbon\Carbon::parse($dataEvento->FechaCreacion)->format('d/m/Y H:i:s')}}</td>
                @if($dataEvento->IdEstado==2)
                    <td><h6><span class="badge badge-primary"><strong>{{$dataEvento->Estado}}</strong></span></h6></td>
                @elseif($dataEvento->IdEstado==3)
                    <td><h6><span class="badge badge-red"><strong>{{$dataEvento->Estado}}</strong></span></h6></td>
                @else
                    <td><h6><span class="badge badge-info"><strong>{{$dataEvento->Estado}}</strong></span></h6></td>
                @endif
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

<!--modal -->
<div class="modal fade text-left" id="modalCapex" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered dtr-modal-display modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark white">
                <div id="IdDetalle">
                </div>
                <button type="button" class="btn btn-raised btn-icon btn-dark" data-dismiss="modal"><i
                        class="ft-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-4 col-sm-6 col-12 fonticon-container">
                </div>
                <form class="form">
                    <div id="row1" class="row">

                    </div>
                    <div id="row2" class="row">

                    </div>
                    <div class="form-bordered">
                        <div id="IdFooter" class="modal-footer justify-content-between" class="blockquote-footer">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
