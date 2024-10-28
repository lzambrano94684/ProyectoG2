var modificando=false;

function activarMenu(id, idMenu,idUsuario) {


    if (id.checked)
    {
        id.value = "A";
        modificando=false;
        var menu = $("#li-men-" + idMenu + " .custom-control-input");
        menu.each(function (index,m)
        {
            $(m).attr("disabled", false);

        });
    }
    else
    {

        swal({
            title: 'Desactivar Roles de Menú',
            text: "Confirma que desea desactivar todos los permisos del usuario al menú?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: 'Desactivar',
            cancelButtonText: "No, Cancelar"
        }).then(function (isConfirm) {
            if (isConfirm) {
                modificando=true;
                cargando(1);
                var datos = {
                    estado: 'I',
                    idMenu:idMenu,
                    idUsuario:idUsuario,
                    _token: $("#_token").val()
                };
                $.post("/pointex/administracion/accesos/activar_roles", datos, function (res) {
                    if (res==="OK") {

                        cargando(2);
                        swal(
                            'Desactivado!',
                            'Los roles del usuario fueron desactivos!!',
                            'success'
                        );

                        id.value = "I";
                        var menu = $("#li-men-" + idMenu + " .custom-control-input");
                        menu.each(function (index,m)
                        {
                            $(m).prop('checked', false).change();
                            $(m).attr("disabled", "disabled");

                        });
                        // location.reload();

                    } else {
                        cargando(2);
                        swal(
                            'Error!',
                            'No fue posible realizar la desactivación!!',
                            'error'
                        );

                    }
                });

            }
        }).catch(swal.noop);


    }
}

function activarSubMenu(id, idMenu, idSubMenu,idUsuario) {

    if(!id.disabled && !modificando)
    {
        if (id.checked)
        {
            id.value = "A";
            swal({
                title: 'Activar Rol de Acceso',
                text: "Confirma que desea activar el permiso seleccionado?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0CC27E',
                cancelButtonColor: '#FF586B',
                confirmButtonText: 'Activar',
                cancelButtonText: "No, Cancelar"
            }).then(function (isConfirm) {
                if (isConfirm) {
                    cargando(1);
                    var datos = {
                        estado: id.value,
                        idMenu:idMenu,
                        idSubMenu:idSubMenu,
                        idUsuario:idUsuario,
                        _token: $("#_token").val()
                    };
                    $.post("/pointex/administracion/accesos/act_sub_menu", datos, function (res) {
                        if (res==="OK") {

                            cargando(2);
                            swal(
                                'Activado!',
                                'El permiso seleccionado para el usuario fue creado correctamente!!',
                                'success'
                            );



                        } else {
                            cargando(2);
                            swal(
                                'Error!',
                                'No fue posible realizar la creación!!',
                                'error'
                            );

                            id.value = "I";
                            id.checked=false;

                        }
                    });

                }
            }).catch(swal.noop);

        }
        else
        {

            id.value = "I";
            swal({
                title: 'Desactivar Rol de Acceso',
                text: "Confirma que desea desactivar el permiso seleccionado?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0CC27E',
                cancelButtonColor: '#FF586B',
                confirmButtonText: 'Desactivar',
                cancelButtonText: "No, Cancelar"
            }).then(function (isConfirm) {
                if (isConfirm) {
                    cargando(1);
                    var datos = {
                        estado: id.value,
                        idMenu:idMenu,
                        idSubMenu:idSubMenu,
                        idUsuario:idUsuario,
                        _token: $("#_token").val()
                    };
                    $.post("/pointex/administracion/accesos/act_sub_menu", datos, function (res) {
                        if (res==="OK") {

                            cargando(2);
                            swal(
                                'Desactivado!',
                                'El permiso seleccionado para el usuario fue desactivado correctamente!!',
                                'success'
                            );



                        } else {
                            cargando(2);
                            swal(
                                'Error!',
                                'No fue posible realizar la desactivación!!',
                                'error'
                            );

                            id.value = "A";
                            id.checked=true;

                        }
                    });

                }
            }).catch(swal.noop);


        }
    }


}

