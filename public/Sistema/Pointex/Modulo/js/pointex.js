$(window).bind('beforeunload', function () {
    cargando(1);
});
cargando(1);

jQuery(document).ready(function () {
    cargando(0);
});
$("#buttonRC").click(function (){
    cargando(0);
})
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + (d.getDate()+1),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [day,month,year].join('-');
}

function dialogLoading(boolCerrar, boolModal) {
    if (!boolModal) boolModal = false;
    if (!boolCerrar) boolCerrar = false;
    var objCargando = document.getElementById("div-cargando");
    if (boolCerrar && !objCargando)
        return false;
    else if (!objCargando)
        objCargando = $("<div id='div-cargando' style='text-align:center; margin-top: -60%'></div>");
    else
        objCargando = $(objCargando);

    if (boolCerrar) {
        objCargando.dialog("close");

        var objParent = objCargando.parent();
        var objModal = objParent.next();
        objParent.css({
            "z-index": ""
        });
        objModal.css({
            "z-index": ""
        });

        return objCargando;
    }

    objCargando.html("");
    objCargando.hide();
    objCargando.dialog({
        autoOpen: false,
        closeOnEscape: true,
        dialogClass: "no-close",
        modal: boolModal,
        height: "auto",
        width: "auto",
        resizable: true,
        close: function (event, ui) {
            $(this).removeClass("no-close");
            $(this).hide("fade");
        },
        open: function (event, ui) {
            var objBarClose = $(this).prev();
            objBarClose.remove();
            $(this).show("fade");
            objCargando.css({"min-height": ""});
        }
    });

    var objImg = $("<img src=\"/Sistema/Pointex/Modulo/img/ajaxloading.gif\" width= \"100\"  style='vertical-align: middle;'/>");
    /*var objImg = $('<svg class="pl-circular" viewBox="25 25 50 50"><circle class="plc-path" cx="50" cy="50" r="20"/></svg>');*/
    objCargando.html(objImg);
    objCargando.append("<br>Cargando...");
    objCargando.dialog("open");
    objCargando.css("min-height", "");
    if (boolModal) {
        var objParent = objCargando.parent();
        var objModal = objParent.next();
        objParent.css({
            "z-index": "9999"
        });
        objModal.css({
            "z-index": "9998"
        });
    }

    return objCargando;
}


function cargando(evento) {
    $("#buttonRC").hide();
    if(evento==1)
    {
        $("#buttonRC").show();
        $("#divCargando").addClass("cargandoExeltis");
    }
    else
    {
        $("#divCargando").removeClass("cargandoExeltis");
    }


}


function loadSelect2() {

    $(".select2_single").select2({
        placeholder: "Seleccione Opción",
        allowClear: true
    });
}

function loadSelect2ByModal(idModal) {
    $(".select2Modal").select2({
        placeholder: "Seleccione Opción",
        allowClear: true,
        dropdownParent: $('#'+idModal)
    });
}



function addForm(idModal) {


    $('#' + idModal + " input").each(function () {
        $($(this)).val('');
    });

    $('#' + idModal + " select option").each(function () {
        $(this).prop('selected', false).trigger('change');
    });

    $('#' + idModal).modal({backdrop:
            'static', keyboard: true,});
    setTimeout(function () {loadSelect2(); loadSelect2ByModal(idModal);},200);
}

function limpiar(idDiv) {
    $('#' + idDiv + " input").each(function () {
        $($(this)).val('');
    });

    $('#' + idDiv + " small").each(function () {
        $($(this)).html('');
    });

    $('#' + idDiv + " textarea").each(function () {
        $($(this)).val('');
    });

    $('#' + idDiv + " select option").each(function () {
        $(this).prop('selected', false).trigger('change');
    });



}

function Solo_Numerico(variable) {
    Numer = parseInt(variable);
    if (isNaN(Numer)) {
        return "";
    }
    return Numer;
}

function ValNumero(Control) {
    Control.value = Solo_Numerico(Control.value);
}

function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) ){
        //alert("Error: La dirección de correo " + email + " es incorrecta.");

    }

}

function scriptAgrupaCentros() {
    $("#cmbEntidad").on("change", function () {
        var idEntidad = this.value;
        var optinHtml = "<option value='' >Seleccione...</option>";
        $.each(jsomCentrosCosto, function (k, v) {
            if (k == idEntidad) {
                $.each(v, function (ki, vi) {
                    optinHtml += "<option value='"+vi.Id+"' >"+vi.Nombre+"</option>";
                })
            }
        });
        $("#cmbCentroCosto").html(optinHtml);
    });
}
