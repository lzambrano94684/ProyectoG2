@php($clienteV100 = [])
@php($clienteV97 = [])
@php($clienteVen = [])
@php($clienteBon = [])
@php($clienteVN = [])
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
                                        Cliente
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
                                    <th class="column-title headp1" style="color: white;">
                                        Venta Neta
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($cuenta = 0)
                                @foreach ($data->sortByDesc("VentaNeta")
                                ->groupBy("NombreBI") as $krs => $vrs)
                                    @php($cliente = $krs)
                                    @php($cv100 = $vrs->sum("Ventas100"))
                                    @php($cc97 = $vrs->sum("Venta97"))
                                    @php($cven = $vrs->sum("Vencidos"))
                                    @php($cbon = $vrs->sum("DescBon"))
                                    @php($cvn = $vrs->sum("VentaNeta"))
                                    @php($clienteV100[] = [$cliente, round($cv100)])
                                    @php($clienteV97[] = [$cliente, round($cc97)])
                                    @php($clienteVen[] = [$cliente, round($cven)])
                                    @php($clienteBon[] = [$cliente, round($cbon)])
                                    @php($clienteVN[] = [$cliente, round($cvn)])
                                    <tr class="">
                                        <td>{{ $cliente }}</td>
                                        <td>{{ number_format((float)$vrs->sum("Unidades"), 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$cv100, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$vrs->sum("CIF"), 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$cc97, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$cven, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$cbon, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$cvn, 2, '.', ',') }}</td>
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
    var dataCliente = '{{ base64_encode(json_encode([
    "v100" => $clienteV100,
    "v97" => $clienteV97,
    "ven"=>$clienteVen,
    "bon"=>$clienteBon,
    "vneta"=>$clienteVN
    ])) }}';
</script>

