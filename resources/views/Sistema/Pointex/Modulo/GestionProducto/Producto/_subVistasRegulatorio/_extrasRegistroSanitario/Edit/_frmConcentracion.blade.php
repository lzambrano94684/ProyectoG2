@extends('Sistema.Pointex.LayOuts.layout')

@section('title', 'Listado de Concentracion')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="horz-layout-basic">Concentracion</h4>
                <p class="mb-0">Por favor llenar los campos para hacer una creación.</p>
            </div>
            <div class="card-content">
                <div class="px-3">
                    <form class="form form-horizontal" method="post" action="/pointex/gestion/regulatorio/Editarconcentracion" novalidate="novalidate" id="form">

                        <input type="hidden" name="Id" value="{{$datos->Id}}">
                        @csrf
                        <div class="form-body">
                            <h4 class="form-section"><i class="ft-file-text"></i> Requerimientos</h4>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" >Nombre: </label>
                                <div class="col-md-9">
                                    <input name="Nombre" value="{{$datos->Nombre}}" id="Nombre"   class="form-control " autocomplete="off" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" >Descripcion: </label>
                                <div class="col-md-9">
                                    <input name="Descripcion" value="{{$datos->Descripcion}}" id="Descripcion"   class="form-control " autocomplete="off" >
                                </div>
                            </div>


                            <div class="form-actions">
                                <a type="button" class="btn btn-raised btn-warning mr-1" href="/pointex/gestion/regulatorio/edit_concentracion">
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
