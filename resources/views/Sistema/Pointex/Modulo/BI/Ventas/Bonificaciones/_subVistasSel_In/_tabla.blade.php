<section id="shopping-cart">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Resultados según su filtro</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($data->count() > 0)
                            <table class="table  datatablePointerUnic">
                                <thead>
                                <tr class="headings darken-4 bg-dark">
                                    <th class="column-title" style="color: white;">
                                        País
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Cliente
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        SKU
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Producto
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Fecha
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Unidades
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Venta 100
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        CIF
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Venta 97
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Vencidos
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Desc/Boni
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Venta Neta
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Marca
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Proyecto
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Franquicia
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Sub-Franquicia
                                    </th>
                                    <th class="column-title" style="color: white;">
                                        Origen
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $krs => $vrs)
                                    <tr class="">
                                        @php($pais = $vrs->Pais)
                                        @php($cliente = $vrs->Distribuidor)
                                        @php($producto = $vrs->Presentacion)
                                        <td>{{ $pais }}</td>
                                        <td>{{ $cliente }}</td>
                                        <td>{{ $vrs->SKU }}</td>
                                        <td>{{ $producto }}</td>
                                        <td>{{ $vrs->Fecha }}</td>
                                        <td>{{ number_format((float)$vrs->Unidades, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->ventas100, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->Inc, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->Venta97, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->Vencidos, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->Descuentos, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->VentaNeta, 2, '.', ',') }}</td>
                                        <td>{{ $vrs->Marca }}</td>
                                        <td>{{ $vrs->Proyecto }}</td>
                                        <td>{{ $vrs->Franquicia }}</td>
                                        <td>{{ $vrs->SubFranquicia }}</td>
                                        <td>{{ $vrs->Origen }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot class="bg-dark text-white">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Totales</td>
                                    <td>{{ number_format((float)$data->sum("Unidades"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("ventas100"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("Inc"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("Venta97"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("Vencidos"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("Descuentos"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("VentaNeta"), 2, '.', ',') }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tfoot>
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
