$(document).ready(function () {

    $(".select2_single").select2({
        placeholder: "Seleccione Opción",
        allowClear: true
    });
});

function modClave() {

    var claveOld=$("#mod_pswClaveAnt");
    var claveNew=$("#mod_pswClaveNew");
    var claveConfirm=$("#mod_pswClaveNewConfirm");
    var idUsuario=$("#hdIdUsuario").val();


    if(claveOld.val()=="")
    {
        claveOld.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo de Clave Anterior es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }else if(claveNew.val() != claveConfirm.val() )
    {
        claveOld.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "Contraseña nueva con confirmación son incorrectas",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }else if(claveOld.val()== claveNew.val())
    {
        claveOld.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "Contraseña nueva debe ser distinta a la original",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        claveOld.removeClass("has-error");
    }

    if(claveNew.val()=="")
    {
        claveNew.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo de Nueva Clave es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        claveNew.removeClass("has-error");
    }


    swal({
        title: 'Modificar Clave de Acceso',
        text: "Desea modificar su clave acceso al sistema?",
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
                IdUsuario: idUsuario,
                ClaveVieja: claveOld.val(),
                ClaveNueva: claveNew.val(),
                _token: $("#_token").val()
            };
            $.post("/pointex/mod_clave", datos, function (res) {
                if (res.RESPUESTA==="OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Su clave de acceso al sistema fue modificada!!',
                        'success'
                    );
                    //location.reload();

                } else {
                    cargando(2);
                    swal(
                        'Error!',
                        res.DESCRIPCION,
                        'error'
                    );

                }
            });

        }
    }).catch(swal.noop);
}

function modPerfil() {
    var idUsuario=$("#hdIdUsuario").val();
    var Direccion=$("#txtDir");
    var Correo=$("#txtCorreo");
    var Telefono=$("#txtTel");
    var IdPais=$("#slcPais");

    if(idUsuario!="")
    {
        if(Direccion.val()=="")
        {
            Direccion.addClass("has-error");
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El campo de Dirección es requerido!",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });

            return false;
        }
        else
        {
            Direccion.removeClass("has-error");
        }

        if(Correo.val()=="")
        {
            Correo.addClass("has-error");
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El campo de Correo es requerido!",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });

            return false;
        }
        else
        {
            Correo.removeClass("has-error");
        }

        if(Telefono.val()=="")
        {
            Telefono.addClass("has-error");
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El campo de Teléfono es requerido!",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });

            return false;
        }
        else
        {
            Telefono.removeClass("has-error");
        }

        if(IdPais.val()=="")
        {
            IdPais.addClass("has-error");
            swal({
                type: 'error',
                title: "Requerido!",
                text: "El campo de País es requerido!",
                timer: 3000,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'

            });

            return false;
        }
        else
        {
            IdPais.removeClass("has-error");
        }


        swal({
            title: 'Modificar de Perfil',
            text: "Desea modificar sus datos de perfil?",
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
                    IdUsuario: idUsuario,
                    Direccion: Direccion.val(),
                    Correo: Correo.val(),
                    Telefono: Telefono.val(),
                    IdPais: IdPais.val(),
                    _token: $("#_token").val()
                };
                $.post("/pointex/mod_perfil", datos, function (res) {
                    if (res.RESPUESTA==="OK") {

                        cargando(2);
                        swal(
                            'Modificado!',
                            'Los datos de su perfil fueron modificados correctamente!!',
                            'success'
                        );
                        location.reload();

                    } else {
                        cargando(2);
                        swal(
                            'Error!',
                            res.DESCRIPCION,
                            'error'
                        );

                    }
                });

            }
        }).catch(swal.noop);
    }
    else
    {
        swal({
            type: 'error',
            title: "Requerido!",
            text: "No fue posible determinar la identidad del usuario!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }



}
