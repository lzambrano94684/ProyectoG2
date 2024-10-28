@extends('Sistema.Pointex.LayOuts.layout')
@section('content')

    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
    <section class="basic-elements">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">@if(isset($titleMsg)){{$titleMsg}}@endif</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">


                    <div class="card-header">
                        <h4 class="card-title mb-0">Listado de Módulos</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <div class="col-lg-4">
                                <label class="text-info">Filtrar por Sistema</label>
                                <select name="slcSistemaChange" id="slcSistemaChange" onchange="filtrarSistema(this)" class="form-control">
                                    <option value="">Seleccione Sistema</option>
                                    @if(isset($sistemas))
                                        @foreach($sistemas as $sistema)
                                            <option value="{{$sistema->Id}}" @if(isset($data->slcSistemaChange) && $data->slcSistemaChange==$sistema->Id) selected @endif>{{$sistema->Nombre}}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                            <br>

                            <fieldset class="fieldset-marco">
                                <legend class="fieldset-marco text-muted">Listado de Módulos</legend>


                                <button class="btn btn-primary float-lg-right"  onclick="addForm('modalModulo')">Agregar Módulo <i class="fas fa-folder-plus fa-lg"></i></button>

                                @if(isset($modulos)&& count($modulos)>0)



                                    <table id="datatable-usuarios"
                                           class="table custom-table table-striped table-bordered  dt-responsive nowrap datatablePointer"
                                           cellspacing="0" style="width: 100%;">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title no-link last"
                                                style="text-align: center"><span
                                                        class="nobr">Acciones</span>
                                            </th>
                                            <th class="column-title">Id</th>
                                            <th class="column-title">Nombre</th>
                                            <th class="column-title">Descripción</th>
                                            <th class="column-title">Icono</th>
                                            <th class="column-title">Imagen</th>
                                            <th class="column-title">Estado</th>
                                            <th class="column-title">Fecha Creación</th>
                                            <th class="column-title">Sistema</th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($modulos as $modulo)
                                            <?php $fecha = new \Carbon\Carbon($modulo->FechaCreacion); ?>

                                            <tr class="">
                                                <td class="last" align="center">
                                                    @if($modulo->Estado=="A")
                                                        <a href="#" class="overRed"   title="Desactivar Módulo" data-placement="top" onclick="estadoModulo({{$modulo->Id}})"><i class="fas fa-toggle-on fa-lg"></i></a>
                                                    @else
                                                        <a href="#" class="overOrange"   data-placement="top" title="Activar Módulo" onclick="estadoModulo({{$modulo->Id}})"><i class="fas fa-toggle-off fa-lg"></i></a>
                                                    @endif

                                                        <a href="#"   data-placement="top" title="Ver Menús Hijos" class="overOrange info" onclick="verMenus({{$modulo->sistema->Id}},{{$modulo->Id}})"><i class="fas fa-arrow-circle-down fa-lg"></i></a>
                                                        <a href="#"   data-placement="top" title="Ver Sistema Padre" class="overOrange success" onclick="verSistemas({{$modulo->sistema->Id}})"><i class="fas fa-arrow-circle-up fa-lg"></i></a>
                                                        <a href="#"   data-placement="top" title="Modificar Módulo" class="overOrange" onclick="showModModulo({{ json_encode($modulo) }})"><i class="fas fa-pencil-alt fa-lg"></i></a>


                                                </td>
                                                <td class=" ">{{$modulo->Id}}</td>
                                                <td class=" ">{{$modulo->Nombre}}</td>
                                                <td class=" ">{{$modulo->Descripcion}}</td>
                                                <td class=" "><li class="{{$modulo->Icono}} warning"></li>  &nbsp;{{$modulo->Icono}}</td>
                                                <td class=" ">{{$modulo->Imagen}}</td>
                                                <td class=" ">{{$modulo->Estado}}</td>
                                                <td class="a-right">{{$fecha->format('d-m-Y H:i:s')}}</td>
                                                <td class="a-right">{{$modulo->sistema->Nombre}}</td>
                                            </tr>


                                        @endforeach

                                        </tbody>
                                    </table>

                                @else
                                    <div class="alert alert-warning alert-dismissible fade show"
                                         role="alert" id="tableUsers">

                                        <div class="text"><i class="fa fa-database"></i> La consulta no gener&oacute; resultados.
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true" class="la la-close"></span>
                                        </button>
                                    </div>
                                @endif
                            </fieldset>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    {{-- Modal para modificar los datos del sistema --}}
    <div class="modal fade text-left" id="modalModulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Datos Del Módulo </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <fieldset class="fieldset-marco">
                        <legend class="fieldset-marco">Módulo</legend>
                        <input type="hidden" id="idModulo">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtNombre">Sistema</label>
                                   <select name="slcSistema" id="slcSistema" class="form-control select2Modal">
                                       <option value="">Seleccione Sistema</option>
                                       @if(isset($sistemas))
                                           @foreach($sistemas as $sistema)
                                               <option value="{{$sistema->Id}}">{{$sistema->Nombre}}</option>
                                               @endforeach
                                           @endif

                                   </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtNombre">Nombre</label>
                                    <input type="text" class="form-control" id="mod_txtNombre" name="mod_txtNombre" placeholder="Nombre del Módulo" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtDesc">Descripción</label>
                                    <input type="text" class="form-control" id="mod_txtDesc" name="mod_txtDesc" placeholder="Descripción" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtIcono">Icono</label>
                                    <input type="text" class="form-control" id="mod_txtIcono" name="mod_txtIcono" placeholder="Icono del Módulo" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtImg">Imagen URL</label>
                                    <input type="text" class="form-control" id="mod_txtImg" name="mod_txtImg" placeholder="Imagen URL" required>
                                </div>
                            </div>
                        </div>

                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="modModulo();" class="btn btn-outline-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>



@stop

@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/estructura.js') !!}
@stop