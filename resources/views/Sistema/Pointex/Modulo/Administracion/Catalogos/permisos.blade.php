@extends('Sistema.Pointex.LayOuts.layout')
@section("css")
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/pickadate/pickadate.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/wizard.css') !!}
    {!! HTML::style('/Sistema/Pointex/Modulo/Administracion/css/administracion.css') !!}
@stop
@section('content')
    <section class="basic-elements">
        <!-- se asígna título a la web -->
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">@if(isset($titleMsg)){{$titleMsg}}@endif</div>
            </div>
        </div>

        <div class="row">
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">

                                <input type="hidden" id="_token" value="{{csrf_token()}}">

                                <button class="btn btn-primary float-lg-right"
                                        onclick="addFormInternal('modalAsignar')">Asignar
                                    Permisos <i class="fas fa-folder-plus fa-lg"></i></button>

                                @if($permisos->count()>0)
                                    <div class="table-responsive">
                                        <table id="datatable-pais"
                                               class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer align='left' "
                                               cellspacing="0" style="width: 100%;">
                                            <thead class="thead-dark">
                                            <tr class="headings">
                                                <th class="column-title no-link last"
                                                    style="text-align: center"><span
                                                            class="nobr">ACCIONES</span>
                                                </th>
                                                <th class="column-title no-link last"
                                                    style="text-align: center">PERFIL</th>
                                                <th class="column-title no-link last"
                                                    style="text-align: center">PERMISOS</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($permisos as $kp => $asignar)

                                                <tr class="">
                                                    <td class="last" align="center">

                                                        <a href="JavaScript:;"
                                                           title="Modificar Permisos"
                                                           data-placement="top"
                                                           onclick="showModTipo({{ $kp }})"><i
                                                                    class="ft-edit-2 font-medium-3 mr-4"></i></a>


                                                        <a href="JavaScript:;"
                                                           title="Eliminar Registros"
                                                           data-placement="top" class="danger" data-original-title="" title=""
                                                           onclick="enviardelete('{{ $kp }}')" ><i
                                                                    class="ft-trash font-medium-3 "></i></a>

                                                        <form id="formElimininar{{ $kp }}" name="formElimininar" method="POST" action="/pointex/administracion/accesos/asignar_permisos/delete_tipo" >
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$asignar}}">
                                                        </form>

                                                    </td>

                                                    <td class=" ">{{$asignar["PerfilNombre"]}}</td>
                                                    <td>

                                                        @if($asignar["Modulo"])
                                                            <ol class="list-group-flush">
                                                            @foreach($asignar["Modulo"] as $kmo => $vmo)
                                                                        @if($asignar["PerfilId"]==$vmo->IdPerfil)
                                                                       <strong>
                                                                           <li>
                                                                               <label class="success">{{ $vmo->Nombre}}
                                                                                   <small>(Módulo)</small>
                                                                               </label>
                                                                           </li>
                                                                       </strong>
                                                                    @if($vmo->Menus)

                                                                        <ol>
                                                                            @foreach($vmo->Menus as $kme => $vme)

                                                                                @if($vmo->Id==$vme->IdModulo && $vme->IdPME==$vmo->IdPerfil )
                                                                                    <strong>
                                                                                        <li>
                                                                                            <label class="info">{{ $vme->Nombre  }}
                                                                                                <small>(Menú)</small>
                                                                                            </label></li>
                                                                                    </strong>
                                                                                    @if($vme->SubMenus)
                                                                                        <ol>
                                                                                            @foreach($vme->SubMenus as $ksme => $vsme)

                                                                                                @if($vme->Id==$vsme->IdMenu && $vmo->IdPerfil==$vsme->IdPSM)
                                                                                                    <strong>
                                                                                                        <li>
                                                                                                            <label class="danger">{{ $vsme->Nombre }}
                                                                                                                <small>(Sub
                                                                                                                    Menú)
                                                                                                                </small>
                                                                                                            </label></li>
                                                                                                    </strong>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </ol>
                                                                                    @endif

                                                                                @endif
                                                                            @endforeach
                                                                        </ol>

                                                                    @endif

                                                                    @endif

                                                            @endforeach
                                                            </ol>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>

                                        </table>


                                        @else
                                            <div class="alert alert-warning alert-dismissible fade show"
                                                 role="alert" id="tableUsers">

                                                <div class="text"><i class="fa fa-database"></i> La consulta no gener&oacute;
                                                    resultados.
                                                </div>

                                            </div>
                                    </div>
                                @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>
    <div class="clearfix">&nbsp;</div>

    <!-- modal -->
    <div class="modal fade text-left" id="modalAsignar" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel16"
         aria-hidden="true" blac>
        <div class="modal-dialog modal-lg modal-dialog-centered dtr-modal-display" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark white">

                    <h4 class="modal-title text-bold-400" id="myModalLabel16">Crear/Modificar
                    </h4>&nbsp;&nbsp;

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">

                        </div>
                    </div>
                </div>
                <div class="modal-body">

                    <form >
                        <h4 class="form-section"><i class="ft-user-check"></i> Asignar Permisos</h4>
                        <div class="form-group">
                            <label class="text-info" for="mod_slcPerfil">Perfil</label>
                            <select class="form-control select2Modal" id="mod_slcPerfil" name="mod_slcPerfil">
                                <option value="">Seleccione</option>
                                @foreach($perfiles as $perfil)
                                    <option value="{{$perfil->Id}}">{{$perfil->Nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-info" for="mod_slcModulo">Módulo</label>
                            <select class="form-control select2Modal" multiple="multiple" id="mod_slcModulo"
                                    name="mod_slcModulo[]">
                                <option value="">Seleccione</option>
                                @foreach($modulos as $modulo)
                                    <option value="{{$modulo->Id}}">{{$modulo->Nombre}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-info" for="modMenu">Menú</label>
                            <select class="form-control select2Modal" multiple="multiple" id="modMenu"
                                    name="mod_slMenu[]">
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="text-info" for="modSubMenu">SubMenú</label>
                            <select class="form-control select2Modal" multiple="multiple" id="modSubMenu"
                                    name="mod_slcSubMenu[]">
                            </select>
                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                            <button type="button" onclick="modAsignar();" class="btn btn-outline-primary"><i class="fas fa-check"></i> Guardar</button>

                        </div>
                    </form>
            </div>
        </div>

    </div>


@stop

@section('js')
    <script type="text/javascript">
        var dataModulo = "{{ base64_encode($modulos) }}";
        var dataAsignada = "{{ base64_encode($permisos) }}";
    </script>
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/cat.js') !!}
@stop