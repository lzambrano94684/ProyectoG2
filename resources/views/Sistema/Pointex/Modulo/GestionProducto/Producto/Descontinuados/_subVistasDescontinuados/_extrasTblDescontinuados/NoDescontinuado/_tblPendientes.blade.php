<table class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer"
       cellspacing="0">
    <thead class="thead-dark">
    <tr class="headings">
        <th class="column-title no-link last" style="text-align: center">Pais</th>
        <th class="column-title no-link last" style="text-align: center">Distribuidor</th>
        <th class="column-title no-link last" style="text-align: center">Fecha</th>
        <th class="column-title no-link last" style="text-align: center">Producto</th>
    </tr>
    </thead>
    <tbody>
    @foreach($NodescontinuadosPendiente as $value)
        @php($kd = $value->first())
        <tr class="">
            <td class="last" align="center">{{$kd->Pais}}</td>
            <td class="last" align="center">{{$kd->Distribuidor}}</td>
            <td class="last" align="center">{{$kd->Fecha}}</td>
            <td>
                @php($listaProductos = $value->pluck("DescripcionSap")->filter()->join("</li><li>"))
                <ul class="list-group-flush">
                    <strong>
                        <li>{!! $listaProductos !!}</li>
                    </strong>
                </ul>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
