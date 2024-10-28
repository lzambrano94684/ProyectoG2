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
        <!-- aquí termina los div para el título de la página -->
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">Catálogo de Países</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title mb-0">Catálogo de Países</h4>

                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <fieldset class="fieldset-marco">
                                <input type="hidden" id="_token" value="{{csrf_token()}}">

                                <legend class="fieldset-marco text-muted">Catálogo de Países</legend>
                                <!-- mandar a llamar modal para crear pais -->
                                <button class="btn btn-primary float-lg-right" onclick="addForm('modalPais')">Agregar
                                    País <i class="fas fa-folder-plus fa-lg"></i></button>

                                @if(isset($paises)&& count($paises)>0)
                                <div class="table-responsive">
                                    <table id="datatable-pais" class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer align='left'"
                                           cellspacing="0" style="width: 100%;">
                                        <thead class="thead-dark">
                                        <tr class="headings">
                                            <th class="column-title no-link last"
                                                style="text-align: center"><span
                                                        class="nobr">ACCIONES</span>
                                            </th>

                                            <th class="column-title">NOMBRE</th>
                                            <th class="column-title">CÓDIGO</th>
                                            <th class="column-title">FECHA CREACIÓN</th>
                                            <th class="column-title">ESTADO</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($paises as $pais)


                                            <?php $fecha = new \Carbon\Carbon($pais->FechaCreacion); ?>


                                            <tr class="">
                                                <td class="last" align="center">
                                                    @if($pais->Estado=="A")
                                                        <a href="JavaScript:Void(0);"   title="Desactivar País"
                                                           data-placement="top" onclick="estadoPais({{$pais->Id}})"><i
                                                                    class="fas fa-toggle-on fa-lg"></i></a>
                                                        <a href="JavaScript:Void(0);"   title="Modificar País"
                                                           data-placement="top"
                                                           onclick="showModPais('{{ base64_encode(json_encode($pais))}}')"><i
                                                                    class="fa fa-pencil-alt fa-lg"></i></a>
                                                    @else
                                                        <a href="JavaScript:Void(0);" title="Activar País"
                                                           onclick="estadoPais({{$pais->Id}})"><i
                                                                    class="fas fa-toggle-off fa-lg"></i></a>
                                                    @endif

                                                </td>

                                                <td class=" ">{{$pais->Nombre}}</td>
                                                <td class=" ">{{$pais->Codigo}}</td>
                                                <td class="a-right">{{$fecha->format('d/m/Y')}}</td>
                                                <!-- if para colocar si está activo o inactivo -->
                                                @if($pais->Estado=="A")
                                                    <td class=" ">ACTIVO</td>
                                                @else
                                                    <td class=" ">INACTIVO</td>
                                                @endif


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
                            </fieldset>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{--Modal para modificar los datos del país--}}
    <div class="modal fade text-left" id="modalPais" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered dtr-modal-display" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark white">

                    <h4 class="modal-title text-bold-400" id="myModalLabel16">Modificar/Crear Datos Del País </h4>&nbsp;&nbsp;


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-info" for="mod_txtPais">Nombre:</label>
                                <input type="text" class="form-control" id="txtPais" name="txtPais" placeholder="Pais"
                                       required>
                            </div>
                        </div>


                        <div class="clearfix">&nbsp;</div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-info" for="mod_txtCodigo">Código:</label>
                                <input type="text" class="form-control" id="txtCodigo" name="txtCodigo"
                                       placeholder="Código" required>
                                <input class="form-control" type="hidden" name="txtIdPais" id="txtIdPais" value="">
                            </div>


                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="modPais();" class="btn btn-outline-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/components-modal.min.js') !!}
    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/cat.js') !!}


@stop