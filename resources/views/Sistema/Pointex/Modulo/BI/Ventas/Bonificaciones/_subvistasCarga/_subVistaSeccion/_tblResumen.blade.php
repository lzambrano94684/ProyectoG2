<table class="table  datatablePointerUnic">
    <thead>
    <tr class="headings darken-4 bg-dark">
        @foreach($titulos as $k => $v)
            <th class="column-title" style="color: white;">
                {{ $v }}
            </th>
        @endforeach
    </tr>
    </thead>

    <tbody>
    @foreach ($dataTable as $krs => $vrs)
        @php($dataFiltrada->push($vrs))
        <tr class="">
            @foreach($vrs as $ki => $vi)
                @php($posPais = $vrs["País CLF"])
                @php($posProducto = $vrs["Material"])
                @php($posCliente = $vrs["Cliente"])
                @php($posCIPed = $vrs["Cliente"])

                @if(!isset($arrayPaises[$posPais]) || !isset($arrayProducto[$posProducto]) || !isset($arrayCliente[$posCliente]))
                    @php($libre->push(1))
                    @if($ki == "País CLF" && !isset($arrayPaises[$posPais]))
                        <td class="bg-danger">{{  $vi }}</td>
                    @elseif($ki == "Material" && !isset($arrayProducto[$posProducto]))
                        <td class="bg-danger">{{  $vi }}</td>
                    @elseif($ki == "Cliente" && !isset($arrayCliente[$posCliente]))
                        <td class="bg-danger">{{  $vi }}</td>
                    @elseif($ki == "Estatus")
                        <td class="bg-danger">Error</td>
                    @elseif($ki == "ClPed")
                        <td class="bg-danger">Error</td>
                    @else
                        <td class="bg-success">{{ $vi }}</td>
                    @endif
                @else
                    @php($estatus = $ki == "Estatus" ? "Libre"  : $vi)
                    <td class="bg-success">{{ $estatus }}</td>
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
