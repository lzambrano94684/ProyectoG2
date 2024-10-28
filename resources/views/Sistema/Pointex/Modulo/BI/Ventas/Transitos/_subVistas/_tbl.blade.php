<section class="basic-select">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3">
                            <h4 class="card-title mb-0">Tabla de Transitos</h4>
                        </div>
                        <div class="col-3">
                        </div>
                        <div class="col-3">
                        </div>
                        <div class="col-3">
                            <fieldset class="form-group">
                                <a onclick="Confirmar();"
                                   class="form-control text-white btn btn-success">
                                    <i class="fas fa-random text-white"></i>
                                    Confirmar Transitos
                                </a>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <table class="table  table-striped table-hover" id="example">
                            <thead class="text-white bg-dark">
                            <tr>
                                <th>Acciones</th>
                                <th class="column-title">Fecha Cierre</th>
                                <th class="column-title">Pais</th>
                                <th class="column-title">Nombre CLiente</th>
                                <th class="column-title">Factura</th>
                                <th class="column-title">Factura FEL</th>
                                <th class="column-title">Fecha Factura</th>
                                <th class="column-title">No Pedido</th>
                                <th class="column-title">Origen Despacho</th>
                                <th class="column-title">Ingreso Bodega</th>
                                <th class="column-title">Ingreso Sistema</th>
                                <th class="column-title">Fecha Despacho</th>
                                <th class="column-title">Transito</th>
                                <th class="column-title">Comentarios</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($dataTransitos->count() > 0)
                                @foreach($dataTransitos as $kvv => $vvv)
                                    <tr class="darken-4 bg-warning">
                                        <td class="text-center">
                                            <a href="{{ url()->current() }}?{{ base64_encode("editar=$vvv->Id") }}"
                                               title="Agregar">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </td>
                                        <td>{{ $vvv->Fecha }}</td>
                                        <td>{{ $vvv->Pais }}</td>
                                        <td>{{ $vvv->Dist }}</td>
                                        <td>{{ $vvv->Referencia }}</td>
                                        <td>{{ $vvv->Factura }}</td>
                                        <td>{{ $vvv->FechaFactura }}</td>
                                        <td>{{ $vvv->NPedidoCliente }}</td>
                                        <td>{{ $vvv->ODespacho }}</td>
                                        <td>{{ $vvv->FechaIngresoBodega }}</td>
                                        <td>{{ $vvv->FechaIngresoSistema }}</td>
                                        <td>{{ $vvv->FechaDespacho }}</td>
                                        <td>{{ $vvv->Transito }}</td>
                                        <td>{{ $vvv->Comentarios }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            @if($data->count() > 0)
                                @foreach($data as $kvv => $vvv)
                                    <tr>
                                        <td>
                                            @if(!$vvv->Estatus)
                                                <a href="JavaScript:void(0);" class="black p-0"
                                                   data-original-title="Eliminar" title="Quitar de Transito"
                                                   onclick="Eliminar('{{$vvv->Id}}')">
                                                    <i class="ft-x font-medium-3 mr-2"
                                                       style="color: #008b8e"></i>
                                                </a>
                                                &nbsp
                                                <a href="{{ url()->current() }}?{{ base64_encode("editar=$vvv->Id") }}">
                                                    <i class="ft-edit-2"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ $vvv->Fecha }}</td>
                                        <td>{{ $vvv->Pais }}</td>
                                        <td>{{ $vvv->Dist }}</td>
                                        <td>{{ $vvv->Referencia }}</td>
                                        <td>{{ $vvv->Factura }}</td>
                                        <td>{{ $vvv->FechaFactura }}</td>
                                        <td>{{ $vvv->NPedidoCliente }}</td>
                                        <td>{{ $vvv->ODespacho }}</td>
                                        <td>{{ $vvv->FechaIngresoBodega }}</td>
                                        <td>{{ $vvv->FechaIngresoSistema }}</td>
                                        <td>{{ $vvv->FechaDespacho }}</td>
                                        <td>{{ $vvv->Transito }}</td>
                                        <td>{{ $vvv->Comentarios }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
