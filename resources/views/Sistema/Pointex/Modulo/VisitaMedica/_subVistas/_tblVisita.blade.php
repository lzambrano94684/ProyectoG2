<div class="offset-6 col-6 text-right">
    <a href="/pointex/visita_medica/visita/fichero"
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
                                    <th class="column-title th-acciones" style="width: 110px">ACCIONES</th>
                                    <th class="column-title">MÉDICO</th>
                                    <th class="column-title">TIPO VISITA</th>
                                    <th class="column-title">MUESTRA ENTREGADA</th>
                                    <th class="column-title">PROMOCIONES</th>
                                    <th class="column-title">Confirmar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dataVisita as $kme => $primero)
                                    <tr>
                                        <td class="text-center">
                                            @if(!$primero->Estado)
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
                                            @endif
                                        </td>
                                        <td>{{ trim($primero->NombreLargo) }}</td>
                                        <td>{{ trim($primero->TipoVisita) }}</td>
                                        <td>{{ $entregaMM->from("MD_EntregaMM as emm")
                                        ->join("MD_ProductoPresentacion as mm", "emm.IdMuestra", "=", "mm.Id")
                                        ->select(Illuminate\Support\Facades\DB::raw("CONCAT(emm.Cantidad, ' ', mm.Presentacion) as Nombre"))
                                        ->where("emm.IdVisita", $primero->Id)->get()->pluck("Nombre")->join(', ', ' y ') }}</td>
                                        <td>{{ $promocion->from("MD_Promocion as emm")
                                        ->join("MD_ProductoPresentacion as mm", "emm.IdProducto", "=", "mm.Id")
                                        ->join("MD_Productos as p", "mm.IdProducto", "=", "p.Id")
                                        ->select("Nombre")
                                        ->where("emm.IdVisita", $primero->Id)->get()->pluck("Nombre")->join(', ', ' y ') }}</td>
                                        <td>
                                            <a onclick="Confirmar({{$primero->Id}},1,'Enviar{{$primero->Id}}');"
                                               id="Enviar{{$primero->Id}}"
                                                class="form-control text-white btn btn-success {{ $primero->Estado != 1 ? 'mostrar':'ocultar' }}">
                                                <i class="fas fa-random text-white"> Enviar</i>
                                            </a>
                                            <a onclick="Confirmar({{$primero->Id}},0,'Cancelar{{$primero->Id}}');"
                                               id="Cancelar{{$primero->Id}}"
                                                class="form-control text-white btn btn-warning {{ $primero->Estado != 1 ? 'ocultar':'mostrar' }}">
                                                <i class="fa fa-times text-white"> Cancelar</i>
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
