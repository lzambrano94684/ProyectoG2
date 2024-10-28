var url = "";
var mensaje = "";
var jsonMessage = {};
jQuery(document).ready(function () {
    var codeCrearItem = $(".codeCrearItem");
    codeCrearItem.tooltip({placement: 'top'});
    addItemSelected(codeCrearItem, null);
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

function msgDeleteUrl(Titulo, Mensaje, btnName, Icon) {
    var jsonSwal = {
        title: Titulo,
        text: Mensaje,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: btnName
    };
    if (Icon) {
        jsonSwal.icon = Icon;
    } else {
        jsonSwal.type = 'warning'
    }
    swal(jsonSwal).then((result) => {
        if (result) {
            redirect();
        }
    }).catch(swal.noop);
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



function activeDropZoneAttached() {
    var jsonDropZone = {
        autoProcessQueue: false,
        url: "nueva_marca",
        paramName: "file",
        clickable: true,
        maxFilesize: 1,
        uploadMultiple: true,
        maxFiles: 1,
        addRemoveLinks: true,
        acceptedFiles: '.png,.jpg,.pdf',
        init: function () {

            this.on("addedfile", function (file) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    var base64String = event.target.result;
                    $('input[name="bse64ArchivoMarca"]').val(base64String);
                };
                reader.readAsDataURL(file);
            });

            this.on("removedfile", function (file) {
                $('input[name="bse64ArchivoMarca"]').val("");
            });
        }
    };
    Dropzone.prototype.defaultOptions.dictDefaultMessage = "Soltar archivos aquí para cargar";
    Dropzone.prototype.defaultOptions.dictFallbackMessage = "Su navegador no admite la carga de archivos con arrastrar y soltar.";
    Dropzone.prototype.defaultOptions.dictFallbackText = "Utilice el formulario de reserva a continuación para cargar sus archivos como en los días anteriores";
    Dropzone.prototype.defaultOptions.dictFileTooBig = "El archivo es demasiado grande ({{tamaño de archivo}} MiB). Tamaño máximo de archivo: {{maxFilesize}} MiB.";
    Dropzone.prototype.defaultOptions.dictInvalidFileType = "No puede cargar archivos de este tipo.";
    Dropzone.prototype.defaultOptions.dictResponseError = "El servidor respondió con el código {{statusCode}}.";
    Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancelar carga";
    Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "¿Está seguro de que desea cancelar esta carga?";
    Dropzone.prototype.defaultOptions.dictRemoveFile = "Eliminar archivo";
    Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "No puedes subir más archivos.";
    return jsonDropZone;
}


function addItemSelected(selector, clase) {
    if (clase) {
        selector.on('click', "." + clase, function () {
            var idCmb = $(this).data("id_cmb");
            var titulo = $(this).data("titulo");
            var modelo = $(this).data("modelo");
            var campo = $(this).data("campo");
            var desc = $(this).data("desc");
            addNewOptionSelected(idCmb, titulo, modelo, campo, desc)
        });
    } else {
        selector.on('click', function () {
            var idCmb = $(this).data("id_cmb");
            var titulo = $(this).data("titulo");
            var modelo = $(this).data("modelo");
            var campo = $(this).data("campo");
            var desc = $(this).data("desc");
            addNewOptionSelected(idCmb, titulo, modelo, campo, desc);
        });
    }
}

function activeDropZone(jsonRequest) {
    return $("div#my-awesome-dropzone").dropzone(jsonRequest);
}

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
