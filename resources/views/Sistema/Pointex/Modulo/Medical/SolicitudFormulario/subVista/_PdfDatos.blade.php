<section class="invoice-template">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div id="invoice-template" class="card-body" style="background: #FFFFFF">
                    <br><br><br>
                    <div class="row centrar">
                        <div class="col-4">
                            <img src="{{asset("Sistema/Pointex/Modulo/img/exeltis_logo.png")}}"
                                 alt=""
                                 width="200" height="130">
                        </div>
                        <div class="col-4 offset-4">
                            <img src="{{asset("Sistema/Pointex/Modulo/img/paises.png")}}"
                                 alt=""
                                 width="" height="">
                        </div>
                    </div>
                    <br><br><br>
                    <div class="text-center">
                        <pre><h3><b>SOLICITUD  DE APROBACIÓN  DE EVENTO  DE EDUCACIÓN  MÉDICA  CONTINUA</b></h3></pre>
                    </div>
                    <br>
                    <div class="row d-flex justify-content-center">
                        <table>
                            <tr>
                                <th>
                                    <h3><b># Correlativo del Evento :</b>{{$solicitudEvento->CodReg}}</h3>
                                </th>
                            </tr>
                            @if($solicitudEvento->TipoEvento == "Presencial")
                                <tr>
                                    <th><h3><b>Nombre del Lugar:</b> {{$solicitudEvento->LugarEvento}}</h3></th>
                                </tr>
                            @endif
                            <tr>
                                <th><h3><b>Nombre del Evento :</b> <span
                                        >{{$solicitudEvento->NombreEvento}}</span></h3></th>
                            </tr>
                            <tr>
                                <th><h3><b>Fecha del Evento :</b> <span
                                        >{{$fechaEvento}}</span></h3>
                                </th>
                            </tr>
                            <tr>
                                <th><h3><b>Lugar del Evento :</b>
                                        <span>
                                            @foreach($consultaPais as $kp)
                                                {{$kp->Nombre}},
                                            @endforeach</span></h3>
                                </th>
                            </tr>
                            <tr>
                                <th><h3><b>Hora del Evento :</b> <span>{{$hora}}</span></h3></th>
                            </tr>
                            <tr>
                                <th><h3><b>Franquicia y Productos :</b> <span>{{$solicitudEvento->NombreFranquicia}}
                                        , @foreach($consultaMarca as $kmar)
                                                {{$kmar->Nombre}}.
                                            @endforeach</span></h3></th>
                            </tr>
                            <tr>
                                <th><h3><b>Objetivo :</b> <span>{{$solicitudEvento->Objetivo}}</span>
                                    </h3></th>
                            </tr>
                            <tr>
                                <th><h3><b>Tipo de Evento :</b> <span
                                        >{{$solicitudEvento->TipoEvento}}</span></h3></th>
                            </tr>
                            @if($solicitudEvento->Plataforma)
                                <tr>
                                    <th><h3><b>Plataforma :</b> <span
                                            >{{$solicitudEvento->Plataforma}}</span></h3></th>
                                </tr>
                            @endif
                            @if($solicitudEvento->TipoEvento == "Presencial")
                                <tr>
                                    <th><h3><b>Invitados :</b> <span>{{$solicitudEvento->CantInvitados}} ,Staff
                                            : {{$solicitudEvento->CantStaff}}</span></h3></th>
                                </tr>
                                <tr>
                                    <th><h3><b>Hospedaje :</b> <span
                                            >{{$solicitudEvento->Hospedaje}}</span></h3></th>
                                </tr>
                            @endif
                            <tr>
                                <th><h3><b>Honorarios :</b> <span
                                        >{{$solicitudEvento->Honorarios}}</span></h3></th>
                                <th><h3><b>Costo Total del
                                            Evento:</b> <span
                                        >{{floatval($solicitudEvento->Hospedaje) + floatval($solicitudEvento->Honorarios) + floatval($solicitudEvento->CostoPlatoComida)}}</span>
                                    </h3>
                                </th>
                            </tr>
                            <tr>
                                <th><h3><b>Tipo de Moneda : USD</b></h3></th>
                            </tr>
                            <tr>
                                @if($solicitudEvento->TipoEvento == "Presencial")
                                    <th><h3><b>Costo de Alimentación y Otros
                                                :</b> <span
                                            >{{$solicitudEvento->CostoPlatoComida}}</span></h3>
                                    </th>
                                @else
                                    <th></th>
                                @endif
                                <th><h3><b>Costo Presupuestado:</b> <span
                                        >{{$solicitudEvento->TotalPresupuesto}}</span></h3></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th><h3><b>Desviación :</b> <span
                                        >{{floatval($solicitudEvento->Hospedaje) + floatval($solicitudEvento->Honorarios) + floatval($solicitudEvento->CostoPlatoComida)-$solicitudEvento->TotalPresupuesto}}</span>
                                    </h3></th>
                            </tr>
                            <tr>
                                <th>
                                    <hr>
                                </th>
                                <th>
                                    <hr>
                                </th>
                            </tr>
                            {{--                            @foreach($consultaPais as $kp)--}}
                            {{--                                <tr>--}}
                            {{--                                    <th class="text-center">--}}
                            {{--                                    </th>--}}
                            {{--                                    <th class="text-center">--}}
                            {{--                                        @if($kp->Nombre == "Guatemala")--}}
                            {{--                                            7.7--}}
                            {{--                                        @elseif($kp->Nombre == "El Salvador")--}}
                            {{--                                            1--}}
                            {{--                                        @endif--}}
                            {{--                                    </th>--}}
                            {{--                                </tr>--}}
                            {{--                                <tr>--}}
                            {{--                                    <th class="text-center"></th>--}}
                            {{--                                    <th class="text-center" style="text-decoration-line: overline;">Tipo de Cambio--}}
                            {{--                                        Budget {{$kp->Nombre}}</th>--}}
                            {{--                                </tr>--}}
                            {{--                            @endforeach--}}
                            <tr>
                                <th class="text-center">
                                    {{$fechaEvento}}
                                </th>
                                <th class="text-center">
                                    <div class="linea"></div>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    <span style="text-decoration-line: overline;">Fecha de solicitud</span>
                                </th>
                                <th class="text-center">Controler Finanzas</th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    Jorge López
                                </th>
                                <th class="text-center">
                                    <div class="linea"></div>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    <span style="text-decoration-line: overline;">Aprobado: Director de Medical</span>
                                </th>
                                <th class="text-center">Aprobado: Director Financiero</th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    <br>
                                    <br>
                                    {{$solicitudEvento->Nombres}} {{$solicitudEvento->Apellidos}}
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center"><span style="text-decoration-line: overline;">Solicitante: GP./ GUN./ GF.</span>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
