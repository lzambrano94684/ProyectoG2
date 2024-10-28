<section id="shopping-cart">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-content">

                    <div class="card-body">

                        @if($dataFichero->count()>0)
                            <table class="table  datatablePointerUnic">
                                <thead class="text-center text-white">
                                <tr class="headings darken-4 bg-dark">
                                    <th class="column-title">FARMACIA</th>
                                    <th class="column-title">CAT</th>
                                    <th class="column-title">F-P</th>
                                    <th class="column-title">ULT. VISITA</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dataFichero as $kme => $primero)
                                    <tr>
                                        <td>{{ trim($primero->Medico) }}</td>
                                        <td>{{ trim($primero->Cat) }}</td>
                                        <td>{{ trim($primero->Frecuencia) }}</td>
                                        <td>
                                            <a href="/pointex/visita_medica/farmacia?{{ ("crear=".base64_encode($primero->Medico)."|$primero->Id") }}"
                                               title="Crear Nueva Visita a {{ trim($primero->Medico) }}">
                                                {{ $primero->FechaVisita ? $primero->FechaVisita : 'Sin Registro' }}
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
