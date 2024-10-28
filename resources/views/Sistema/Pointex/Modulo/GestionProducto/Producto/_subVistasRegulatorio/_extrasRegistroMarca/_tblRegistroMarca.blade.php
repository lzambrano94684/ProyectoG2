<section id="shopping-cart">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $subTitulo }}</h4>
                    <p class="card-text">A continuación un listado de los Registros de Marca creados, si deseas crear
                        uno nuevo por favor dar click
                        <a class="btn btn-flat btn-danger"
                           href="{{  "/pointex/gestion/regulatorio/crear_listar?".base64_encode("registroMarca=1&crear=1") }}">aqui</a>
                    </p>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($modelRegistroMarca->count()>0)
                            <table class="table  datatablePointer">
                                <thead class="text-center">
                                <tr class="headings darken-4 bg-dark">
                                    <th class="column-title th-acciones" style="width: 105px">ACCIONES</th>
                                    <th class="column-title">REGISTRO</th>
                                    <th class="column-title">MARCA</th>
                                    <th class="column-title">PAÍS</th>
                                    <th class="column-title">TITULAR</th>
                                    <th class="column-title">ESTATUS</th>
                                    <th class="column-title">FECHA VENCIMIENTO</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modelRegistroMarca as $kmr => $vmr)
                                    <tr>
                                        <td class="text-center">
                                            <a href="/pointex/gestion/regulatorio/crear_listar?{{ base64_encode("registroMarca=1&editar=$vmr->Id") }}"
                                               class="btn btn-flat btn-info overOrange aActiveModal tooltip-per"
                                               data-frm="marca">
                                                <i class="ft-edit-2"></i>
                                                <span class="tooltiptext">¿Modificar el registro <b>{{ $vmr->NoRegistro }}</b>?</span>
                                            </a>
                                            <a href="/pointex/gestion/regulatorio/crear_listar?{{ base64_encode("registroMarca=1&ver=$vmr->Id") }}"
                                               class="btn btn-flat btn-success overOrange aActiveModal tooltip-per"
                                               data-frm="marca">
                                                <i class="ft-eye"></i>
                                                <span class="tooltiptext">¿Ver todos los datos <b>{{ $vmr->NoRegistro }}</b>?</span>
                                            </a>
                                            <a onclick="deleteRegMarca('{{$vmr->Id}}','{{$vmr->NoRegistro}}')"
                                               href="javascript:void(0);"
                                               class="btn btn-flat btn-danger overOrange tooltip-per deleteMarca">
                                                <i class="ft-trash"></i>
                                                <span class="tooltiptext">¿Eliminar el Registro <b>{{ $vmr->NoRegistro }}</b>?</span>
                                            </a>
                                        </td>
                                        <td>{{ trim($vmr->NoRegistro) }}</td>
                                        <td>{{ isset($arrayMarcas[$vmr->IdMarca]) ? trim($arrayMarcas[$vmr->IdMarca]) : null }}</td>
                                        <td>{{ isset($arrayPaises[$vmr->IdPaisComercializacion]) ? trim($arrayPaises[$vmr->IdPaisComercializacion]) : null }}</td>
                                        <td>{{ isset($arrayEntidades[$vmr->IdTitular]) ? trim($arrayEntidades[$vmr->IdTitular]) : null }}</td>
                                        <td>{!! $vmr->validaStatus() !!}</td>
                                        <td>{{ trim($vmr->fechaVencimientoCorrect()) }}</td>
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