<section id="shopping-cart">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $subTitle }}</h4>
                    @if ($table != 'PX_GP_ProductoCodigos')
                        <p class="card-text">A continuación un listado de l@s {{ $subTitle }} cread@s, si deseas crear
                            más
                            favor dar click
                            <a class="btn btn-flat btn-danger"
                               href="/pointex/gestion/catalogos/{{  base64_encode($table)."?".base64_encode("crear=1") }}">aquí</a>
                        </p>
                    @endif
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($dataTable && $dataTable->count() > 0)
                            <table class="table  datatablePointer">
                                <thead>
                                <tr class="headings darken-4 bg-dark">
                                    <th class="column-title th-acciones" style="color: white;width: 110px">ACCIONES</th>
                                    @foreach($dataTable->first() as $k => $v)
                                        @if($k!== "Id" && $k!== "FechaCreacion" && $k!== "FechaModificacion" && $k!== "UsuarioCreacion" && $k!== "UsuarioModificacion")
                                            <th class="column-title" style="color: white;">
                                                {{ $dataFK->where("constraint_column_name",$k)->first() ? str_replace("ID", "",strtoupper ($k)) : strtoupper ($k) }}
                                            </th>
                                        @endif
                                    @endforeach
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($dataTable as $krs => $vrs)
                                    <tr class="">
                                        <td class="text-center">
                                            <a href="/pointex/gestion/catalogos/{{  base64_encode($table)."?".base64_encode("editar=$vrs->Id") }}"
                                               class="btn btn-flat btn-info overOrange aActiveModal tooltip-per"
                                               title="Modificar item">
                                                <i class="ft-edit-2"></i>
                                            </a>
                                            <a href="/pointex/gestion/catalogos/{{  base64_encode($table)."?".base64_encode("ver=$vrs->Id") }}"
                                               class="btn btn-flat btn-success overOrange aActiveModal tooltip-per"
                                               title="Ver item">
                                                <i class="ft-eye"></i>
                                            </a>
                                            <a onclick="deleteData('{{$vrs->Id}}')"
                                               href="javascript:void(0);"
                                               class="btn btn-flat btn-danger overOrange tooltip-per delete">
                                                <i class="ft-trash"></i>
                                            </a>
                                        </td>
                                        @php($arrayFK = $dataFK->pluck("dataTable","constraint_column_name")->toArray())
                                        @foreach($dataTable->first() as $ki => $vi)
                                            @if($ki!== "Id" && isset($arrayFK[$ki][$vrs->$ki]))
                                                <td class=" ">{{ trim($arrayFK[$ki][$vrs->$ki]) }}</td>
                                            @elseif($ki!== "Id" && $ki!== "FechaCreacion" && $ki!== "FechaModificacion" && $ki!== "UsuarioCreacion" && $ki!== "UsuarioModificacion")
                                                <td class=" ">{{ $vrs->$ki }}</td>
                                            @endif
                                        @endforeach
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
</section>