<section id="file-export">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content ">
                    <div class="card-body card-dashboard table-responsive">
                        <table class=" display datatablePointer" id="TheTable" border="1"
                               width="100%" style="font-size: 10px">
                            <thead>
                            <tr class="">
                                <th>ACCIONES</th>
                                <th>FECHA NOTIFICACION</th>
                                <th>DEPTO</th>
                                <th>SOLICITANTE</th>
                                <th>ESTATUS</th>
                                <th>FECHA ACCION</th>
                            </tr>
                            </thead>

                            <tbody class="">
                            @if($dataUniversal->count()>0)
                                @foreach ($dataUniversal as $krs => $vrs)
                                    <tr>
                                        <td valign="bottom" align="center">
                                            @if($vrs->Estatus == 1)
                                                <a class="btn btn-flat btn-warning aActiveModal tooltip-per"
                                                   title="Aprobar" target="_blank">
                                                    <i class="far fa-share-square fa-xs" onclick="modalUniversal('{{$vrs->DocumentoUrl}}');"></i>
                                                </a>
                                            @else
                                                <a onclick="modalUniversal('{{$vrs->DocumentoUrl}}');"
                                                   class="btn btn-flat btn-darken-1 tooltip-per actionBTN"
                                                   title="Ver" target="_blank">
                                                    <i class="ft-eye fa-xs"></i>
                                                </a>
                                            @endif

                                        </td>
                                        <td class="text-right">{{ $vrs->FechaCreacion }}</td>
                                        <td class="text-right">{{ $vrs->Departamento }}</td>
                                        <td class="text-right" >{{ $vrs->Persona }}</td>
                                        @switch($vrs->Estatus)
                                            @case(1)
                                            <td class="text-right text-warning">Pendiente</td>
                                            @break
                                            @case(2)
                                            <td class="text-right text-success">Aprobado</td>
                                            @break
                                            @default
                                            <td class="text-right text-danger">Rechazado</td>
                                        @endswitch
                                        <td class="text-center">{{ $vrs->FechaModificacion }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade bs-example-modal-xl" role="dialog" aria-hidden="true"  style="height: 100%">
    <div class="modal-dialog modal-xl" style="height: 95%">
        <div class="modal-content" style="height: 95%">
            <iframe src="" frameborder="0" style="height: 95%"></iframe>
        </div>
    </div>
</div>

{{--<iframe src="/pointex/people/ausencias?aprobar=43&form=1" title="description" style="width: 100%;height: 100%"></iframe>--}}
