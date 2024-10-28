$(document).ready(function () {
    $(".select2_single").select2({
        width: '100%'
    });

  /*  var currentTime = new Date()
    var year = currentTime.getFullYear()
    $("#txtFechaConsultorio").attr("min", year + "-" + "01" + "-01");
    $("#txtFechaConsultorio").attr("max", year + "-" + "12" + "-31");*/
    $('.entero').numeric({
        negative:false
    })

});

if (validarVer != 0) {
    $("#formMDGrow input").prop("disabled", true);
    $("#formMDGrow select").prop("disabled", true);
    $("#formMDGrow textarea").prop("disabled", true);
    $("#Idbtn").remove();
}

var MDGrow = JSON.parse(atob(dataGrow));

if(MDGrow.Id){
    $("#slcGenero").val(MDGrow.Genero).trigger("change.select2");
    $("#slcCarta").val(MDGrow.CartaFirmada).trigger("change.select2");
    $("#slcConsultorio").val(MDGrow.ConsultorioListo).trigger("change.select2");
}

function eliminarMDGrow(id) {

    swal({
        title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Deseo Eliminarlo!',
        cancelButtonText: 'No',
    }).then(function (isConfirm) {
        if (isConfirm) {
            url = '/pointex/medical/mdgrow/delete/'+id;
            redirect()
        }
    });
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
    );
    mensaje = "";
}

function msgJson() {
    return swal(jsonMessage).catch(swal.noop);
}

function redirect() {
    location.href = url;
}


