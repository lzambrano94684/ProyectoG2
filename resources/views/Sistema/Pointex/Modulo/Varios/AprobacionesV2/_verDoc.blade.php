<style>
    .marca-de-agua {
        background-image: url("/Sistema/Pointex/Modulo/img/{{$marcaAgua}}.JPG");
        background-repeat: repeat;
        background-position: center;
        height: auto;
        margin: auto;
    }

    .watermark {
        position: absolute;
        color: lightgray;
        opacity: 0.25;
        font-size: 3em;
        width: 100%;
        top: 8%;
        text-align: center;
        z-index: 0;
    }

    [data-title]:hover:after {
        opacity: 1;
        transition: all 0.2s ease 0.6s;
        visibility: visible;
    }

    [data-title]:after {
        content: attr(data-title);
        position: absolute;
        padding: 4px 8px 4px 8px;
        color: #ffffff;
        border-radius: 5px;
        box-shadow: 0px 0px 15px #ffffff;
        background-image: -webkit-linear-gradient(
            top, #000000, #000000);

        background-image: -moz-linear-gradient(
            top, #000000, #000000);

        background-image: -ms-linear-gradient(
            top, #000000, #000000);

        background-image: -o-linear-gradient(
            top, #000000, #000000);

        visibility: hidden;
    }
</style>
<section class="invoice-template">
    <div class="card">
        <div class="card-content p-3">
            <div id="invoice-template" class="card-body {{ $marcaAgua ? "marca-de-agua" : null }}">
                <!-- Invoice Customer Details -->
                <div id="invoice-customer-details" class="row pt-2">
                    <div class="col-md-6 col-sm-12  text-center text-md-left">
                        <p><span class="text-muted">Departamento:</span> {{ $dataFirst->Departamento }}</p>
                        <p><span class="text-muted">{{ $dataFirst->IdEjecucionTipo == 1 ?  "Justificación" : "Descripción"}}:</span> <span
                                data-title="{{ $dataFirst->DescEncabezado ? $dataFirst->DescEncabezado : "Sin descripción" }}"
                                style="cursor: pointer">{{ $dataFirst->IdEjecucionTipo == 1 ?  $dataFirst->Justificacion : $dataFirst->DescEncabezado}}</span></p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-center text-md-right">
                        <p><span class="text-muted">Fecha Entrega:</span> {{ $dataFirst->FechaEntrega }}</p>
                        <p><span class="text-muted">Elaborado por:</span> {{ $dataFirst->Usuario }}</p>
                        <p><span class="text-muted">Moneda:</span> {{ $dataFirst->Moneda }}</p>
                    </div>
                </div>
                <!--/ Invoice Customer Details -->
                <!-- Invoice Items Details -->
                <div id="invoice-items-details" class="pt-2">
                    <div class="row">
                        <div class="table-responsive col-sm-12">
                            <table class="table">
                                <div class="watermark"></div>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>País</th>
                                    <th>Cuenta SAP</th>
                                    <!--                                    <th>Desripción</th>-->
                                    <!--                                    <th class="text-right">Cantidad</th>-->
                                    <!--                                    <th class="text-right">Precio</th>-->
                                    @if($dataFirst->IdEjecucionTipo == 1)
                                        <th class="text-right">Cantidad</th>
                                    @endif
                                    <th class="text-right">ML Sub-Total</th>
                                    <th class="text-right">USD Sub-Total<br>
                                        (TC: {{ number_format( $dataFirst->TC, 2, '.', ',') }})
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="aprobado">
                                @if($data->count()>0)
                                    @foreach($data as $kd => $vd)
                                        <tr>
                                            <th scope="row">{{ $kd+1 }}</th>
                                            <th scope="row">{{ $vd->Pais }}</th>
                                            <td>
                                                {{ $vd->CuentaSAP }}
                                            </td>
                                            @if($dataFirst->IdEjecucionTipo == 1)
                                                <td class="text-right">{{ $vd->Cantidad }}</td>
                                            @endif
                                            <td class="text-right">{{ $vd->SubTotalFormatML }}</td>
                                            <td class="text-right">{{ $vd->SubTotalFormat }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Totales:</th>
                                    @if($dataFirst->IdEjecucionTipo == 1)
                                        <th class="text-right">{{ number_format( $data->sum("CantidadLimpio"), 2, '.', ',') }}</th>
                                    @endif
                                    <th class="text-right">{{ number_format( $data->sum("SubTotalLimpioML"), 2, '.', ',') }}</th>
                                    <th class="text-right">{{ number_format( $data->sum("SubTotalLimpio"), 2, '.', ',') }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

