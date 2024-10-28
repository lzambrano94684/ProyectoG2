
function modPais() {

    var nombrePais = $("#txtPais");
    var codigoPais = $("#txtCodigo");
    var idPais = $("#txtIdPais");


    if (nombrePais.val() == "") {
        nombrePais.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre País es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombrePais.removeClass("has-error");
    }

    if (codigoPais.val() == "") {
        codigoPais.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo de Código de País es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        codigoPais.removeClass("has-error");
    }


    if (idPais.val() == "") {
        cargando(1);
        var data = {
            Nombre: nombrePais.val(),
            _token: $("#_token").val()
        };


        $.post("/pointex/administracion/catalogos/pais/val_pais", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombrePais.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "País ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {

                cargando(2);
                swal({
                    title: 'Creación País',
                    text: "Confirma que desea crear los datos del País?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear País',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);

                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombrePais.val(),
                            Codigo: codigoPais.val(),

                        };
                        $.post("/pointex/administracion/catalogos/pais/crear_pais", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Cración!',
                                    'Los datos del Páis fueron creados correctamente!!',
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
        });
    } else {
        cargando(1);
        var data = {

            Nombre: nombrePais.val(),
            idPais: idPais.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/administracion/catalogos/pais/val_pais", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombrePais.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de País que ingresó ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {


                cargando(2);
                swal({
                    title: 'Modificar País',
                    text: "Confirma que desea modificar los datos del país?",
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
                            _token: $("#_token").val(),
                            Nombre: nombrePais.val(),
                            Codigo: codigoPais.val(),
                            id: idPais.val(),

                        };
                        $.post("/pointex/administracion/catalogos/pais/modificar_pais", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos del País fueron modificados correctamente!!',
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
        });
    }

}

$("#btn-asignaPerfil").click(function(){

    $("#IdAddCapex").empty()
    $("#IdAddCapex").append('<h4 class="modal-title text-bold-400" id="myModalLabel16">Crear&nbsp;</h4>');
});

function guardarUP() {
    var IdUsuario = $("#mod_slcUsuario");
    var IdPerfil = $("#mod_slcPerfil");


    if (IdUsuario.val()== ""){
        IdUsuario.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "Usuario es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }else {
        IdUsuario.removeClass("has-error");
    }

    if (IdPerfil.val()==""){
        IdPerfil.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "Perfil es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else{
        IdPerfil.removeClass("has-error");
    }

   swal({
        title: 'Modificar',
        text: "Confirma que desea modificar los datos ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Crear',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {

            cargando(1)

            var datos = {
                IdUsuario: IdUsuario.val(),
                IdPerfil: IdPerfil.val(),
                _token: $("#_token").val()

            };

            cargando(1)
            $.post("/pointex/administracion/accesos/asignar_perfil/crear", datos, function (res) {

                if (res.ESTADO === "OK") {

                    cargando(0);
                    swal(
                        'Creación!',
                        'Los datos fueron creados correctamente!!',
                        'success'
                    );
                    location.reload();

                } else {
                    cargando(2);

                    swal(
                        'Error!',
                        res.RESULTADO,
                        'error'
                    );


                }
            });


        }
    }).catch(swal.noop);





}

function eliminarUP() {
    var IdUsuario = $("#delete_slcUsuario");
    var IdPerfil = $("#delete_slcPerfil");


    if (IdUsuario.val()== ""){
        IdUsuario.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "Usuario es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }else {
        IdUsuario.removeClass("has-error");
    }

    if (IdPerfil.val()==""){
        IdPerfil.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "Perfil es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else{
        IdPerfil.removeClass("has-error");
    }

    swal({
        title: 'Eliminar',
        text: "Confirma que desea eliminar los datos ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Eliminar',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {

            cargando(1)

            var datos = {
                IdUsuario: IdUsuario.val(),
                IdPerfil: IdPerfil.val(),
                _token: $("#_token").val()

            };

            cargando(1)
            $.post("/pointex/administracion/accesos/asignar_perfil/delete", datos, function (res) {

                if (res.ESTADO === "OK") {

                    cargando(0);
                    swal(
                        'Creación!',
                        'Los datos fueron eliminados correctamente!!',
                        'success'
                    );
                    location.reload();

                } else {
                    cargando(2);

                    swal(
                        'Error!',
                        res.RESULTADO,
                        'error'
                    );


                }
            });


        }
    }).catch(swal.noop);





}

function modAsignar() {
    var IdPerfil = $("#mod_slcPerfil");
    var IdModulo = $("#mod_slcModulo");
    var IdMenu = $("#modMenu");
    var IdSubMenu = $("#modSubMenu");




    if (IdPerfil.val() == "") {
        IdPerfil.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Perfil está vacio!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'OK'

        });

        return false;
    } else {
        IdPerfil.removeClass("has-error");

        cargando(2);
        swal({
            title: 'Guardar Permisos',
            text: "Confirma que desea guardar los Permisos Asignados?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: 'OK',
            cancelButtonText: "No, Cancelar"
        }).then(function (isConfirm) {
            if (isConfirm) {
                cargando(1);

                var datos = {
                    _token: $("#_token").val(),
                    IdPerfil: IdPerfil.val(),
                    IdModulo: IdModulo.val(),
                    IdMenu:     IdMenu.val(),
                    IdSubMenu:  IdSubMenu.val(),
                };

                $.post("/pointex/administracion/accesos/asignar_permisos/modificar_tipo", datos, function (res) {
                    if (res.ESTADO === "OK") {

                        cargando(2);
                        swal(
                            'Almacenado!',
                            'Los datos fueron almacenados correctamente!!',
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




}


function modEntidad() {

    var nombre = $("#txtEntidadNombre");
    var localidad = $("#txtEntidadLocalidad");
    var razonSocial = $("#txtEntidadRazonSocial");
    var representante = $("#txtEntidadRepresentante");
    var idPais = $("#mod_slcPais");
    var direccion = $("#txtEntidadDireccion");
    var telefono = $("#txtEntidadTelefono");
    var email = $("#txtEntidadCorreo");
    var relInt = $("#rdEntRelI");
    var fabS = $("#rdEntFabS");

    var relacion = (relInt.prop("checked")) ? "I" : "E";
    var fabricante = (fabS.prop("checked")) ? "S" : "N";

    //validacion de nombre
    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre de entidad es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }
    // nombre representante
    if (representante.val() == "") {
        representante.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Representante de entidad es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'
        });
        return false;
    } else {
        representante.removeClass("has-error");
    }

    if (idPais.val() == "") {
        idPais.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "Seleccione país es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'
        });
        return false;

    } else {
        idPais.removeClass("has-error");
    }

    if (direccion.val() == "") {
        idPais.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo dirección es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'
        });
        return false;

    } else {
        direccion.removeClass("has-error");
    }



    if (idEntidad.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: localidad.val(),
            RazonSocial: razonSocial.val(),
            Representante: representante.val(),
            idPais: idPais.val(),
            Direccion: direccion.val(),
            Telefono: telefono.val(),
            Correo: email.val(),
            Relacion: relacion,
            Fabricante: fabricante,
            _token: $("#_token").val()
        };

        $.post("/pointex/administracion/catalogos/entidad/validar_Entidad", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de la entidad ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de entidad',
                    text: "Confirma que desea crear los datos de la Entidad?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Entidad',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        //se crea la entidad
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: localidad.val(),
                            RazonSocial: razonSocial.val(),
                            Representante: representante.val(),
                            IdPais: idPais.val(),
                            Direccion: direccion.val(),
                            Telefono: telefono.val(),
                            Correo: email.val(),
                            Relacion: relacion,
                            Fabricante: fabricante,
                        };
                        $.post("/pointex/administracion/catalogos/entidad/crearEntidad", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos de la Entidad fueron creados correctamente!!',
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
        });
    } else {
        cargando(1);
        var data = {
            Nombre: nombre.val(),
            Descripcion: localidad.val(),
            RazonSocial: razonSocial.val(),
            Representante: representante.val(),
            IdPais: idPais.val(),
            Direccion: direccion.val(),
            Telefono: telefono.val(),
            Correo: email.val(),
            Relacion: relacion,
            Fabricante: fabricante,
            id: idEntidad.val(),
            _token: $("#_token").val()
        };

        $.post("/pointex/administracion/catalogos/entidad/validar_Entidad", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de la entidad ingresada ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar Entidad',
                    text: "Confirma que desea modificar los datos de la entidad?",
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
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: localidad.val(),
                            RazonSocial: razonSocial.val(),
                            Representante: representante.val(),
                            IdPais: idPais.val(),
                            Direccion: direccion.val(),
                            Telefono: telefono.val(),
                            Correo: email.val(),
                            Relacion: relacion,
                            Fabricante: fabricante,
                            id: idEntidad.val(),

                        };

                        $.post("/pointex/administracion/catalogos/entidad/modificarEntidad", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de la Entidad fueron modificados correctamente!!',
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
        });
    }
}

function modPerfil() {

    var nombre = $("#txtPerfil");
    var idPerfil = $("#txtIdPerfil");

    //validacion de nombre
    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo vacio!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (idPerfil.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/administracion/catalogos/perfil/validar_Perfil", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "Perfil ya existe!",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de Perfil',
                    text: "Desea crear los datos del perfil?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Perfil',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),

                        };
                        $.post("/pointex/administracion/catalogos/perfil/crearPerfil", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos fueron creados correctamente!!',
                                    'success'
                                );
                                location.reload();
                            } else {
                                cargando(2);
                                swal(
                                    'Error!',
                                    res.RESULTADO,
                                    'error'
                                );


                            }
                        });

                    }
                }).catch(swal.noop);
            }
        });
    } else {
        cargando(1);
        var data = {


            Nombre: nombre.val(),
            id: idPerfil.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/administracion/catalogos/perfil/validar_Perfil", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "Perfil ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {


                cargando(2);
                swal({
                    title: 'Modificar Perfil',
                    text: "Desea modificar los datos de Perfil?",
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
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            id: idPerfil.val(),
                        };

                        $.post("/pointex/administracion/catalogos/perfil/modificarPerfil", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos del perfil fueron modificados correctamente!!',
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
        });
    }
}

function showModPais(paisRecibe) {
    try {
        var pais =JSON.parse(atob(paisRecibe));
        $("#txtPais").val(pais.Nombre);
        $("#txtCodigo").val(pais.Codigo);
        $("#txtIdPais").val(pais.Id);
        $("#modalPais").modal({backdrop:
                'static', keyboard: true,});

        setTimeout(function () {
            loadSelect2ByModal('modalPais');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModTipo(posicion) {


    var inputModulo = $("#mod_slcModulo");
    var jsonData = JSON.parse(atob(dataModulo));
    var dataSelectModulo = [];
    $.each(jsonData,function (k,v) {

        var dataInt = {
            id : v.Id,
            text : v.Nombre,
            menu : v.menu,
        };
        dataSelectModulo[k]=dataInt
    });

    try {
        var asignar = JSON.parse(atob(dataAsignada));
        var modulo = asignar[posicion].Modulo;
        var arrayIdModulos=[];
        var arrayIdMenus=[];
        var arrayIdSubMenus=[];



        $.each(modulo,function (k,v) {
            arrayIdModulos.push(v.Id);
            $.each(v.Menus,function (ki,vi) {
                arrayIdMenus.push(vi.Id)
                $.each(vi.SubMenus,function (kii,vii) {
                    arrayIdSubMenus.push(vii.Id)
                })
            })
        });

        inputModulo.val(asignar[posicion].PerfilId).select2({
            placeholder: "Seleccione Opción",
            allowClear: true,
            multiple: true,
            width: "100%"
        }).on("change",function () {
            var cuenta =0;
            var dataOption ="";
            var arrayIdModulo = $(this).val();
            var arrayMenus = [];
            var countArray = 0;
            $.each(jsonData, function (k,v) {
                if (inArray(v.Id, arrayIdModulo))
                {
                    $.each( v.menu ,function (kii,vii) {
                        vii["IdModulo"]= v.Id;
                        dataOption += "<option value='"+vii.Id+"' class='optionMenu"+v.Id+"'>"+vii.Nombre+"</option>";
                        arrayMenus[countArray] = vii;
                        countArray++;
                    });

                }
            });

            var modMenu = $("#modMenu");
            modMenu.html(dataOption);
            modMenu.select2({
                placeholder: "Seleccione Opción",
                allowClear: true,
                multiple: true,
                width: "100%"
            }).on("change",function () {
                var arrayIdMenu = $(this).val();
                var dataOptionSubMenu = "";
                var modSubMenu = $("#modSubMenu");
                $.each(arrayMenus, function (k,v) {
                    if (inArray(v.Id, arrayIdMenu))
                    {
                        $.each( v.sub_menu ,function (kii,vii) {
                            vii["IdModulo"]= v.Id;
                            dataOptionSubMenu += "<option value='"+vii.Id+"' class='optionMenu"+v.Id+"'>"+vii.Nombre+"</option>";
                            countArray++;
                        });

                    }
                });
                modSubMenu.html(dataOptionSubMenu);
                modSubMenu.select2({
                    placeholder: "Seleccione Opción",
                    allowClear: true,
                    multiple: true,
                    width: "100%"
                });
            });
        });


        var dataOption ="";
        var arrayIdModulo = arrayIdModulos;
        var arrayMenus = [];
        var countArray = 0;

        $.each(jsonData, function (k,v) {

            if (inArray(v.Id, arrayIdModulo))

            {
                $.each( v.menu ,function (kii,vii) {

                    vii["IdModulo"]= v.Id;
                    dataOption += "<option value='"+vii.Id+"' class='optionMenu"+v.Id+"'>"+vii.Nombre+"</option>";
                    arrayMenus[countArray] = vii;
                    countArray++;
                });

            }
        });

        var modMenu = $("#modMenu");
        modMenu.html(dataOption);
        modMenu.select2({
            placeholder: "Seleccione Opción",
            allowClear: true,
            multiple: true,
            width: "100%"
        });

        var arrayIdMenu = arrayIdMenus;
        var dataOptionSubMenu = "";
        var modSubMenu = $("#modSubMenu");
        $.each(arrayMenus, function (k,v) {
            if (inArray(v.Id, arrayIdMenu))
            {
                $.each( v.sub_menu ,function (kii,vii) {
                    vii["IdModulo"]= v.Id;
                    dataOptionSubMenu += "<option value='"+vii.Id+"' class='optionMenu"+v.Id+"'>"+vii.Nombre+"</option>";
                    countArray++;
                });

            }
        });
        modSubMenu.html(dataOptionSubMenu);
        modSubMenu.select2({
            placeholder: "Seleccione Opción",
            allowClear: true,
            multiple: true,
            width: "100%"
        });



        $("#mod_slcPerfil").val(asignar[posicion].PerfilId).prop('disabled', true);
        $("#mod_slcModulo").val(arrayIdModulos).trigger("change.select2");
        $("#modMenu").val(arrayIdMenus).trigger("change.select2");
        $("#modSubMenu").val(arrayIdSubMenus).trigger("change.select2");
        $("#modalAsignar").modal({
            backdrop:
                'static', keyboard: true,
        });

        setTimeout(function () {
            loadSelect2ByModal('modalAsignar');
        }, 200);
    } catch (e) {
        alert(e.message())
    }

}

function enviardelete(idFrm) {

    swal({
        title: 'Eliminar Permisos',
        text: "Confirma que desea eliminar permisos?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Si',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {
            $("#formElimininar"+idFrm).submit();

            swal(
                'OK!',
                'Los datos se han eliminado correctamente!!',
                'success'
            );

        } else {

            swal(
                'Error!',
                res.DESCRIPCION,
                'error'
            );


        }


    }).catch(swal.noop);


}

function deleteUsuarioPerfil(idFrm) {

    swal({
        title: 'Eliminar Perfiles',
        text: "Confirma que desea eliminar todos los perfiles?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Si',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {
            $("#formUsuarioPerfil"+idFrm).submit();

            swal(
                'OK!',
                'Los datos se han eliminado correctamente!!',
                'success'
            );

        } else {

            swal(
                'Error!',
                res.DESCRIPCION,
                'error'
            );


        }


    }).catch(swal.noop);


}


function deletePerfil(idFrm) {

    swal({
        title: 'Eliminar Perfil',
        text: "Confirma que desea eliminar perfil?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Si',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {
            $("#formPefilElimininar"+idFrm).submit();

            swal(
                'OK!',
                'Los datos se han eliminado correctamente!!',
                'success'
            );

        } else {

            swal(
                'Error!',
                res.DESCRIPCION,
                'error'
            );


        }

    }).catch(swal.noop);


}

function showModPerfil(perfilRecibe) {

    try {
        var perfil =JSON.parse(atob(perfilRecibe));

        $("#txtPerfil").val(perfil.Nombre);
        $("#mod_slcModulo").val(perfil.IdModulo).trigger("change.select2");
        $("#txtIdPerfil").val(perfil.Id);

        $("#modalPerfil").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalPerfil');
        }, 200);
    }catch (e) {
        alert(e.message())
    }

}

function showModRoles(rolRecibe) {

    $("#IdAddCapex").empty()
    $("#IdAddCapex").append('<h4 class="modal-title text-bold-400" id="myModalLabel16">Actualizar&nbsp;</h4>');
    try {
        var rol =JSON.parse(atob(rolRecibe));
        console.log(rol)
        var arrayIdPerfiles=[];
        var arrayIds=[];

        $.each(rol, function(i,item){
            arrayIdPerfiles.push(item.IdPerfil);
            arrayIds.push(item.Id);
        });

        $("#mod_slcUsuario").val(rol[0].IdUsuario).prop('disabled', true);
        $("#mod_slcPerfil").val(arrayIdPerfiles).trigger("change.select2");
        $("#IdUserPerfil").val(arrayIds);
        $("#AsigarPerfil").modal({backdrop:
                'static', keyboard: true,}

                );
        setTimeout(function () {
            loadSelect2ByModal('AsigarPerfil');
        }, 200);

    }catch (e) {
        alert(e.message())
    }

}

function showDelRoles(rolRecibe) {


    try {
        var rol =JSON.parse(atob(rolRecibe));
        console.log(rol)
        var arrayIdPerfiles=[];
        var arrayIds=[];

        $.each(rol, function(i,item){
            arrayIdPerfiles.push(item.IdPerfil);
            arrayIds.push(item.Id);
        });


        $("#delete_slcUsuario").val(rol[0].IdUsuario).prop('disabled', true);
        $("#delete_slcPerfil").val(arrayIdPerfiles).trigger("change.select2");
        $("#DeletePerfil").modal({backdrop:
                'static', keyboard: true,}

        );
        setTimeout(function () {
            loadSelect2ByModal('DeletePerfil');
        }, 200);


    }catch (e) {
        alert(e.message())
    }

}


function showModEntidad(entidadRecibe) {


    try {
        var entidad = JSON.parse(atob(entidadRecibe));
        $("#txtEntidadNombre").val(entidad.Nombre);
        $("#txtEntidadLocalidad").val(entidad.Descripcion);
        $("#txtEntidadRazonSocial").val(entidad.RazonSocial);
        $("#txtEntidadRepresentante").val(entidad.Representante);
        $("#mod_slcPais").val(entidad.IdPais).trigger("change.select2");
        $("#txtEntidadDireccion").val(entidad.Direccion);
        $("#txtEntidadTelefono").val(entidad.Telefono);
        $("#txtEntidadCorreo").val(entidad.Correo);

        if (entidad.Relacion == 'I') {
            $("#chkRelacion").prop("checked", true);
        } else {
            $("#chkRelacion").prop("checked", false);
        }


        if (entidad.Fabricante == 'S') {
            $("#chkFabricante").prop("checked", true);
        } else {
            $("#chkFabricante").prop("checked", false);
        }


        $("#txtIdEntidad").val(entidad.Id);

        $("#modalEntidad").modal({backdrop:
                'static', keyboard: true,});

        setTimeout(function () {
            loadSelect2ByModal('modalEntidad');
        }, 200);
    } catch (e) {
        alert(e.message())
    }


}

function estadoEntidad(id) {

    swal({
        title: 'Activar/Desactivar Entidad',
        text: "Desea modificar el estado de la entidad en el sistema?",
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

            $.post("/pointex/administracion/catalogos/entidad/estado_entidad/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos dela Entidad fueron modificados!!',
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


};

function addFormInternal(idModal) {
    $('#' + idModal + " input").each(function () {
        $($(this)).val('');
    });

    $('#' + idModal + " select option").each(function () {
        $(this).prop('selected', false).trigger('change');
    });

    $("#mod_slcPerfil").prop('disabled', false);
    $('#' + idModal).modal({backdrop:
            'static', keyboard: true,});
    setTimeout(function () {loadSelect2(); loadSelect2ByModalInternal();},200);
}

// selected modal
function loadSelect2ByModalInternal() {

    var inputModulo = $("#mod_slcModulo");
    var jsonData = JSON.parse(atob(dataModulo));
    var dataSelectModulo = [];

    $.each(jsonData,function (k,v) {
        var dataInt = {
            id : v.Id,
            text : v.Nombre,
            menu : v.menu,
        };
        dataSelectModulo[k]=dataInt
    });
    inputModulo.select2({
        placeholder: "Seleccione Opción",
        allowClear: true,
        multiple: true,
        width: "100%"
    }).on("change",function () {
        var cuenta =0;
        var dataOption ="";
        var arrayIdModulo = $(this).val();
        var arrayMenus = [];
        var countArray = 0;
        $.each(jsonData, function (k,v) {
            if (inArray(v.Id, arrayIdModulo))
            {
                $.each( v.menu ,function (kii,vii) {
                    vii["IdModulo"]= v.Id;
                    dataOption += "<option value='"+vii.Id+"' class='optionMenu"+v.Id+"'>"+vii.Nombre+"</option>";
                    arrayMenus[countArray] = vii;
                    countArray++;
                });

            }
        });

        var modMenu = $("#modMenu");
        modMenu.html(dataOption);
        modMenu.select2({
            placeholder: "Seleccione Opción",
            allowClear: true,
            multiple: true,
            width: "100%"
        }).on("change",function () {
            var arrayIdMenu = $(this).val();
            var dataOptionSubMenu = "";
            var modSubMenu = $("#modSubMenu");
            $.each(arrayMenus, function (k,v) {
                if (inArray(v.Id, arrayIdMenu))
                {
                    $.each( v.sub_menu ,function (kii,vii) {
                        vii["IdModulo"]= v.Id;
                        dataOptionSubMenu += "<option value='"+vii.Id+"' class='optionMenu"+v.Id+"'>"+vii.Nombre+"</option>";
                        countArray++;
                    });

                }
            });
            modSubMenu.html(dataOptionSubMenu);
            modSubMenu.select2({
                placeholder: "Seleccione Opción",
                allowClear: true,
                multiple: true,
                width: "100%"
            });
        });
    });

}

function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}


