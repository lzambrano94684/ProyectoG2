<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <fieldset class="fieldset-marco">
                            <legend class="fieldset-marco text-muted">Listado de Productos</legend>
                            @if($dataProducto->count() > 0)

                                <div style="overflow-x:auto;">
                                    <table id="datatable-Productos-Codes"
                                           class="table responsive-sm  nowrap datatablePointer"
                                           style="width: 100% !important;">
                                        <thead class="thead1">
                                        {!! $th !!}
                                        </thead>
                                        <tbody>
                                        @foreach ($dataProducto as $kdp => $vdp)
                                            @php
                                                $nombreCompleto = "<small>".trim($vdp->FormaFarmaceutica." ".
                                                $vdp->TipoFormaFarmaceutica)." ".trim($vdp->Presentacion)." ".
                                                trim($vdp->TipoPresentacion)."</small>";
                                                $codigoSap = $vdp->CodigoSap;
                                                $codigoBarras = $vdp->CodigoBarras;
                                                $codigoBarrasDesc = $vdp->Descripcion;
                                                $iconCodeSap = '<i class="fas fa-plus"></i>';
                                                $iconCodeBarras = '<i class="fas fa-plus"></i>';
                                                $titleTultipSap = "Cear";
                                                $titleTultipBarras = "Cear";
                                                $classBtnSap = "success";
                                                $classBtnBar = "success";

                                                if ($vdp->IdFormaFarmaceuticaTipo){
                                                    $codigoSap = $vdp->CodigoSapTipoPresentacion;
                                                    $codigoBarras = $vdp->CodigoBarrasTipoPresentacion;
                                                    $codigoBarrasDesc = $vdp->Descripcion;
                                                }
                                                if ($codigoSap){
                                                    $iconCodeSap = '<i class="fas fa-pencil-alt"></i>';
                                                    $titleTultipSap = "Editar";
                                                    $classBtnSap = "warning";
                                                }

                                                if ($codigoBarras){
                                                    $iconCodeBarras = '<i class="fas fa-pencil-alt"></i>';
                                                    $titleTultipBarras = "Editar";
                                                    $classBtnBar = "warning";
                                                }
                                                $conjuntoIds ="$vdp->Id-$vdp->IdFormaFarmaceutica-$vdp->IdFormaFarmaceuticaTipo";
                                                $idFormaFarmaceuticaTipo = $vdp->IdFormaFarmaceuticaTipo ?  $vdp->IdFormaFarmaceuticaTipo : 0;
                                            @endphp
                                            <tr class="prodTr_{{ $vdp->Id }}">
                                                <td class=" "><b>{{ trim($vdp->Marca) }}</b></td>
                                                <td class=" ">{{ trim($vdp->FormaFarmaceutica) }}</td>
                                                <td class=" ">{{ trim($vdp->TipoFormaFarmaceutica) }}</td>
                                                <td class=" ">
                                                    <b>{{ $vdp->TipoPresentacion }} </b>{{ trim($vdp->Presentacion) }}
                                                </td>

                                                <td class=" " align="center" id="td_sap_{{ $conjuntoIds }}">
                                                    {{ trim($codigoSap) }}<br>
                                                    <a class="btn btn-flat btn-{{ $classBtnSap }}" href="javascript:void(0)"
                                                       title="{{ $titleTultipSap }} código SAP"
                                                       onclick="addCodes('{{ $vdp->Id }}', '{{ $vdp->IdFormaFarmaceutica }}', '{{ $idFormaFarmaceuticaTipo }}', '{{trim($vdp->Marca)}}','{{ $nombreCompleto }}', 'CodigoSap', '{{ trim($codigoSap) }}', '{{ trim($codigoBarrasDesc) }}' ,'td_sap_{{ $conjuntoIds }}','{{ "prodTr_$vdp->Id" }}')">
                                                        {!! $iconCodeSap !!}
                                                    </a>
                                                </td>
                                                <td class=" " align="center" id="td_bar_{{ $conjuntoIds }}">
                                                    {{ trim($codigoBarras) }}<br>
                                                    <a class="btn btn-flat btn-{{ $classBtnBar }}" href="javascript:void(0)"
                                                       title="{{ $titleTultipBarras }} código Varras"
                                                       onclick="addCodes('{{ $vdp->Id }}', '{{ $vdp->IdFormaFarmaceutica }}', '{{ $idFormaFarmaceuticaTipo }}','{{trim($vdp->Marca)}}', '{{ $nombreCompleto }}', 'CodigoBarras', '{{ trim($codigoBarras) }}','{{ trim($codigoBarrasDesc) }}', 'td_bar_{{ $conjuntoIds }}','{{ "prodTr_$vdp->Id" }}')">
                                                        {!! $iconCodeBarras !!}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        {!! $th !!}
                                        </tfoot>
                                    </table>
                                </div>
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
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>