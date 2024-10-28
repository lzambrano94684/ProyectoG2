var url = "";
var mensaje = "";
var jsonMessage = {};
var entraValidate = 0;

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
    );
    mensaje = "";
}

function msgJson() {
    return swal(jsonMessage).catch(swal.noop);
}

function redirect() {
    location.href = url;
}

$("#formConferencista").validate({
    onclick: false,
    errorPlacement: function (error, element) {
        if (count === 0) {
            var idInput = $("#" + element[0].id)
            idInput.addClass("has-error");
            idInput.focus();
            var labelInput = $("label[for='" + element[0].id + "']").text().replace("Agregar Nuevo", "");
           console.log(labelInput)
            mensaje = error.text().replace("Este campo", labelInput.trim());

            errorMsg();
        }
        count++;
    },
    invalidHandler: function (form, validator) {
        count = 0;
    }
})

$(document).ready(function () {

    $( ".checkGenero" ).prop( "checked", false );

    var selector = $('.codeCrearItem');
    selector.on('click', function () {
        var data = $(this).data();
        cargando(1);
        jsonMessage = {
            title: data.titulo
        };
        var url = "/pointex/medical/eventos/educ/conferencista";
        jsonMessage.html = "<iframe src='" + url + "' style='width:100%; min-height:800px' type='application/pdf'></iframe>";


        setTimeout('cargando(2)', 200);
        setTimeout('msgJson()', 200);

    });

    route = '/pointex/medical/eventos/educ/speaker'
    $.getJSON(route, function (data) {
        $("#slcConferencista").empty();
        $("#slcConferencista").append($('<option></option>').attr('value', 0).text("Seleccione..."));
        $.each(data, function (key, entry) {
            $("#slcConferencista").append($('<option></option>').attr('value', entry.Id).text(entry.Nombres));
        });
    });

  /*  $(".checkGenero").on('click', function() {
        alert("presioné el radio butto")
    });*/

  // console.log(radio.prop("checked", true))

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

});

$('#cmbPais').change(function() {
   var cod = $("#cmbPais").find(':selected').attr('codigo');

  $("#docIdentidad").empty()
    if(cod == 'GT'){
        $("#docIdentidad").append('<div class="form-group col-12 mb-2">'+'<label class="text-info" for="txtDPI">DPI:</label>'

            +' <input type="text" id="txtDPI" name="txtIdentificacion" class="form-control dpi"' +
            '    placeholder="Documento Personal de Indentificacion" minlength="13" maxlength="13" required oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\')">'+
            '</div>')
    }else{
        $("#docIdentidad").append('<div class="form-group col-12 mb-2">'+'<label class="text-info" for="txtPasaporte">Pasaporte:</label>'

            +' <input type="text" id="txtPasaporte" name="txtIdentificacion" class="form-control"' +
            '    placeholder="Ingrese Número de pasaporte"required>'+
            '</div>')
    }

});

function loadItemsToSelect(route){


    $.getJSON(route, function (data) {
        $("#slcConferencista").empty();
        $("#slcConferencista").append($('<option></option>').attr('value', 0).text("Seleccione..."));
        $.each(data, function (key, entry) {
            $("#slcConferencista").append($('<option></option>').attr('value', entry.Id).text(entry.Nombres));
        });
    });
}


