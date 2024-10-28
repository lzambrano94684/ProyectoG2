var url = "";
var mensaje = "";
var jsonMessage = {};


function mapPage(arrayRecorre) {
    $(".content-header a").css("color", "gray");
    var cantSubs = arrayRecorre.length;
    var content_header = $(".content-header");
    $.each(arrayRecorre, function (k, v) {
        var numCompare = k + 1;
        var colorActive = "black";
        var linkMap = "";
        if (numCompare < cantSubs) {
            colorActive = "gray";
            linkMap = "<a href='" + v.Ref + "'>" +
                "<small style='color: " + colorActive + "'>" +
                '<i style="color: red" class="ft-skip-forward"></i> ' +
                v.Titulo +
                "</small>" +
                "</a>";

        } else {
            linkMap = "<small>" +
                '<i style="color: red" class="ft-skip-forward"></i> ' +
                '<b style="color: ' + colorActive + '">' +
                v.Titulo +
                '</b>' +
                "</small>";
        }
        content_header.append(linkMap)
    });
}


// addItemSelected($(".codeCrearItem"), false);

// function addItemSelected(selector) {
//     selector.on('click', function () {
//         var idCmb = $(this).data("id_cmb");
//         var titulo = $(this).data("titulo");
//         var modelo = $(this).data("modelo");
//         var campo = $(this).data("campo");
//         var desc = $(this).data("desc");
//         addNewOptionSelected(idCmb, titulo, modelo, campo, desc);
//     });
//     selector.each(function () {
//         var idCmb = $(this).data("id_cmb");
//         var titulo = $(this).data("titulo");
//         var modelo = $(this).data("modelo");
//         var campo = $(this).data("campo");
//         $(this).after('<i title="Actualizar Catálogo ' + titulo + '"' +
//             'id="icon' + idCmb + '" ' +
//             'class="fas fa-sync-alt" ' +
//             'onclick="reloadCat(\'' + idCmb + '\',\'' + modelo + '\',\'Id\', \'' + campo + '\')" ' +
//             'style="cursor:pointer;"></i>')
//     });
// }


function reloadCat(idCmb, Modelo, Id, Value) {
    var selectorIcon = $("#icon" + idCmb);
    var select = $("#" + idCmb);
    var value = select.val();

    console.log(value);
    selectorIcon.addClass("fa-spin");
    $.get("/pointex/gestion/catalogos/select/" + Modelo + "/" + Id + "/" + Value, function (response) {
        selectorIcon.removeClass("fa-spin");
        if (response) {
            if (select.prop) {
                var options = select.prop('options');
            }
            else {
                var options = select.attr('options');
            }
            $('option', select).remove();

            $.each(response, function (text, val) {
                options[options.length] = new Option(text, val);
            });
            if ($.isArray(value)) {
                $.each(value, function (k, v) {
                    $('select option[value="' + v + '"]').attr("selected", "selected");
                });
            } else {
                $('select option[value="' + value + '"]').attr("selected", "selected");
            }
        }
    });

}

function addNewOptionSelected(idCmb, titulo, modelo, campo, desc) {

    swal({
        title: titulo,
        html:
            '<input id="swal-Nombre" class="swal2-input" placeholder="Nombre">' +
            '<input id="swal-Descripcion" class="swal2-input" placeholder="Descripción">',
        showCancelButton: true,
        confirmButtonText: 'Enviar',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        focusConfirm: false
    }).then(function () {
        var nombre = document.getElementById('swal-Nombre').value;
        var descripcion = document.getElementById('swal-Descripcion').value
        if (!nombre && !descripcion) {
            mensaje = "¡Los campos Nombre y Descripción son requeridos!";
            errorMsg();
        } else {
            cargando(1);
            var dataFrm = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                tabla: modelo.trim(),
                nombre: campo.trim(),
                valor: nombre.trim(),
                nombreDesc: desc.trim(),
                valorDesc: descripcion.trim()
            };
            $.post("/pointex/gestion/marca/inset_in_tables", dataFrm, function (resp) {
                if (resp.STATUS == "OK") {
                    mensaje = "Datos guardados con con exito";
                    successMsg();
                    var cmbChangedId = $('#' + idCmb);
                    var cmbChangedName = cmbChangedId.attr("name");
                    var cmbChanged = $("select[name*='" + cmbChangedName + "']");
                    cmbChanged.append(new Option(resp.DATA[0], resp.DATA[1]));
                    $('#' + idCmb + ' option[value=' + resp.DATA[1] + ']').attr('selected', 'selected');
                } else {
                    mensaje = resp.DATA;
                    errorMsg()
                }
                cargando(2);
            });

        }
    })
}

function activeDropZone(jsonRequest) {
    return $("div#my-awesome-dropzone").dropzone(jsonRequest);
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

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function llenaCorreos() {
    var correos = $("#correos").val();
    var textarea = $("#textarea");
    if (correos) {
        $.each(correos.split(";"), function (k, v) {
            if (v) {
                textarea.append('<button>' + v + '</button>')
            }
        });
    }
    textarea.append('<input type="text"/>');
}

// function notificar(opcion) {
//     var divNotificar = $('#divNotificar');
//     if (opcion) {
//         divNotificar.show();
//     } else {
//         divNotificar.hide();
//     }
// }

jQuery(document).ready(function () {
    var isCorreoValido = false;
    var textareaInput = $('#textarea input');
    textareaInput.on('keyup', function (e) {
        var key = e.which;
        var correos = $("#correos");
        var valorCorreos = correos.val();
        if (key == 188) {
            var txtEmail = $(this).val().slice(0, -1);
            if (IsEmail(txtEmail)) {
                isCorreoValido = true;
                var valAgregado = $(this).val();
                $('<button/>').text(valAgregado.slice(0, -1)).insertBefore($(this));
                correos.val(valorCorreos + valAgregado);
                $(this).val('').focus();
            } else {
                mensaje = "Por favor ingresar un correo válido";
                errorMsg();
                $("#correos").val();
                $(this).val('').focus();
            }
        } else if (IsEmail($(this).val())) {
            isCorreoValido = true;
        }
    });
    textareaInput.on('change', function (e) {
        var thisInterno = $(this);
        var correos = $("#correos");
        var valorCorreos = correos.val();
        if (!IsEmail(thisInterno.val())) {
            console.log("primer if")
            mensaje = "El correo ingresado es incorrecto";
            errorMsg();
            thisInterno.val("");
            thisInterno.focus();
        } else if (!isCorreoValido) {
            console.log("segundo if")
            mensaje = "El correo ingresado es incorrecto";
            errorMsg();
            thisInterno.val("");
            thisInterno.focus();
        } else {
            console.log("else")
            var valAgregado = $(this).val();
            $('<button/>').text(valAgregado.trim()).insertBefore($(this));
            correos.val(valorCorreos + valAgregado + ";");
            $(this).val('').focus();
        }
    });

    $('#textarea').on('click', 'button', function (e) {
        var correos = $("#correos");
        var valorCorreos = correos.val().replace($(this).text() + ";", "");
        e.preventDefault();
        $(this).remove();
        correos.val(valorCorreos);
        return false;
    });
    setTimeout(function () {
        $('input[name="txtNombreProducto"]').focus()
    }, 1);
});
var count = 0;

llenaCorreos();

// jQuery(document).ready(function () {
//     notificar($('#txtNotificar1').is(':checked') ? $('#txtNotificar1').is(':checked') : false);
//     var mapPageArray = [
//         {
//             Titulo: "Marca Propiedad Intelectual"
//         }
//     ];
//     mapPageArray[0].Ref = "/pointex/gestion/regulatorio/crear_listar?cmVnaXN0cm9NYXJjYT0x";
//     mapPageArray[1] = {
//         Titulo: " Registro de Marca"
//     };
//     mapPage(mapPageArray);
//     var btnCancelar = $("#btnCancelar");
//     btnCancelar.html('<i class="fas fa-backspace"></i> Regresar');
//     btnCancelar.click(function () {
//         swal({
//             title: '¿Deseas Salir de la Página?',
//             type: 'question',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: '¡Si, Deseo Salir!',
//             cancelButtonText: 'No',
//         }).then(function(isConfirm) {
//             if (isConfirm) {
//                 url = '/pointex/gestion/regulatorio/crear_listar?cmVnaXN0cm9NYXJjYT0x';
//                 redirect()
//             }
//         });
//     });
//
//     $('.mostarImagen').on('click', function () {
//         cargando(1);
//         jsonMessage = {
//             title: this.alt,
//         };
//         var url = $(this).attr("url");
//         var lastChar = url.substr(-3).toUpperCase();
//         if (lastChar == "PDF") {
//             jsonMessage.html = "<iframe src='" + url + "' style='width:100%; min-height:800px' type='application/pdf'></iframe>";
//         } else {
//             jsonMessage.imageUrl = url;
//         }
//         setTimeout('cargando(2)', 200);
//         setTimeout('msgJson()', 200);
//
//     });
//
//     $('#frmIngresoMarca input').keydown(function(event){
//         if(event.keyCode == 13) {
//             event.preventDefault();
//             return false;
//         }
//     });
// });
