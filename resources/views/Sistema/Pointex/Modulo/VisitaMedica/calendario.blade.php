@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
    {!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.css') !!}
@endsection

@section('content')
    <div class="mb-12">
        <a href="javascript:void(0)"  class="btn btn-raised gradient-purple-bliss white shadow-z-1-hover btn-block">
            <h2 style="animation: scroll-right 20s linear infinite">{{ $mensajeInfo }}</h2>
        </a>
    </div>
    <section id="calendar">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Planificación de Visitas</h4>

                    </div>
                    <div class="card-body">

                        <div id="divCalendar"></div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModalCenter" role="dialog"
         aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="/pointex/visita_medica/visita/guarda_planificacion" method="get" class="form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agendar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <input type="hidden" name="txtFecha" id="txtFecha">
                                <label class="sr-only" for="cmbFichero">Priority</label>
                            </div>
                            <di class="col-6">
                                {!! $cmbTiempoNP !!}
                            </di>
                            <di class="col-6" id="divFichero">
                                    <select id="cmbFichero" name="cmbFichero" class="select2_single">
                                    </select>
                            </di>
                        </div>
                        <div class="row FechaPlanif">
                            <di class="col-6">
                                <fieldset class="form-group">
                                    <label for="Incio">Hora de Inicio</label>
                                    <input type="time" name="HoraInicio" id="HoraInicio" class="form-control"/>
                                </fieldset>
                            </di>
                            <di class="col-6">
                                <fieldset class="form-group">
                                    <label for="Fin">Hora Fin</label>
                                    <input type="time" name="HoraFin" id="HoraFin" class="form-control"/>
                                </fieldset>
                            </di>
                        </div>
                        <div class="row FechaPlanifAM">
                            <di class="col-6">
                                <fieldset class="form-group">
                                    <label for="Incio">Horario</label>
                                    <select class="form-control select2_single" id="cmbHorario" name="cmbHorario">
                                        <option value="">Seleccione</option>
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </fieldset>
                            </di>
                            <di class="col-6">
                                <fieldset class="form-group">
                                    <label for="Fin">Orden de visita</label>
                                    <input type="number" name="Ordenvisita" id="Ordenvisita" class="form-control" min="1"/>
                                </fieldset>
                            </di>
                        </div>
                        <br>
                        <div class="row">
                            <di class="col-12">
                                <textarea id="desc" name="desc" rows="4" cols="50"></textarea>
                            </di>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agendar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')

    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js') !!}

    <script type="text/javascript">
        $(".select2_single").select2({
            width: '100%',
            placeholder: "Seleccione Opción",
            allowClear: true
        });
        $(document).ready(function () {
            var basePlanificacion = atob('{{ $planificacionBase }}');
            var jsonEventos = JSON.parse(basePlanificacion);
            $('#divCalendar').fullCalendar({
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                lang: 'es',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek ,basicDay'
                },
                buttonText: {
                    prev: 'Ant',
                    next: 'Sig',
                    today: 'Hoy',
                    month: 'Mes',
                    basicWeek: 'Semana',
                    basicDay: 'Día'
                },hiddenDays: [0,6],
                timeFormat: 'h(:mm)t',
                selectable: true,
                eventClick: function (calEvent, jsEvent, view) {
                    console.log(calEvent);
                    var check = $.fullCalendar.formatDate(calEvent.start, 'yyyy-MM-dd');
                    var checkM = $.fullCalendar.formatDate(calEvent.start, 'MM');
                    var today = $.fullCalendar.formatDate(new Date(), 'yyyy-MM-dd');
                    var des = calEvent.Descripcion?calEvent.Descripcion:'';
                    // if (Date.parse(check) == Date.parse(today) && calEvent.IdVisita == null || $.fullCalendar.formatDate(calEvent.start, 'MM') >= $.fullCalendar.formatDate(new Date(), 'MM') && calEvent.IdVisita == null) {
                    // if (Date.parse(check) == Date.parse(today) && calEvent.IdVisita == null || '08' == checkM && calEvent.IdVisita == null || '09' == checkM && calEvent.IdVisita == null|| '10' == checkM && calEvent.IdVisita == null|| '11' == checkM && calEvent.IdVisita == null) {

                    var smsPresentacion = "";

                    if(calEvent.tipo == "Visita Medica/Farmacia"){
                        smsPresentacion = "" +
                            "<div class='container'> <div class='row'><div class='col-md-4 offset-md-9'>" +
                            "<a class='btn btn-raised btn-info' href='/pointex/visita_medica/ir_visita/"+calEvent.Id+"' title='ir a la visita'>" +
                            "<i class='fa fa-share-square-o' aria-hidden='true'></i></a></div></div></div>"+
                            "<i class='"+calEvent.Icono+" fa-3x white' aria-hidden='true'></i><br><h4 style='color: #F2F5F7;'>"+calEvent.Medico+"</h4> " +
                            "<table style='width: 100%;border-collapse: separate;border-spacing: 2px;'>" +
                            "<tr><th style='background: #EC6D24'><i class='fa fa-stethoscope white' aria-hidden='true'></i></td><td style='background: #9F9F9F;text-align: center'><h5 style='color: black'><strong>"+ calEvent.EspPromoRegilla+"/ "+ calEvent.EspecialidadPrimaria +"</strong></h5></td></tr>" +
                            "<tr><th style='background: #EC6D24'><i class='fa fa-map-marker white' aria-hidden='true'></i></td><td style='background: #9F9F9F;text-align: center'><h5 style='color: black'><strong>"+ calEvent.Direccion +"</strong></h5></td></tr>" +
                            "</table>";
                    }else{
                        var horaInicio = calEvent.HoraInicio ? calEvent.HoraInicio :'';
                        var horaFin = calEvent.HoraFin ? calEvent.HoraFin :'';
                        horaInicio = horaInicio.length ? horaInicio.slice(0,-6)+" a": ' - - - ';
                        horaFin = horaFin.length ?  horaFin.slice(0,-6): '';
                        smsPresentacion = "" +
                            "<i class='"+calEvent.Icono+" fa-3x white' aria-hidden='true'></i><br><h4 style='color: #F2F5F7;'>"+calEvent.tipo+"</h4>" +
                            "<table style='width: 100%;border-collapse: separate;border-spacing: 2px;'>" +
                            "<tr><th style='background: #EC6D24'><i class='fa fa-clock-o white' aria-hidden='true'></i></td><td style='background: #9F9F9F;text-align: center'><h5 style='color: black'><strong>"+ horaInicio +" "+ horaFin +"</strong></h5></td></tr>" +
                            "<tr><th style='background: #EC6D24'><i class='fa fa-commenting-o white' aria-hidden='true'></i></td><td style='background: #9F9F9F;text-align: center'><h5 style='color: black'><strong>"+ calEvent.Descripcion +"</strong></h5></td></tr>" +
                            "</table>";
                    }


                    if (calEvent.IdVisita == null) {
                        if(calEvent.HoraInicio && calEvent.HoraFin){
                            var sms =  "<div class='row'>" +
                                "<div class='col-12'><br>"+"De "+calEvent.HoraInicio+" a "+calEvent.HoraFin+"<i class='fa fa-clock-o' aria-hidden='true'></i>" + "<br>"+des+ "</div>" + "</div>" + "<br>¿Quitar de la planificación?";
                        }else if(calEvent.Descripcion){
                            var sms =  "<div class='row'><div class='col-12'>" + "<br>"+des+ "</div>" + "</div></div>" + "<br>¿Quitar de la planificación?";
                        }else{
                            var sms =  "<div class='row'><div class='col-12'><br>¿Quitar de la planificación?</div></div";
                        }
                        var cuadro = $(this);
                        cuadro.css('border-color', 'red');
                        swal({
                            title: '',
                            // html: "¿Quitar de la planificación a <strong style='font-weight: bold;'>" + calEvent.title + "</strong>?",
                            html: smsPresentacion,
                            type: '',
                            background: '#333B42',
                            showCancelButton: true,
                            confirmButtonColor: '#0CC27E',
                            cancelButtonColor: '#FF586B',
                            confirmButtonText: 'Quitar',
                            cancelButtonText: "Cancelar",
                        }).then(function (isConfirm) {
                            if (isConfirm) {
                                location.href = '/pointex/visita_medica/visita/borra_plani/' + calEvent.Id;
                            }
                        }).catch(function () {
                            swal.noop;
                            cuadro.css('border-color', '')
                        });
                    }
                    else {
                        if(calEvent.HoraInicio && calEvent.HoraFin){
                            var sms =  "<div class='row'>" +
                                "<div class='col-12'><br>"+"De "+calEvent.HoraInicio+" a "+calEvent.HoraFin+"<i class='fa fa-clock-o' aria-hidden='true'></i>" + "<br>"+des+ "</div>" + "</div>";
                        }else if(calEvent.Descripcion){
                            var sms =  "<div class='row'><div class='col-12'>" + "<br>"+des+ "</div>" + "</div></div>";
                        }
                        var cuadro = $(this);
                        cuadro.css('border-color', 'red');
                        swal({
                            // title: calEvent.titleMSG,
                            html: smsPresentacion,
                            type: '',
                            background: '#333B42',
                            confirmButtonColor: '#0CC27E',
                        }).catch(function () {
                            swal.noop;
                            cuadro.css('border-color', '')
                        });
                    }


                },
                select: function (start, end, allDay) {
                    var check = $.fullCalendar.formatDate(start, 'yyyy-MM-dd');
                    var checkM = $.fullCalendar.formatDate(start, 'MM');
                    var today = $.fullCalendar.formatDate(new Date(), 'yyyy-MM-dd');
                    // if (Date.parse(check) >= Date.parse(today) || $.fullCalendar.formatDate(start, 'MM') >= $.fullCalendar.formatDate(new Date(), 'MM')) {
                    // if (Date.parse(check) >= Date.parse(today) || '08' == checkM || '09' == checkM|| '10' == checkM|| '11' == checkM ) {
                    // if (Date.parse(check) >= Date.parse(today)) {
                        var fecha = start.getFullYear() + '-' + (start.getMonth() + 1) + '-' + start.getDate();
                        var fecha2 = start.getDate() + '/' + (start.getMonth() + 1) + '/' + start.getFullYear();
                        $("#txtFecha").val(fecha);
                        $("#exampleModalLongTitle").html("Planificando para el día: " + fecha2);
                        $("#exampleModalCenter").modal("show")
                        $(".select2_single").select2({
                            width: '100%',
                            placeholder: "Seleccione Opción",
                            allowClear: true
                        });
                        document.getElementById('HoraFin').readOnly = true;
                    // } else {
                        // Its a right date
                        // Do something
                    // }
                    $('#divFichero').hide();
                },
                // eventOrderStrict: true,
                // eventOrder: "title",
                events: jsonEventos
            });

            $(".fc-event-inner span").attr("style", 'color:black');
            // $(".fc-event-title").attr("style", 'font-size: 11px');

            $(".FechaPlanifAM").hide();
        });

        $("#cmbTiempoNP").on('change', function () {
            if(this.value == 19){
                $("#HoraInicio").val("08:00");
                $("#HoraFin").val("17:00");
                document.getElementById('HoraInicio').readOnly = true;
                document.getElementById('HoraFin').readOnly = true;
                $(".FechaPlanif").show();
                $(".FechaPlanifAM").hide();
            }else if(this.value == 1){
                $(".FechaPlanif").hide();
                $(".FechaPlanifAM").show();
            }else{
                document.getElementById('HoraInicio').readOnly = false;
                document.getElementById('HoraFin').readOnly = false;
                $(".FechaPlanif").show();
                $(".FechaPlanifAM").hide();
            }

        });

        $("#HoraInicio").on('change', function () {
            const vInicioP = this.value;
            const tIniP = new Date();
            const pInicioP = vInicioP.split(":");
            tIniP.setHours(pInicioP[0], pInicioP[1]);
            tIniP.setMinutes(tIniP.getMinutes() + 5)
            var nuevaFin = tIniP.getHours() +":" +tIniP.getMinutes();
            $("#HoraFin").val(nuevaFin);
            // $("#HoraFin").val(null);
            document.getElementById('HoraFin').readOnly = false;
        });

        $("#HoraFin").on('change', function () {
            console.log($("#HoraInicio").val(), this.value);
            const vInicio = $("#HoraInicio").val();
            const vFinal = this.value;
            const tIni = new Date();
            const pInicio = vInicio.split(":");
            tIni.setHours(pInicio[0], pInicio[1]);
            const tFin = new Date();
            const pFin = vFinal.split(":");
            tFin.setHours(pFin[0], pFin[1]);
            if (tFin.getTime() > tIni.getTime()) {
                console.log("final mayor a inicio");
            }
            if (tFin.getTime() < tIni.getTime()) {
                $("#HoraFin").val(null);
                swal(
                    'Error!',
                    "Hora incorrecta",
                    'error'
                );
                console.log("final menor a inicio");
            }
            if (tFin.getTime() === tIni.getTime()) {
                $("#HoraFin").val(null);
                swal(
                    'Error!',
                    "Hora incorrecta",
                    'error'
                );
                console.log("Iguales");
            }
        });

        $("#cmbTiempoNP").on("change", function () {
            var fillSecondary = function () {
                $('#cmbFichero').empty();
                $.get("/pointex/visita_medica/get_fichero/" + $('#cmbTiempoNP').val(), null, function (data) {
                    if(data){
                        $('#divFichero').show();
                        // $('#cmbFichero').append('<option selected="true">Seleccione</option>');
                        Object.values(data).forEach(function (elemento, indice, array) {
                            $('#cmbFichero').append('<option value="' + elemento.Id + '">' + elemento.NombreLargo + '</option>');
                        });
                    }else{
                        $('#divFichero').hide();
                    }
                });
            }
            $('#cmbTiempoNP').change(fillSecondary);
            fillSecondary();
        });

        function irVisita(id){
            console.log(id);
        }
    </script>
    @if(session()->get('msg.0'))
        @php($description = session()->get('msg.0.Descripcion'))
        <script>
            @switch(session()->get('msg.0.Tipo'))
            @case("error")
            swal({
                title: "Error!",
                html: "{{ $description }}",
                icon: "error",
                buttons: true,
                dangerMode: true,
            })
            @break
            @endswitch
        </script>
    @endif
@endsection

