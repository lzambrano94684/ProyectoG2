$(document).ready(function () {

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

    $(".select2_multiple").select2({
        maximumSelectionLength: 2,
        placeholder: "Máximo 2 Productos",
        allowClear: true,
        language: "es"
    });
    var currentTime = new Date()
// returns the year (four digits)
    var year = currentTime.getFullYear()
    $("#txtFecha").attr("min", year+"-"+"01"+"-01");
    $("#txtFecha").attr("max", year+"-"+"12"+"-31");
    $('#cmbProducto').trigger('change');
});

$('#cmbMaterialPromocional,#cmbProducto,#slcFranquicia,#cmbPais,#txtFecha').change(function() {
    var MaterialPromocional = $("#cmbMaterialPromocional option:selected").text();
    var Marca = $("#cmbProducto option:selected").text();
    var IdFranquicia = $("#slcFranquicia").val();
    var Pais  = $("#cmbPais option:selected").text();

    var Fecha = $("#txtFecha").val();
    var d = new Date( Fecha );
    var anio = d.getFullYear();
    var mes = d.getMonth()+1;
    var getAnio =Fecha.substring(2,4);
    var getMes = Fecha.substring(5,7);
    var CodFranquicia = null;
    $.each($("#slcFranquicia  option"),function () {
        if (IdFranquicia == this.value){
            CodFranquicia = $(this).attr("codigo");
        }
    });

    var subStr = Marca.substring(0, 4);
    var CodMatePromocional = MaterialPromocional.split(" ");
    var CodReg =null;
    if(mes>=10){
        CodReg = Pais +"-"+CodFranquicia+"-"+subStr.toUpperCase()+"-"+CodMatePromocional[0]+"-"+getMes+"-"+getAnio
    }else{
        CodReg = Pais +"-"+CodFranquicia+"-"+subStr.toUpperCase()+"-"+CodMatePromocional[0]+"-"+getMes+"-"+getAnio
    }
    if(Pais =='Seleccione...' || MaterialPromocional == 'Seleccione...' || CodFranquicia === undefined || subStr==''   || isNaN(mes)  || isNaN(anio)){
        $('#CodMaterialPromocional').val('Generando Código');
    }
    else{
        $('#CodMaterialPromocional').val(CodReg);
    }


});

$("#slcFranquicia").on('change', function() {
    var IdFranquicia = this.value

    if(IdFranquicia ===""){
        $("#cmbProducto").empty()
    }
    var Marca = JSON.parse(atob(dataMarcas));

    $("#cmbProducto").empty()
    $('#CodMaterialPromocional').val('Generando Código');
    $("#cmbProducto").append($('<option></option>').attr('value', "").text("Seleccione..."));

    $.each(Marca, function( index, value ) {
        if(value.IdFranquicia == IdFranquicia){
            $("#cmbProducto").append('<option value=' + value.Id +'>' + value.Marca + '</option>')
        }
    });
}).triggerHandler('change');

function deleteMaterial(id, codigo) {
    swal({
        title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información <b class="text-danger">' + codigo + '</b>?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Deseo Eliminarlo!',
        cancelButtonText: 'No',
    }).then(function (isConfirm) {
        if (isConfirm) {
            url = '/pointex/medical/material/promocional/' + id;
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



if(validarVer!=0){
    $("#formMaterialPromocional input").prop("disabled", true);
    $("#formMaterialPromocional select").prop("disabled", true);
    $("#Idbtn").remove();

}

if(TiempoDuracion!=0 && IdMarca !=0){
    $("#cmbDuracion").val(TiempoDuracion).trigger("change.select2");
    $("#cmbProducto").val(IdMarca).trigger("change.select2");
}

$('.mostarImagen').on('click', function () {
    cargando(1);
    jsonMessage = {
        title: this.alt,
    };
    var url = $(this).attr("url");
    var lastChar = url.substr(-3).toUpperCase();
    if (lastChar == "PDF") {
        jsonMessage.html = "<iframe src='" + url + "' style='width:100%; min-height:600px' type='application/pdf'></iframe>";
    } else {
        jsonMessage.imageUrl = url;
    }
    setTimeout('cargando(2)', 200);
    setTimeout('msgJson()', 200);

});



function enviarRegistro(id, nombre, estatus) {
    swal({
        title: '<i class="far fa-share-square fa-7x warning"></i><br>¿Deseas Enviar al árbol de aprobaciones <b class="text-danger">' + nombre + '</b>?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Deseo Enviar!',
        cancelButtonText: 'No',
    }).then(function (isConfirm) {
        if (isConfirm) {
            url = "/pointex/medical/material/promocional/aprobaciones/"+id;
            redirect()
        }
    });
}


function Aprobaciones(id, nombre, estatus, Icono,mens) {
    swal({
        title: '<i class="'+Icono+' fa-7x warning"></i><br>¿Deseas '+mens+' <b class="text-danger">' + nombre + '</b>?',
        input: 'text',
        inputPlaceholder: 'Agregar Observaciones',
        inputAttributes: {
            autocapitalize: 'off',
            maxlength: 300,
            required: 'false'
        },
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Deseo '+mens+'!',
        cancelButtonText: 'No'
    }).then(function (observacion) {
        url = "/pointex/multiples/canbia_estatus/"+id+"/"+estatus+"/UFhfTUVEX1NvbGljaXR1ZE1hdGVyaWFsUHJvbW9jaW9uYWw=/"+observacion;
        redirect()
    });;
}
