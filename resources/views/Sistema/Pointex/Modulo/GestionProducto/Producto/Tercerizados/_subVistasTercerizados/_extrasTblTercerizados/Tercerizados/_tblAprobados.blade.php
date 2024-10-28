<table id="datatable"
       class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer"
       cellspacing="0">
    <thead class="thead-dark">
    <tr class="headings">
        <th class="column-title no-link last" style="text-align: center">Pais</th>
        <th class="column-title no-link last" style="text-align: center">Distribuidor</th>
        <th class="column-title no-link last" style="text-align: center">Producto</th>
        <th class="column-title no-link last" style="text-align: center">Fecha</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tercerizadosAprobacion as $value)
        @php($kd = $value->first())
        <tr>
            <td class="last" align="center">{{$kd->Pais}}</td>
            <td class="last" align="center">{{$kd->Distribuidor}}</td>
            <td>
                <ul class="list-group-flush">
                    @php($listaProductos = $value->pluck("DescripcionSap")->filter()->join("</li><li>"))
                    <strong>
                        <li>{!! $listaProductos !!}</li>
                    </strong>
                </ul>
            </td>
            <td class="last" align="center">{{$kd->Fecha}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
