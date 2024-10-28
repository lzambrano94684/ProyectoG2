@extends('Sistema.Pointex.LayOuts.layout')
@section('title',$titleMsg)
@section("css")
@endsection
@section("content")
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="horz-layout-basic">Médico: {{$data->NombreLargo}}</h4>
                <p class="mb-0">Por favor llenar los campos.</p>
            </div>
            <div class="card-content">
                <div class="px-3">
                    <form class="form form-horizontal" method="post" action="/pointex/visita_medica/paneles/modifica_panel" novalidate="novalidate" id="form">
                        <input type="hidden" id="txtId" name="txtId" value="{{$data->Id}}">
                        @csrf
                        <div class="form-body">
                            <h4 class="form-section"><i class="ft-file-text"></i> Requerimientos</h4>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Nombre: </label>
                                <div class="col-md-9">
                                    <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="{{$data->NombreLargo}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Quintil: </label>
                                <div class="col-md-9">
                                    <input type="text" id="txtQuintl" name="txtQuintl" class="form-control" value="{{$data->Cat}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Colegiado: </label>
                                <div class="col-md-9">
                                    <input type="text" id="txtColegiado" name="txtColegiado" class="form-control" value="{{$data->Colegiado}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Especialidad: </label>
                                <div class="col-md-9">
                                    <input type="text" id="EspPromoRegilla" name="EspPromoRegilla" class="form-control" value="{{$data->EspPromoRegilla}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Segunda Especialidad: </label>
                                <div class="col-md-9">
                                    <input type="text" id="SegundaEsp" name="SegundaEsp" class="form-control" value="{{$data->EspecialidadSecundaria}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Frecuencia: </label>
                                <div class="col-md-9">
                                    <input type="text" id="Frecuencia" name="Frecuencia" class="form-control" value="{{$data->Frecuencia}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Correo: </label>
                                <div class="col-md-9">
                                    <input type="text" id="Mail1" name="Mail1" class="form-control" value="{{$data->Mail1}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Direccion: </label>
                                <div class="col-md-9">
                                    <input type="text" id="Direccion" name="Direccion" class="form-control" value="{{$data->Direccion}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Depto: </label>
                                <div class="col-md-9">
                                    <input type="text" id="Depto" name="Depto" class="form-control" value="{{$data->Depto}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Municipio: </label>
                                <div class="col-md-9">
                                    <input type="text" id="Municipio" name="Municipio" class="form-control" value="{{$data->Municipio}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Localidad: </label>
                                <div class="col-md-9">
                                    <input type="text" id="Localidad" name="Localidad" class="form-control" value="{{$data->Localidad}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Region: </label>
                                <div class="col-md-9">
                                    <input type="text" id="Region" name="Region" class="form-control" value="{{$data->Region}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 label-control">Telefono: </label>
                                <div class="col-md-9">
                                    <input type="text" id="Telefono" name="Telefono" class="form-control" value="{{$data->Telefono}}">
                                </div>
                            </div>
                            <div class="form-actions">
                                <a type="button" class="btn btn-raised btn-warning mr-1" href="/pointex/visita_medica/paneles/asignar">
                                    <i class="ft-arrow-left"></i>Regresar
                                </a>
                                <button class="btn btn-raised btn-primary eventoClickGuardar">

                                    <i class="ft-save"></i> Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section("js")
@endsection
