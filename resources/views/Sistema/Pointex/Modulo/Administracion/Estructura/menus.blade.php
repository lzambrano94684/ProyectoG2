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

                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="text-info">Filtrar por Sistema</label>
                                    <select name="slcSisChange" id="slcSisChange" onchange="filtrarSistemaMenu(this)" class="form-control select2_single">
                                        <option value="">Seleccione Sistema</option>
                                        @if(isset($sistemas))
                                            @foreach($sistemas as $sist)
                                                <option value="{{$sist->Id}}" @if(isset($sistema) && $sistema==$sist->Id) selected @endif>{{$sist->Nombre}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="text-info">Filtrar por Módulo</label>
                                    <select name="slcModChange" id="slcModChange" onchange="filtrarModulos(this)" class="form-control select2_single">
                                        <option value="">Seleccione Sistema</option>
                                        @if(isset($modulos))
                                            @foreach($modulos as $mod)
                                                @if(isset($sistema) && $sistema==$mod->IdSistema)
                                                    <option value="{{$mod->Id}}" @if(isset($modulo) && $modulo==$mod->Id) selected @endif>{{$mod->Nombre}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <br>

                            <fieldset class="fieldset-marco">
                                <legend class="fieldset-marco text-muted">Listado de Menús</legend>


                                <button class="btn btn-primary float-lg-right" onclick="addForm('modalMenu')">Agregar Menú <i class="fas fa-folder-plus fa-lg"></i></button>

                                @if(isset($menus)&& count($menus)>0)



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
                                            <th class="column-title">URL</th>
                                            <th class="column-title">Estado</th>
                                            <th class="column-title">Fecha Creación</th>
                                            <th class="column-title">Sistema</th>
                                            <th class="column-title">Modulo</th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($menus as $menu)
                                            <?php $fecha = new \Carbon\Carbon($menu->FechaCreacion); ?>

                                            <tr class="">
                                                <td class="last" align="center">
                                                    @if($menu->Estado=="A")
                                                        <a href="#" class="overRed"   title="Desactivar Módulo" data-placement="top" onclick="estadoMenu({{$menu->Id}})"><i class="fas fa-toggle-on fa-lg"></i></a>
                                                    @else
                                                        <a href="#" class="overOrange"   data-placement="top" title="Activar Módulo" onclick="estadoMenu({{$menu->Id}})"><i class="fas fa-toggle-off fa-lg"></i></a>
                                                    @endif

                                                    <a href="#"   data-placement="top" title="Ver SubMenús Hijos" class="overOrange info" onclick="verSubMenus({{$menu->IdSistema}},{{$menu->IdModulo}},{{$menu->Id}})"><i class=" fas fa-arrow-circle-down fa-lg"></i></a>
                                                    <a href="#"   data-placement="top" title="Ver Módulo Padre" class="overOrange success" onclick="verModulo({{$menu->IdModulo}})"><i class=" fas fa-arrow-circle-up fa-lg"></i></a>
                                                    <a href="#"   data-placement="top" title="Modificar Menú" class="overOrange" onclick="showModMenu({{ json_encode($menu) }},{{json_encode($modulos)}})"><i class="fas fa-pencil-alt fa-lg"></i></a>


                                                </td>
                                                <td class=" ">{{$menu->Id}}</td>
                                                <td class=" ">{{$menu->Nombre}}</td>
                                                <td class=" ">{{$menu->Descripcion}}</td>
                                                <td class=" "><li class="{{$menu->Icono}} warning"></li>  &nbsp;{{$menu->Icono}}</td>
                                                <td class=" ">{{$menu->URL}}</td>
                                                <td class=" ">{{$menu->Estado}}</td>
                                                <td class="a-right">{{$fecha->format('d-m-Y H:i:s')}}</td>
                                                <td class="a-right">{{$menu->Sistema}}</td>
                                                <td class="a-right">{{$menu->Modulo}}</td>
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
    <div class="modal fade text-left" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark white">
                    <h4 class="modal-title" id="myModalLabel16">Datos Del Menú </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <fieldset class="fieldset-marco">
                        <legend class="fieldset-marco">Menú</legend>
                        <input type="hidden" id="idMenu">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-info" for="slcModSistema">Sistema</label>
                                    <select onchange="llenaModulo(this.value,{{json_encode($modulos)}},'')" name="slcModSistema" id="slcModSistema" class="form-control select2Modal">
                                        <option value="">Seleccione Sistema</option>
                                        @if(isset($sistemas))
                                            @foreach($sistemas as $sis)
                                                <option value="{{$sis->Id}}">{{$sis->Nombre}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-info" for="slcModModulo">Módulo</label>
                                    <select name="slcModModulo" id="slcModModulo" class="form-control select2Modal">
                                        <option value="">Seleccione Modulo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtNombre">Nombre</label>
                                    <input type="text" class="form-control" id="mod_txtNombre" name="mod_txtNombre" placeholder="Nombre del Módulo" required>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtDesc">Descripción</label>
                                    <input type="text" class="form-control" id="mod_txtDesc" name="mod_txtDesc" placeholder="Descripción" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtIcono">Icono</label>
                                    <input type="text" class="form-control" id="mod_txtIcono" name="mod_txtIcono" placeholder="Icono del Módulo" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-info" for="mod_txtURL">URL</label>
                                    <input type="text" class="form-control" id="mod_txtURL" name="mod_txtURL" placeholder="Imagen URL" required>
                                </div>
                            </div>
                        </div>

                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="modMenu();" class="btn btn-outline-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>



@stop

@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/estructura.js') !!}
@stop