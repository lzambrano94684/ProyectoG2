{{--<div class="card">--}}
{{--    <div class="card-content">--}}
{{--        <div class="card-body">--}}
{{--            <div class="table-responsive">--}}
{{--                @if($data->count()>0)--}}
{{--                    <table id="datatable-market"--}}
{{--                           class="table custom-table table-striped table-bordered table-hover table-condensed nowrap align='left'"--}}
{{--                           cellspacing="0" style="width: 100%;">--}}
{{--                        <thead class="darken-4 bg-dark text-white">--}}
{{--                        <tr class="headings">--}}
{{--                            <th class="column-title"></th>--}}
{{--                            <th class="column-title">SKU</th>--}}
{{--                            <th class="column-title">Producto</th>--}}
{{--                            <th class="column-title">PrecioVF</th>--}}
{{--                            <th class="column-title">UnidadesNetas</th>--}}
{{--                            <th class="column-title">VentaNeta</th>--}}
{{--                            <th class="column-title">TipoVenta</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($data as $value)--}}
{{--                            <tr>--}}
{{--                                <td></td>--}}
{{--                                <td>{{$value->SKU}}</td>--}}
{{--                                <td>{{$value->Presentacion}}</td>--}}
{{--                                <td>{{number_format($value->PrecioVF,2)}}</td>--}}
{{--                                <td>{{$value->UnidadesNetas}}</td>--}}
{{--                                <td>{{number_format($value->VentaNeta,2)}}</td>--}}
{{--                                <td>{{$value->TipoVenta}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                @else--}}
{{--                    <div class="alert alert-warning alert-dismissible fade show"--}}
{{--                         role="alert" id="tableUsers">--}}

{{--                        <div class="text"><i class="fa fa-database"></i> La consulta no gener&oacute;--}}
{{--                            resultados.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<section id="simple-table">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Listado de Productos</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($data->count()>0)
                            <table id="MarketAccess"
                                class="table text-center"
                                cellspacing="0">
                                <thead class="thead-dark">
                                <tr class="headings">
{{--                                    <th class="column-title no-link last" style="text-align: center"></th>--}}
{{--                                    <th class="column-title no-link last" style="text-align: center">Distribuidor</th>--}}
{{--                                    <th class="column-title no-link last" style="text-align: center">farmacia</th>--}}
                                    <th class="column-title no-link last" style="text-align: center">&nbsp;&nbsp;&nbsp;Modificar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th class="column-title no-link last" style="text-align: center">Distribuidor</th>
                                    <th class="column-title no-link last" style="text-align: center">Farmacia</th>
                                    <th class="column-title no-link last" style="text-align: center">SKU</th>
                                    <th class="column-title no-link last" style="text-align: center">Producto</th>
                                    <th class="column-title no-link last" style="text-align: center">PrecioVF</th>
                                    <th class="column-title no-link last" style="text-align: center">UnidadesNetas</th>
                                    <th class="column-title no-link last" style="text-align: center">VentaNeta</th>
                                    <th class="column-title no-link last" style="text-align: center">TipoVenta</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $value)
                                    <tr class="">
{{--                                        <td class="last" align="center"></td>--}}
{{--                                        <td class="last" align="center">{{$value->IdDistribuidor}}</td>--}}
{{--                                        <td class="last" align="center">{{$value->IdFarmaciaDepurado}}</td>--}}
                                        <td>
                                            <select class="form-control">
                                                <option {{$value->TipoVenta == "Venta" ? "selected=".true."":""}} value="Venta" onclick="UpdateTipo('{{$value->Id}}','Venta');">Venta</option>
                                                <option {{$value->TipoVenta == "Venta Inst" ? "selected=".true."":""}} value="Venta Inst" onclick="UpdateTipo('{{$value->Id}}','Venta Inst');">Venta Inst</option>
                                            </select>
                                        </td>
                                        <td class="last" align="center">{{$value->Distribuidor}}</td>
                                        <td class="last" align="center">{{$value->Farmacia}}</td>
                                        <td class="last" align="center">{{$value->SKU}}</td>
                                        <td class="last" align="center">{{$value->Presentacion}}</td>
                                        <td class="last" align="center">{{number_format($value->PrecioVF,2)}}</td>
                                        <td class="last" align="center">{{$value->UnidadesNetas}}</td>
                                        <td class="last" align="center">{{number_format($value->VentaNeta,2)}}</td>
                                        <td class="last" align="center">
                                            <p id="{{$value->Id}}">{{$value->TipoVenta}}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
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
