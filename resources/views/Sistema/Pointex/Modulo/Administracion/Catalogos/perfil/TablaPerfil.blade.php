@if(isset($roles)&& count($roles)>0)

    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-pais"
                           class="table custom-table table-striped table-bordered table-hover table-condensed nowrap align='left'"
                           cellspacing="0" style="width: 100%;">
                        <thead class="darken-4 bg-dark text-white">
                        <tr class="headings">
                            <th class="column-title no-link last"
                                style="text-align: center"><span
                                        class="nobr">ACCIONES</span>
                            </th>

                            <th class="column-title">PUESTO</th>
                            <th class="column-title">NOMBRE</th>
                            <th class="column-title">PERFIL</th>


                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($roles->groupBy('IdUsuario') as $krol => $vrol)

                            <tr>
                                <td class="last" align="center">

                                    <a href="JavaScript:;"
                                       title="Modificar"
                                       data-placement="top"
                                       onclick="showModRoles('{{ base64_encode(json_encode($vrol))}}')"><i
                                                class="icon-note font-medium-3 mr-3"></i></a>

                                    <a href="JavaScript:;"
                                       title="Eliminar Item"
                                       data-placement="top" class="danger" data-original-title="" title=""
                                       onclick="showDelRoles('{{ base64_encode(json_encode($vrol))}}')"><i
                                                class="ft-trash-2 font-medium-3 mr-3"></i></a>

                                    <a href="JavaScript:void(0);"
                                       title="Eliminar Todos Registros"
                                       data-placement="top" class="danger" data-original-title="" title=""
                                       onclick="deleteUsuarioPerfil('{{ $krol }}')"><i
                                                class="ft-trash font-medium-3"></i></a>

                                    <form id="formUsuarioPerfil{{ $krol }}" name="formUsuarioPerfil" method="POST"
                                          action="/pointex/administracion/accesos/asignar_perfil/delete_usuario">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$krol}}">
                                    </form>

                                </td>

                                <td>
                                    {{  $puesto->get($vrol->first()->Usuario->IdPuesto) }}
                                </td>

                                <td>
                                    {{ $vrol->first()->Usuario->Persona->Nombres.' '.$vrol->first()->Usuario->Persona->Apellidos}}
                                </td>
                                <td>
                                    <strong>{!! $vrol->pluck("Perfil.Nombre")->join('<BR>- ') !!} </strong>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
