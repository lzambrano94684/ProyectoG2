$(document).ready(function () {

    $(".select2_single").select2({
        placeholder: "Seleccione Opción",
        allowClear: true
    });
});

//Métodos para sistemas
function estadoSistema(id) {
    swal({
        title: 'Activar/Desactivar Sistema',
        text: "Desea modificar el estado del sistema?",
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
            $.post("/pointex/administracion/accesos/estado_sistema/" +id, datos, function (res) {
                if (res==="OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del sistema fueron modificados!!',
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
function showModSistema(sistema) {

    //document.getElementById("mod_txtNombre").value=obj.Nombre;
    $("#mod_txtNombre").val(sistema.Nombre);
    $("#mod_txtDesc").val(sistema.Descripcion);
    $("#mod_txtIcono").val(sistema.Icono);
    $("#mod_txtImg").val(sistema.Imagen);
    $("#idSistema").val(sistema.Id);

    $("#modalSistema").modal("show");
    setTimeout(function () {
        loadSelect2ByModal('modalSistema');
    },200);
}
function modSistema() {
   var Nombre= $("#mod_txtNombre");
   var Descripcion= $("#mod_txtDesc");
   var Icono=$("#mod_txtIcono");
   var Imagen= $("#mod_txtImg");
   var IdSistema= $("#idSistema");


    if(Nombre.val()=="")
    {
        Nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El Nombre del Sistema es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Nombre.removeClass("has-error");
    }

    if(Descripcion.val()=="")
    {
        Descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La Descripción del Sistema es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Descripcion.removeClass("has-error");
    }

    if(Imagen.val()=="")
    {
        Imagen.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La Imagen del Sistema es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Imagen.removeClass("has-error");
    }

    if(IdSistema.val()=="")
    {
        cargando(1);
        var data = {
            Nombre: Nombre.val(),
            _token: $("#_token").val()
        };

        $.post("/pointex/administracion/accesos/val_sistema", data, function (res) {
            if (res==="SI")
            {

                cargando(2);
                Nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Sistemas que ingresó ya existe en la base de datos",
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
                    title: 'Creación Sistema',
                    text: "Confirma que desea crear los datos del sistema?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Sistema',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);

                        var datos={
                            _token: $("#_token").val(),
                            Nombre: Nombre.val(),
                            Descripcion: Descripcion.val(),
                            Icono: Icono.val(),
                            Imagen: Imagen.val(),
                        };

                        $.post("/pointex/administracion/accesos/crear_sistema", datos, function (res) {
                            if (res.ESTADO==="OK") {

                                cargando(2);
                                swal(
                                    'Cración!',
                                    'Los datos del Sistema fueron creados correctamente!!',
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
    else
    {
        cargando(1);
        var data = {
            sistema: Nombre.val(),
            idSistema: IdSistema.val(),
            _token: $("#_token").val()
        };

        $.post("/pointex/administracion/accesos/val_sistema_id", data, function (res) {
            if (res==="SI")
            {

                cargando(2);
                Nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Sistemas que ingresó ya existe en la base de datos",
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
                    title: 'Modificar Sistema',
                    text: "Confirma que desea modificar los datos del sistema?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Modificar',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);

                        var datos={
                            _token: $("#_token").val(),
                            Nombre: Nombre.val(),
                            Descripcion: Descripcion.val(),
                            Icono: Icono.val(),
                            Imagen: Imagen.val(),
                            IdSistema: IdSistema.val(),
                        };

                        $.post("/pointex/administracion/accesos/modificar_sistema", datos, function (res) {
                            if (res.ESTADO==="OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos del Sistema fueron modificados correctamente!!',
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


 return false

}
function verModulos(id) {
    cargando(1);
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/modulos';

    var input = document.createElement('input');
    input.type = "text";
    input.name = "slcSistemaChange";
    input.value = id;
    form.appendChild(input);

    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);

    $('body').append(form);
    form.submit();
}

//Métodos para Módulos
function estadoModulo(id) {
    swal({
        title: 'Activar/Desactivar Módulo',
        text: "Desea modificar el estado del módulo?",
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
            $.post("/pointex/administracion/accesos/modulos/estado_modulo/"+id, datos, function (res) {
                if (res==="OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del módulo fueron modificados!!',
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
function showModModulo(modulo) {

    //document.getElementById("mod_txtNombre").value=obj.Nombre;
    $("#mod_txtNombre").val(modulo.Nombre);
    $("#mod_txtDesc").val(modulo.Descripcion);
    $("#mod_txtIcono").val(modulo.Icono);
    $("#mod_txtImg").val(modulo.Imagen);
    $("#slcSistema").val(modulo.sistema.Id);
    $("#idModulo").val(modulo.Id);

    $("#modalModulo").modal("show");
    setTimeout(function () {
        loadSelect2ByModal('modalModulo');
    },200);
}
function modModulo() {
    var Nombre= $("#mod_txtNombre");
    var Descripcion= $("#mod_txtDesc");
    var Icono=$("#mod_txtIcono");
    var Imagen= $("#mod_txtImg");
    var Sistema= $("#slcSistema");
    var IdModulo= $("#idModulo");


    if(Sistema.val()=="")
    {
        Sistema.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El Sistema del Módulo es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Sistema.removeClass("has-error");
    }

    if(Nombre.val()=="")
    {
        Nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El Nombre del Módulo es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Nombre.removeClass("has-error");
    }

    if(Descripcion.val()=="")
    {
        Descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La Descripción del Módulo es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Descripcion.removeClass("has-error");
    }

    if(Icono.val()=="")
    {
        Icono.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El Ícono del Módulo es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Icono.removeClass("has-error");
    }




    if(IdModulo.val()=="")
    {
        cargando(1);
        var data = {
            Nombre: Nombre.val(),
            IdSistema:Sistema.val(),
            _token: $("#_token").val()
        };

        $.post("/pointex/administracion/accesos/modulos/val_modulo", data, function (res) {
            if (res==="SI")
            {

                cargando(2);
                Nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre del Módulo que ingresó ya existe en la base de datos",
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
                    title: 'Creación Módulo',
                    text: "Confirma que desea crear los datos del módulo?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Modulo',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);

                        var datos={
                            _token: $("#_token").val(),
                            Nombre: Nombre.val(),
                            Descripcion: Descripcion.val(),
                            Icono: Icono.val(),
                            Imagen: Imagen.val(),
                            IdSistema: Sistema.val(),
                        };

                        $.post("/pointex/administracion/accesos/modulos/crear_modulo", datos, function (res) {
                            if (res.ESTADO==="OK") {

                                cargando(2);
                                swal(
                                    'Cración!',
                                    'Los datos del Módulo fueron creados correctamente!!',
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
    else
    {
        cargando(1);
        var data = {
            Nombre: Nombre.val(),
            idSistema: Sistema.val(),
            idModulo: IdModulo.val(),
            _token: $("#_token").val()
        };

        $.post("/pointex/administracion/accesos/modulos/val_modulo", data, function (res) {
            if (res==="SI")
            {

                cargando(2);
                Nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Módulo que ingresó ya existe en la base de datos",
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
                    title: 'Modificar Módulo',
                    text: "Confirma que desea modificar los datos del módulo?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Modificar',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);

                        var datos={
                            _token: $("#_token").val(),
                            Nombre: Nombre.val(),
                            Descripcion: Descripcion.val(),
                            Icono: Icono.val(),
                            Imagen: Imagen.val(),
                            IdModulo: IdModulo.val(),
                            IdSistema: Sistema.val(),
                        };

                        $.post("/pointex/administracion/accesos/modulos/modificar_modulo", datos, function (res) {
                            if (res.ESTADO==="OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos del Módulo fueron modificados correctamente!!',
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

    return false

}
function verSistemas(id) {
    cargando(1);
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/sistemas';

    var input = document.createElement('input');
    input.type = "text";
    input.name = "idSistema";
    input.value = id;
    form.appendChild(input);

    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);

    $('body').append(form);
    form.submit();
}
function verMenus(sistema,modulo) {
    cargando(1);
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/menus/'+sistema+"/"+modulo;
    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);
    $('body').append(form);
    form.submit();
}
function filtrarSistema(id) {
    cargando(1);
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/modulos';

    var input = document.createElement('input');
    input.type = "text";
    input.name = "slcSistemaChange";
    input.value = id.value;
    form.appendChild(input);

    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);

    $('body').append(form);
    form.submit();
}

//Métodos para Menús
function estadoMenu(id) {
    swal({
        title: 'Activar/Desactivar Menú',
        text: "Desea modificar el estado del menú?",
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
            $.post("/pointex/administracion/accesos/menus/estado_menu/"+id, datos, function (res) {
                if (res==="OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del menú fueron modificados!!',
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
function showModMenu(menu,vector) {


    $("#mod_txtNombre").val(menu.Nombre);
    $("#mod_txtDesc").val(menu.Descripcion);
    $("#mod_txtIcono").val(menu.Icono);
    $("#mod_txtURL").val(menu.URL);
    $("#slcModSistema").val(menu.IdSistema).trigger('change.select2');
    llenaModulo(menu.IdSistema,vector,menu.IdModulo)
    $("#idMenu").val(menu.Id);

    $("#modalMenu").modal("show");

    setTimeout(function () {
        loadSelect2ByModal('modalMenu');
    },200);
}
function modMenu() {
    var Nombre= $("#mod_txtNombre");
    var Descripcion= $("#mod_txtDesc");
    var Icono=$("#mod_txtIcono");
    var URL= $("#mod_txtURL");
    var IdSistema= $("#slcModSistema");
    var IdModulo= $("#slcModModulo");
    var IdMenu= $("#idMenu");


    if(IdSistema.val()=="")
    {
        IdSistema.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La opción Sistema es requerida",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        IdSistema.removeClass("has-error");
    }

    if(IdModulo.val()=="")
    {
        IdModulo.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La opción Módulo es requerida",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        IdModulo.removeClass("has-error");
    }

    if(Nombre.val()=="")
    {
        Nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El Nombre del Menú es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Nombre.removeClass("has-error");
    }

    if(Descripcion.val()=="")
    {
        Descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La Descripción del Menú es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Descripcion.removeClass("has-error");
    }

    if(Icono.val()=="")
    {
        Icono.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El Ícono del Menú es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Icono.removeClass("has-error");
    }


    if(URL.val()=="")
    {
        URL.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La URL del Menú es requerida",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        URL.removeClass("has-error");
    }




    if(IdMenu.val()=="")
    {
        cargando(1);
        var data = {
            Nombre: Nombre.val(),
            IdModulo:IdModulo.val(),
            _token: $("#_token").val()
        };

        $.post("/pointex/administracion/accesos/menus/val_menu", data, function (res) {
            if (res==="SI")
            {

                cargando(2);
                Nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre del Menú que ingresó ya existe en la base de datos",
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
                    title: 'Creación Menú',
                    text: "Confirma que desea crear los datos del menú?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Menú',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);

                        var datos={
                            _token: $("#_token").val(),
                            Nombre: Nombre.val(),
                            Descripcion: Descripcion.val(),
                            Icono: Icono.val(),
                            URL: URL.val(),
                            IdSistema: IdSistema.val(),
                            IdModulo: IdModulo.val(),
                        };

                        $.post("/pointex/administracion/accesos/menus/crear_menu", datos, function (res) {
                            if (res.ESTADO==="OK") {

                                cargando(2);
                                swal(
                                    'Cración!',
                                    'Los datos del Menú fueron creados correctamente!!',
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
    else
    {
        cargando(1);
        var data = {
            menu: Nombre.val(),
            idModulo: IdModulo.val(),
            idMenu: IdMenu.val(),
            _token: $("#_token").val()
        };

        $.post("/pointex/administracion/accesos/menus/val_menu_id", data, function (res) {
            if (res==="SI")
            {

                cargando(2);
                Nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Menú que ingresó ya existe en la base de datos",
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
                    title: 'Modificar Menú',
                    text: "Confirma que desea modificar los datos del menú?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Modificar',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);

                        var datos={
                            _token: $("#_token").val(),
                            Nombre: Nombre.val(),
                            Descripcion: Descripcion.val(),
                            Icono: Icono.val(),
                            URL: URL.val(),
                            IdModulo: IdModulo.val(),
                            IdMenu: IdMenu.val(),
                        };

                        $.post("/pointex/administracion/accesos/menus/modificar_menu", datos, function (res) {
                            if (res.ESTADO==="OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos del Menú fueron modificados correctamente!!',
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


    return false

}
function verModulo(id) {
    cargando(1);
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/modulos';

    var input = document.createElement('input');
    input.type = "text";
    input.name = "IdModulo";
    input.value = id;
    form.appendChild(input);

    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);

    $('body').append(form);
    form.submit();
}
function filtrarModulos(id) {
    cargando(1);
    var modulo=(id.value=="")?0:id.value;
    var sistema=($("#slcSisChange").val()=="")?0:$("#slcSisChange").val();
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/menus/'+sistema+"/"+modulo;
    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);
    $('body').append(form);
    form.submit();
}
function filtrarSistemaMenu(id) {
    cargando(1);
    var sistema=(id.value=="")?0:id.value;
    var modulo=($("#slcModChange").val()=="")?0:$("#slcModChange").val();
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/menus/'+sistema+"/"+modulo;
    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);
    $('body').append(form);
    form.submit();
}
function verSubMenus(sistema,modulo,menu) {
    cargando(1);
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/sub_menus/'+sistema+"/"+modulo+"/"+menu;
    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);
    $('body').append(form);
    form.submit();
}


//Métodos para SubMenús
function estadoSubMenu(id) {
    swal({
        title: 'Activar/Desactivar SubMenú',
        text: "Desea modificar el estado del submenú?",
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
            $.post("/pointex/administracion/accesos/sub_menus/estado_sub_menu/"+id, datos, function (res) {
                if (res==="OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del submenú fueron modificados!!',
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
function showModSubMenu(subMenu,vectorModulos,vectorMenus) {


    $("#mod_txtNombre").val(subMenu.Nombre);
    $("#mod_txtDesc").val(subMenu.Descripcion);
    $("#mod_txtIcono").val(subMenu.Icono);
    $("#mod_txtURL").val(subMenu.URL);
    $("#slcModSistema").val(subMenu.IdSistema).trigger('change.select2');
    $("#slcModModulo").val(subMenu.IdSistema).trigger('change.select2');
    llenaModulo(subMenu.IdSistema,vectorModulos,subMenu.IdModulo)
    llenaMenu(subMenu.IdModulo,vectorMenus,subMenu.IdMenu)
    $("#idSubMenu").val(subMenu.Id);

    $("#modalSubMenu").modal("show");

    setTimeout(function () {
        loadSelect2ByModal('modalSubMenu');
    },200);
}
function modSubMenu() {
    var Nombre= $("#mod_txtNombre");
    var Descripcion= $("#mod_txtDesc");
    var Icono=$("#mod_txtIcono");
    var URL= $("#mod_txtURL");
    var IdSistema= $("#slcModSistema");
    var IdModulo= $("#slcModModulo");
    var IdMenu= $("#slcModMenu");
    var IdSubMenu= $("#idSubMenu");


    if(IdSistema.val()=="")
    {
        IdSistema.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La opción Sistema es requerida",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        IdSistema.removeClass("has-error");
    }

    if(IdModulo.val()=="")
    {
        IdModulo.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La opción Módulo es requerida",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        IdModulo.removeClass("has-error");
    }

    if(IdMenu.val()=="")
    {
        IdMenu.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La opción Menú es requerida",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        IdMenu.removeClass("has-error");
    }

    if(Nombre.val()=="")
    {
        Nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El Nombre del SubMenú es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Nombre.removeClass("has-error");
    }

    if(Descripcion.val()=="")
    {
        Descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La Descripción del SubMenú es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Descripcion.removeClass("has-error");
    }

    if(Icono.val()=="")
    {
        Icono.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El Ícono del SubMenú es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        Icono.removeClass("has-error");
    }


    if(URL.val()=="")
    {
        URL.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "La URL del SubMenú es requerida",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    }
    else
    {
        URL.removeClass("has-error");
    }




    if(IdSubMenu.val()=="")
    {
        cargando(1);
        var data = {
            Nombre: Nombre.val(),
            IdMenu:IdMenu.val(),
            _token: $("#_token").val()
        };

        $.post("/pointex/administracion/accesos/sub_menus/val_sub_menu", data, function (res) {



            cargando(2);
            swal({
                title: 'Creación SubMenú',
                text: "Confirma que desea crear los datos del submenú?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0CC27E',
                cancelButtonColor: '#FF586B',
                confirmButtonText: 'Crear SubMenú',
                cancelButtonText: "No, Cancelar"
            }).then(function (isConfirm) {
                if (isConfirm) {
                    cargando(1);

                    var datos={
                        _token: $("#_token").val(),
                        Nombre: Nombre.val(),
                        Descripcion: Descripcion.val(),
                        Icono: Icono.val(),
                        URL: URL.val(),
                        IdMenu: IdMenu.val()
                    };

                    $.post("/pointex/administracion/accesos/sub_menus/crear_sub_menu", datos, function (res) {
                        if (res.ESTADO==="OK") {

                            cargando(2);
                            swal(
                                'Cración!',
                                'Los datos del SubMenú fueron creados correctamente!!',
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
        });
    }
    else
    {
        cargando(1);
        var data = {
            menu: Nombre.val(),
            idSubMenu: IdSubMenu.val(),
            idMenu: IdMenu.val(),
            _token: $("#_token").val()
        };

        $.post("/pointex/administracion/accesos/sub_menus/val_sub_menu_id", data, function (res) {



            cargando(2);
            swal({
                title: 'Modificar SubMenú',
                text: "Confirma que desea modificar los datos del submenú?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0CC27E',
                cancelButtonColor: '#FF586B',
                confirmButtonText: 'Modificar',
                cancelButtonText: "No, Cancelar"
            }).then(function (isConfirm) {
                if (isConfirm) {
                    cargando(1);

                    var datos={
                        _token: $("#_token").val(),
                        Nombre: Nombre.val(),
                        Descripcion: Descripcion.val(),
                        Icono: Icono.val(),
                        URL: URL.val(),
                        IdSubMenu: IdSubMenu.val(),
                        IdMenu: IdMenu.val(),
                    };

                    $.post("/pointex/administracion/accesos/sub_menus/modificar_sub_menu", datos, function (res) {
                        if (res.ESTADO==="OK") {

                            cargando(2);
                            swal(
                                'Modificado!',
                                'Los datos del SubMenú fueron modificados correctamente!!',
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
        });
    }


    return false

}
function verMenu(sistema,modulo,menu) {
    cargando(1);
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/menus/'+sistema+"/"+modulo;
    var input = document.createElement('input');
    input.type = "text";
    input.name = "IdMenu";
    input.value = menu;
    form.appendChild(input);
    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);
    $('body').append(form);
    form.submit();
}
function filtrarMenusSubMenu(id) {
    cargando(1);
    var menu=(id.value=="")?0:id.value;
    var sistema=($("#slcSisChange").val()=="")?0:$("#slcSisChange").val();
    var modulo=($("#slcModChange").val()=="")?0:$("#slcModChange").val();
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/sub_menus/'+sistema+"/"+modulo+"/"+menu;
    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);
    $('body').append(form);
    form.submit();
}
function filtrarModulosSubMenu(id) {
    cargando(1);
    var modulo=(id.value=="")?0:id.value;
    var sistema=($("#slcSisChange").val()=="")?0:$("#slcSisChange").val();
    var menu=($("#slcMenChange").val()=="")?0:$("#slcMenChange").val();
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/sub_menus/'+sistema+"/"+modulo+"/"+menu;
    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);
    $('body').append(form);
    form.submit();
}
function filtrarSistemaSubMenu(id) {
    cargando(1);
    var sistema=(id.value=="")?0:id.value;
    var modulo=($("#slcModChange").val()=="")?0:$("#slcModChange").val();
    var menu=($("#slcMenChange").val()=="")?0:$("#slcMenChange").val();
    var form = document.createElement("form");
    form.method = 'post';
    form.action = '/pointex/administracion/accesos/sub_menus/'+sistema+"/"+modulo+"/"+menu;
    var token = document.createElement('input');
    token.type = "text";
    token.name = "_token";
    token.value = $("#_token").val();
    form.appendChild(token);
    $('body').append(form);
    form.submit();
}


function llenaModulo(sistema,vector,modulo){
    var modObj=vector;
    $("#slcModModulo").empty().append("<option value=''></option>");
    $("#slcModMenu").empty();
    $.each( modObj, function( key, value ) {
        if(value.IdSistema==sistema)
        {
            if(value.Id==modulo)
            {
                $("#slcModModulo").append("<option value=" + value.Id + " selected>" + value.Nombre + "</option>");
            }else
            {
                $("#slcModModulo").append("<option value=" + value.Id + ">" + value.Nombre+ "</option>");
            }

        }

    });
}
function llenaMenu(modulo,vector,menu){
    var menObj=vector;
    $("#slcModMenu").empty().append("<option value=''></option>");
    $.each( menObj, function( key, value ) {
        if(value.IdModulo==modulo)
        {
            if(value.Id==menu)
            {
                $("#slcModMenu").append("<option value=" + value.Id + " selected>" + value.Nombre + "</option>");
            }else
            {
                $("#slcModMenu").append("<option value=" + value.Id + ">" + value.Nombre+ "</option>");
            }

        }

    });
}



