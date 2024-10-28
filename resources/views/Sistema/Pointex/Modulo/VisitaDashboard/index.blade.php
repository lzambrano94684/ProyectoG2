@extends('Sistema.Pointex.LayOuts.layout')

@section("css")
    <style>
        .table-fixed thead,
        .table-fixed tfoot {
            width: 300px;
        }

        .table-fixed tbody {
            height: 50px;
            overflow-y: auto;
            width: 300px;
        }

        .table-fixed thead,
        .table-fixed tbody,
        .table-fixed tfoot,
        .table-fixed tr,
        .table-fixed td,
        .table-fixed th {
            display: block;
        }

        .table-fixed tbody td,
        .table-fixed thead > tr > th,
        .table-fixed tfoot > tr > td {
            float: left;
        }
    </style>
@stop

@section('content')
    @if($consultaPuesto == 2)
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Dias Trabajados</th>
                                    <th>Dias No Trabajados</th>
                                    <th>Objetivo Dia</th>
                                    <th>Total Prog</th>
                                    <th>OBJ. Ciclo</th>
                                    <th>Visita Total</th>
                                    <th>Alcance_OBJ</th>
                                    <th>Alcance_Real</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coberturaCiclo as $key)
                                    <tr>
                                        <td class="text-center">{{$key->DiasTrabajados}}</td>
                                        <td class="text-center">{{$key->DiasNoTrabajados}}</td>
                                        <td class="text-center">{{round($key->ObjetivoDia,2)}}</td>
                                        <td class="text-center">{{round($key->TotalProg,0)}}</td>
                                        <td class="text-center">{{round($key->ObjCiclo,2)}}</td>
                                        <td class="text-center">{{round($key->VisitaTotal,0)}}</td>
                                        <td class="text-center">{{$key->COB_OBJ}}</td>
                                        <td class="text-center">{{$key->COB_Real}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
        <div id="dash"></div>

    @stop
@section('js')
    <script>
        $(document).ready(function () {
            var IdUs = '{{ $IdUs }}';
            var IdPais = '{{ $consultaIdPais }}';
            var Pais = '{{ $consultaNombrePais }}';
            var consultaPuesto = '{{ $consultaPuesto }}';
            if (consultaPuesto == 2) {
                var params = {
                    "ds0.prm_id_usuario": IdUs,
                    "ds9.prm_id_usuario_plan": IdUs,
                    "ds14.prm_id_usuario_visita": IdUs,
                    "ds25.prm_idusmednovis": IdUs,
                    "ds24.prm_idusmedvis": IdUs,
                };
                var paramsAsString = JSON.stringify(params);
                var encodedParams = encodeURIComponent(paramsAsString);
                if (IdPais == 5) {
                    $("#dash").html('<iframe width="850" height="850" src="https://lookerstudio.google.com/embed/reporting/cd0b5eb5-7dbc-4bc8-b398-92991e8e9c18/page/rkaFD?params=' + encodedParams + '" frameborder="0" style="border:0" allowfullscreen></iframe>');
                } else if (IdPais == 4) {
                    $("#dash").html('<iframe width="850" height="850" src="https://lookerstudio.google.com/embed/reporting/18406576-ffd8-48d6-aa81-7ce97db56275/page/rkaFD?params=' + encodedParams + '" frameborder="0" style="border:0" allowfullscreen></iframe>');
                } else if (IdPais == 3) {
                    $("#dash").html('<iframe width="850" height="850" src="https://lookerstudio.google.com/embed/reporting/f6499dbc-5384-4228-8406-c55b2afc7d53/page/rkaFD?params=' + encodedParams + '" frameborder="0" style="border:0" allowfullscreen></iframe>');
                } else if (IdPais == 2) {
                    $("#dash").html('<iframe width="850" height="850" src="https://lookerstudio.google.com/embed/reporting/8746c53e-e363-4d65-9dfc-6097722403fd/page/rkaFD?params=' + encodedParams + '" frameborder="0" style="border:0" allowfullscreen></iframe>');
                } else {
                    $("#dash").html('<iframe width="850" height="850" src="https://lookerstudio.google.com/embed/reporting/5e16511f-c1da-4636-ae0b-3cc67dc1ae68/page/p_vnaahwqd3c?params=' + encodedParams + '" frameborder="0" style="border:0" allowfullscreen></iframe>');
                }
            } else {
                var params = {
                    "ds0.prm_id_pais": IdPais,
                    "ds5.prm_id_paisdv": IdPais,
                    "ds29.prm_id_pais_cob": IdPais,
                    "ds25.prm_id_pais_cobq": IdPais,
                    "ds45.prm_id_pais_mn": IdPais,
                    "ds46.prm_id_pais_mv": IdPais,
                    "ds15.prm_pais": Pais,
                };
                var paramsAsString = JSON.stringify(params);
                var encodedParams = encodeURIComponent(paramsAsString);
                if (IdPais == 5) {
                    $("#dash").html('<iframe width="850" height="850" src="https://lookerstudio.google.com/embed/reporting/c16417e5-b992-49ed-ae6a-33278ab9e637/page/p_ve667die3c?params=' + encodedParams + '" frameborder="0" style="border:0" allowfullscreen></iframe>');
                } else if (IdPais == 4) {
                    $("#dash").html('<iframe width="850" height="850" src="https://lookerstudio.google.com/embed/reporting/98e4a884-73bf-4219-98e4-278260b6c2c3/page/p_7krufp5t3c?params=' + encodedParams + '" frameborder="0" style="border:0" allowfullscreen></iframe>');
                } else if (IdPais == 3) {
                    $("#dash").html('<iframe width="850" height="850" src="https://lookerstudio.google.com/embed/reporting/e201ff15-b2bf-4898-a7a2-77f564bcb46c/page/p_m6cq4w0t3c?params=' + encodedParams + '" frameborder="0" style="border:0" allowfullscreen></iframe>');
                } else if (IdPais == 2) {
                    $("#dash").html('<iframe width="850" height="850" src="https://lookerstudio.google.com/embed/reporting/783b3e26-f941-490f-87ea-eef04eea4155/page/p_ve667die3c?params=' + encodedParams + '" frameborder="0" style="border:0" allowfullscreen></iframe>');
                } else {
                    // $("#dash").html('<iframe width="850" height="850" src="https://lookerstudio.google.com/embed/reporting/fdab4b57-9368-4fa5-bf71-2200262c49a0/page/XOgFD?params=' + encodedParams + '" frameborder="0" style="border:0" allowfullscreen></iframe>');
                    $("#dash").html('<div class="container"><div class="row"><div class="col"><div class="card"><div class="col-12"><br><div class="nav-vertical"><ul class="nav nav-tabs navbar-horizontal"><li class="nav-item"><a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"href="#tab1" aria-expanded="true">Panamá</a></li><li class="nav-item"><a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"href="#tab2" aria-expanded="false">Nicaragua</a></li><li class="nav-item"><a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"href="#tab3" aria-expanded="false">República Dominicana</a></li><li class="nav-item"><a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4"href="#tab4" aria-expanded="false">El Salvador</a></li></ul><div class="tab-content"><div class="tab-pane active" id="tab1" aria-labelledby="base-tab1"><iframe width="850" height="850"src="https://lookerstudio.google.com/embed/reporting/e201ff15-b2bf-4898-a7a2-77f564bcb46c/page/p_m6cq4w0t3c"frameborder="0" style="border:0" allowfullscreen></iframe></div><div class="tab-pane" id="tab2" aria-labelledby="base-tab2"><iframe width="850" height="850"src="https://lookerstudio.google.com/embed/reporting/98e4a884-73bf-4219-98e4-278260b6c2c3/page/p_7krufp5t3c"frameborder="0" style="border:0" allowfullscreen></iframe></div><div class="tab-pane" id="tab3" aria-labelledby="base-tab3"><iframe width="850" height="850"src="https://lookerstudio.google.com/embed/reporting/c16417e5-b992-49ed-ae6a-33278ab9e637/page/p_ve667die3c"frameborder="0" style="border:0" allowfullscreen></iframe></div><div class="tab-pane" id="tab4" aria-labelledby="base-tab4"><iframe width="850" height="850"src="https://lookerstudio.google.com/embed/reporting/783b3e26-f941-490f-87ea-eef04eea4155/page/p_ve667die3c"frameborder="0" style="border:0" allowfullscreen></iframe></div></div></div></div></div></div></div></div>');
                }
            }
        });

        {{--$(document).ready(function() {--}}
        {{--    var Rep = '{{ $consultaRep }}';--}}
        {{--    var IdUs = '{{ $IdUs }}';--}}
        {{--    var Rep_codificado = encodeURIComponent(Rep);--}}
        {{--    var IdUs_codificado = encodeURIComponent(IdUs);--}}
        {{--    $("#dash").html('<iframe width="850" height="850" src="https://lookerstudio.google.com/embed/reporting/5e16511f-c1da-4636-ae0b-3cc67dc1ae68/page/p_vnaahwqd3c?params=%7B%22ds0.prm_id_usuario'+IdUs_codificado+',%22ds9.prm_id_usuario_plan%22:%228%22,%22ds14.prm_id_usuario_visita%22:%228%22%7D"frameborder="0" style="border:0" allowfullscreen></iframe>');--}}
        {{--    // var valor = decodeURIComponent("%228%22%7D");--}}
        {{--    console.log(IdUs,IdUs_codificado)--}}
        {{--})--}}
    </script>
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>--}}
    {{--    <script>--}}
    {{--        var datoEspecialidad = "{{base64_encode($chartEspecialidad)}}";--}}
    {{--        var arrayEspecialidad = JSON.parse(atob(datoEspecialidad));--}}
    {{--        var datocolorPie = "{{base64_encode($colorPie)}}";--}}
    {{--        var arraycolorPie = JSON.parse(atob(datocolorPie));--}}
    {{--        const xValues = [];--}}
    {{--        const yValues = [];--}}
    {{--        const barColors = [];--}}
    {{--        $.each(arrayEspecialidad, function (index, value) {--}}
    {{--            xValues.push(value.Especialidad);--}}
    {{--            yValues.push(value.Cant);--}}
    {{--        });--}}
    {{--        $.each(arraycolorPie, function (index, value) {--}}
    {{--            barColors.push(value.Codigo);--}}
    {{--        });--}}
    {{--        new Chart("myChart", {--}}
    {{--            type: "pie",--}}
    {{--            data: {--}}
    {{--                labels: xValues,--}}
    {{--                datasets: [{--}}
    {{--                    backgroundColor: barColors,--}}
    {{--                    data: yValues--}}
    {{--                }]--}}
    {{--            },--}}
    {{--            options: {--}}
    {{--                title: {--}}
    {{--                    display: true,--}}
    {{--                    text: "Especialidades"--}}
    {{--                }--}}
    {{--            }--}}
    {{--        });--}}
    {{--    </script>--}}
@stop
