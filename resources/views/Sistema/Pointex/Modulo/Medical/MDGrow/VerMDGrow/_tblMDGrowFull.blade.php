<section id="simple-table">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Listado MDGROW</h4>
                    <p></p>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($MDGrow->count()>0)
                            <table class="table table-sm table-condensed table-borderless nowrap datatablePointer"
                                   style="width: 100% !important;">
                                <thead class="thead-inverse thead-dark">
                                <tr>
                                    <th><strong>Código</strong></th>
                                    <th><strong>Nombres</strong></th>
                                    <th><strong>Género</strong></th>
                                    <th><strong>Estado</strong></th>
                                    <th><strong>Especialidad</strong></th>
                                    <th><strong>País</strong></th>
                                    <th><strong>Celular</strong></th>
                                    <th><strong>Teléfono</strong></th>
                                    <th><strong>Correo</strong></th>
                                    <th><strong>No.Colegiado</strong></th>
                                    <th><strong>DirecciónConsultorio</strong></th>
                                    <th><strong>TeléfonoConsultorio</strong></th>
                                    <th><strong>Carga Firmada</strong></th>
                                    <th><strong>Consultorio Listo</strong></th>
                                    <th><strong>Fecha Consultorio</strong></th>
                                    <th><strong>Encuesta Satisfacción</strong></th>
                                    <th><strong>Observaciones</strong></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($MDGrow as $k => $data)
                                    <tr>
                                        <td>{{$data->Id}}</td>
                                        <td>{{$data->Nombres}}</td>
                                        @if($data->Genero == "M")
                                            <td>Masculino</td>
                                        @elseif($data->Genero == "F")
                                            <td>Femenino</td>
                                        @else
                                            <td>--</td>
                                        @endif
                                        <td>{{$data->Estado}}</td>
                                        <td>{{$data->Especialidad}}</td>
                                        <td>{{$data->Pais}}</td>
                                        <td>{{$data->NoCelular}}</td>
                                        <td>{{$data->Telefono}}</td>
                                        <td>{{$data->Correo}}</td>
                                        <td>{{$data->NoColegiado}}</td>
                                        <td>{{$data->Direccion}}</td>
                                        <td>{{$data->TelConsultorio}}</td>
                                        @if($data->CartaFirmada == "S")
                                            <td>SI</td>
                                        @else
                                            <td>No</td>
                                        @endif
                                        @if($data->ConsultorioListo == "S")
                                            <td>SI</td>
                                        @else
                                            <td>No</td>
                                        @endif
                                        <td>{{Carbon\Carbon::parse($data->FechaConsultorio)->format('d/m/Y')}}</td>
                                        <td>{{$data->EncuestaSatisfaccion}}</td>
                                        <td>{{$data->Observaciones}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
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
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
