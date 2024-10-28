function errorMsg() {
    swal(
        'Error!',
        mensaje,
        'error'
    );
    mensaje = "";
}

$.extend($.validator.messages, {
    required: "Este campo es obligatorio.",
    remote: "Por favor, completá este campo.",
    email: "Por favor, escribí una dirección de correo válida.",
    url: "Por favor, escribí una URL válida.",
    date: "Por favor, escribí una fecha válida.",
    dateISO: "Por favor, escribí una fecha (ISO) válida.",
    number: "Por favor, escribí un número entero válido.",
    digits: "Por favor, escribí sólo dígitos.",
    creditcard: "Por favor, escribí un número de tarjeta válido.",
    equalTo: "Por favor, escribí el mismo valor de nuevo.",
    extension: "Por favor, escribí un valor con una extensión aceptada.",
    maxlength: $.validator.format("Por favor, no escribas más de {0} caracteres."),
    minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
    rangelength: $.validator.format("Por favor, escribí un valor entre {0} y {1} caracteres."),
    range: $.validator.format("Por favor, escribí un valor entre {0} y {1}."),
    max: $.validator.format("Por favor, escribí un valor menor o igual a {0}."),
    min: $.validator.format("Por favor, escribí un valor mayor o igual a {0}."),
    nifES: "Por favor, escribí un NIF válido.",
    nieES: "Por favor, escribí un NIE válido.",
    cifES: "Por favor, escribí un CIF válido."
});

$(document).ready(function () {

    var form = $(".icons-tab-steps");
    form.validate({
        onclick: false, // <-- add this option
        errorPlacement: function (error, element) {
            var labelInput = $("label[for='" + element[0].id + "']").text().replace("Agregar Nuevo", "");
            mensaje = error.text().replace("Este campo", labelInput.trim());
            errorMsg();
        }
    });
    form.steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: 'Guardar',
            next: "Siguiente",
            previous: "Anterior",
            loading: "Cargando ..."
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            var txtPresupueto = $("#txtPresupueto").val();
            if (currentIndex == 0) {
                if (parseInt(txtPresupueto)) {
                    txtPresupueto = parseInt(txtPresupueto);
                    if (!txtPresupueto > 0) {
                        mensaje = "El presupuesto debe ser positivo";
                        errorMsg();
                        return false;
                    }
                }
            }

            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            $("#formEventoMedical").submit();
        }
    });

    // To select event date
    $('.pickadate').pickadate();

});

// validate


$(document).ready(function () {


    $(".select2_single").select2({
        width: '100%'
    });

    $(".select2ModPersonas").select2({
        placeholder: "Seleccione Opción",
        allowClear: true,
        language: "es",
        dropdownParent: $('#modalPersonas')
    });

    $(".select2_group").select2({});

    // $(".select2_multiple").select2({
    //     maximumSelectionLength: 2,
    //     placeholder: "Máximo 2 Productos",
    //     allowClear: true,
    //     language: "es"
    // });

    $(".select2ModPerson").select2({
        placeholder: "Seleccione Opción",
        allowClear: true,
        language: "es",
        dropdownParent: $('#modalPersona')
    });

    $("#slcFranquicia").on("change", function () {
        cargando(1)
        changeFranquicia(this.value, "{}")
    });
});

/**
 *
 * @param value
 * @param select
 */
function changeFranquicia(value, select) {
    select = JSON.parse(select);
    // console.log(select)
    $.get("/pointex/medical/eventos/educ/producto/" + value, function (response) {
        cargando(0)
        var franquicia = $("#slcFranquicia").val();

        $("#slcProducto").empty();
        $.each(response, function (key, value) {
            var seleted = jQuery.inArray(parseInt(value.Id), select) !== -1 ? 'selected' : '';
            $("#slcProducto").append('<option value=' + value.Id + ' ' + seleted + '>' + value.Nombre + '</option>');
        });

    }).fail(function (jqXHR, textStatus) {
        cargando(0)
        $("#slcProducto").empty();
    });
}

$(document).ready(function () {

    function CalculosFromMedical() {
        var options2 = {style: 'currency', currency: 'USD'};
        var numberFormat2 = new Intl.NumberFormat('en-US', options2);

        var CantHonorarios = parseFloat($('#txtMontoHonorario').val());
        var CantHospedaje = parseFloat($('#txtMontoHospedaje').val());
        var CantInvitados = parseInt($('#txtCantInvidados').val());
        var CantStaff = parseInt($('#txtCantStaff').val());
        var CantComida = parseFloat($('#txtMontoComida').val());
        var CatPresupuestada = parseFloat($('#txtTotalPresupueto').val());
        var TotalComida = (CantInvitados + CantStaff) * CantComida;
        var TotalEvento = CantHonorarios + CantHospedaje + TotalComida;
        var TotalCom = numberFormat2.format(TotalComida);
        var TotalEvet = numberFormat2.format(TotalEvento);
        var Desviacion = numberFormat2.format(TotalEvento - CatPresupuestada);
        var txtTotalEvento = $('#txtTotalEvento');
        if (isNaN(TotalEvento)) {
            $('#txtTotalEvento').val(0);
            $('#txtTotalComida').val(0);
            $('#txtDesviacion').val(0);
        } else {
            $('#txtTotalComida').val(TotalCom);
            $('#txtTotalEvento').val(TotalEvet);
            $('#txtDesviacion').val(Desviacion);
            //validaciones presupuesto
            if (TotalEvento > CatPresupuestada) {
                txtTotalEvento.removeClass("has-success");
                txtTotalEvento.addClass("has-error");
                $(".actions").hide();
                if (TotalEvento > CatPresupuestada) {
                    mensaje = "No tienes el Presupuesto suficiente";
                    errorMsg(mensaje)
                }
            } else {
                txtTotalEvento.removeClass("has-error");
                txtTotalEvento.addClass("has-success");
                $(".actions").show();
            }
        }
    }


    $('#txtMontoHonorario,#txtMontoHospedaje,#txtMontoComida,#txtCantInvidados,#txtCantStaff').change(function () {

        CalculosFromMedical();

    });

    CalculosFromMedical();

// monto

    // $('#slcMes,#slcPais,#slcFranquicia, #slcProducto').change(function () {
    //     var Persona = $("#txtUsuarioInicial").val();
    //     var IdPersona = $("#txtUsuario").val();
    //     var IdMes = $("#slcMes").val();
    //     // var IdPais = $("#slcPais").val();
    //     var IdPais = $('#slcPais-meal-type').val();
    //
    //     var IdFranquicia = $("#slcFranquicia").val();
    //     var IdMarca = $("#slcProducto").val();
    //     var CodPais = null;
    //     var CodFranquicia = null;
    //     $.each($("#slcPais  option"), function () {
    //         if (IdPais == this.value) {
    //             CodPais = this.text;
    //         }
    //     });
    //     $.each($("#slcFranquicia  option"), function () {
    //         if (IdFranquicia == this.value) {
    //             CodFranquicia = $(this).attr("codigo");
    //         }
    //     });
    //     var currentTime = new Date()
    //     var year = currentTime.getFullYear()
    //     var codReg = null;
    //     if (IdMes >= 10) {
    //         codReg = CodPais + "-" + "MR" + "-" + CodFranquicia + "-" + Persona + "-" + year + "-" + IdMes + "-";
    //     } else {
    //         codReg = CodPais + "-" + "MR" + "-" + CodFranquicia + "-" + Persona + "-" + year + "-0" + IdMes + "-";
    //     }
    //     cargando(1)
    //     $.get("/pointex/medical/eventos/educ/monto/" + IdPersona + "/" + IdFranquicia + "/" + IdMarca + "/" + IdPais + "/" + IdMes, function (response) {
    //         cargando(0)
    //
    //         $(".presupuesto").empty();
    //         if (jQuery.isEmptyObject(response[0].Monto)) {
    //             $('#txtTotalPresupueto').val(0);
    //             $('#txtPresupueto').val(0);
    //             $('#txtCodReg').val('Sin Presupuesto');
    //             $(".actions").hide();
    //         } else {
    //             $(".actions").show();
    //             $.each(response, function (key, value) {
    //                 if (jQuery.isEmptyObject(value)) {
    //                     $('#txtTotalPresupueto').val(0);
    //                     $('#txtPresupueto').val(0);
    //                     $('#txtCodReg').val('Sin Presupuesto');
    //                     $(".actions").hide();
    //                     $('.presupuesto').append(
    //                         $('<label for="">Total Presupuestado:</label> ' +
    //                             ' <input type="text" class="form-control" id="txtPresupueto" readonly>').val('Sin Presupuesto')
    //                     );
    //                 } else {
    //                     var options2 = {style: 'currency', currency: 'USD'};
    //                     var numberFormat2 = new Intl.NumberFormat('en-US', options2);
    //
    //                     var MontoMedical = numberFormat2.format(value.Monto);
    //
    //                     $('#txtTotalPresupueto').val(value.Monto);
    //                     $('#txtPresupueto').val(MontoMedical);
    //                     $('#txtCodReg').val(codReg);
    //                     $('#txtIdPresupuesto').val(value.Id)
    //                     $('.presupuesto').append(
    //                         $('<label for="">Total Presupuestado:</label>  <input type="text" class="form-control" id="txtPresupueto" readonly>').val(MontoMedical)
    //                     );
    //                 }
    //             });
    //         }
    //         ;
    //
    //     }).fail(function (jqXHR, textStatus) {
    //         cargando(0)
    //         $(".presupuesto").empty();
    //     });
    // });

});


