@if($reporte)
    <a href="/pointex/gestion/regulatorio/crear_listar" class="btn btn-flat btn-warning">
        <i class="fas fa-long-arrow-alt-left"></i> Regresar
    </a>
@endif
<section id="shopping-cart">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $subTitulo }}</h4>
                    @if($reporte)
                        <p class="card-text">A continuación un listado de los Registros Sanitarios que vencerán en los
                            últimos 6 meses
                        </p>
                    @else
                        <p class="card-text">A continuación un listado de los Registros Sanitarios creados, si deseas
                            crear
                            uno nuevo por favor dar click
                            <a class="btn btn-flat btn-danger"
                               href="{{  "/pointex/gestion/regulatorio/crear_listar?".base64_encode("registroSanitario=1&crear=1") }}">aqui</a>
                        </p>
                    @endif
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($modelRegistroSanitario->count()>0)
                            <table class="table  datatablePointer">
                                <thead class="text-center">
                                <tr class="headings darken-4 bg-dark">
                                    <th class="column-title th-acciones" style="width: 110px">ACCIONES</th>
                                    <th class="column-title">NOMBRE</th>
                                    <th class="column-title">REGISTRO</th>
                                    <th class="column-title">PAÍS</th>
                                    <th class="column-title">ESTATUS</th>
                                    <th class="column-title">PERMISO COMERCIALIZACIÓN</th>
                                    <th class="column-title">FECHA VENCIMIENTO</th>
                                    <th class="column-title">TRAMITE CONTROL ESTATÁL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modelRegistroSanitario as $kmr => $vmr)
                                    <tr>
                                        <td class="text-center">
                                            @if($reporte)
                                                <a href="/pointex/gestion/regulatorio/crear_listar?{{ base64_encode("registroSanitario=1&ver=$vmr->Id") }}"
                                                   class="btn btn-flat btn-success overOrange aActiveModal tooltip-per"
                                                   data-frm="marca">
                                                    <i class="ft-eye"></i>
                                                    <span class="tooltiptext">¿Ver todos los datos <b>{{ $vmr->NoRegistroSanitario }}</b>?</span>
                                                </a>
                                            @else
                                                <a href="/pointex/gestion/regulatorio/crear_listar?{{ base64_encode("registroSanitario=1&editar=$vmr->Id") }}"
                                                   class="btn btn-flat btn-info overOrange aActiveModal tooltip-per"
                                                   data-frm="marca">
                                                    <i class="ft-edit-2"></i>
                                                    <span class="tooltiptext">¿Modificar el registro <b>{{ $vmr->NoRegistroSanitario }}</b>?</span>
                                                </a>
                                                <a href="/pointex/gestion/regulatorio/crear_listar?{{ base64_encode("registroSanitario=1&ver=$vmr->Id") }}"
                                                   class="btn btn-flat btn-success overOrange aActiveModal tooltip-per"
                                                   data-frm="marca">
                                                    <i class="ft-eye"></i>
                                                    <span class="tooltiptext">¿Ver todos los datos <b>{{ $vmr->NoRegistroSanitario }}</b>?</span>
                                                </a>
                                                <a onclick="deleteRegSanitario('{{$vmr->Id}}','{{$vmr->NoRegistroSanitario}}')"
                                                   href="javascript:void(0);"
                                                   class="btn btn-flat btn-danger overOrange tooltip-per deleteMarca">
                                                    <i class="ft-trash"></i>
                                                    <span class="tooltiptext">¿Eliminar el Registro <b>{{ $vmr->NoRegistroSanitario }}</b>?</span>
                                                </a>
                                            @endif

                                        </td>
                                        <td>{{ trim($vmr->Nombre) }}</td>
                                        <td>{{ trim($vmr->NoRegistroSanitario) }}</td>
                                        <td>{{ isset($arrayPaises[$vmr->IdPais]) ? trim($arrayPaises[$vmr->IdPais]) : null }}</td>
                                        <td>{!! $vmr->IdEstatusName($arrayEstatus) !!}</td>
                                        <td class="text-center">{!! $vmr->TagPermisoComercializacion() !!}</td>
                                        <td class="text-center">{!! trim($vmr->fechaVencimientoCorrect()) !!}</td>
                                        <td class="text-center">{!! $vmr->TagTramiteControlEstatal() !!}</td>
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