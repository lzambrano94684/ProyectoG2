if (!verRegSanitario){
    Dropzone.autoDiscover = false;
    var jsonDropZone = activeDropZoneAttached();
}

var count = 0;
llenaCorreos();
$("#frmIngresoSanitario").validate({
    onclick: false,
    errorPlacement: function (error, element) {
        if (count === 0) {
            var idInput = $("#" + element[0].id)
            idInput.addClass("has-error");
            idInput.focus();
            var labelInput = $("label[for='" + element[0].id + "']").text().replace("Agregar Nuevo", "");
            mensaje = error.text().replace("Este campo", labelInput.trim());
            errorMsg();
        }
        count++;
    },
    invalidHandler: function (form, validator) {
        count = 0;
    }
})

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
console.log($("#cmbPresentacion option:selected").text())
jQuery(document).ready(function () {
    notificar($('#txtNotificar1').is(':checked') ? $('#txtNotificar1').is(':checked') : false);
    $("#cmbMarca").on("change", function () {
        cargando(1)
        var divCheckPresentaciones = $("#divCheckPresentaciones");
        var divPresentacion = $("#divPresentacion");
        var divPresentacionRegulatorio = $("#divPresentacionRegulatorio");
        divCheckPresentaciones.html("")
        divPresentacion.html("")
        divPresentacionRegulatorio.html("")
        $.get("/pointex/gestion/regulatorio/get_presentaciones/" + this.value, function (response) {
            cargando(0)
            $.each(response, function (key, value) {
                var presentacion = value.Presentacion == null ? '' : value.Presentacion;
                var presentacionRegulatorio = value.PresentacionRegulatorio == null ? '' : value.PresentacionRegulatorio;
                divCheckPresentaciones.append('<input type="checkbox" id="productoPresentaciones' + value.Id + '" name="productoPresentaciones[]"\n' +
                    '                                               class="form-control"\n' +
                    '                                               value="' + value.Id + '" >');
                divPresentacion.append('<input ' + 'class="form-control"\n' +
                    ' value="' + presentacion + '" disabled>');
                divPresentacionRegulatorio.append('<input type="text" id="productoPresentacionesRegulatorio' + value.Id + '"\n' +
                    '                                               name="productoPresentacionesRegulatorio[' + value.Id + ']" class="form-control"\n' +
                    '                                               value="' + presentacionRegulatorio + '"  placeholder="Presentación Regulatorio">');
            });
        });
    });

    var mapPageArray = [
        {
            Titulo: "Listado de Registros Sanitarios"
        }
    ];
    mapPageArray[0].Ref = "/pointex/gestion/regulatorio/crear_listar?cmVnaXN0cm9TYW5pdGFyaW89MQ==";
    mapPageArray[1] = {
        Titulo: " Registro Sanitario"
    };
    mapPage(mapPageArray);
    var btnCancelar = $("#btnCancelar");
    btnCancelar.html('<i class="fas fa-backspace"></i> Regresar');
    btnCancelar.click(function () {
        swal({
            title: '¿Deseas Salir de la Página?',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, Deseo Salir!',
            cancelButtonText: 'No',
        }).then(function(isConfirm) {
            if (isConfirm) {
                url = '/pointex/gestion/regulatorio/crear_listar?cmVnaXN0cm9TYW5pdGFyaW89MQ==';
                redirect()
            }
        });
    });
    if (verRegSanitario){
        $("#frmIngresoSanitario input").prop("disabled", true);
        $("#frmIngresoSanitario textarea").prop("disabled", true);
        $("#frmIngresoSanitario select").prop("disabled", true);
        $(".js-example-disabled-multi").prop("disabled", false);
        $("#btnRegistroSanitario").remove();
        $(".codeCrearItem").remove();
    }else {
        activeDropZone(jsonDropZone);
    }
    $('.mostarImagen').on('click', function () {
        cargando(1);
        jsonMessage = {
            title: this.alt,
        };
        var url = $(this).attr("url");
        var lastChar = url.substr(-3).toUpperCase();
        if (lastChar == "PDF") {
            jsonMessage.html = "<iframe src='" + url + "' style='width:100%; min-height:800px' type='application/pdf'></iframe>";
        } else {
            jsonMessage.imageUrl = url;
        }
        setTimeout('cargando(2)', 200);
        setTimeout('msgJson()', 200);

    });

    actionControlEstatal(groupControlEstatal);
    actionPermizoCom(groupPermizoCom);
});

function actionControlEstatal(opcion) {
    var groupControlEstatal = $('.groupControlEstatal');
    var txtFechaControlEstatal = $('#txtFechaControlEstatal');
    var txtEstimacionObtencion = $('#txtEstimacionObtencion');
    if (opcion == 1) {
        groupControlEstatal.show();
        txtFechaControlEstatal.removeAttr("readonly");
        //txtEstimacionObtencion.removeAttr("readonly");
    } else {
        groupControlEstatal.hide();
        txtFechaControlEstatal.attr("readonly","readonly");
        //txtEstimacionObtencion.attr("readonly","readonly");
    }
}

function actionPermizoCom(accion) {
    var groupPermizoCom = $('#groupPermizoCom');
    var txtPermisoComercializacion = $('#txtPermisoComercializacion');
    if (accion == 0){
        groupPermizoCom.show();
        txtPermisoComercializacion.removeAttr("readonly");
    } else {
        groupPermizoCom.hide();
        txtPermisoComercializacion.attr("readonly","readonly");
    }
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}