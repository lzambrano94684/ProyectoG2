<section class="basic-elements">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="px-3">
                        <div class="row">
                            <div class="col-md-12">
                                @if($buscaIframe->count() > 0)
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="base-tab1" data-toggle="tab"
                                               aria-controls="tab1"
                                               href="#tab1" aria-expanded="true">
                                                Data Completa
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab2" data-toggle="tab"
                                               aria-controls="tab2"
                                               href="#tab2" aria-expanded="false">
                                                Descargar
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                        <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true"
                                             aria-labelledby="base-tab1">
                                            <p>
                                                <iframe width="100%" height="800"
                                                        src="{{ $buscaIframe->first()->Iframe }}" frameborder="0"
                                                        allowFullScreen="true"></iframe>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                                            @include("Sistema.Pointex.Modulo.Reportes.Universal._extenciones._filtros")
                                        </div>
                                    </div>

                                @else
                                    @if($data->count() == 5000)
                                        <div class="alert bg-danger alert-icon-left alert-dismissible mb-2"
                                             role="alert">
                                            <strong>Ha exedido el numero de filas!</strong> para mostrar en la
                                            pantalla por favor descargue la informacion completa aquí <a
                                                class="alert-link black"
                                                href="{{  $request->url()."?".http_build_query($request->input())."&descargaData=1" }}"
                                                target="_blank">Aqui</a>
                                        </div>

                                    @endif
                                    @if($data->count()>0)
                                        <table class="table  text-center datatablePointer">
                                            <thead class="text-white">
                                            <tr class="headings darken-4 bg-dark">
                                                @foreach(collect($data->first())->keys() as $vh)
                                                    <th class="column-title">{{ $vh }}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $kvd => $vd)
                                                <tr>
                                                    @foreach(collect($data->first())->keys() as $vdd)
                                                        <td class="column-title">{{ $vd->$vdd }}</td>
                                                    @endforeach
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

