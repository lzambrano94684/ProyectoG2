<section id="shopping-cart">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        @if($modelProductos->count()>0)
                            <table class="table  datatablePointer">
                                <thead class="text-center">
                                <tr class="headings darken-4 bg-dark">
                                    <th class="column-title th-acciones" style="width: 110px">ACCIONES</th>
                                    <th class="column-title">SKU Padre</th>
                                    <th class="column-title">Presentación Única</th>
                                    <th class="column-title">Codigo</th>
                                    <th class="column-title">Descripción SAP</th>
                                    <th class="column-title">Tipo de Presentación</th>
                                    <th class="column-title">Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modelProductos as $kmr => $vmr)
                                    <tr>
                                        <td class="text-center">
                                            <a href="/pointex/gestion/producto/supply?{{ base64_encode("editar=$vmr->Id") }}"
                                               class="btn btn-flat btn-info" title="¿Modificar el registro {{ $vmr->DescripcionSap }}?">
                                                <i class="ft-edit-2"></i>
                                            </a>
                                            <a onclick="deleteRegistro('{{$vmr->Id}}')"
                                               href="javascript:void(0);"
                                               class="btn btn-flat btn-danger" title="¿Modificar el registro {{ $vmr->DescripcionSap }}?">
                                                <i class="ft-trash"></i>
                                            </a>
                                        </td>
                                        <td>{{ trim($vmr->SKU) }}</td>
                                        <td>{{ trim($vmr->Presentacion) }}</td>
                                        <td>{{ trim($vmr->CodigoSap) }}</td>
                                        <td>{{ trim($vmr->DescripcionSap) }}</td>
                                        <td>{{ trim($vmr->TipoPresentacion) }}</td>
                                        <td class="text-{{ $vmr->Estado ? 'success' : 'danger' }} ">{{ $estado[$vmr->Estado] }}</td>
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
