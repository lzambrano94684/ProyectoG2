
$(".select2_single").select2({
    placeholder: "Seleccione Opción",
    allowClear: true
});

$(document).ready(function(){
    $('.datos').numeric({ negative : false });
    $( ".checkGenero" ).prop( "checked", false );
});



$("#cmbPais"). change(function(){
    var idPais = this.value;
    var DataEnt = JSON.parse(atob(entDeptPuesto));
    var htmlEntidad = [];
    htmlEntidad.push("<option value=''>Seleccione</option>");
    if (idPais === "") {
        $("#cmbEntidad").empty()
        $("#cmbDepartamento").empty()
        $("#cmbPuesto").empty()
    }else{
        $("#cmbDepartamento").empty()
        $("#cmbPuesto").empty()
    }
    $.each(DataEnt, function (key, value) {
        /*if (idPais == value.IdPais) {
            htmlEntidad.push("<option value='" + value.Id + "'>" + value.Entidad + "</option>");
        }*/
        htmlEntidad.push("<option value='" + value.Id + "'>" + value.Entidad + "</option>");
    });

    $("#cmbEntidad").html(jQuery.unique(htmlEntidad).join(''));

});


$("#cmbEntidad").change(function () {
    var IdEntidad = this.value
    var DataEnt = JSON.parse(atob(entDeptPuesto));
    var htmlDepto = [];
    htmlDepto.push("<option value=''>Seleccione</option>");
    if (IdEntidad === "") {
        $("#cmbDepartamento").empty()
        $("#cmbPuesto").empty()
    }else{
        $("#cmbDepartamento").empty()
        $("#cmbPuesto").empty()
    }
    $.each(DataEnt, function (key, value) {
        /*if (IdEntidad == value.IdEntidad) {
            htmlDepto.push("<option value='" + value.IdDepto + "'>" + value.Departamento + "</option>");
        }*/
        htmlDepto.push("<option value='" + value.IdDepto + "'>" + value.Departamento + "</option>");
    });
    $("#cmbDepartamento").html(jQuery.unique(htmlDepto).join(''));
});

$("#cmbDepartamento").change(function () {
    var IdDepto = this.value
    var DataEnt = JSON.parse(atob(entDeptPuesto));
    var htmlPuesto = [];

    if (IdDepto === "") {
        $("#cmbPuesto").empty()
    }else{
        $("#cmbPuesto").empty()
    }
    htmlPuesto.push("<option value=''>Seleccione</option>");

    $.each(DataEnt, function (key, value) {
       /* if (IdDepto == value.IdDepartamento) {
            htmlPuesto.push("<option value='" + value.IdPuesto + "'>" + value.Puesto + "</option>");
        }*/
        htmlPuesto.push("<option value='" + value.IdPuesto + "'>" + value.Puesto + "</option>");
    });
    $("#cmbPuesto").html(jQuery.unique(htmlPuesto).join(''));
});

$("#Idbtn").on("click", function(){

validaciones()
});

function validaciones() {

    // if($("#txtNombres").val()=="")
    // {
    //     $("#txtNombres").addClass("has-error");
    //     swal({
    //         type: 'error',
    //         title: "Requerido!",
    //         text: "El campo Nombres es requerido!",
    //         timer: 2000,
    //         showConfirmButton: true,
    //         confirmButtonText: 'Aceptar'
    //     });
    //     return false;
    // }
    // else
    // {
    //     $("#txtNombres").removeClass("has-error");
    // }

    // if($("#txtApellidos").val()=="")
    // {
    //     $("#txtApellidos").addClass("has-error");
    //     swal({
    //         type: 'error',
    //         title: "Requerido!",
    //         text: "El campo  Apellidos es requerido!",
    //         timer: 2000,
    //         showConfirmButton: true,
    //         confirmButtonText: 'Aceptar'
    //
    //     });
    //
    //     return false;
    // }
    // else
    // {
    //     $("#txtApellidos").removeClass("has-error");
    // }


    if($("#cmbPersona").val()=="")
    {
        $("#cmbPersona").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "Persona es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#cmbPais").removeClass("has-error");
    }

    if($("#cmbPais").val()=="")
    {
        $("#cmbPais").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "País es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#cmbPais").removeClass("has-error");
    }
    if($("#cmbEntidad").val()=="")
    {
        $("#cmbEntidad").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La Entidad es requerida!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#cmbEntidad").removeClass("has-error");
    }

    if($("#cmbDepartamento").val()=="")
    {
        $("#cmbDepartamento").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "Departamento es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#cmbDepartamento").removeClass("has-error");
    }

    if($("#cmbPuesto").val()=="")
    {
        $("#cmbPuesto").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "Puesto es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#cmbPuesto").removeClass("has-error");
    }

   /*
    if($('.checkGenero').not( "checked")) {
        $(".checkGenero").addClass("has-error");
        swal({
            type: 'error',
            title: "Género!",
            text: "Puesto es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else{
        $('.checkGenero').removeClass("has-error");
    }
    */


    if($("#txtEmail").val()=="")
    {
        $("#txtEmail").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "E-mail es requerido!",
            timer: 2000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#txtEmail").removeClass("has-error");
        validarCorreo()
    }



}


function validarCorreo() {
    step3 = false
    cargando(1);

    var datos = {
        correo: $("#txtEmail").val(),
        _token: $("#_token").val()
    };

    $.post("/pointex/administracion/usuarios/val_correo", datos, function (res) {
        if (res==="SI") {

            cargando(2);
            $("#txtEmail").addClass("has-error");
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El Correo que ingresó ya existe en el sistema",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });

            step3=false;

        } else {
            cargando(2);
            $("#txtEmail").removeClass("has-error");

            step3=true;

        if(step3 = true){

        }
            cargando(2);
            swal({
                title: 'Crear Usuario',
                text: "Confirma que desea crear el nuevo usuario en el sistema?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0CC27E',
                cancelButtonColor: '#FF586B',
                confirmButtonText: 'Crear Usuario',
                cancelButtonText: "No, Cancelar"
            }).then(function (isConfirm) {
                if (isConfirm) {
                    cargando(1);

                    var datos={
                        "_token": $("#_token").val(),
                        "IdPersona": $("#cmbPersona").val(),
                        // "Nombres": $("#txtNombres").val(),
                        // "Apellidos": $("#txtApellidos").val(),
                        "Genero": $(".checkGenero").val(),
                        "IdEntidad": parseInt($("#cmbEntidad").val()),
                        "IdPais": parseInt($("#cmbPais").val()),
                        "Direccion": $("#txtDireccion").val(),
                        "Correo": $("#txtEmail").val(),
                        "Telefono": $("#txtTelefono").val(),
                        "IdPuesto": parseInt($("#cmbPuesto").val())
                    };

                    $.post("/pointex/administracion/usuarios/crear_user", datos, function (res) {

                        if (res.ESTADO==="OK") {

                            cargando(2);
                            swal(
                                'Creado!',
                                'El nuevo usuario fue creado correctamente!!',
                                'success'
                            );
                            location.href = "/pointex/administracion/usuarios/";

                        } else {
                            cargando(2);
                            swal(
                                'Error!',
                                'No fue posible crear el nuevo usuario!!',
                                'error'
                            );

                        }

                    });

                }
            }).catch(swal.noop);

        }
    });


}
