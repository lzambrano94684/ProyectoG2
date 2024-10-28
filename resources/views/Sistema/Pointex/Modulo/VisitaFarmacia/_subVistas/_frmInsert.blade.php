<section id="striped-inverse">
    <div class="row">
        @if($consultaPlanificacion->count() > 0)
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Planificacion</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th>Observación</th>
                                    <th>Hora de Inicio</th>
                                    <th>Hora de finalización</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($consultaPlanificacion as $value)
                                    <tr>
                                        <td>{{$value->Descripcion}}</td>
                                        <td>
                                            <input type="time" name="HoraInicio{{$value->Id}}" id="HoraInicio{{$value->Id}}" class="form-control" value="{{str_replace(':00.00','',$value->HoraInicio)}}"/>
                                        </td>
                                        <td>
                                            <input type="time" name="HoraFin{{$value->Id}}" id="HoraFin{{$value->Id}}" class="form-control" value="{{str_replace(':00.00','',$value->HoraFin)}}"/>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-raised btn-raised btn-primary" onclick="Update('{{$value->Id}}');">
                                                <i class="fa fa-check-square-o"></i> Guardar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Datos de la Farmacia</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-group">

                                <li class="list-group-item list-group-item-warning">
                                    Dirección: {{ "$dataFichero->Direccion, $dataFichero->Municipio, $dataFichero->Depto" }}</li>
                                <li class="list-group-item list-group-item-warning">
                                    Farmacia: {{ "$dataFichero->NombreLargo" }}</li>
                                Volver a : <a href="/pointex/visita_medica/farmacia" class="btn btn-flat btn-danger">Bandeja
                                    de Visitas</a>
                                <a href="/pointex/visita_medica/farmacia/fichero"
                                   class="btn btn-flat btn-warning">Fichero</a>

                            </ul>
                        </div>

                        <div class="col-6">
                            <form class="form" @if(!$id) method="post"
                                  @endif action="/pointex/visita_medica/farmacia/guarda_visita">
                                @csrf
                                <input type="hidden" name="txtIdFichero" value="{{ $dataFichero->Id }}">
                                <input type="hidden" name="txtMedico" value="{{ base64_encode($medico) }}">
                                <input type="hidden" name="txtIdVisita" value="{{ $id }}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Tipo de Visita</label>
                                                <div class="input-group">
                                                    @if($tipoVisita->count() > 0)
                                                        @foreach($tipoVisita as $ktv => $vtv)
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="tipovisita{{ $ktv }}"
                                                                       value="{{ $ktv  }}"
                                                                       name="tipovisita"
                                                                       {{ $modelVisita->IdTipoVisita == $ktv ? "checked" : null}}
                                                                       class="custom-control-input">
                                                                <label class="custom-control-label"
                                                                       for="tipovisita{{ $ktv }}">{{ $vtv }}</label>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cmbAcompania">Acompañante</label>
                                                {!! $cmbAcompania !!}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txtDesc1">Comentario de Visita</label>
                                                <textarea id="txtDesc1" rows="2" class="form-control"
                                                          name="txtDesc1"> {{ $modelVisita->Descripcion }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txtDesc1">Objetivo Siguiente Visita</label>
                                                <textarea id="txtDesc2" rows="2" class="form-control"
                                                          name="txtDesc2"> {{ $modelVisita->Descripcion2 }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txtDesc1">Fecha de Visita</label>
                                                <input type="date" id="txtFechaVisita" name="txtFechaVisita" class="form-control"
{{--                                                       min="{{date('Y-m-d', strtotime(date('Y-m-d') . ' -2 day'))}}" --}}
                                                        min = "2022-08-01"
                                                       value="{{ $modelVisita->FechaVisita?$modelVisita->FechaVisita:date("Y-m-d") }}" max="{{date("Y-m-d")}}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @if(!$id)
                                    <div class="form-actions">
                                        <a href="{{ url()->previous() }}" type="button"
                                           class="btn btn-raised btn-raised btn-warning mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-raised btn-raised btn-primary">
                                            <i class="fa fa-check-square-o"></i> Guardar
                                        </button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@if($id)
    <section id="striped-inverse">
        <div class="row">
            @if($arrayMM->count() > 0)
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Entrega de Muestra Medica</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="post" action="/pointex/visita_medica/visita/guarda_mm">
                                    @csrf
                                    <input type="hidden" name="txtIdVisita" value="{{ $id }}">
                                    <table class="table table-striped table-dark">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Muestra</th>
                                            <th>Cantidad</th>
                                            <th>Guardar</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>{!! $cmbMM !!}</th>
                                            <th>
                                                <input type="number" min="0" class="form-control" required
                                                       name="txtCantidad"
                                                       id="txtCantidad">
                                            </th>
                                            <th>
                                                <button type="submit" class="btn btn-flat btn-primary" title="Guardar">
                                                    <i class="fa fa-save"></i>
                                                </button>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($entregaMM->count() > 0)
                                            @php($coutEm = 1)
                                            @foreach($entregaMM as $kem => $vem)
                                                <tr>
                                                    <th scope="row">{{ $coutEm }}</th>
                                                    <td>{{ isset($arrayMM[$vem->IdMuestra]) ? $arrayMM[$vem->IdMuestra] : null }}</td>
                                                    <td>{{ $vem->Cantidad }}</td>
                                                    <td>
                                                        <a href="/pointex/visita_medica/visita/borra_emm/{{ $vem->Id }}"
                                                           class="btn btn-flat btn-danger" title="Eliminar">
                                                            <i class="fas fa-minus"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @php($coutEm++)
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(/*$arrayPrpductos->count() > 0*/ true)
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Promociones</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body" style="overflow-x:auto;">
                                <form class="form" method="post" action="/pointex/visita_medica/visita/guarda_promo">
                                    @csrf
                                    <input type="hidden" name="txtIdVisita" value="{{ $id }}">
                                    <table class="table table-striped table-dark table-scroll">
                                        <thead>
                                        <tr>
                                            <th></th>
{{--                                            <th>Menciones Complementarias</th>--}}
                                            <th>Menciones</th>
                                            <th>Guardar</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
{{--                                            <th>{!! $cmbPromocion !!}</th>--}}
                                            <th>{!! $cmbPromocion2 !!}</th>
                                            <th>
                                                <button type="submit" class="btn btn-flat btn-primary" title="Guardar">
                                                    <i class="fa fa-save"></i>
                                                </button>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($promocion->count() > 0)
                                            @php($coutP = 1)
                                            @foreach($promocion as $kpr => $vpr)
                                                <tr>
                                                    <th scope="row">{{ $coutP }}</th>
                                                    <td>{{ isset($arrayPrpductos[$vpr->IdProducto]) ? $arrayPrpductos[$vpr->IdProducto] : null }}</td>
                                                    <td>{{ isset($arrayPrpductosLinea[$vpr->Descripcion]) ? $arrayPrpductosLinea[$vpr->Descripcion] : null }}</td>
                                                    <td>
                                                        <a href="/pointex/visita_medica/visita/borra_promo/{{ $vpr->Id }}"
                                                           class="btn btn-flat btn-danger" title="Eliminar">
                                                            <i class="fas fa-minus"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @php($coutP++)
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endif
