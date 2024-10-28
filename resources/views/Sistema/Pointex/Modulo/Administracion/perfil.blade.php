<div class="accordion md-accordion accordion-blocks" id="accordionEx78" role="tablist"
     aria-multiselectable="false">

    <div class="card content-wrapper collapse-icon accordion-icon-rotate">

        <div class="card-header" role="tab" id="heading">
            <div class="card-title mb-0">
                <label class="font-medium-3 text-bold-500">LISTADO DE PERFILES</label>
            </div>
            <a data-toggle="collapse" data-parent="#accordionEx78" href="#collapse81" aria-expanded="false"
               aria-controls="collapse81">
                <h5 class="mt-1 mb-0">
                    <span>Perfiles </span>
                    <span class="badge badge-warning mr-2"><i class="far fa-id-badge fa-lg"></i> </span>
                </h5>
            </a>
        </div>

        <div id="collapse81" class="collapse" role="tabpanel" aria-labelledby="heading"
             data-parent="#accordionEx78">
            <div class="card-body">

                <div class="table-responsive mx-3">

                    <table class="table table-hover mb-0">

                        <thead>
                        <tr>
                            <th>

                            </th>
                            <th class="th-lg"><a>Perfil <i class="fas fa-sort lg-1"></i></a></th>
                            <th class="order-lg-last" align="center"><a>Módulos Asignados </a></th>

                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($perfiles->groupBy('IdPerfil') as  $perfil)

                            <tr>
                                <th scope="row">

                                </th>
                                <td class="last" align="left"><strong>{{$perfil->first()->Perfil->Nombre}}</strong></td>
                                <td class="last" align="center">

                                    {{ $perfil->pluck("Modulo.Nombre")->join(', ', ' y ') }}
                                </td>

                            </tr>


                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
        <div style="visibility: hidden"> a </div>
    </div>
    <!-- Accordion card -->

</div>

<!--/.Accordion wrapper-->
