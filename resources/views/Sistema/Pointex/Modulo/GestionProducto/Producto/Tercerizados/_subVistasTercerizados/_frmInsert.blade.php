<div class="row ">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="/pointex/gestion/tercerizados" class="btn btn-flat btn-warning">
                    <i class="fas fa-long-arrow-alt-left"></i> Regresar
                </a>
            </div>
            <div class="card-content">
                <div class="px-3">
                    <div class="form-body">
                        <form action="/pointex/gestion/tercerizados/crear" id="frmEncabezado" method="post">
                            <input type="hidden" name="txtIdEncabezado" id="txtIdEncabezado" value="{{ $id }}">
                            @csrf
                            <h4 class="form-section"><i class="far fa-file-alt"></i><b>Productos Tercerizados</b></h4>

{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-md-3 label-control" for="txtCodigo">MES: </label>--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            {!! $cmbMes!!}--}}
{{--                                        </div>--}}
{{--                                        <label class="col-md-2 label-control" for="cmbMoneda">AÑO: </label>--}}
{{--                                        <div class="col-md-3"><input type="number" class="form-control"--}}
{{--                                                                     max="{{ date("Y") }}" min="2020"--}}
{{--                                                                     value="{{$anio}}" name="txtAnio" id="txtAnio"--}}
{{--                                                                     autocomplete="off">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-5">--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-md-3 label-control" for="cmbEntidad">País: </label>--}}
{{--                                        <div class="col-md-9">--}}
{{--                                            {!! $cmbPais !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="txtCodigo">Distribuidor: </label>
                                        <div class="col-md-9">
                                                {!! $cmbDistribuidor!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active"
                                   aria-controls="active" aria-expanded="true"><i class="fas fa-sitemap"></i>
                                    Detalle</a>
                            </li>
                        </ul>
                        <div class="tab-content px-1 pt-1">
                            <div role="tabpanel" class="tab-pane show active" id="active" aria-labelledby="active-tab"
                                 aria-expanded="true">
                                <div style="overflow-x:auto;">
                                    @if($id)
                                    <table id="example" class="table table-striped col-md-12 font-small-1">
                                        <thead class="darken-4 bg-dark text-white">
                                        <tr>
                                            <th></th>
                                            <th class="text-center">Producto</th>
                                            <th class="text-center">Fecha Inicio</th>
                                            <th class="text-center">Fecha Finalizacion</th>
                                            <th class="text-center"></th>
                                        </tr>
                                        </thead>
                                        <thead class="darken-4 bg-white">
                                        <tr>
                                                <form action="/pointex/gestion/tercerizados/save_detalle"
                                                      method="post" class="frmDetalle" id="frmDetalle"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="txtIdEncabezado" id="txtIdEncabezado" value="{{ $id }}">
                                                    <td>
                                                        <a href="javascript:void(0)" id="btnClear"
                                                           class="btn btn-flat btn-success">
                                                            <i class="ft-refresh-ccw"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {!! $cmbProducto!!}
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control border-primary myFont"
                                                               tabindex="5" placeholder="Fecha Factura"
                                                               name="txtFechaInicio" id="txtFechaInicio"
                                                               max="" required/>
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control border-primary myFont"
                                                               tabindex="5" placeholder="Fecha Factura"
                                                               name="txtFechaFin" id="txtFechaFin"
                                                               max=""/>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-flat btn-success"
                                                                tabindex="14"><i class="fas fa-save"></i> Guardar
                                                        </button>
                                                    </td>
                                                </form>
                                        </tr>
                                        </thead>
                                            <tbody class="darken-4 bg-light text-dark">
                                            @foreach($detalleTercerizados as $kd)
                                                <tr>
                                                    <td class="last" align="center">
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-flat btn-danger"
                                                           onclick="deleteDetalleT('{{ $kd->Id }}')">
                                                            <i class="ft-minus"></i>
                                                            <div></div>
                                                        </a>
                                                    </td>
                                                    <td class="last" align="center">{{$kd->DescripcionSap}}</td>
                                                    <td class="last" align="center">
                                                        <input class="form-control border-primary myFont" type="date"
                                                               name="txtFechaInicio_{{$kd->Id}}"
                                                               id="txtFechaInicio_{{$kd->Id}}"
                                                               value="{{$kd->FechaInicio}}"
                                                               onchange="enviaFecha('{{$kd->Id}}',this.value,'I');"
                                                               required>
                                                    </td>
                                                    <td class="last" align="center">
                                                        <input class="form-control border-primary myFont" type="date"
                                                               name="txtFechaFin_{{$kd->Id}}"
                                                               id="txtFechaFin_{{$kd->Id}}"
                                                               value="{{$kd->FechaFinalizacion}}"
                                                               onchange="enviaFecha('{{$kd->Id}}',this.value,'F');"
                                                               required>
                                                    </td>
                                                    <td class="last" align="center">
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot class="darken-4 bg-dark text-white">
                                            <tr>
                                            </tr>
                                            </tfoot>
                                    </table>
                                    @else
                                        <div class="alert alert-warning alert-dismissible fade show"
                                             role="alert" id="tableUsers">
                                            <div class="text"><i class="fa fa-database"></i> No cuenta con
                                                productos asignados
                                            </div>
                                            <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                <span aria-hidden="true" class="la la-close"></span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('jsExtras')
    <script type="text/javascript">
        var cmbDistribuidor = $("#cmbDistribuidor");
        $("#cmbDistribuidor").on("change", function () {
            var inputEncabezado = [cmbDistribuidor.val()];
            if ($.inArray("", inputEncabezado) == -1 && $.inArray(null, inputEncabezado) == -1) {
                envia_encabezado(txtIdEncabezado, frmEncabezado)
            }
        });

        function deleteDetalleT(id) {
            swal({
                title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deseo Eliminarlo!',
                cancelButtonText: 'No',
            }).then(function (isConfirm) {
                if (isConfirm) {
                    url = '/pointex/gestion/tercerizados/delete_detalle/' + id;
                    redirect()
                }
            });
        }

    </script>
@endsection

{{--<section id="configuration">--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-content">--}}
{{--                    <div class="card-body">--}}
{{--                        <legend class="fieldset-marco text-muted"><h4 class="form-section"><i--}}
{{--                                    class="ft-file-text"></i> @if(isset($titleMsg)){{$titleMsg}}@endif</h4></legend>--}}
{{--                        <form id="formNotaSalesExpenses" name="formNotaSalesExpenses" method="POST"--}}
{{--                              action="/pointex/gestion/tercerizados/crear" enctype="multipart/form-data">--}}
{{--                            <input type="hidden" id="txtId" name="txtId" value="{{$id}}">--}}
{{--                            @csrf--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <label class="text-info required" for="cmbDistribuidor">Seleccione--}}
{{--                                        el mes:</label>--}}
{{--                                    {!! $cmbMes!!}--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <label class="text-info required" for="cmbDistribuidor"></label>--}}

{{--                                </div>--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <label class="text-info required" for="cmbPais">Seleccione País:</label>--}}
{{--                                    {!! $cmbPais !!}--}}
{{--                                </div>--}}

{{--                                @if($id)--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <label class="text-info required" for="cmbDistribuidor">Seleccione--}}
{{--                                            Distribuidor:</label>--}}
{{--                                        {!! $cmbDistribuidor!!}--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <label class="text-info required" for="cmbDistribuidor">Seleccione--}}
{{--                                            los Productos:</label>--}}
{{--                                        {!! $cmbProducto!!}--}}
{{--                                    </div>--}}

{{--                                @else--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <label class="text-info required" for="cmbDistribuidor">Seleccione--}}
{{--                                            Distribuidor:</label>--}}
{{--                                        <select id="cmbDistribuidor" name="cmbDistribuidor" class="select2_single"--}}
{{--                                                required>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <label class="text-info required" for="cmbDistribuidor">Seleccione--}}
{{--                                            los Productos:</label>--}}
{{--                                        <select id="cmbProducto" name="cmbProducto[]" class="select2_single" multiple>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}

{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <br>--}}

{{--                        @if($id)--}}
{{--                            {!!$detalleTercerizados!!}--}}
{{--                        @endif--}}
{{--                        <!--footer -->--}}
{{--                            <div class="form-actions">--}}
{{--                                <a type="button" class="btn btn-raised btn-warning mr-1"--}}
{{--                                   href="{{  url()->current() }}">--}}
{{--                                    <i class="ft-arrow-left"></i> Regresar--}}
{{--                                </a>--}}
{{--                                <button class="btn btn-raised btn-primary" id="Idbtn" onclick="ShowSelected();">--}}
{{--                                    <i class="ft-save"></i> Guardar--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}


