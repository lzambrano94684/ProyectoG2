<section id="file-export">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content ">
                    <div class="card-body card-dashboard table-responsive">
                    @if($aprobacionesCount->count()>0)
                        <!--                                            <ul class="nav nav-tabs">
                                                @foreach($aprobacionesCount->sortBy("IdTipoDoc")->groupBy("IdTipoDoc") as $k => $v)
                            @php($numeroAprobaciones = $v->where("Estatus", "1")->sum("TotalLimpio"))
                            @php($numeroAprobaciones = $v->where("Estatus", "1")->count("TotalLimpio"))
                            @php($ejecucionTipo = $v->first() ? $v->first()->EjecucionTipo : null)
                                <li class="nav-item">
                                    <a class="nav-link {{ $k == $tipoSelect ? 'active' : null }}"
                                                           href="/pointex/aprobaciones?tipoSelect={{ $k }}"
                                                           aria-expanded="true">{{ $ejecucionTipo }}
                                <span class="badge badge-primary badge-pill"> {{ $numeroAprobaciones }} </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                            </ul>-->
                        @endif
                        <table class="datatablePointerUnic display" id="TheTable" border="1"
                               width="100%" style="font-size: 10px">
                            <!--data-ordering="false"-->
                            <thead>
                            <tr class="">
                                <th style="width: 120px">ACCIONES</th>
                                <th>FECHA</th>
                                @if($idEstado == 2)
                                    <th>FECHA APROBACIÓN</th>
                                @elseif($idEstado == 3)
                                    <th>FECHA RECHAZO</th>
                                @endif
                                <th>DEPTO</th>
                                @if(!$sumar)
                                    <th>USUARIO</th>
                                @endif
                                <th>CÓDIGO</th>
                                <th>{{ $tipoSelect == 1 ? "JUSTIFICACIÓN" : "DESCRIPCIÓN"}}</th>
                                <th class="text-right">ML</th>
                                <th class="text-right">ML SUB-TOTAL</th>
                                <th class="text-right">USD SUB-TOTAL</th>
                            </tr>
                            </thead>

                            <tbody class="">
                            @if($modelAprobaciones->count()>0)
                                @foreach ($modelAprobaciones as $krs => $vrs)
                                    <tr id="{{ $vrs->Codigo }}">
                                        <td align="left" valign="bottom" style="width: 120px">
                                            @if($vrs->Estatus == 1)
                                                <a style="size: 8px" href="javascript:void(0)"
                                                   class="btn btn-flat btn-info aActiveModal tooltip-per actionBTN"
                                                   data-toggle="modal"
                                                   data-keyboard="false" data-target="#keyboard"
                                                   data-idaprobacion="{{ $vrs->Id }}"
                                                   data-codigo="{{ $vrs->Codigo }}"
                                                   id="sExpres-{{ $vrs->Codigo }}"
                                                   title="Aprobación Express">
                                                    <i class="icon-speedometer"></i>
                                                </a>
                                                <a href="{{ $vrs->DocumentoUrl }}"
                                                   id="url-{{ $vrs->Codigo }}"
                                                   class="btn btn-flat btn-warning aActiveModal tooltip-per actionBTN"
                                                   title="Aprobación Detallada" target="_blank">
                                                    <i class="ft-corner-up-right"></i>
                                                </a>
                                            @else
                                                <a style="size: 8px" href="javascript:void(0)"
                                                   class="btn btn-flat btn-info aActiveModal tooltip-per actionBTN"
                                                   data-toggle="modal"
                                                   data-keyboard="false" data-target="#keyboard"
                                                   data-idaprobacion="{{ $vrs->Id }}"
                                                   data-codigo="{{ $vrs->Codigo }}"
                                                   id="sExpres-{{ $vrs->Codigo }}"
                                                   title="Resumen">
                                                    <i class="fa fa-file-text-o"
                                                       aria-hidden="true"></i>
                                                </a>

                                                <a href="{{ $vrs->DocumentoUrl }}"
                                                   id="url-{{ $vrs->Codigo }}"
                                                   class="btn btn-flat btn-darken-1 tooltip-per actionBTN"
                                                   title="Ver" target="_blank">
                                                    <i class="ft-eye"></i>
                                                </a>
                                                @if($sumar)
                                                    @if($vrs->EstatusCat != "CO")
                                                        <a href="javascript:void(0)"
                                                           onclick="Revertir({{ "$vrs->Id,'$vrs->Codigo', 1, 'fa fa-exclamation', 'Revertir'" }})"
                                                           class="btn btn-flat btn-warning tooltip-per actionBTN"
                                                           title="Revertir Acción">
                                                            <i class="ft-zap"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-flat btn-grey tooltip-per disabled actionBTN"
                                                           title="Esta requisicion ya tiene órden de compra">
                                                            <i class="ft-zap"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $vrs->Fecha }}</td>
                                        @if($aplicarColumna)
                                            <td>{{ $vrs->FechaModificacion }}</td>
                                        @endif
                                        <td>{{ $vrs->Departamento }}</td>
                                        @if(!$sumar)
                                            <td>{{ $vrs->Persona }}</td>
                                        @endif
                                        <td>{{ $vrs->Codigo }}</td>
                                        <td>{{ $vrs->Justificacion }}</td>
                                        <td class="text-right">{{ $vrs->Moneda }}</td>
                                        <td class="text-right">{{ number_format(str_replace(",", "", $vrs->TotalML), 2, '.', ',') }}</td>
                                        <td class="text-right">{{ $vrs->TotalUSD }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @endif
                            <tfoot>
                            <tr>
                                <th colspan="{{ $sumaCol-2 }}" class="text-right">Total:
                                </th>
                                <th class="text-right">3434</th>
                                <th class="text-right">43</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
