<section id="file-export">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Listado</h4>
                    <p class="card-text">A continuación un listado de las marcas creadas, si deseas crear una nueva
                        marca por favor dar click
                        <a class="btn btn-flat btn-danger" data-toggle="tooltip" data-title="Crear Nueva Marca"
                           href="{{  "/pointex/gestion/marca/crear_listar?".base64_encode("crear=1") }}">aqui</a></p>
                </div>
                <div class="card-content ">
                    <div class="card-body card-dashboard table-responsive">
                        @if($modelMarca->count()>0)
                            <table class="table  text-center datatablePointer">
                                <thead>
                                <tr class="headings darken-4 bg-dark">
                                    <th class="column-title">ACCIONES</th>
                                    <th class="column-title">DOCUMENTO</th>
                                    <th class="column-title">NOMBRE</th>
                                    <th class="column-title">PRODUCTOS</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($modelMarca as $krs => $vrs)
                                    @php $nombre = $vrs->Nombre;@endphp
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0);"
                                               class="btn btn-flat btn-success overOrange aActiveModal tooltip-per"
                                               data-info="{{ base64_encode($vrs) }}"
                                               data-frm="marca">
                                                <i class="ft-edit"></i>
                                                <span class="tooltiptext">¿Modificar la marca <b>{{ $nombre }}</b>?</span>
                                            </a>
                                            @if($vrs->InRegistroMarca()>0)
                                                <a onclick="deleteMarca({{ $vrs->Id }})"
                                                   href="javascript:void(0);"
                                                   class="btn btn-flat btn-danger overOrange tooltip-per deleteMarca"
                                                   data-id_marca="{{ $vrs->Id }}"
                                                   data-nombre_marca="{{ $nombre }}">
                                                    <i class="ft-trash"></i>
                                                    <span class="tooltiptext">¿Eliminar la marca <b>{{ $nombre }}</b>?</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="overOrange btn btn-flat overRed"
                                               title="Expandir">
                                                @if($vrs->URLRegistro)
                                                    <img class="media-object round-media mostarImagen"
                                                         src="{{ strtoupper(substr($vrs->URLRegistro, -3)) == "PDF" ? "/Vendor/Plantillas/Apex/app-assets/img/elements/pdf.png" : "/pointex/getArchivo?ruta=$vrs->URLRegistro" }}"
                                                         alt="{{$nombre}}"
                                                         url="{{"/pointex/getArchivo?ruta=$vrs->URLRegistro" }}"
                                                         style="height: 50px;"/>
                                                @else
                                                    <img class="media-object round-media"
                                                         src="/Sistema/Pointex/Modulo/img/no-image.jpg"
                                                         style="height: 50px;"/>
                                                @endif

                                            </a>
                                        </td>
                                        <td id="Nombre{{ $vrs->Id }}">
                                            {{ $nombre }}
                                        </td>
                                        <td>
                                            <a class="overOrange btn btn-flat btn-info tooltip-per"
                                               href="/pointex/gestion/marca/crear_listar?{{ base64_encode("listar=1&idMarca=$vrs->Id") }}">
                                                <i class="ft-list"></i>
                                                <span class="tooltiptext">¿Ver los productos de la marca <b>{{ $nombre }}</b>?</span>
                                            </a>
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
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" class="la la-close"></span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>