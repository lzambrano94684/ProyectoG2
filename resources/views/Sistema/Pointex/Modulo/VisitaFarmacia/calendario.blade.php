@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
    {!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.css') !!}
@endsection

@section('content')
    <div class="mb-12">
        <a href="javascript:void(0)" class="btn btn-raised gradient-purple-bliss white shadow-z-1-hover btn-block">
            <h2 style="animation: scroll-right 10s linear infinite">{{ $mensajeInfo }}</h2>
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
                <form action="/pointex/visita_medica/farmacia/guarda_planificacion" method="get" class="form">
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
                            <di class="col-6">
                                {!! $cmbFichero !!}
                            </di>
                        </div>
                        <div class="row">
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
                        <div class="row">
                            <di class="col-12">
                                <textarea id="desc" name="desc" rows="4" cols="50"></textarea>
                            </di>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Agendar</button>
                        </div>
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
                    var check = $.fullCalendar.formatDate(calEvent.start, 'yyyy-MM-dd');
                    var today = $.fullCalendar.formatDate(new Date(), 'yyyy-MM-dd');
                    var des = calEvent.Descripcion?calEvent.Descripcion:'';
                    if (Date.parse(check) == Date.parse(today) && calEvent.IdVisita == null) {
                        if (calEvent.HoraInicio && calEvent.HoraFin) {
                            var sms = "<div class='row'>" + "<div class='col-12'><br>" +
                                "De " + calEvent.HoraInicio + " a " + calEvent.HoraFin + "<i class='fa fa-clock-o' aria-hidden='true'></i>" + "<br>" + des + "</div>" + "</div>" + "<br>¿Quitar de la planificación?";
                        } else if (calEvent.Descripcion) {
                            var sms = "<div class='row'><div class='col-12'>" + "<br>" + des + "</div>" + "</div></div>" + "<br>¿Quitar de la planificación?";
                        } else {
                            var sms = "<div class='row'><div class='col-12'><br>¿Quitar de la planificación?</div></div";
                        }

                        var cuadro = $(this);
                        cuadro.css('border-color', 'red');
                        swal({
                            title: calEvent.title,
                            html: sms,
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#0CC27E',
                            cancelButtonColor: '#FF586B',
                            confirmButtonText: 'Quitar',
                            cancelButtonText: "Cancelar"
                        }).then(function (isConfirm) {
                            if (isConfirm) {
                                location.href = '/pointex/visita_medica/visita/borra_plani/' + calEvent.Id;
                            }
                        }).catch(function () {
                            swal.noop;
                            cuadro.css('border-color', '')
                        });
                    }else {
                        if (calEvent.HoraInicio && calEvent.HoraFin) {
                            var sms = "<div class='row'>" + "<div class='col-12'><br>" +
                                "De " + calEvent.HoraInicio + " a " + calEvent.HoraFin + "<i class='fa fa-clock-o' aria-hidden='true'></i>" + "<br>" + des + "</div>" + "</div>";
                        } else if (calEvent.Descripcion) {
                            var sms = "<div class='row'><div class='col-12'>" + "<br>" + des + "</div>" + "</div></div>";
                        }
                        var cuadro = $(this);
                        cuadro.css('border-color', 'red');
                        swal({
                            title: calEvent.title,
                            html: sms,
                            type: 'info',
                            confirmButtonColor: '#0CC27E',
                        }).catch(function () {
                            swal.noop;
                            cuadro.css('border-color', '')
                        });
                    }

                },
                select: function (start, end, allDay) {
                    var check = $.fullCalendar.formatDate(start, 'yyyy-MM-dd');
                    var today = $.fullCalendar.formatDate(new Date(), 'yyyy-MM-dd');
                    if (Date.parse(check) >= Date.parse(today)) {
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
                    } else {
                        // Its a right date
                        // Do something
                    }
                },
                events: jsonEventos,
                nextDayThreshold: '09:00:00'
            });


        });

        $("#cmbTiempoNP").on('change', function () {
            if(this.value == 19){
                $("#HoraInicio").val("08:00");
                $("#HoraFin").val("17:00");
                document.getElementById('HoraInicio').readOnly = true;
                document.getElementById('HoraFin').readOnly = true;
            }else {
                document.getElementById('HoraInicio').readOnly = false;
                document.getElementById('HoraFin').readOnly = false;
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

