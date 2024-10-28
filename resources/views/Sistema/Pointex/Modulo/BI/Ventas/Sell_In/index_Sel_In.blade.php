@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")

@endsection

@section('content')

    <section id="basic-tabs-components">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">{{ $titleMsg }}</div>
            </div>
        </div>
        @include("Sistema.Pointex.Modulo.BI.Ventas.Sell_In._subVistasSel_In._filtro_busqueda")
        <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
                <div class="card" style="height: 100%;">
                    <div class="card-header">
                        <h4 class="card-title">Reporte de Ventas</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                                       href="#tab1" aria-expanded="true">
                                        Detalle
                                    </a>
                                </li>
                               <li class="nav-item">
                                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
                                       href="#tab2" aria-expanded="false">
                                       Dashboard
                                    </a>
                                </li>
                                <!--                               <li class="nav-item">
                                                                  <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"
                                                                     href="#tab3" aria-expanded="false">
                                                                      Resumen Por Cliente
                                                                  </a>
                                                              </li>
                                                              <li class="nav-item">
                                                                  <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4"
                                                                     href="#tab4" aria-expanded="false">
                                                                      Resumen Por Producto
                                                                  </a>
                                                              </li>
                                                              <li class="nav-item">
                                                                  <a class="nav-link" id="base-tab5" data-toggle="tab" aria-controls="tab5"
                                                                     href="#tab5" aria-expanded="false">
                                                                      Comportamiento Por País y Cliente
                                                                  </a>
                                                              </li>-->
                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true"
                                     aria-labelledby="base-tab1">
                                    <p>@include("Sistema.Pointex.Modulo.BI.Ventas.Sell_In._subVistasSel_In._tabla")</p>
                                </div>
                                <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                                    <iframe width="100%" height="800"
                                            src="https://app.powerbi.com/view?r=eyJrIjoiMzVkYmM2NWItZTI4Zi00MWZkLTliZGUtZDQwZDVlOGIzMWMxIiwidCI6ImEwYTVlZmU2LWQ0MjMtNDA3Ni05MTM2LTY5ZDA0OTNhZWY2OCJ9" frameborder="0"
                                            allowFullScreen="true"></iframe>
                                </div>
                                <div class="tab-pane" id="tab3" aria-labelledby="base-tab3">
                                    <p>{{--@include("Sistema.Pointex.Modulo.BI.Ventas.Sell_In._subVistasSel_In._tablaCliente")--}}</p>
<!--                                    <div id="charCliente" style="height: 600px"></div>-->
                                </div>
                                <div class="tab-pane" id="tab4" aria-labelledby="base-tab4">
                                    <p>{{--@include("Sistema.Pointex.Modulo.BI.Ventas.Sell_In._subVistasSel_In._tablaProducto")--}}</p>
<!--                                    <div id="charProducto" style="height: 600px"></div>-->
                                </div>
                                <div class="tab-pane" id="tab5" aria-labelledby="base-tab5">
                                    {{--@php($options = $data->transform(function ($v) { $v->paisClientev = base64_encode($v->NombreBI)."/".$v->Codigo; $v->paisClienteh ="$v->NombreBI $v->CodigoBI"; return $v;})->pluck("paisClienteh", "paisClientev"))--}}
                                    <select id="cmbPaisCleinte" class="select2_single">
                                        <option value="">Seleccione</option>
                                        {{--@foreach($options as $ko => $vo)--}}
                                            <option value="{{ '$ko' }}">{{ '$vo' }}</option>
                                        {{--@endforeach--}}
                                    </select>
                                    <div id="viewDash">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('js')
    {!! HTML::script('/Sistema/Pointex/Modulo/Finanzas/js/universales.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    <script type="text/javascript">
        $(document).ready(function () {
            $(".select2_single").select2({
                width: '100%',
                placeholder: "Seleccione Opción",
                allowClear: true
            });
            JsonDatatableViews.paging = false;
            JsonDatatableViews.scrollY = "400px";
            var datatablePointerUnic = $(".datatablePointerUnic");
            if (datatablePointerUnic.length) {
                datatableViews = datatablePointerUnic.DataTable(JsonDatatableViews);
            }
            $(".clearCache").on("click", function () {
                datatableViews.state.clear();
                location.reload(true);
            });
            $( "#base-tab1, #base-tab2, #base-tab3, #base-tab4" ).on( "click", function () {
                setTimeout(function () {
                    datatableViews.draw();
                }, 1);
            } );
        });
    </script>
<!--    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>-->
    <script type="text/javascript">
        v/*ar jsonPais = JSON.parse(atob(dataPais));
        var jsonCliente = JSON.parse(atob(dataCliente));
        var jsonProducto = JSON.parse(atob(dataProducto));

        //jQuery.noConflict();
        $(document).ready(function () {
            $("#cmbPaisCleinte").on("change", function () {
                cargando(1);
                if (this.value) {
                    $.get("/pointex/promotion/reportes/condicion_comercial/" + this.value + "?form=0", function (response) {
                        cargando(0);
                        $("#viewDash").html(response.vista);
                        var jsonGrafica = JSON.parse(atob(response.dataChart));
                        jsonGrafica.exporting = {
                            formAttributes: {
                                target: '_blank'
                            }
                        };
                        Highcharts.chart('grafica', jsonGrafica);
                    });
                } else {
                    cargando(0);
                }
            });

            Highcharts.chart('charPais', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Ventas por País'
                },
                xAxis: {
                    categories: jsonPais.head
                },
                yAxis: {
                    title: {
                        text : "USD+000"
                    }
                },
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                },
                plotOptions: {
                    series: {
                        pointWidth: 20
                    }
                },
                credits: {
                    enabled: false
                },
                series: [
                    {
                        data: jsonPais.v100,
                        name: "Venta 100",
                    },
                    {
                        data: jsonPais.v97,
                        name: "Venta 97",
                    },
                    {
                        data: jsonPais.pve,
                        name: "Vencidos",
                    },
                    {
                        data: jsonPais.pbd,
                        name: "Desc/Bon",
                    },
                    {
                        data: jsonPais.pvn,
                        name: "Venta Neta",
                    }
                ]
            });

            var jsonChart = {
                chart: {
                    type: 'bar',
                    marginLeft: 150
                },
                xAxis: {
                    type: 'category',
                    title: {
                        text : "Orden por Venta Neta",
                    },
                    min: 0,
                    max: 1,
                    scrollbar: {
                        enabled: true
                    },
                    tickLength: 0
                },
                yAxis: {
                    title: {
                        text: 'USD+000',
                        align: 'high'
                    }
                },
                credits: {
                    enabled: false
                }
            };

            jsonChart.title = {
                text: 'Venta por Cliente'
            };

            jsonChart.series = [
                getseries(jsonCliente.v100, 'Ventas al 100'),
                getseries(jsonCliente.v97, 'Ventas 97'),
                getseries(jsonCliente.ven, 'Vencidos'),
                getseries(jsonCliente.bon, 'Bonificados'),
                getseries(jsonCliente.vneta, 'Venta Neta')
            ];

            Highcharts.chart('charCliente', jsonChart);
            jsonChart.title = {
                text: 'Unidades por Producto'
            };
            jsonChart.series = [
                getseries(jsonProducto, 'Unidades'),
            ];
            jsonChart.xAxis.title.text = ""
            Highcharts.chart('charProducto', jsonChart);

        });

        function getseries(venta, nombre) {
            var seriesVentaCliente = {
                name: nombre,
                data: venta
            };
            return seriesVentaCliente;*/
        }

    </script>
@endsection
