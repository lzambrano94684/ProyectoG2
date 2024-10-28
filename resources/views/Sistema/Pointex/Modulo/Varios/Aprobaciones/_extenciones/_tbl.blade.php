<section id="file-export">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Listado</h4>
                    <p class="card-text">A continuación un listado de aprobaciones o rechazos de documentos.</p>
                </div>
                <div class="card-content ">
                    <div class="card-body card-dashboard table-responsive">
                        @if($tipoDoc->count()>0)
                            <ul class="nav nav-tabs">
                                @foreach($tipoDoc as $k => $v)
                                    @php($numeroAprobaciones = $aprobacionesCount->where("IdTipoDoc", $v->Id)
                                                ->sum("Total"))
                                    @if($numeroAprobaciones > 0)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $v->Id == $tipoSelect ? 'active' : null }}"
                                               href="/pointex/multiples/aprobeciones?tipoSelect={{ $v->Id }}"
                                               aria-expanded="true">{{ $v->Nombre }}
                                                <span
                                                    class="badge badge-primary badge-pill">
                                                {{ $numeroAprobaciones }}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                        @foreach($arrayColorEstatus as $k => $v)
                            <a href="/pointex/multiples/aprobeciones?tipoSelect={{ $tipoSelect }}&estado={{ $k }}"
                               class="btn {{ $k == $request->estado ? "btn-raised btn-outline-$v" : "btn-flat btn-$v" }} ">
                                {{ $estatos[$k] }} {{ $aprobacionesCount->where("IdTipoDoc", $tipoSelect)->where("Estatus", "$k")
                                                ->sum("Total") }}</a>
                        @endforeach

                        <div class="tab-content px-1 pt-1">
                            @if($modelAprobaciones->count()>0)
                                <table class="table table-striped datatablePointer">
                                    <thead class="darken-4 bg-dark text-white">
                                    <tr class="headings darken-4 bg-dark">
                                        <th class="column-title">ACCIONES</th>
                                        <th class="column-title">Fecha Notificacion</th>
                                        <th class="column-title">DEPTO</th>
                                        <th class="column-title">SOLICITANTE</th>
                                        <th class="column-title">TIPO DOCUMENTO</th>
                                        <th class="column-title">DOCUMENTO</th>
                                        <th class="column-title">Justificacion</th>
                                        <th class="column-title">ESTATUS</th>
                                        <th class="column-title">Fecha Accion</th>
                                    </tr>
                                    </thead>

                                    <tbody class="darken-4 bg-light text-dark">
                                    @foreach ($modelAprobaciones as $krs => $vrs)
                                        <tr>
                                            <td class="text-center">
                                                <a href="{{ $vrs->DocumentoUrl }}"
                                                   class="btn btn-flat btn-darken-1 tooltip-per"
                                                   title="Ver" target="_blank">
                                                    <i class="ft-eye"></i>
                                                </a>
                                                @if($vrs->Estatus == 1)
                                                    <a href="{{ $vrs->DocumentoUrl }}"
                                                       class="btn btn-flat btn-warning aActiveModal tooltip-per"
                                                       title="Aprobar" target="_blank">
                                                        <i class="far fa-share-square"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $vrs->FechaCreacion }}</td>
                                            <td>{{ $vrs->Departamento }}</td>
                                            <td>{{ $vrs->Persona }}</td>
                                            <td>{{ $vrs->Documento }}</td>
                                            <td>{{ $vrs->Documento != "Perfil Ausencias" && $vrs->Documento != "Perfil Vacaciones" ? $vrs->Nombre : ""}}</td>
                                            <td>{{ $vrs->Documento != "Perfil Ausencias" && $vrs->Documento != "Perfil Vacaciones" ? $vrs->Justificacion : $vrs->Nombre }}</td>
                                            <td class="text-center text-{{ $arrayColorEstatus[$vrs->Estatus] }}">{{ $estatos[$vrs->Estatus] }}</td>
                                            <td>{{ $vrs->FechaModificacion }}</td>
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
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true" class="la la-close"></span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
