@php($headPais = [])
@php($arrayPaisU = [])
@php($arrayPaisV100 = [])
@php($arrayPaisCif = [])
@php($arrayPaisV97 = [])
@php($arrayPaisVe = [])
@php($arrayPaisBd = [])
@php($arrayPaisVn = [])
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
                            <table class="table table-striped table-bordered dom-jQuery-events dataTable  datatablePointerUnic">
                                <thead>
                                <tr class="headings darken-4 bg-dark">
                                    <th class="column-title" style="color: white;">
                                        País
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
                                @foreach ($data->sortBy("Orden")->groupBy("CodigoBI") as $krs => $vrs)
                                    @php($pais = $krs)
                                    @php($punidades = $vrs->sum("Unidades"))
                                    @php($pv100 = $vrs->sum("Ventas100"))
                                    @php($pCif = $vrs->sum("CIF"))
                                    @php($pv97 = $vrs->sum("Venta97"))
                                    @php($pve = $vrs->sum("Vencidos"))
                                    @php($pbd = $vrs->sum("DescBon"))
                                    @php($pvn = $vrs->sum("VentaNeta"))
                                    @php($headPais[] = $pais)
                                    @php($arrayPaisU[] = $punidades)
                                    @php($arrayPaisV100[] = round($pv100))
                                    @php($arrayPaisCif[] = $pCif)
                                    @php($arrayPaisV97[] = round($pv97))
                                    @php($arrayPaisVe[] = round($pve))
                                    @php($arrayPaisBd[] = round($pbd))
                                    @php($arrayPaisVn[] = round($pvn))
                                    <tr class="">
                                        <td>{{ $pais }}</td>
                                        <td>{{ number_format((float)$punidades, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$pv100, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$pCif, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$pv97, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$pve, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$pbd, 2, '.', ',') }}</td>
                                        <td>{{ number_format((float)$pvn, 2, '.', ',') }}</td>
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
    var dataPais = '{{ base64_encode(json_encode([
    "head"=>collect($headPais)->unique()->toArray(),
    "unidades" => array_unique($arrayPaisU),
    "v100" => array_unique($arrayPaisV100),
    "v97" => array_unique($arrayPaisV97),
    "pve" => array_unique($arrayPaisVe),
    "pbd" => array_unique($arrayPaisBd),
    "pvn" => array_unique($arrayPaisVn),
    ])) }}';
</script>
