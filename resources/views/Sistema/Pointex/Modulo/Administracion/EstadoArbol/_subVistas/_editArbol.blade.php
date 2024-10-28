@extends('Sistema.Pointex.LayOuts.layout')
@section("css")
    {!! HTML::style('/Sistema/Pointex/Modulo/Administracion/css/administracion.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/dropzone.min.css') !!}
    <style>
        .required:after {
            content: " *";
            color: #e32;
            display: inline;
            font-weight: bold;
        }
    </style>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">{{$titleMsg}}</div>
        </div>
    </div>
    <section id="basic-elements">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h3 class="card-title" id="horz-layout-basic"></h3>
                            <br>
                            <legend>
                                <h4 class="form-section"><i class="ft-file-text"></i>
                                    Formulario del Arbol {{$Msg}}</h4></legend>
                            <hr>
                            <div class="row">
                                <div class="col-3">
                                    <a type="button" class="btn btn-raised btn-warning mr-1"
                                       onclick="Required();">
                                        <i class="ft-arrow-left"></i> Guardar
                                    </a>
                                    <input type="hidden" id="NombreArbol" name="NombreArbol"
                                           value="{{base64_decode($nombre)}}">
                                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

                                    @if($habilitar)
                                        <div id="bloque">
                                            <fieldset class="form-group">
                                                <label class="text-info required" for="$cmbPersona">Selecccione el
                                                    solicitante:</label>
                                                <form name="FrmSolicitante">
                                                    {!! $cmbPersona !!}
                                                </form>
                                            </fieldset>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label class="text-info">Usuarios pertenecientes al arbol:</label>
                                    <form action="/pointex/multiples/arbol/store" id="frm1" method="post">
                                        @csrf
                                        <input type="hidden" id="agregar" name="agregar" value="0" disabled>
                                        <table class="table-hover" id="table1">
                                            <thead>
                                            <tr>
                                                <th>Aprobadores</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($consArbol as $kexis)
                                                @php($icon = $kexis->IdPadrePersona ? '<i class="fas fa-arrow-down"></i>': '<i class="fas fa-check-double"></i>')
                                                @php($nombrePer = $collectPersonas->where("Id", $kexis->IdHijoPersona)->first() ? $collectPersonas->where("Id", $kexis->IdHijoPersona)->first()->Nombres : "" )
                                                <tr style="cursor: pointer">

                                                    <input type="hidden" id="NombreArbol" name="NombreArbol"
                                                           value="{{base64_decode($nombre)}}" disabled>
                                                    <input type="hidden" id="Perfil" name="Perfil"
                                                           value="{{$consultaPerfil->IdPerfil}}" disabled>
                                                    <input type="hidden" id="idArbol" name="idArbol"
                                                           value="{{$kexis->Id}}" disabled>
                                                    <td>{!! "$icon $nombrePer"!!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class="col-2">
                                <button id="RightMove"
                                        class="btn btn-raised btn-icon btn-pure danger mr-1 text-center">
                                    <i class="ft-chevron-right"></i>
                                </button>
                                <button id="LeftMove"
                                        class="btn btn-raised btn-icon btn-pure success mr-1 text-center">
                                    <i class="ft-chevron-left"></i>
                                </button>
                            </div>

                            <div class="col-5">
                                <div class="form-group">
                                    <label class="text-info" for="IdDestino"><b>Usuarios no pertenecientes al
                                            arbol</b>:</label>
                                    <form action="/pointex/multiples/arbol/store" id="frm2" method="post">
                                        @csrf
                                        <table class="table-hover" id="table2">
                                            <thead>
                                            <tr>
                                                <th>Usuarios</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($arrayPersonaInicial as $kpe)
                                                <tr>
                                                    <input type="hidden" id="agregar" name="agregar" value="1"
                                                           disabled>
                                                    <input type="hidden" id="NombreArbol" name="NombreArbol"
                                                           value="{{base64_decode($nombre)}}" disabled>
                                                    <input type="hidden" id="Perfil" name="Perfil"
                                                           value="{{$consultaPerfil->IdPerfil}}" disabled>
                                                    <input type="hidden" id="IdPersona" name="IdPersona"
                                                           value="{{$kpe->Id}}"
                                                           disabled>
                                                    <td>{{ $kpe->Nombres }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </form>
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
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/EditArbol.js') !!}
    <script>
    </script>
@stop
