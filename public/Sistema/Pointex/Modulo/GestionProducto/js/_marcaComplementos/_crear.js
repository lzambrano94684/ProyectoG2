var cuentaAdd = 0;
var cuentaAddPresentacion = 0;
Dropzone.autoDiscover = false;
var jsonDropZone = activeDropZoneAttached();

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
        finish: 'Guardar'
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        if (currentIndex === 1 && newIndex === 2) {
            var options = "";
            for (var i = 0; i <= cuentaAddPresentacion; i++) {
                var valPresentacion = $("#txtPresentacion"+i).val();
                var valTipoPresentacion0 = $("#txtTipoPresentacion"+i+"0")
                var valTipoPresentacion1 = $("#txtTipoPresentacion"+i+"1")
                var tipoPresentacion ="";
                if (valTipoPresentacion0.is(':checked')){
                    if (tipoPresentacion != ""){
                        tipoPresentacion += " y "+valTipoPresentacion0.val()
                    } else {
                        tipoPresentacion = valTipoPresentacion0.val()
                    }

                }
                if (valTipoPresentacion1.is(':checked')){
                    if (tipoPresentacion != ""){
                        tipoPresentacion += " y "+valTipoPresentacion1.val()
                    } else {
                        tipoPresentacion = valTipoPresentacion1.val()
                    }
                }
                options += '<option value="'+i+'" selected>'+valPresentacion+' '+tipoPresentacion+'</option>'
                $("select.cmbIdProductos").html(options);

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
        $("#frmIngresoMarca").submit();
    }
});
if (idMarca){
    form.steps("next");
}
$('select.select2_single').select2({width: '100%'});

jQuery(document).ready(function () {
    $('#frmIngresoMarca input').keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    var mapPageArray =[
        {
            Titulo : "Creación de Nueva Marca"
        }
    ];
    if (idMarca){
        mapPageArray[0].Titulo = "Agregar más presentaciones a la marca "+$("#cmbMarca option:selected").text();
    }
    mapPage(mapPageArray);
    activeDropZone(jsonDropZone);
    $(".titleTooltop").tooltip({placement: 'top'});

    var idAddProducto = $("#addProducto");
    addItemSelected(idAddProducto, "codeCrearItem");
    addItemSelected($("#mostrarPresentacion"), "codeCrearItem");

    $("#agregarPresentacion").on("click", function () {
        var addPresentacion = $("#addPresentacion");
        cuentaAddPresentacion++;
        var htmlPresentacion = inputsPresentaciones(cuentaAddPresentacion, '', '', '');

        addPresentacion.append(htmlPresentacion);
        var grupoPresentacion = $('#grupoPresentacion' + cuentaAddPresentacion);
        $('body, html').animate({scrollTop: grupoPresentacion.offset().top}, 1000);
        $('div#addPresentacion select.select2_single').select2({width: '100%'});
    });

    $("#removerPresentacion").on("click", function () {
        if (cuentaAddPresentacion > 0) {
            var grupoPresentacion = $('#grupoPresentacion' + cuentaAddPresentacion);
            var grupoFormaTipo = $('#grupoFormaTipo' + cuentaAddPresentacion);
            $('body, html').css("scrollTop", grupoPresentacion.offset().top);
            grupoPresentacion.remove();
            grupoFormaTipo.remove();
            cuentaAddPresentacion--;
        } else {
            cuentaAddPresentacion = 0;
        }
    });


    $("#agregar").on("click", function () {
        var cuentaAnt =cuentaAdd;
        cuentaAdd++;
        var cantMas1 = cuentaAdd+1;
        var groupForma = gruopAddAction("groupForma", "cmbFormaFarmaceutica", cuentaAdd);
        var groupFormaTipo = gruopAddAction("groupFormaTipo", "cmbTipoFormaFarmaceutica", cuentaAdd);
        var optionPresentaciones = $("#cmbIdProductos"+cuentaAnt).html();
        var groupPresentaciones = '<div class="col-md-12 groupGrupoPresenteciones'+cuentaAdd+'">\n' +
            '            <div class="form-group">\n' +
            '                <label for="cmbIdProductos'+cuentaAdd+'">Elija las presentaciones para esta forma farmacéutica</label>' +
            '                <select name="cmbIdProductos['+cuentaAdd+'][]" id="cmbIdProductos'+cuentaAdd+'"' +
            '                        class="form-control select2_single cmbIdProductos" multiple required>' +
                                        optionPresentaciones+
            '                </select>' +
            '            </div>' +
            '        </div>'
        var newAppend = '<div id="grupoAddProd'+cuentaAdd+'"><hr><b class="danger">'+cantMas1+'</b>' +
            '<div class="row">' +
            '<div class="col-md-6">' +
            groupForma +
            '</div>' +
            '<div class="col-md-6">' +
            groupFormaTipo +
            '</div>' +
            groupPresentaciones+
            '</div>';
        $("#addProducto").append(newAppend);
        $(".cmbTipoFormaFarmaceutica").each(function (k, v) {
            var getFirstItem = $(this).find('option').get(0);
            if (getFirstItem.value == 0) {
                getFirstItem.remove();
            }
        })
        $('body, html').animate({scrollTop: $('.cloneGroup' + cuentaAdd).offset().top}, 1000);
        $('div#addProducto select.select2_single').select2({width: '100%'});
    });

    $("#remover").on("click", function () {
        if (cuentaAdd > 0) {
            var classCloneGroup = $('#grupoAddProd'+cuentaAdd);
            $('body, html').css("scrollTop", classCloneGroup.offset().top);
            classCloneGroup.remove();
            cuentaAdd--;
        } else {
            cuentaAdd = 0;
        }
    });

});


function gruopAddAction(group, nameCmb, number) {
    var isTipoForma = nameCmb == "cmbTipoFormaFarmaceutica";
    var dataCode = $("div ." + group + " div code");
    var nameLabel = $("div ." + group + " div label").html();
    var Cmboptions = $("div ." + group + " div select").html();
    var data_titulo = dataCode.attr("data-titulo");
    var data_modelo = dataCode.attr("data-modelo");
    var data_campo = dataCode.attr("data-campo");
    var data_desc = dataCode.attr("data-desc");
    var data_id_cmb = dataCode.attr("data-id_cmb") + number;
    var nameCmbChange = isTipoForma ? "cmbTipoFormaFarmaceutica[" + number + "]" : nameCmb;
    var cmbMultiple = isTipoForma ? "multiple" : null;
    return '<div class="form-group cloneGroup' + number + '">\n' +
        '<label for="' + data_id_cmb + '">' + nameLabel + '</label>  ' +
        '<code style="cursor: pointer" class="codeCrearItem" ' +
        'data-toggle="tooltip" data-placement="top" ' +
        'data-titulo="' + data_titulo + '" ' +
        'data-modelo="' + data_modelo + '" ' +
        'data-campo="' + data_campo + '" ' +
        'data-desc="' + data_desc + '" ' +
        'data-id_cmb="' + data_id_cmb + '" ' +
        'title="Si no existe puede agregar uno nuevo">Agregar Nuevo</code>\n' +
        '<select class="form-control select2_single ' + nameCmb + '" id="' + data_id_cmb + '" name="' + nameCmbChange + '[]" required="" ' + cmbMultiple + '>' +
        Cmboptions +
        '</select>' +
        '</div>';
}


function inputsPresentaciones(numero, value1, value21, value22) {
    var conteoInt = cuentaAddPresentacion + 1;
    var checked1 = value21 ? 'checked' : null;
    var checked2 = value22 ? 'checked' : null;
    return '<div class="row" id="grupoPresentacion' + numero + '">' +
        '        <div class="col-md-8">' +
        '            <div class="form-group">' +
        '                <label for="txtPresentacion' + numero + '">Presentación ' + conteoInt + '</label>' +
        '                <input type="text" class="form-control txtPresentacion" id="txtPresentacion' + numero + '" ' +
        '               name="txtPresentacion[' + numero + ']" value="' + value1 + '" maxlength="50" required>' +
        '            </div>' +
        '        </div>' +
        '        <div class="col-md-4">' +
        '            <div class="form-group">' +
        '                <label>Tipo Presentación</label>' +
        '                <div class="custom-control custom-checkbox m-0">' +
        '                    <input type="checkbox" class="custom-control-input txtTipoPresentacion" id="txtTipoPresentacion' + numero + '0"' +
        '                           name="txtTipoPresentacion[' + numero + '][]" value="Venta" value="' + checked1 + '">' +
        '                    <label class="custom-control-label primary" for="txtTipoPresentacion' + numero + '0">Venta</label>' +
        '                </div>' +
        '                <div class="custom-control custom-checkbox m-0">' +
        '                    <input type="checkbox" class="custom-control-input txtTipoPresentacion" id="txtTipoPresentacion' + numero + '1"' +
        '                           name="txtTipoPresentacion[' + numero + '][]" value="Muestra Médica" value="' + checked2 + '">' +
        '                    <label class="custom-control-label primary" for="txtTipoPresentacion' + numero + '1">Muestra Médica</label>' +
        '                </div>' +
        '            </div>' +
        '        </div>' +
        '    </div>';
}
