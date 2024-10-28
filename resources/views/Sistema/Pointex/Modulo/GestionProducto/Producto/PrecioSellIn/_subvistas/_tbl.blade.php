<section class="basic-elements">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-basic">{{ $titleMsg }}</h4>
                    <p class="card-text"> si deseas
                        crear
                        más
                        favor dar click
                        <a class="btn btn-flat btn-danger" href="/pointex/gestion/sell_in/agregar">aquí</a>
                    </p>

                    <table class="table  text-center datatablePointer">
                        <thead class="headings darken-4 bg-dark text-white">
                        <tr>
                            <th>Acciones</th>
                            <th>SKU SAP</th>
                            <th>Nombre Sap</th>
                            <th>Pais</th>
                            <th>Monto</th>
                            <th>Moneda</th>
                            <th>Planta</th>
                            <th>Promocionado/No promocionado</th>
                            <th>Origen</th>
                            <th>SKU Padre</th>
                            <th>Nombre Padre</th>
                            <th>Incoterm</th>
                        </tr>
                        </thead>
                        @foreach($data as $kd)
                            <tbody>
                            <tr>
                                <th class="text-center">
                                    <a href="{{ url("/pointex/gestion/sell_in/edit{$kd->Id}")}}">
                                        <i class="ft-edit-2"></i>
                                    </a>
                                    &nbsp
                                    <a href="javascript:void(0)" class="eventoClickElimina" id="{{ $kd->Id }}">
                                        <i class="ft-trash danger"></i>
                                    </a>
                                </th>
                                <th>{{$kd->SKUSAP}}</th>
                                <th>{{$kd->NombreSAP}}</th>
                                <th>{{$kd->IdPais}}</th>
                                <th>{{$kd->Monto}}</th>
                                <th>{{$kd->IdMoneda}}</th>
                                <th>{{$kd->IdPlanta}}</th>
                                @if($kd->EstatusPromocion == 1)
                                    <th>Promocionado</th>
                                @else
                                    <th>No Promocionado</th>
                                @endif
                                <th>{{$kd->Origen}}</th>
                                <th>{{$kd->SKUPadre}}</th>
                                <th>{{$kd->NombrePadre}}</th>
                                <th>{{$kd->IdIncoterm}}</th>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
