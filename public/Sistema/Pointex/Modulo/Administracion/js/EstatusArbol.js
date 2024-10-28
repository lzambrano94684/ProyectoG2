
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
    ).then(function (isConfirm) {
        if (isConfirm) {
            location.reload();
        }
    });
    mensaje = "";
}


function estadoArbolActivo(id) {
    swal({
        title: 'Activar/Desactivar Arbol',
        text: "Desea modificar el estado del Arbol?",
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
            $.post("/pointex/multiples/arbol/cambia_estatus_activo/" + id, datos, function (res) {
                if (res === "OK") {
                    cargando(2);
                    swal(
                        'Modificado!',
                        'Arbol modificado!!',
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

function estadoArbolDesactivado(id) {
    swal({
        title: 'Activar/Desactivar Arbol',
        text: "Desea modificar el estado del Arbol?",
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
            $.post("/pointex/multiples/arbol/cambia_estatus_desactivado/" + id, datos, function (res) {
                if (res.res === "OK") {
                    cargando(2);
                    swal(
                        'Modificado!',
                        'Arbol modificado!!',
                        'success'
                    ).then(function (isConfirm) {
                        if (isConfirm) {
                            location.reload();
                        }
                    });
                } else if (res.res === "A-OK") {
                    cargando(2);
                    swal(
                        'Error!',
                        'No es posible inactivar el Arbol, ya que los usuarios '+res.persona+ ' tienen una ejecución en transito',
                        'error'
                    );
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


addItemSelected($(".codeCrearItem"), false);

function addItemSelected(selector) {
    selector.on('click', function () {
        var idCmb = $(this).data("id_cmb");
        var titulo = $(this).data("titulo");
        var modelo = $(this).data("modelo");
        var camponombre = $(this).data("camponombre");
        var campotipoejecucion = $(this).data("campotipoejecucion");
        addNewOptionSelected(idCmb, titulo, modelo, camponombre, campotipoejecucion);
    });
}

function b64_to_utf8( str ) {
    return decodeURIComponent(escape(window.atob( str )));
}
function addNewOptionSelected(idCmb, titulo, modelo, camponombre, campotipoejecucion) {
    console.log(campotipoejecucion)
    swal({
        title: titulo,
        html: '<input id="swal-Nombre" class="swal2-input" placeholder="Nombre">'
             +b64_to_utf8(cmbTipoEje),
        input: 'hidden',
        inputAttributes:{ id : 'Tipo' , name: campotipoejecucion},
        inputPlaceholder: 'Seleccione..',
        showCancelButton: true,
        confirmButtonText: 'Enviar',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        focusConfirm: false,
        customClass: 'swal-wide',
        onOpen: function () {
            $('.swal2-modal  .cmbMulti').select2({
                minimumResultsForSearch: 15,
                width: '100%',
                placeholder: "Seleccione",
                language: "it",
                dropdownParent: $('.swal2-container')
            });
        },
    }).then(function (result) {
        var nombrevalor = document.getElementById('swal-Nombre').value;
        var tipoejecucionvalor = $('.swal2-modal  .cmbMulti option:selected').val();
        console.log(tipoejecucionvalor, "hola mundo")
        if (!nombrevalor && !tipoejecucionvalor) {
            mensaje = "¡Los campos Nombre y Tipo Ejecucion son requeridos!";
            errorMsg();
        } else {
           // cargando(1);
            var dataFrm = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                tabla: modelo.trim(),
                nombre: camponombre.trim(),
                nombrevalor: nombrevalor.trim(),
                tipoejecucion: campotipoejecucion.trim(),
                tipoejecucionvalor: tipoejecucionvalor
            };
            console.log(dataFrm)
            $.post("/pointex/multiples/arbol/save", dataFrm, function (resp) {
                if (resp.STATUS == "OK") {
                    mensaje = "Datos guardados con exito";
                    successMsg();
                } else {
                    mensaje = resp.DATA;
                    errorMsg()
                }
                cargando(2);
            })
        }
    })
}
