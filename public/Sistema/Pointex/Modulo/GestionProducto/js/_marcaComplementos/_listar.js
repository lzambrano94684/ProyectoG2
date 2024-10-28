var frm;
var dataInfoJson;
var frmEditMarca = $("#frmEditMarca");
var frmEditProducto = $("#frmEditProducto");
var cmbFormaFarmaceutica = $("#cmbFormaFarmaceutica");
var cmbTipoFormaFarmaceutica = $("#cmbTipoFormaFarmaceutica");
var cmbPresentacionTipo = $("#cmbPresentacionTipo");
var txtTipoPresentacion = $(".txtTipoPresentacion");


cmbFormaFarmaceutica.attr("name", "cmbFormaFarmaceutica");
cmbPresentacionTipo.attr("name", "cmbPresentacionTipo");
txtTipoPresentacion.attr("name", "txtTipoPresentacion[]");
Dropzone.autoDiscover = false;
Dropzone.prototype.defaultOptions.dictDefaultMessage = "Subir archivo a modificar";
var jsonDropZone = activeDropZoneAttached();
var cambioPrincipios = false;

$("#btnGuardar").on("click", function () {
    cargando(1);
    if (frm == "marca") {
        var IdMarca = $("#txtIdMarca").val();
        var message = "";
        var arrayText = {
            txtMarca: "",
            cmbPatologia: "",
            txtDescripcion: "",
            cmbFranquiciaMarca: ""
        };
        $.each(frmEditMarca.serializeArray(), function (i, v) {
            var name = v.name;
            var value = v.value.trim();
            if (typeof (arrayText[name]) != "undefined" && arrayText[name] !== null) {
                arrayText[name] = value;
                var idInput = $("[name*='" + name + "']");
                var lblFor = $("[for=" + name + "]").text();
                if (value == "" || value == "0") {
                    message += "<small>" + lblFor + "</small><br/>";
                    idInput.addClass("has-error");
                }
            }
        });
        mensaje = message != "" ? "Los campos: <br/>" + message + "son requeridos." : "";
        console.log(arrayText.cmbPatologia,dataInfoJson)
        if (arrayText.txtMarca == dataInfoJson.Nombre.trim() &&
            arrayText.cmbPatologia == dataInfoJson.IdPatologia.trim() &&
            arrayText.txtDescripcion == dataInfoJson.Descripcion.trim() &&
            arrayText.cmbFranquiciaMarca == dataInfoJson.IdFranquicia.trim() &&
            $("#bse64ArchivoMarca").val() == "" &&
            !cambioPrincipios) {
            mensaje = "Debe realizar cambios para enviar el formulario";
        }
        if (mensaje == "") {
            var txtNombreMarca = $("#txtMarca");
            $.get("/pointex/gestion/marca/val_marca/" + IdMarca + "/" + txtNombreMarca.val(), function (data) {
                if (data.STATUS == "OK" && data.DATA == "") {
                    frmEditMarca.submit();
                } else if (data.STATUS == "ERROR") {
                    mensaje = data.DATA;
                    txtNombreMarca.addClass("has-error");
                    setTimeout('cargando(2)', 200);
                    setTimeout('errorMsg()', 200);
                } else {
                    mensaje = "El el valor del campo <small>" + $("[for='txtMarca']").text() +
                        "</small> ya existe en la Base de datos, por favor ingrese otro";
                    txtNombreMarca.addClass("has-error");
                    setTimeout('cargando(2)', 200);
                    setTimeout('errorMsg()', 200);
                }
            });
        } else {
            setTimeout('cargando(2)', 200);
            setTimeout('errorMsg()', 200);
        }
    } else {
        $("select[name='cmbPresentacionTipo[]']").remove();
        $("#frmEditProducto").submit()
    }
});
activeDropZone(jsonDropZone);
addItemSelected($(".codeCrearItem"), null);
// boton que activa la accion de busqueda en el filtro de busqueda
$("#btnFiltroMarca").on("click", function () {
    cargando(1);
    var frmFiltroMarca = $("#frmFiltroMarca");
    frmFiltroMarca.submit(function () {
        return false;
    });
    $.each(frmFiltroMarca.serializeArray(), function (i, v) {
        if (v.value != "" && v.value != 0) {
            url += "&" + v.name + "=" + v.value
        }
    });

    if (url != "") {
        url = "?" + btoa(urlActual + url)
        setTimeout('redirect(url)', 200);
    } else {
        mensaje = "Por favor llene uno de los campos";
        setTimeout('cargando(2)', 200);
        setTimeout('errorMsg()', 200);
    }
});
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


$(".aActiveModal").on("click", function () {
    frm = $(this).data("frm");
    var tituloModal;
    $("#mdlMarca").modal('show');
    if (frm == "marca") {
        $("#frmMarca").show();
        $("#frmProducto").hide();
        var dataInfoBase = $(this).data("info");
        dataInfoJson = JSON.parse(atob(dataInfoBase));
        var idPrincipiosActivos = [];
        $.each(dataInfoJson.marca_principio_activo,function (k,v) {
            idPrincipiosActivos.push(v.IdPrincipioActivo);
        });
        var cmbPrincipioActivo = $("#cmbPrincipioActivo");
        frmEditMarca.append("<input name='txtIdMarca' id='txtIdMarca' type='hidden' value='" + dataInfoJson.Id + "'/>");
        tituloModal = dataInfoJson.Nombre.trim();

        $("#txtMarca").val(dataInfoJson.Nombre);
        $("#txtDescripcion").html(dataInfoJson.Descripcion);
        $("select[name='cmbPatologia']").val(dataInfoJson.IdPatologia);
        $("select[name='cmbFranquiciaMarca']").val(dataInfoJson.IdFranquicia);
        $("select[name='cmbGrupoTerapeutico']").val(dataInfoJson.IdGrupoTerapeutico);
        cmbPrincipioActivo.val(idPrincipiosActivos);
    } else {
        $("#frmProducto").show();
        $("#frmMarca").hide();
        $("#agregar").remove();
        $("#remover").remove();
        var dataInfoBase = $(this).data("info");
        var dataTipoForma = $(this).data("idconsentracion");
        dataInfoJson = JSON.parse(atob(dataInfoBase));
        tituloModal = dataInfoJson.forma_farmaceutica.Nombre
        tituloModal += dataInfoJson.forma_farmaceutica_tipo ? " " + dataInfoJson.forma_farmaceutica_tipo.Nombre : "";
        tituloModal += dataInfoJson.Presentacion ? " " + dataInfoJson.Presentacion : "";
        tituloModal += dataInfoJson.presentacion_tipo ? " " + dataInfoJson.presentacion_tipo.Nombre : "";
        var groupPresentacionTipo = $(".groupPresentacionTipo");
        dataInfoJson = JSON.parse(atob(dataInfoBase));
        frmEditProducto.append("<input name='txtIdProducto' id='txtIdProducto' type='hidden' value='" + dataInfoJson.Id + "'/>");
        groupPresentacionTipo.removeClass("col-md-4");
        groupPresentacionTipo.addClass("col-md-6");
        $("#mostrarPresentacion").html(
            "<div class='row'>" +
            '<div class="col-md-6">' +
            '<div class="form-group">' +
            '<label for="txtPresentacion">Presentación para ' + '</label>' +
            '<textarea maxlength="300" name="txtPresentacion" id="txtPresentacion" rows="2" class="form-control">' +
            dataInfoJson.Presentacion +
            '</textarea>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-6">' +
            groupPresentacionTipo.html() +
            '</div>' +
            "</div>");
        cmbTipoFormaFarmaceutica.val(dataTipoForma);
        var tipoPresentacionViene = dataInfoJson.TipoPresentacion.trim();
        var txtTipoPresentacion1 = $("#txtTipoPresentacion1");
        var txtTipoPresentacion2 = $("#txtTipoPresentacion2");

        txtTipoPresentacion1.removeAttr('checked');
        txtTipoPresentacion2.removeAttr('checked');
        switch (tipoPresentacionViene) {
            case "Venta Libre y Muestra Medica":
                txtTipoPresentacion1.attr('checked', 'checked');
                txtTipoPresentacion2.attr('checked', 'checked');
                break;
            case "Venta Libre":
                txtTipoPresentacion1.attr('checked', 'checked');
                break;
            case "Muestra Medica":
                txtTipoPresentacion1.attr('checked', 'checked');
                break;
            default:
                txtTipoPresentacion1.removeAttr('checked');
                txtTipoPresentacion2.removeAttr('checked');
                break;
        }

        cmbFormaFarmaceutica.val(dataInfoJson.IdFormaFarmaceutica);

    }

    $("#mdlTitleMarca").html("Editar <strong>" + tituloModal + "</strong>");
    $('select.select2_single').select2({width: '100%'});
    cmbPrincipioActivo.change(function () {
        cambioPrincipios = true;
    });
});


jQuery(document).ready(function () {
    var mapPageArray = [
        {
            Titulo: "Marcas"
        }
    ];

    if (idMarca){
        mapPageArray[0].Ref = "/pointex/gestion/marca/crear_listar?bGlzdGFyPTE=";
        mapPageArray[1] = {
            Titulo: nombreMarca.toUpperCase()
        };
        mapPage(mapPageArray);
        var jsonData = [];
        if (dataProducto) {
            dataProducto = JSON.parse(atob(dataProducto));
            $.each(dataProducto, function (k, v) {
                var btnDelete = v.isRegistroSanitario > 0 ?
                    "<a class='btn btn-flat btn-danger' href='javascript:void(0)' onclick=\"deletePresentacion('" + v.IdProducto + "')\">"+
                    '<i class="ft-trash"></i>' +
                    "</a>": "";

                var btnEdit =
                    "<a class='btn btn-flat btn-info' " +
                    "href='/pointex/gestion/catalogos/"+
                    btoa('PX_GP_Producto')+"?" + btoa('editar='+v.IdProducto)+"' >" +
                    "<i class='ft-edit-2'></i>" +
                    "</a>";
                jsonData[k] = [
                    btnDelete +
                    btnEdit+
                    "<label id='pPresentacion" + v.IdProducto + "'>" +
                    v.Presentacion +
                    " <b>" +
                    v.TipoPresentacion +
                    "</b>" +
                    "</label>", v.FormaFarmaceutica, v.FormaFarmaceuticaTipo
                ];
            });
            JsonDatatableViews.data = jsonData;
            JsonDatatableViews.rowsGroup = [0];
        }
        JsonDatatableViews.columns = [
            {
                className: "centerTd"
            },
            null,
            null
        ];
        JsonDatatableViews.order = [[0, "desc"]];
        $("#dataProducto").DataTable(JsonDatatableViews);
    } else {
        mapPage(mapPageArray);
    }
});


function deletePresentacion(IdProducto) {
    var nombrePresentacion = $("#pPresentacion" + IdProducto).text();
    var nombreMarca = $("#strgMarca").text();
    var Titulo = '<i class="far fa-surprise warning fa-5x"></i><br>¿Estás seguro?';
    var Mensaje = "¡Se borrará esta presentación <b class='danger'>" + nombrePresentacion + "</b> de la marca " +
        "<b class='danger'>" + nombreMarca + "</b> y ya no se podrá recuperar!";
    var btnName = "¡Si, borrar!";
    var Icon = "fa-surprise";
    msgDeleteUrl(Titulo, Mensaje, btnName, Icon)
    url = "/pointex/gestion/marca/delete_producto/" + IdProducto;
}

function deleteMarca(IdMarca) {
    var nombreMarca = "<b class='danger'>" + $("#Nombre" + IdMarca).text().trim() + "</b>";
    var Titulo = '<i class="far fa-surprise warning fa-5x"></i><br>¿Estás seguro?';
    var Mensaje = "¡Estas a punto de borrar la marca " + nombreMarca + " si continuas se borraran todas " +
        "las presentaciones guardadas para esta marca!";
    var btnName = "¡Si, borrar!";
    var Icon = "fa-surprise";
    msgDeleteUrl(Titulo, Mensaje, btnName, Icon)
    url = "/pointex/gestion/marca/delete_marca/" + IdMarca;
}

function editTable(id) {
    var slcPresentacion = $("#tdSpanPresentacion" + id);
    var slcPresentacionP1 = $("#pPresentacion1" + id);
    var slcPresentacionP2 = $("#pPresentacion2" + id);
    var inputPresentacion = '<input type="text" class="column_filter_search" ' +
        'onkeydown="insertInTable(this, ' + id + ')" ' +
        'id="txtPresentacion" name="txtPresentacion" value="' + slcPresentacion.text() + '">' +
        '<label for="txtTipoPresentacion0"><input type="checkbox" name="tipoPresentacion" id="txtTipoPresentacion0" ' +
        'value="Venta"> Venta </label><br>' +
        '<label for="txtTipoPresentacion1"><input type="checkbox" name="tipoPresentacion" id="txtTipoPresentacion1" ' +
        'value="Muestra Médica"> Muestra Médica </label><br>';
    slcPresentacionP1.hide();
    slcPresentacionP2.show();
    slcPresentacionP2.html(inputPresentacion);
}

function insertInTable(data, id) {
    console.log(JsonDatatableViews.data)
    if (event.keyCode == 13) {
        var slcPresentacionP1 = $("#pPresentacion1" + id);
        var slcPresentacionP2 = $("#pPresentacion2" + id);
        var slcPresentacion = $("#tdSpanPresentacion" + id);
        var slcTipoPresentacion = $("#tdBPresentacion" + id);
        slcPresentacion.html('<img alt="96x96" class="media-object d-flex mr-3" src="/Sistema/Pointex/Modulo/img/loading.gif" style="width: 80px; height: 80px;">');
        slcPresentacionP1.show();
        slcPresentacionP2.hide();
        /* var dataFrm = {
             _token: $('meta[name="csrf-token"]').attr('content'),
             tabla: tabla,
             nombre: campo.trim(),
             valor: nombre.trim(),
             nombreDesc: desc.trim(),
             valorDesc: descripcion.trim()
         };*/
        $.get("/pointex/gestion/marca/crear_listar", function (request) {
            console.log(request);
            slcPresentacion.html($("#txtPresentacion").val().trim());
        });
    }
}