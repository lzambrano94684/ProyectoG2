@php($arayProducto = [])
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
                                    <th class="column-title" id="headp1" style="color: white;">
                                        Producto
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
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($data->sortByDesc("Unidades")->groupBy("DescripcionSap") as $krs => $vrs)
                                    @php($producto = $krs)
                                    @php($unidades = $vrs->sum("Unidades"))
                                    @php($arayProducto[] = [$producto, $unidades])
                                    <tr class="">
                                        <td>{{ $producto }}</td>
                                        <td>{{ number_format((float)$unidades, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->sum("Ventas100"), 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->sum("CIF"), 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->sum("Venta97"), 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->sum("Vencidos"), 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->sum("DescBon"), 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->sum("VentaNeta"), 2, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot class="bg-dark text-white">
                                    <td>Totales</td>
                                    <td>{{ number_format((float)$data->sum("Unidades"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("Ventas100"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("CIF"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("Venta97"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("Vencidos"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("DescBon"), 2, '.', ',') }}</td>
                                    <td>{{ number_format((float)$data->sum("VentaNeta"), 2, '.', ',') }}</td>
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
<script type="text/javascript">
    var dataProducto = '{{ base64_encode(json_encode(collect($arayProducto)->sortByDesc(1)->values()->toArray())) }}';
</script>
