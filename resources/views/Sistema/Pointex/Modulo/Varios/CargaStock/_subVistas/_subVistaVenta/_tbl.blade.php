<div class="col-md-8">
    <b class="text-danger">Plantilla ideal para la carga del archivo</b>
    <div id="aguarda">
    &nbsp;&nbsp;<a href="{{ url()->current() }}?guardar_v=1&tipo_venta={{ $tipoVenta }}"  title="Guardar la Información"><i
            class="far fa-save"></i></a>
    </div>
    <table class="table  text-center datatablePointerUnic">
        <thead class="text-white bg-blue">
        <tr>
            <th>ProductoExeltis</th>
            @foreach($EncabezadoVemta as $kv => $vv)
                <th class="column-title">{{ $kv }}</th>
            @endforeach
        </tr>
        </thead>

        <tbody>
        @if($data)
            @php($arrayTotalBru = [])
            @php($arrayValML = [])
            @php($arrayValDlB = [])
            @php($arrayuB = [])
            @php($arrayDescMl = [])
            @php($arrayUnDev = [])
            @php($arrayValMlDev = [])
            @php($arrayUnNet = [])
            @php($arrayVtaNetMl = [])
            @foreach($data as $k=> $v)
                <?php try {?>
                @if($k > $inicio)
                    @php($producto = isset($v->productoExe) ? $v->productoExe : null)
                    <tr class="{{ !$producto ? "darken-4 bg-danger tbError" : null }}">
                        <td>{!! !$producto ? '<a href="/pointex/gestion/catalogos/UFhfQklfUHJvZHVjdG9EaXN0cmlidWlkb3I=" title="Agregar" class="text-white"><i class="fab fa-google-plus-g"></i></a>' : $producto !!}</td>
                        @foreach($EncabezadoVemta as $kvv => $vvv)
                            @if($kvv == "UnidadesBrutas")
                                @php($arrayTotalBru[] = $thisIn->validaCampo("v", $dataCliente, $kvv, $head, $v, null))
                            @elseif($kvv == "ValorMonedaLocal")
                                @php($arrayValML[] = $thisIn->validaCampo("v", $dataCliente, $kvv, $head, $v, null))
                            @elseif($kvv == "ValorDolaresBruto")
                                @php($arrayValDlB[] = $thisIn->validaCampo("v", $dataCliente, $kvv, $head, $v, null))
                            @elseif($kvv == "UnidadesBon")
                                @php($arrayuB[] = $thisIn->validaCampo("v", $dataCliente, $kvv, $head, $v, null))
                            @elseif($kvv == "DescuentosML")
                                @php($arrayDescMl[] = $thisIn->validaCampo("v", $dataCliente, $kvv, $head, $v, null))
                            @elseif($kvv == "UnidadesDevoluciones")
                                @php($arrayUnDev[] = $thisIn->validaCampo("v", $dataCliente, $kvv, $head, $v, null))
                            @elseif($kvv == "ValorMLDevoluciones")
                                @php($arrayValMlDev[] = $thisIn->validaCampo("v", $dataCliente, $kvv, $head, $v, null))
                            @elseif($kvv == "UnidadesNetas")
                                @php($arrayUnNet[] = $thisIn->validaCampo("v", $dataCliente, $kvv, $head, $v, null))
                            @elseif($kvv == "VentaNetaML")
                                @php($arrayVtaNetMl[] = $thisIn->validaCampo("v", $dataCliente, $kvv, $head, $v, null))
                            @endif
                            <td>{{ $thisIn->validaCampo("v", $dataCliente, $kvv, $head, $v, null) }}</td>
                        @endforeach
                    </tr>
                @endif
                <?php
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
                ?>
            @endforeach
        @endif
        </tbody>
        <tfoot class="text-white bg-blue">
        <tr>
            <td></td>
            @foreach($EncabezadoVemta as $kvv => $vvv)
                @if($kvv == "UnidadesBrutas")
                    <td>{{ number_format(array_sum($arrayTotalBru),2) }}</td>
                @elseif($kvv == "ValorMonedaLocal")
                    <td>{{ number_format(array_sum($arrayValML),2) }}</td>
                @elseif($kvv == "ValorDolaresBruto")
                    <td>{{ number_format(array_sum($arrayValDlB),2) }}</td>
                @elseif($kvv == "UnidadesBon")
                    <td>{{ number_format(array_sum($arrayuB),2) }}</td>
                @elseif($kvv == "DescuentosML")
                    <td>{{ number_format(array_sum($arrayDescMl),2) }}</td>
                @elseif($kvv == "UnidadesDevoluciones")
                    <td>{{ number_format(array_sum($arrayUnDev),2) }}</td>
                 @elseif($kvv == "ValorMLDevoluciones")
                    <td>{{ number_format(array_sum($arrayValMlDev),2) }}</td>
                @elseif($kvv == "UnidadesNetas")
                    <td>{{ number_format(array_sum($arrayUnNet),2) }}</td>
                @elseif($kvv == "VentaNetaML")
                    <td>{{ number_format(array_sum($arrayVtaNetMl),2) }}</td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
        </tfoot>
    </table>
</div>
