@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")

@endsection

@section('content')
    <section class="basic-elements">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">{{ $titleMsg }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="px-3">
                            <div class="form-body">
                                <form type="get">
                                    <div class="container"><br>
                                        <label for="txtFiltro">Seleccione el rango de Planificacion</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="date" id="txtFechaInicio" class="form-control"
                                                       name="txtFechaInicio"
                                                       value="{{ $FechaInicio }}"
                                                       placeholder="Fecha" required aria-describedby="button-addon2">
                                            </div>
                                            <div class="col">
                                                <input type="date" id="txtFechaFin" class="form-control"
                                                       name="txtFechaFin"
                                                       value="{{ $FechaFin }}"
                                                       placeholder="Fecha" required aria-describedby="button-addon2">

                                            </div>
                                            <div class="col">
                                                <div class="input-group-append">
                                                    <button class="btn btn-raised btn-primary" type="submit">Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-toggle="tab"
                                                data-target="#home" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">Validar
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-toggle="tab"
                                                data-target="#profile" type="button" role="tab" aria-controls="profile"
                                                aria-selected="false">Aprobados
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-toggle="tab"
                                                data-target="#contact" type="button" role="tab" aria-controls="contact"
                                                aria-selected="false">Rechazados
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                         aria-labelledby="home-tab">
                                        <table class="table datatablePointer">
                                            <thead class="text-center text-white">
                                            <tr class="headings darken-4 bg-dark">
                                                <th class="column-title th-acciones" style="width: 110px">ACCIONES</th>
                                                <th class="column-title">Fecha</th>
                                                <th class="column-title">Representante</th>
                                                <th class="column-title">Tipo</th>
                                                <th class="column-title">Inicio</th>
                                                <th class="column-title">Fin</th>
                                                <th class="column-title">Descripcion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($dataValidar as $v)
                                                <tr>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0);" onclick="Aprobar(1,'Aprobar',{{$v->Id}},'fa fa-check-square-o','success');" type="button" class="btn btn-raised btn-success btn-min-width mr-1 mb-1"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
                                                        <a href="javascript:void(0);"  onclick="Aprobar(2,'Rechazar',{{$v->Id}},'fa fa-window-close-o','danger');" type="button" class="btn btn-raised btn-danger btn-min-width mr-1 mb-1"><i class="fa fa-window-close-o" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td class="text-center" style="width: 100%;">{{$v->Fecha}}</td>
                                                    <td class="text-center">{{$v->Representante}}</td>
                                                    <td class="text-center">{{$v->Tiempo}}</td>
                                                    <td class="text-center">{{$v->HoraInicio}}</td>
                                                    <td class="text-center">{{$v->HoraFin}}</td>
                                                    <td class="text-center">{{$v->Descripcion}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel"
                                         aria-labelledby="profile-tab">
                                        <table class="table">
                                            <thead class="text-center text-white">
                                            <tr class="headings darken-4 bg-dark">
                                                <th class="column-title">Fecha</th>
                                                <th class="column-title">Representante</th>
                                                <th class="column-title">Tipo</th>
                                                <th class="column-title">Inicio</th>
                                                <th class="column-title">Fin</th>
                                                <th class="column-title">Descripcion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($dataAprobado as $v)
                                                <tr>
                                                    <td class="text-center" style="width: 100%;">{{$v->Fecha}}</td>
                                                    <td class="text-center">{{$v->Representante}}</td>
                                                    <td class="text-center">{{$v->Tiempo}}</td>
                                                    <td class="text-center">{{$v->HoraInicio}}</td>
                                                    <td class="text-center">{{$v->HoraFin}}</td>
                                                    <td class="text-center">{{$v->Descripcion}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel"
                                         aria-labelledby="profile-tab">
                                        <table class="table">
                                            <thead class="text-center text-white">
                                            <tr class="headings darken-4 bg-dark">
                                                <th class="column-title">Fecha</th>
                                                <th class="column-title">Representante</th>
                                                <th class="column-title">Tipo</th>
                                                <th class="column-title">Inicio</th>
                                                <th class="column-title">Fin</th>
                                                <th class="column-title">Descripcion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($dataRechazado as $v)
                                                <tr>
                                                    <td class="text-center" style="width: 100%;">{{$v->Fecha}}</td>
                                                    <td class="text-center">{{$v->Representante}}</td>
                                                    <td class="text-center">{{$v->Tiempo}}</td>
                                                    <td class="text-center">{{$v->HoraInicio}}</td>
                                                    <td class="text-center">{{$v->HoraFin}}</td>
                                                    <td class="text-center">{{$v->Descripcion}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@section('js')
    <script>

        function redirect() {
            location.href = url;
        }
        function Aprobar(estatus, titulo,id , Icono,color) {
            swal({
                title: '<div class="' + titulo + '"><i class="' + Icono + ' fa-7x '+color+'"></i></div><br>¿Deseas ' + titulo + ' <b class="text-danger">' + titulo + '</b>?',
                // input: 'text',
                // inputPlaceholder: 'Agregar Observaciones',
                inputAttributes: {
                    autocapitalize: 'off',
                    maxlength: 300,
                    required: 'false'
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deseo ' + titulo + '!',
                cancelButtonText: 'No'
            }).then(function (observacion) {
                url = "/pointex/visita_medica/visita/tiemponp/"+id+"/"+estatus;
                redirect();
            });
        }
    </script>
@stop
