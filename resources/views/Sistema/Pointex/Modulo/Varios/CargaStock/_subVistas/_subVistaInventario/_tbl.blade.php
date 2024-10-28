<div class="col-md-8">
    <b class="text-danger">Plantilla ideal para la carga del archivo</b>
    <div id="aguarda">
    &nbsp;&nbsp;<a href="{{ url()->current() }}?guardar_i=1&tipo_venta={{ $tipoVenta }}" title="Guardar la Información"><i class="far fa-save"></i></a>
    </div>
    <table class="table  text-center datatablePointerUnic2">
        <thead class="text-white bg-blue">
        <tr>
            <th class="column-title">Producto Exeltis</th>
            <th class="column-title">Codigo Producto</th>
            <th class="column-title">Nombre Producto</th>
            <th class="column-title">Lote</th>
            <th class="column-title">Vencimiento</th>
            <th class="column-title">Inv. Inicial</th>
            <th class="column-title">Unidades Facturadas</th>
            <th class="column-title">Ingresos Compras</th>
            <th class="column-title">Ingreso Devolución</th>
            <th class="column-title">Bonificaciones</th>
            <th class="column-title">Ajustes</th>
            <th class="column-title">Inv. Final</th>
            <th class="column-title">Costo Bodega Unitario</th>
            <th class="column-title">TipoBodega</th>
            <th class="column-title">Clasificacion</th>
        </tr>
        </thead>

        <tbody>
        @if($dataInv)
            @php($arrayInvIn = [])
            @php($arrayUnFac = [])
            @php($arrayInCom = [])
            @php($arrayInDev = [])
            @php($arrayBon = [])
            @php($arrayAjus = [])
            @php($arrayInvFin = [])
            @foreach($dataInv as $k=> $v)
                <?php try {?>
                @php($descripcion = $thisIn->validaCampo("i", $dataClienteInv, 'NombreProducto', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento))
                {{--{{ dd($headInv, $dataClienteInv->UnidadesFac) }}--}}
                @if($descripcion && $k > $inicioInv)
                    @php($producto = isset($v->productoExe) ? $v->productoExe : null)
                    <tr class="{{ !$producto ? "darken-4 bg-danger tbError" : null }}">
                        <td>{!! !$producto ? '<a href="/pointex/gestion/catalogos/UFhfQklfUHJvZHVjdG9EaXN0cmlidWlkb3I=" title="Agregar" class="text-white"><i class="fab fa-google-plus-g"></i></a>' : $producto !!}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'CodigoProducto', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $descripcion }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'Lote', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'Vencimiento', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'InvInicial', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'UnidadesFac', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'IngresoCompras', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'IngresoDevolucion', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'Bonificaciones', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'Ajustes', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'InvFinal', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'CostoBodegaUni', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'TipoBodega', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        <td>{{ $thisIn->validaCampo("i", $dataClienteInv, 'Clasificacion', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento) }}</td>
                        @php($arrayInvIn[] = $thisIn->validaCampo("i", $dataClienteInv, 'InvInicial', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento))
                        @php($arrayUnFac[] = $thisIn->validaCampo("i", $dataClienteInv, 'UnidadesFac', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento))
                        @php($arrayInCom[] = $thisIn->validaCampo("i", $dataClienteInv, 'IngresoCompras', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento))
                        @php($arrayInDev[] = $thisIn->validaCampo("i", $dataClienteInv, 'IngresoDevolucion', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento))
                        @php($arrayBon[] = $thisIn->validaCampo("i", $dataClienteInv, 'Bonificaciones', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento))
                        @php($arrayAjus[] = $thisIn->validaCampo("i", $dataClienteInv, 'Ajustes', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento))
                        @php($arrayInvFin[] = $thisIn->validaCampo("i", $dataClienteInv, 'InvFinal', $headInv, $v, $dataClienteInv->FormatoFechaVencimiento))
                    </tr>

                @endif
                <?php
                } catch (\Exception $e){
                    dd($e->getMessage());
                }
                ?>
            @endforeach
        @endif
        </tbody>
        <tfoot class="text-white bg-blue">
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ number_format(array_sum($arrayInvIn),2) }}</td>
            <td>{{ number_format(array_sum($arrayUnFac),2) }}</td>
            <td>{{ number_format(array_sum($arrayInCom),2) }}</td>
            <td>{{ number_format(array_sum($arrayInDev),2) }}</td>
            <td>{{ number_format(array_sum($arrayBon),2) }}</td>
            <td>{{ number_format(array_sum($arrayAjus),2) }}</td>
            <td>{{ number_format(array_sum($arrayInvFin),2) }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tfoot>
    </table>
</div>
