@extends('Sistema.Pointex.LayOuts.layout')

@section("css")
@stop
@section('content')

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Comentario Visita</th>
                                    <th>Objetivo de Visita</th>
                                    <th>Fecha Visita</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key)
                                    <tr>
                                        <td class="text-center">{{$key->Descripcion}}</td>
                                        <td class="text-center">{{$key->Descripcion2}}</td>
                                        <td class="text-center">{{$key->FechaVisita}}</td>
                                        <td class="text-center">{{$key->HoraInicio}}</td>
                                        <td class="text-center">{{$key->HoraFin}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@stop
@section('js')
@stop
