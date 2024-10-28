data_marca = JSON.parse(atob(data_marca));
dataPatologia = JSON.parse(atob(dataPatologia));
dataFranquicia = JSON.parse(atob(dataFranquicia));
dataGrupoTerapeutico = JSON.parse(atob(dataGrupoTerapeutico));


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

var frmUpdateMarca = $("#frmUpdateMarca");
var cuenta = 0;
frmUpdateMarca.validate({
    onclick: false, // <-- add this option
    errorPlacement: function (error, element) {
        var labelInput = $("label[for='" + element[0].id + "']").text().replace("Agregar Nuevo", "");
        if (labelInput.trim() && cuenta ===0){
            mensaje = error.text().replace("Este campo", labelInput.trim());
            errorMsg();
            cuenta++;
        }else {
            cuenta =0;
        }
    }
});

jQuery(document).ready(function () {
    var mapPageArray = [
        {
            Titulo: "Listado de Marcas Actualizadas"
        }
    ];
    mapPageArray[0].Ref = "/pointex/gestion/regulatorio/crear_listar?YWN0dWFsaXphX21hcmNhPTEmYWN0dWFsaXphX21hcmNhX2xpc3RhPTE=";
    mapPageArray[1] = {
        Titulo: " Actualización de Marca"
    };
    mapPage(mapPageArray);
    if (idMarca){
        llenaCamposUpdatemarca(idMarca);
    }

    var codeCrearItem = $(".codeCrearItem");

    codeCrearItem.tooltip({placement: 'top'});
    addItemSelected(codeCrearItem, null);

    $("#cmbMarca").on("change",function () {
        var idMarca = this.value;
        llenaCamposUpdatemarca(idMarca);
    });
    
    $("#btnCancelar").click(function () {
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
                url = '/pointex/gestion/regulatorio/crear_listar?YWN0dWFsaXphX21hcmNhPTEmYWN0dWFsaXphX21hcmNhX2xpc3RhPTE=';
                redirect()
            }
        });
    });
});

function llenaCamposUpdatemarca(idMarca) {
    var marcaFiltro = data_marca.filter(function (marca) { return marca.Id ==idMarca })[0];
    $("#txtPatologia").val(dataPatologia[marcaFiltro.IdPatologia]);
    $("#txtGrupoT").val(dataGrupoTerapeutico[marcaFiltro.IdGrupoTerapeutico]);
    $("#txtFranquicia").val(dataFranquicia[marcaFiltro.IdFranquicia]);
    $("#txtDescripcion").val(marcaFiltro.Descripcion.trim());
    $('#cmbFabricante option[value="'+marcaFiltro.IdFabricante+'"]').attr('selected','selected');
    $('#cmbPaises option[value="'+marcaFiltro.IdPais+'"]').attr('selected','selected');
    $('select.select2_single').select2({width: '100%'});
}