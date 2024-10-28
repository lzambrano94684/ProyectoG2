@extends("Sistema.Pointex.LayOuts.layout")
@section('title',$titleMsg)

@section("css")
@stop

@section('content')
    <section id="simple-table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <br>
                    <div class="card-header">
                        <h4 class="card-title">Listado de Productos Descontinuados</h4>
                        <p>A continuación un listado de aprobaciones o rechazos de Productos Descontinuados.</p>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                                       href="#tab1" aria-expanded="true">Productos Descontinuados</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
                                       href="#tab2" aria-expanded="false">No Descontinuado</a>
                                </li>
                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true"
                                     aria-labelledby="base-tab1">
                                    <br>
                                    <table id="datatable-pais"
                                           class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer"
                                           cellspacing="0">
                                        <thead class="thead-dark">
                                        <tr class="headings">
                                            <th class="column-title no-link last" style="text-align: center"><span
                                                    class="nobr">ACCIONES</span>
                                            </th>
                                            <th class="column-title no-link last" style="text-align: center">Pais</th>
                                            <th class="column-title no-link last" style="text-align: center">Fecha</th>
                                            <th class="column-title no-link last" style="text-align: center">Producto
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($dataDescontinuado as $kd)
                                            <tr class="">
                                                <td class="last" align="center">
                                                    <a href="/pointex/gestion/descontinuados?{{ base64_encode("aprobarUno=$kd->Id") }}"
                                                       class="success">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                    &nbsp;
                                                    <code style="cursor: pointer;color: #9f191f"
                                                          class="codeCrearItem"
                                                          data-toggle="tooltip"
                                                          data-placement="top"
                                                          data-titulo="Observaciones"
                                                          data-modelo="PX_GP_ProductoDescontinuadoDetalle"
                                                          data-Observaciones="Observaciones"
                                                          data-id="{{$kd->Id}}"><i class="fas fa-times"></i>
                                                    </code>
                                                </td>
                                                <td class="last" align="center">{{$kd->Pais}}</td>
                                                <td class="last" align="center">{{$kd->Fecha}}</td>
                                                <td class="last" align="center">{{$kd->DescripcionSap}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                                    <div class="row" matchheight="card">
                                        <br>
                                        <table id="datatable-pais"
                                               class="table custom-table table-striped table-bordered table-hover table-condensed nowrap datatablePointer"
                                               cellspacing="0">
                                            <thead class="thead-dark">
                                            <tr class="headings">
                                                <th class="column-title no-link last" style="text-align: center"><span
                                                        class="nobr">ACCIONES</span>
                                                </th>
                                                <th class="column-title no-link last" style="text-align: center">Pais
                                                </th>
                                                <th class="column-title no-link last" style="text-align: center">Fecha
                                                </th>
                                                <th class="column-title no-link last" style="text-align: center">
                                                    Producto
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($dataNoDescontinuado as $kd)
                                                <tr class="">
                                                    <td class="last" align="center">
                                                        <a href="/pointex/gestion/descontinuados?{{ base64_encode("aprobarUno=$kd->Id") }}"
                                                           class="success">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                        &nbsp;
                                                        <code style="cursor: pointer;color: #9f191f"
                                                              class="codeCrearItemdos"
                                                              data-toggle="tooltip"
                                                              data-placement="top"
                                                              data-titulo="Observaciones"
                                                              data-modelo="PX_GP_ProductoDescontinuadoDetalle"
                                                              data-Observaciones="Observaciones"
                                                              data-id="{{$kd->Id}}"><i class="fas fa-times"></i>
                                                        </code>
                                                    </td>
                                                    <td class="last" align="center">{{$kd->Pais}}</td>
                                                    <td class="last" align="center">{{$kd->Fecha}}</td>
                                                    <td class="last" align="center">{{$kd->DescripcionSap}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

    <script>
        $("#base-tab1, #base-tab2, #base-tab3, #base-tab4,#base-tab5,#base-tab6,#base-tab7").on("click", function () {
            setTimeout(function () {
                datatableViews.draw();
            }, 1);
        });


        addItemSelected($(".codeCrearItem"), false);

        function addItemSelected(selector) {
            selector.on('click', function () {
                var id = $(this).data("id");
                var titulo = $(this).data("titulo");
                var modelo = $(this).data("modelo");
                var Observaciones = $(this).data("Observaciones");
                addNewOptionSelected(id, titulo, modelo, Observaciones);
            });
        }

        function addNewOptionSelected(id, titulo, modelo, Observaciones) {
            swal({
                title: titulo,
                html: '<textarea id="swal-Observaciones" class="swal2-input" placeholder="Observaciones"></textarea> ' +
                      '<input id="swal-id" value="'+id+'" type="hidden" class="swal2-input">',
                showCancelButton: true,
                confirmButtonText: 'Enviar',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                focusConfirm: false,
                customClass: 'swal-wide',
            }).then(function (result) {
                var valorObservaciones = document.getElementById('swal-Observaciones').value;
                var id = document.getElementById('swal-id').value;
                if (!valorObservaciones) {
                    mensaje = "¡Las Observaciones son requeridos!";
                    errorMsg();
                } else {
                    cargando(1);
                    var dataFrm = {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        tabla: modelo.trim(),
                        id: id,
                        Observaciones: Observaciones,
                        valorobservaciones: valorObservaciones
                    };
                    $.post("/pointex/gestion/descontinuados/save", dataFrm, function (resp) {
                        if (resp.STATUS == "OK") {
                            mensaje = "Datos guardados con exito";
                            successMsg();
                        } else {
                            mensaje = resp.DATA;
                            errorMsg()
                        }
                        cargando(2);
                    })
                }
            })
        }

        addItemSelecteddos($(".codeCrearItemdos"), false);

        function addItemSelecteddos(selector) {
            selector.on('click', function () {
                var id = $(this).data("id");
                var titulo = $(this).data("titulo");
                var modelo = $(this).data("modelo");
                var Observaciones = $(this).data("Observaciones");
                addNewOptionSelecteddos(id, titulo, modelo, Observaciones);
            });
        }

        function addNewOptionSelecteddos(id, titulo, modelo, Observaciones) {
            swal({
                title: titulo,
                html: '<textarea id="swal-Observaciones" class="swal2-input" placeholder="Observaciones"></textarea> ' +
                      '<input id="swal-id" value="'+id+'" type="hidden" class="swal2-input">',
                showCancelButton: true,
                confirmButtonText: 'Enviar',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                focusConfirm: false,
                customClass: 'swal-wide',
            }).then(function (result) {
                var valorObservaciones = document.getElementById('swal-Observaciones').value;
                var id = document.getElementById('swal-id').value;
                if (!valorObservaciones) {
                    mensaje = "¡Las Observaciones son requeridos!";
                    errorMsg();
                } else {
                    cargando(1);
                    var dataFrm = {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        tabla: modelo.trim(),
                        id: id,
                        Observaciones: Observaciones,
                        valorobservaciones: valorObservaciones
                    };
                    $.post("/pointex/gestion/descontinuados/save_dos", dataFrm, function (resp) {
                        if (resp.STATUS == "OK") {
                            mensaje = "Datos guardados con exito";
                            successMsg();
                        } else {
                            mensaje = resp.DATA;
                            errorMsg()
                        }
                        cargando(2);
                    })
                }
            })
        }

        function errorMsg() {
            swal(
                'Error!',
                mensaje,
                'error'
            );
            mensaje = "";
        }

        function successMsg() {
            swal(
                'Ok!',
                mensaje,
                'success'
            ).then(function (isConfirm) {
                if (isConfirm) {
                    location.reload();
                }
            });
            mensaje = "";
        }
    </script>
@endsection

