@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
    <style></style>
@endsection

@section('content')
    <div class="mb-12">
        <a href="javascript:void(0)" class="btn btn-raised gradient-purple-bliss white shadow-z-1-hover btn-block">
            <h2 style="animation: scroll-right 10s linear infinite">{{ $mensajeInfo }}</h2>
        </a>
    </div>

    <section id="shopping-cart">
        <div class="row">
            <div class="col-sm-12">
                <div class="card"><div class="card-header">
                        <h4 class="card-title">Planificación de Visitas</h4>

                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary float-lg-right"
                                                onclick="Asignar();">Asignar
                                            Fecha <i class="fa fa-calendar fa-lg"></i></button>
                                        <br>
                                    </div>
                                </div>
                            </div>

                            @if($dataFichero->count()>0)

                                <table class="table  datatablePointerUnic" style="font-size: 10px">
                                    <thead class="text-center text-white">
                                    <tr class="headings darken-4 bg-dark">
                                        <th class="column-title">SELECCIONAR</th>
                                        <th class="column-title">PLANIFICACION</th>
                                        <th class="column-title">MÉDICO</th>
                                        <th class="column-title">DATOS</th>
                                        <th class="column-title">FECHA DE PLANIFICACION</th>
                                        <th class="column-title">Estado</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dataFichero as $kme => $primero)
                                        <tr>

                                            <td style="text-align: center;">
                                                <input type="checkbox" class="checkbox" value="{{$primero->Id}}">
                                            </td>
                                            <td style="text-align: left;">
                                                <strong>{{ trim($primero->Visita) }}</strong><br>
                                            </td>
                                            <td style="text-align: left;">{{ trim($primero->NombreLargo) }}</td>
                                            <td style="text-align: left;"><strong>Frecuencia: </strong>{{ trim($primero->Frecuencia) }}<br><strong>Quintil: </strong>{{ trim($primero->Cat) }}<br><strong>ESP:</strong> {{ trim($primero->Esp) }}<br> <strong>Dirección:</strong> {{ trim($primero->Direccion) }}</td>
                                            <td style="text-align: left;">
                                                <strong>{{ trim($primero->Fecha) }}</strong>
                                            </td>
                                            <td style="text-align: left;">
                                                @if($primero->VisitaRealizada)
                                                <span class="badge badge-success">Visitado</span>
                                                @else
                                                <span class="badge badge-danger">No Visitado</span>
                                                @endif
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




    <div class="modal fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered dtr-modal-display" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-bold-400" id="myModalLabelTitle">Planificar para:</h4>&nbsp;&nbsp;
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="table-responsive">
                                <div class="col-6">
                                        <input id="txtFecha" type="date" class="form-control">
                                </div>
                            <table id="tblModal" class="table table-striped table-bordered hide-columns-dynamically">
                                <thead>
                                <tr>
                                    <th>Cuenta</th>
                                    <th>Horario</th>
                                    <th>Comentarios</th>
                                </tr>
                                </thead>
                                <tbody id="bodyDataModal">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnUpdateCapex" class="btn btn-outline-primary" onclick="Planificar();"><i
                            class="ft-save"></i> Confirmar
                    </button>
                </div>
            </div>
        </div>
    </div>



@stop

@section('js')

    {!! HTML::script('/Sistema/Pointex/Modulo/Finanzas/js/universales.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}

    <script type="text/javascript">
        $(document).ready(function () {
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

            $('#tblModal').DataTable({
                ordering: false,
                destroy: true,
                searching: false, paging: false,
            });
        });

        function Asignar(){
            const checkboxes = document.querySelectorAll('.checkbox');
            const valoresSeleccionados = [];
            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    valoresSeleccionados.push(checkbox.value);
                }
            });
            console.log(valoresSeleccionados);

            $('#modal').modal({
                backdrop:
                    'static', keyboard: true,
            });
            setTimeout(function () {
                loadSelect2();
            }, 200);

            var datos = {
                Id: valoresSeleccionados,
                _token: $("#_token").val()
            };
            $.post("/pointex/visita_medica/planificacion/fichero/asignacion",datos, function (res) {
            console.log(res);
            var htmlBody= "";
            $.each(res.DATA, function (k, v) {
                    htmlBody += '<tr>' +
                        "<td><input value='"+ v.Id +"' type='hidden' class='IdFichero form-control'>"+ v.NombreLargo +'<br><br>Dirección:<br>'+ v.Direccion +'</td>' +
                        "<td>" +
                        "<select id='cmbHorario"+ v.Id +"' class='form-control'>" +
                        "<option selected>Seleccione</option>" +
                        "<option VALUE='AM'>AM</option>" +
                        "<option VALUE='PM'>PM</option>" +
                        "</select>" +
                        "<br> Orden:<input id='txtOrden"+ v.Id +"' type='number' class='form-control'>" +
                        "</td>" +
                        "<td><textarea class='form-control' id='txtComentario"+ v.Id +"'></textarea></td>" +
                        "</tr>";
            });
            $("#bodyDataModal").html(htmlBody);
            });
        }

        function Planificar(){
            const inputs = document.querySelectorAll('.IdFichero');
            const valoresInput = [];
            var data = {};

            if($("#txtFecha").val()){
                inputs.forEach((input) => {
                    data = {
                        Id: input.value,
                        fecha: $("#txtFecha").val(),
                        horario: $("#cmbHorario"+input.value).val(),
                        orden: $("#txtOrden"+input.value).val(),
                        comentario: $("#txtComentario"+input.value).val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };

                    $.post("/pointex/visita_medica/planificacion/fichero/asignacion/save",data, function (res) {
                        if (res.STATUS === "OK") {
                            cargando(2);
                            swal(
                                'Actualizado!',
                                'Planificacion realizada!!',
                                'success'
                            );
                        } else {
                            cargando(2);
                            swal(
                                'Error!',
                                res.SMS,
                                'error'
                            );
                        }
                    });

                });
            }else{
                swal(
                    'Error!',
                    'La fecha es requerida',
                    'error'
                );
            }


        }

    </script>

@stop
