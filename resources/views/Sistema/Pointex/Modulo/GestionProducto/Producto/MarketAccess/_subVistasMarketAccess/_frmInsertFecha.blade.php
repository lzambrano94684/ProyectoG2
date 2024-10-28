<section id="simple-table">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Listado de Productos Market Access</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <table
                            class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer"
                            cellspacing="0">
                            <thead class="thead-dark">
                            <tr class="headings">
                                <th class="column-title no-link last" style="text-align: center">Producto</th>
                                <th class="column-title no-link last" style="text-align: center">Fecha de inicio</th>
                                <th class="column-title no-link last" style="text-align: center">Fecha fin</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataDetalle as $kd)
                                <tr>
                                    <td class="last" align="center">{{$kd->DescripcionSap}}</td>
                                    <td class="last" align="center">
                                        <input  class="form-control border-primary myFont" type="date" name="txtFechaInicio_{{$kd->Id}}"
                                               id="txtFechaInicio_{{$kd->Id}}" value="{{$kd->FechaInicio}}" onchange="enviaFecha('{{$kd->Id}}',this.value,'I');">
                                    </td>
                                    <td class="last" align="center">
                                        <input class="form-control border-primary myFont" type="date" name="txtFechaFin_{{$kd->Id}}" id="txtFechaFin_{{$kd->Id}}"
                                               value="{{$kd->FechaFinalizacion}}" onchange="enviaFecha('{{$kd->Id}}',this.value,'F');">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table><br>
                        <div class="form-actions">
                            <a type="button" class="btn btn-raised btn-warning mr-1"
                               href="{{  url()->current() }}">
                                <i class="ft-arrow-left"></i> Regresar
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
