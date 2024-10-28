@extends('pointex-1.0.resources.views.Sistema.Pointex.LayOuts.layout')

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
        <!-- aquí termina los div para el título de la página -->
        <div class="row">
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">

                                <input type="hidden" id="_token" value="{{csrf_token()}}">

                                <button class="btn btn-primary float-lg-right" onclick="addForm('modalPerfil')">Agregar
                                    Perfil <i class="fas fa-folder-plus fa-lg"></i></button>

                                @if(isset($perfiles)&& count($perfiles)>0)
                                <div class="table-responsive">
                                    <table id="datatable-perfil"
                                           class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer align='left'"
                                           cellspacing="0" style="width: 100%;">
                                        <thead class="thead-dark">
                                        <tr class="headings">
                                            <th class="column-title no-link last"
                                                style="text-align: center"><span
                                                        class="nobr">ACCIONES</span>
                                            </th>
                                            <th class="column-title">NOMBRE DEL PERFIL</th>
                                            <th class="column-title">FECHA CREACIÓN</th>
                                            <th class="column-title">FECHA MOFICACIÓN</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($perfiles as $kper => $perfil)


                                            <?php $fecha = new \Carbon\Carbon($perfil->FechaCreacion); ?>
                                            <?php $fecha1 = new \Carbon\Carbon($perfil->FechaModificacion); ?>


                                            <tr class="">
                                                <td class="last" align="center">

                                                        <a href="JavaScript:;"   title="Modificar Perfil"
                                                           data-placement="top"
                                                           onclick="showModPerfil('{{ base64_encode(json_encode($perfil))}}')"><i
                                                                    class="ft-edit-2 font-medium-3 mr-3"></i></a>

                                                    <a href="JavaScript:;"
                                                       title="Eliminar Registros"
                                                       data-placement="top" class="danger" data-original-title="" title=""
                                                       onclick="deletePerfil('{{ $kper }}')" ><i
                                                                
                                                                class="ft-trash font-medium-3 "></i></a>

                                                    <form id="formPefilElimininar{{ $kper }}" name="formPerfilElimininar" method="POST" action="/pointex/administracion/catalogos/perfil/eliminar" >
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$perfil->Id}}">
                                                    </form>

                                                </td>

                                                <td class="column title align-center "><strong>{{$perfil->Nombre}}</strong></td>
                                                <td class="a-right">{{$fecha->format('d/m/Y')}}</td>
                                                <td class="a-right">{{$fecha1->format('d/m/Y')}}</td>

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
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <div class="modal fade text-left" id="modalPerfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered dtr-modal-display modal-md " role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark white">

                    <h4 class="modal-title text-bold-400" id="myModalLabel16">Modificar/Crear</h4>&nbsp;&nbsp;


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <h4 class="form-section"><i class="ft-user"> Perfil</i></h4>
                        <div class="form-group">
                            <div class="position-relative has-icon-left">
                                <input type="text" class="form-control" id="txtPerfil" name="txtPerfil"
                                       placeholder="Nombre Perfil" required>
                                <input class="form-control" type="hidden" name="txtIdPerfil" id="txtIdPerfil" value="">
                                <div class="form-control-position">
                                    <i class="ft-user"></i>
                                </div>
                            </div>
                        </div>

                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i
                                    class="fas fa-times"></i> Cancelar
                        </button>
                        <button type="button" onclick="modPerfil();" class="btn btn-outline-primary"><i
                                    class="fas fa-check"></i> Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/toastr.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/cat.js') !!}


@stop