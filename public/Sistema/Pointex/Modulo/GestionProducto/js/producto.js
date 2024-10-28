var url = "";
var mensaje = "";

$(document).ready(function () {
    $('#datatable-Productos-Codes tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            datatableViews.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
});


function addCodes(idProd, idForma, idFormaTipo, marca, producto, campo, value, descSap , idTd,classRow) {

    if (campo == "CodigoBarras") {
        var divBarCOde = $("#muestaBarcod");
        if (value == "") {
            JsBarcode("#barcode", " ");
        }
        barcorPrint(value);
        var html = '<div class="form-group">' +
            '<h5> (BARRAS)' + producto + '</h5>' +
            '<div class="controls mb-1">' +
            divBarCOde.html() +
            '<input id="swal-Nombre" class="swal2-input" placeholder="Nombre" onkeyup="barcorPrint(this.value)" value="' + value + '">' +
            '<input id="swal-Descripcion" class="swal2-input" type="hidden"  placeholder="Descripción" value="'+descSap+'">' +
            '<div class="help-block"></div>' +
            '</div>' +
            '</div>';
    }else {
        var html = '<div class="form-group">' +
            '<h5> (SAP)' + producto + '</h5>' +
            '<div class="controls mb-1">' +
            '<input id="swal-Nombre" class="swal2-input" placeholder="Nombre" value="' + value + '">' +
            '<input id="swal-Descripcion" class="swal2-input" type="text"  placeholder="Descripción" value="'+descSap+'">' +
            '<div class="help-block"></div>' +
            '</div>' +
            '</div>';
    }
    swal({
        title: marca,
        html: html,
        showCancelButton: true,
        confirmButtonText: 'Enviar',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        focusConfirm: false
    }).then(function () {
        var nombre = document.getElementById('swal-Nombre').value.trim();
        var descripcion = document.getElementById('swal-Descripcion').value.trim();
        var pase = true;
        if (campo == "CodigoBarras") {
            pase = !descripcion;
        }
        if (!nombre && pase) {
            mensaje = "¡El campo código es requerido!";
            if (campo == "CodigoBarras") {
                mensaje = "¡Los campos código y descripción son requeridos!";
            }
            errorMsg();
        } else {
            cargando(1);
            var dataFrm = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                txtNombre: campo.trim(),
                txtValor: nombre.trim(),
                txtVDesc: descripcion.trim()
            }
            $.post("/pointex/gestion/producto/insert_codes/" + idProd + "/" + idForma + "/" + idFormaTipo, dataFrm, function (resp) {
                if (resp.STATUS == "OK") {
                    console.log("entra",idTd)
                    $("#" + idTd).html(
                        nombre + "<br><a class=\"btn btn-flat btn-warning\" href=\"javascript:void(0)\"\n" +
                        "title=\"Editar código de BARRAS\"\n" +
                        "onclick=\"addCodes('"+idProd+"', '"+idForma+"', '"+idFormaTipo+"', '"+marca+"', '"+producto+"', '"+campo+"', '"+nombre.trim()+"', '"+descripcion.trim()+"' , '"+idTd+"')\">" +
                        "<i class=\"fas fa-pencil-alt\"></i>\n" +
                        "</a>");
                    mensaje = resp.DATA;
                    if (typeof resp.REMOVER !== 'undefined') {
                        datatableViews.row('.'+classRow).remove().draw(false);
                    }
                    successMsg();
                } else {
                    mensaje = resp.DATA;
                    errorMsg()
                }
                cargando(2);
            });

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
    );
    mensaje = "";
}

function msgJson() {
    swal(jsonMessage);
    jsonMessage = null;
}

function redirect() {
    location.href = url;
}

function barcorPrint(valor) {
    if (valor) {
        JsBarcode("#barcode", valor);
    }
}
