<div class="offset-6 col-6 text-right">
    <a href="/pointex/visita_medica/farmacia/fichero"
       class="form-control text-white btn btn-primary"
       title="Agregar uno nuevo">
        <i class="icon-plus"></i> Agregar
    </a>
</div>
<section id="shopping-cart">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-content">

                    <div class="card-body">

                        @if($dataVisita->count()>0)
                            <table class="table  datatablePointer">
                                <thead class="text-center text-white">
                                <tr class="headings darken-4 bg-dark">
                                    {{--<th class="column-title th-acciones" style="width: 110px">ACCIONES</th>--}}
                                    <th class="column-title">MÉDICO</th>
                                    <th class="column-title">TIPO VISITA</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dataVisita as $kme => $primero)
                                    <tr>
<!--                                        <td class="text-center">
                                            {{--@if(true)--}}
                                                <a href="{{ "/pointex/visita_medica/visita/borra_visita/$primero->Id" }}"
                                                   class="btn btn-flat btn-danger tooltip-per"
                                                   data-frm="marca">
                                                    <i class="ft-delete"></i>
                                                </a>
                                                <a href="{{ "/pointex/visita_medica/visita?"."crear=0&editar=$primero->Id-".base64_encode("$primero->NombreLargo|$primero->IdFichero") }}"
                                                   class="btn btn-flat btn-info overOrange aActiveModal tooltip-per"
                                                   data-frm="marca">
                                                    <i class="ft-edit-2"></i>
                                                </a>
                                            {{--@endif--}}
                                        </td>-->
                                        <td>{{ trim($primero->NombreLargo) }}</td>
                                        <td>{{ trim($primero->TipoVisita) }}</td>
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
