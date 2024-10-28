var step3 = false;


$(document).ready(function () {

    $(".select2_single").select2({
        placeholder: "Seleccione Opción",
        allowClear: true
    });


    $(".select2ModPersonas").select2({
        placeholder: "Seleccione Opción",
        allowClear: true,
        dropdownParent: $('#modalPersonas')
    });

    $(".select2_group").select2({});
    $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "sole puedes elegir 4",
        allowClear: true
    });

    $(".select2ModPerson").select2({
        placeholder: "Seleccione Opción",
        allowClear: true,
        dropdownParent: $('#modalPersona')
    });


    /*moveToTarget('tableUsers');*/

});

function validarPaso(paso) {


    switch (paso)
    {
        case 0:
            return validarPersona();
        case 1:
            return validarPersonaIdentidad();
        case 2:
            return validarPersonaContacto();
        default:
            return true;

    }
}

function validarPersona() {


    if($("#txtNombres").val()=="")
    {
        $("#txtNombres").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo de Nombres es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#txtNombres").removeClass("has-error");
    }

    if($("#txtApellidos").val()=="")
    {
        $("#txtApellidos").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo de Apellidos es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#txtApellidos").removeClass("has-error");
    }


    if($("#slcGenero").val()=="")
    {
        $("#slcGenero").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El Género es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#slcGenero").removeClass("has-error");
    }

    if($("#slcEntidad").val()=="")
    {
        $("#slcEntidad").addClass("has-error");
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
        $("#slcEntidad").removeClass("has-error");
    }



    return true;
}

function validarPersonaIdentidad() {

    if($("#txtCui").val()=="")
    {
        $("#txtCui").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo CUI es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#txtCui").removeClass("has-error");
    }

    if($("#txtNit").val()=="")
    {
        $("#txtNit").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo NIT es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#txtNit").removeClass("has-error");
    }


    return true;
}

function validarPersonaContacto() {

    if($("#slcPais").val()=="")
    {
        $("#slcPais").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo País es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#slcPais").removeClass("has-error");
    }

    if($("#txtCorreo").val()=="")
    {
        $("#txtCorreo").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Correo es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#txtCorreo").removeClass("has-error");
    }


    cargando(1);

    var datos = {
        correo: $("#txtCorreo").val(),
        _token: $("#_token").val()
    };

    $.post("/pointex/administracion/usuarios/val_correo", datos, function (res) {
        if (res==="SI") {

            cargando(2);
            $("#txtCorreo").addClass("has-error");
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
            $("#txtCorreo").removeClass("has-error");

            step3=true;
            stepsWizard.steps("next");
        }
    });

    if(step3)
    {
        return true
    }


}

function validarUsuario() {


    if($("#slcTipoUsuario").val()=="")
    {
        $("#slcTipoUsuario").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Departamento es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#slcTipoUsuario").removeClass("has-error");
    }

    if($("#txtUsuario").val()=="")
    {
        $("#txtUsuario").addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Usuario es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        $("#txtUsuario").removeClass("has-error");
    }



    cargando(1);
    var data = {
        usuario: $("#txtUsuario").val(),
        _token: $("#_token").val()
    };

    $.post("/pointex/administracion/usuarios/val_usuario", data, function (res) {
        if (res==="SI")
        {

            cargando(2);
            $("#txtUsuario").addClass("has-error");
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El Usuario que ingresó ya existe en el sistema",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });

            return false;

        }
        else
        {


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
                        "Nombres": $("#txtNombres").val(),
                        "Apellidos": $("#txtApellidos").val(),
                        "Genero": $("#slcGenero").val(),
                        "IdEntidad": parseInt($("#slcEntidad").val()),
                        "IdPais": parseInt($("#slcPais").val()),
                        "Direccion": $("#txtDir").val(),
                        "Correo": $("#txtCorreo").val(),
                        "Telefono": $("#txtTel").val(),
                        "IdPuesto": parseInt($("#slcTipoUsuario").val())
                    };

                    $.post("/pointex/administracion/usuarios/crear_user", datos, function (res) {

                        if (res.ESTADO==="OK") {

                            cargando(2);
                            swal(
                                'Creado!',
                                'El nuevo usuario fue creado correctamente!!',
                                'success'
                            );
                            location.reload();

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


            // return true;

        }
    });
}

function estadoUsuario(id){

    swal({
        title: 'Activar/Desactivar Usuario',
        text: "Desea modificar el estado del usuario en el sistema?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Cambiar',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {
            cargando(1);
            var datos = {
                id: id,
                _token: $("#_token").val()
            };
            $.post("/pointex/administracion/usuarios/estado_user/"+id, datos, function (res) {
                if (res==="OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del usuario fueron modificados!!',
                        'success'
                    );
                    location.reload();

                } else {
                    cargando(2);
                    swal(
                        'Error!',
                        'No fue posible realizar la modificación!!',
                        'error'
                    );

                }
            });

        }
    }).catch(swal.noop);


}

function showModPersona(id) {

    var datos = {
        usuario: id,
        _token: $("#_token").val()
    };

    cargando(1);
    $.post("/pointex/administracion/usuarios/info/"+id, datos, function (res) {


        cargando(2);

        if(res.ESTADO=='OK')
        {
            var datos = res.DATOS[0];


            $("#mod_txtUsuario").val(datos.Usuario);
            if(datos.Estado=="A")
            {
                $("#iconUser").removeClass("fa-toggle-off");
                $("#iconUser").addClass("fa-toggle-on")
            }
            else
            {
                $("#iconUser").removeClass("fa-toggle-on");
                $("#iconUser").addClass("fa-toggle-off")
            }

            $("#hdIdPersona").val(datos.persona.Id);



            $("#mod_txtNombres").val(datos.persona.Nombres);
            $("#mod_txtApellidos").val(datos.persona.Apellidos);
            $("#mod_slcGenero").val(datos.persona.Genero);
            $("#mod_slcEntidad").val(datos.persona.IdEntidad).trigger("change.select2");




            if(!$.isEmptyObject(datos.persona.persona_identidad))
            {
                $("#mod_txtCui").val(datos.persona.persona_identidad[0].CUI);
                $("#mod_txtNit").val(datos.persona.persona_identidad[0].NIT);
                $("#mod_txtIgss").val(datos.persona.persona_identidad[0].IGSS);
                $("#mod_txtPasaporte").val(datos.persona.persona_identidad[0].Pasaporte);
            }

            if(!$.isEmptyObject(datos.persona.persona_contacto))
            {


                $("#mod_slcPais").val(datos.persona.persona_contacto[0].IdPais).trigger("change.select2");
                $("#mod_txtDireccion").val(datos.persona.persona_contacto[0].Direccion);
                $("#mod_txtCorreo").val(datos.persona.persona_contacto[0].Correo);
                $("#mod_txtTel").val(datos.persona.persona_contacto[0].Telefono);

            }


            $("#modalPersona").modal("show");

            setTimeout(function () {
                loadSelect2ByModal('modalPersona');
            },200);


        }else {
            swal({
                type: 'error',
                title: "Requerido!",
                text: "No fue posible encontrar la información solicitada",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });
        }





    });


    //  $("#modalPersona").modal("show");
}

function modPersona() {

    var datos={
        "_token": $("#_token").val(),
        "IdPersona": $("#hdIdPersona").val(),
        "Nombres": $("#mod_txtNombres").val(),
        "Apellidos": $("#mod_txtApellidos").val(),
        "Genero": $("#mod_slcGenero").val(),
        "IdEntidad": $("#mod_slcEntidad").val(),
        "CUI": $("#mod_txtCui").val(),
        "NIT": $("#mod_txtNit").val(),
        "IGSS": $("#mod_txtIgss").val(),
        "Pasaporte": $("#mod_txtPasaporte").val(),
        "Pais": $("#mod_slcPais").val(),
        "Direccion": $("#mod_txtDireccion").val(),
        "Correo": $("#mod_txtCorreo").val(),
        "Telefono": $("#mod_txtTel").val(),
        "Usuario":$("#mod_txtUsuario").val()
    };

    if(datos.IdPersona!="" && datos.Usuario!="")
    {

        if(datos.Nombres==="")
        {
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El campo de Nombres es requerido",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });
            return false;
        }

        if(datos.Apellidos==="")
        {
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El campo de Apelllidos es requerido",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });

            return false;
        }

        if(datos.Genero==="")
        {
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El campo de Género es requerido",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });

            return false;
        }

        if(datos.IdEntidad==="")
        {
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El campo de Entidad es requerido",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });
            return false;
        }

        if(datos.CUI==="")
        {
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El campo de CUI es requerido",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });
            return false;
        }

        if(datos.Pais==="")
        {
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El campo de Pais es requerido",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });
            return false;
        }

        if(datos.Correo==="")
        {
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El campo de Correo es requerido",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });
            return false;
        }


        var data = {
            usuario: datos.Usuario,
            _token: $("#_token").val()
        };

        cargando(1);
        $.post("/pointex/administracion/usuarios/val_usuario/"+datos.IdPersona, data, function (res) {
            if (res === "SI") {
                cargando(2);
                $("#mod_txtUsuario").addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Usuario que ingresó ya existe en el sistema",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            }
            else
            {
                cargando(2);
                swal({
                    title: 'Confirmación de Cambio',
                    text: "Desea realizar las modificaciones al usuario:"+datos.Nombres+" en el sistema?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Modificar',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);

                        $.post("/pointex/administracion/usuarios/modificar_user", datos, function (res) {
                            if (res.ESTADO==="OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos del usuario fueron modificados!!',
                                    'success'
                                );
                                location.reload();

                            } else {
                                cargando(2);
                                swal(
                                    'Error!',
                                    'No fue posible realizar la modificación!!',
                                    'error'
                                );

                            }
                        });

                    }
                }).catch(swal.noop);
            }
        });


    }
    else
    {
        swal({
            type: 'error',
            title: "Requerido!",
            text: "No fue posible encontrar el identificador del usuario, vuelva a cargar su ventana",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }


}

function restablecerClave(id) {

    swal({
        title: 'Restablecer Contraseña',
        text: "Desea realmente modificar la contraseña del usuario?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Modificar',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {
            cargando(1);
            var datos = {
                id: id,
                _token: $("#_token").val()
            };

            $.post("/pointex/administracion/usuarios/renew_user_pass/"+id, datos, function (res) {
                if (res==="OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del usuario fueron modificados!!',
                        'success'
                    );
                    // location.reload();

                } else {
                    cargando(2);
                    swal(
                        'Error!',
                        'No fue posible realizar la modificación!!',
                        'error'
                    );

                }
            });

        }
    }).catch(swal.noop);

}

/*function loadSelect2() {

    $(".select2_single").select2({
        placeholder: "Seleccione Opción",
        allowClear: true
    });
}*/

function modRoles(id){
    $("#idUsuario").val(id);
    cargando(1);
    $("#frmRoles").submit();

}




function showModReport(idUser)
{
    if(idUser != '' && idUser != null && $.isNumeric(idUser) && idUser > 0)
    {
        var token = $("#_token").val();
        var data = {idUser: idUser, _token: token};

        $.ajax({
            url: '/pointex/administracion/reporteRoles',
            type: 'POST',
            data: data,
            dataType: 'html',
            beforeSend: function () {
                /*dialogLoading(false, true);*/
                cargando(1);
            },

            error: function (xhr, status, error) {

            },

            success: function (resp) {
                dialogLoading(true, true);
                cargando(2);


                resp =JSON.parse(resp);

                if(resp.ESTATUS=="OK")
                {
                    var div = $('#divRoles');
                    var div = $('#div-pdf');
                    var html="<iframe id='divRoles' src='data:application/pdf;base64,"+resp.DATA+"' style='width:100%; min-height:800px' type='application/pdf'></iframe>";

                    div
                        .empty()
                        .html(html)
                    .attr('src','data:application/pdf;base64,'+resp.DATA)
                    ;
                    $('#modalReporte').modal('show');
                }
                else
                {
                    swal({
                        type: 'error',
                        title: "Mensaje del Sistema!",
                        text: resp.DATA,
                        // timer: 3000,
                        showConfirmButton: true,
                        confirmButtonText: 'Aceptar'

                    });
                    return false;
                }



                if(data.ESTATUS == 'OK')
                {
                    var array = data.DATA;
                    var div = $('#divRoles');
                    var table = '';

                    div.empty();

                    table = '<table class="table table-striped" cellspacing="0" width="100%">';
                    table +=    '<thead>';
                    table +=        '<tr>';
                                        $.each(array[1], function(k,v){
                                            table += '<td>' + k +'</td>';
                                        });
                    table +=        '</tr>';
                    table +=    '</thead>';

                    table +=    '<tbody>';
                    $.each(array, function(ka,va){
                        table += '<tr>';
                            $.each(va, function(k,v){
                                table += '<td>' + v + '</td>';
                            });
                        table += '</tr>';
                    });
                    table +=    '</tbody>';
                    table +=    '</table>';

                    div.html(table);
                    $('#modalReporte').modal('show');
                }
            }
        });
    }
}


$(document).ready(function(){
    $('.datos').numeric({ negative : false });
});
