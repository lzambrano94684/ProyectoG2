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
                        <h4 class="card-title mb-0">Listado de Sistemas</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <fieldset class="fieldset-marco">
                                <legend class="fieldset-marco text-muted">Listado de Sistemas</legend>

                                <button class="btn btn-primary float-lg-right" onclick="addForm('modalSistema')">Agregar Sistema <i class="fas fa-folder-plus fa-lg"></i></button>

                                @if(isset($sistemas)&& count($sistemas)>0)



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

                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($sistemas as $sistema)
                                            <?php $fecha = new \Carbon\Carbon($sistema->FechaCreacion); ?>

                                            <tr class="">
                                                <td class="last" align="center">
                                                    @if($sistema->Estado=="A")
                                                        <a href="#" class="overRed"   title="Desactivar Sistema" data-placement="top" onclick="estadoSistema({{$sistema->Id}})"><i class="fas fa-toggle-on fa-lg"></i></a>
                                                    @else
                                                        <a href="#" class="overOrange"   data-placement="top" title="Activar Sistema" onclick="estadoSistema({{$sistema->Id}})"><i class="fas fa-toggle-off fa-lg"></i></a>
                                                    @endif

                                                        <a href="#"   data-placement="top" title="Ver Módulos" class="overOrange info" onclick="verModulos({{$sistema->Id}})"><i class="fas fa-arrow-circle-down fa-lg"></i></a>
                                                        <a href="#"   data-placement="top" title="Modificar Sistema" class="overOrange" onclick="showModSistema({{ json_encode($sistema) }})"><i class="fas fa-pencil-alt fa-lg"></i></a>


                                                </td>
                                                <td class=" ">{{$sistema->Id}}</td>
                                                <td class=" ">{{$sistema->Nombre}}</td>
                                                <td class=" ">{{$sistema->Descripcion}}</td>
                                                <td class=" "><li class="{{$sistema->Icono}} warning"></li>  &nbsp;{{$sistema->Icono}}</td>
                                                <td class=" ">{{$sistema->Imagen}}</td>
                                                <td class=" ">{{$sistema->Estado}}</td>
                                                <td class="a-right">{{$fecha->format('d-m-Y H:i:s')}}</td>
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
    <div class="modal fade text-left" id="modalSistema" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Datos Del Sistema </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <fieldset class="fieldset-marco">
                        <legend class="fieldset-marco">Sistema</legend>
                        <input type="hidden" id="idSistema">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtNombre">Nombre</label>
                                    <input type="text" class="form-control" id="mod_txtNombre" name="mod_txtNombre" placeholder="Nombre del Sistema" required>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                                    <input type="text" class="form-control" id="mod_txtIcono" name="mod_txtIcono" placeholder="Icono del Sistema" required>
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
                    <button type="button" onclick="modSistema();" class="btn btn-outline-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/estructura.js') !!}
@stop