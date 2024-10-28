<section id="shopping-cart">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        @if($modelProdReg->count()>0)
                            <table class="table  datatablePointer">
                                <thead class="text-center">
                                <tr class="headings darken-4 bg-dark">
                                    <th class="column-title th-acciones" style="width: 110px">ACCIONES</th>
                                    <th class="column-title">Codigo Sap</th>
                                    <th class="column-title">Nombre Sap</th>
                                    <th class="column-title">Registro Sanitario</th>
                                    <th class="column-title">Presentación Registro</th>
                                    <th class="column-title">País</th>
                                    <th class="column-title">Fecha Vencimiento</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modelProdReg as $kmr => $vmr)
                                    <tr>
                                        <td class="text-center">
                                            <a
                                                    href="/pointex/gestion/regulatorio/delete_enlazar/{{ $vmr->Id }}"
                                                    class="btn btn-flat btn-danger"
                                                    title="¿Eliminar {{ $vmr->DescripcionSap }}?">
                                                <i class="ft-trash"></i>
                                            </a>
                                        </td>
                                        <td>{{ trim($vmr->CodigoSap) }}</td>
                                        <td>{{ trim($vmr->DescripcionSap) }}</td>
                                        <td>{{ trim($vmr->NoRegistroSanitario) }}</td>
                                        <td>{{ trim($vmr->PresentacionReg) }}</td>
                                        <td>{{ trim($vmr->Pais) }}</td>
                                        <td>{{ trim($vmr->FechaVencimiento) }}</td>
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