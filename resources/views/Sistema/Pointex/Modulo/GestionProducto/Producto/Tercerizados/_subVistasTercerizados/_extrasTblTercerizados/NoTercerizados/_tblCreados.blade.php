{{--<table class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer"--}}
{{--       cellspacing="0">--}}
{{--    <thead class="thead-dark">--}}
{{--    <tr class="headings">--}}
{{--        <th class="column-title no-link last" style="text-align: center"><span class="nobr">ACCIONES</span></th>--}}
{{--        <th class="column-title no-link last" style="text-align: center">Pais</th>--}}
{{--        <th class="column-title no-link last" style="text-align: center">Distribuidor</th>--}}
{{--        <th class="column-title no-link last" style="text-align: center">Fecha</th>--}}
{{--        <th class="column-title no-link last" style="text-align: center">Estatus</th>--}}
{{--        <th class="column-title no-link last" style="text-align: center">Producto</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($NotercerizadosCreados as $value)--}}
{{--        @php($kd = $value->first())--}}
{{--        <tr class="">--}}
{{--            <td class="last" align="center">--}}
{{--                <a href="/pointex/gestion/tercerizados?{{ base64_encode("editFecha=$kd->Id") }}">--}}
{{--                    <i class="fa fa-calendar" aria-hidden="true"></i>--}}
{{--                </a>--}}
{{--            </td>--}}
{{--                <td class="last" align="center">{{$kd->Pais}}</td>--}}
{{--                <td class="last" align="center">{{$kd->Distribuidor}}</td>--}}
{{--                <td class="last" align="center">{{$kd->Fecha}}</td>--}}
{{--                <td class="last" align="center">--}}
{{--                    <ol class="list-group-flush">--}}
{{--                        @php($listaProductos = $value->pluck("DescripcionSap")->filter())--}}
{{--                        @foreach($listaProductos as $v)--}}
{{--                            <strong>--}}
{{--                                    <li>--}}
{{--                                        <a>--}}
{{--                                            <i class="fas fa-toggle-off danger"></i>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </strong>--}}
{{--                        @endforeach--}}
{{--                    </ol>--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    @php($listaProductos = $value->pluck("DescripcionSap")->filter()->join("</li><li>"))--}}
{{--                    <ul class="list-group-flush">--}}
{{--                        <strong>--}}
{{--                            <li>{!! $listaProductos !!}</li>--}}
{{--                        </strong>--}}
{{--                    </ul>--}}
{{--                </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}


<table
    class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer"
    cellspacing="0">
    <thead class="thead-dark">
    <tr class="headings">
        <th class="column-title no-link last" style="text-align: center"><span class="nobr">ACCIONES</span></th>
        <th class="column-title no-link last" style="text-align: center">Pais</th>
        <th class="column-title no-link last" style="text-align: center">Distribuidor</th>
        <th class="column-title no-link last" style="text-align: center">Estatus</th>
        <th class="column-title no-link last" style="text-align: center">Producto</th>
    </tr>
    </thead>
    <tbody>
    {{--    @foreach($tercerizadosAprobacion as $value)--}}
    @foreach($tercerizadosAprobacionTNo as $value)
        @php($kd = $value->first())
        <tr class="">
            <td class="last" align="center"><br>
                <a href="/pointex/gestion/tercerizados?{{ base64_encode("edit=$kd->Id") }}">
                    <i class="ft-edit-2"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                {{--                <a href="/pointex/gestion/tercerizados?{{ base64_encode("editFecha=$kd->Id") }}">--}}
                {{--                    <i class="fa fa-calendar" aria-hidden="true"></i>--}}
                {{--                </a>--}}
                {{--                <br><br>--}}
                <a href="javascript:void(0)" class="eventoClickElimina"
                   id="{{ $kd->Id }}">
                    <i class="ft-trash danger"></i>
                </a>
            </td>
            <td class="last" align="center">{{$kd->Pais}}</td>
            <td class="last" align="center">{{$kd->Distribuidor}}</td>
            <td class="last" align="center">
                <ol class="list-group-flush">
                    @php($listaIdDetalle = $value->pluck("IdDetalle")->filter())
                    @foreach($listaIdDetalle as $v)
                        <strong>
                            <li>
{{--                                <a href="javascript:void(0)"--}}
{{--                                   title="Cambiar a Producto no Tercerizado"--}}
{{--                                   id="{{ base64_encode("cambiarProducto=$v") }}"--}}
{{--                                   class="cambiar">--}}
                                    <i class="fas fa-toggle-off danger"></i>
{{--                                </a>--}}
                            </li>
                        </strong>
                    @endforeach
                </ol>
            </td>
            <td>
                <ul class="list-group-flush">
                    @php($listaProductos = $value->pluck("DescripcionSap")->filter()->join("</li><li>"))
                    <strong>
                        <li>{!! $listaProductos !!}</li>
                    </strong>
                </ul>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
