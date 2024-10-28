// mostrar
function showModUnidad(medidaRecibe) {

    try {
        var medida =JSON.parse(atob(medidaRecibe));
console.log(medida);
        $("#txtNombreMedida").val(medida.Nombre);
        $("#txtDescripcionMedida").val(medida.Descripcion);
        $("#txtIdUnidadMedida").val(medida.Id);
        $("#modalUnidad").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalUnidad');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModFranquicia(lineaRecibe) {

    try {
        var linea =JSON.parse(atob(lineaRecibe));

        $("#txtLineaNombre").val(linea.Nombre);
        $("#txtDescripcionLinea").val(linea.Descripcion);
        $("#txtIdLinea").val(linea.Id);
        $("#modalLinea").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalLinea');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModTipoArte(arteRecibe) {

    try {
        var arte =JSON.parse(atob(arteRecibe));

        $("#txtArteNombre").val(arte.Nombre);
        $("#txtDescripcionArte").val(arte.Descripcion);
        $("#txtIdArte").val(arte.Id);
        $("#modalTipoArte").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalTipoArte');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModTipoPresentacion(presentacionRecibe) {

    try {
        var presentacion =JSON.parse(atob(presentacionRecibe));

        $("#txtPresentacionNombre").val(presentacion.Nombre);
        $("#txtDescripcionPresentacion").val(presentacion.Descripcion);
        $("#txtIdPresentacion").val(presentacion.Id);
        $("#modalTipoPresentacion").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalTipoPresentacion');
        }, 200);
    }catch (e) {
        alert(e.message())
    }

}

function showDistReg(distribuicionRecibe) {

    try {
        var distribuicion =JSON.parse(atob(distribuicionRecibe));

        $("#txtDistRegNombre").val(distribuicion.Nombre);
        $("#txtDescripcionDistReg").val(distribuicion.Descripcion);
        $("#txtIdDistReg").val(distribuicion.Id);
        $("#modalDistReg").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalDistReg');
        }, 200);
    }catch (e) {
        alert(e.message())
    }

}

function showFaseMarca(faseRecibe) {
    try {
        var fase =JSON.parse(atob(faseRecibe));

        $("#txtFaseMarcaNombre").val(fase.Nombre);
        $("#txtDescripcionFaseMarca").val(fase.Descripcion);
        $("#txtIdFaseMarca").val(fase.Id);
        $("#modalFaseMarca").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalFaseMarca');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModSubFranquicia(subRecibe) {
    try {
        var sub =JSON.parse(atob(subRecibe));

        $("#txtSubFranquiciaNombre").val(sub.Nombre);
        $("#txtDescripcionSubFranquicia").val(sub.Descripcion);
        $("#mod_slcFranquicia").val(sub.IdFranquicia).trigger("change.select2");
        $("#txtIdSubFranquicia").val(sub.Id);
        $("#modalSubFranquicia").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalSubFranquicia');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModProyecto(proyectoRecibe) {
    try {
        var proyecto =JSON.parse(atob(proyectoRecibe));
        $("#txtNombreProyecto").val(proyecto.Nombre);
        $("#txtDescripcionProyecto").val(proyecto.Descripcion);
        $("#txtIdProyecto").val(proyecto.Id);
        $("#modalProyecto").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalProyecto');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModEstadoProducto(statusRecibe) {
    try {
        var status =JSON.parse(atob(statusRecibe));
        $("#txtNombreEstado").val(status.Nombre);
        $("#txtDescripcionEstado").val(status.Descripcion);
        $("#txtIdEstado").val(status.Id);
        $("#modalEstadoProducto").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalProyecto');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModMolecula(moleculaRecibe) {
    try {
        var molecula =JSON.parse(atob(moleculaRecibe));
        $("#txtNombreMolecula").val(molecula.Nombre);
        $("#txtDescripcionMolecula").val(molecula.Descripcion);
        $("#txtIdMolecula").val(molecula.Id);
        $("#modalMolecula").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalMolecula');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModPrincipio(principioRecibe) {
    try {
        var principio =JSON.parse(atob(principioRecibe));
        $("#txtNombrePrincipio").val(principio.Nombre);
        $("#txtDescripcionPrincipio").val(principio.Descripcion);
        $("#txtIdPrincipio").val(principio.Id);
        $("#modalPrincipioActivo").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalPrincipioActivo');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModMoleculaPrincipio(mprincipioRecibe) {
    try {
        var mprincipio =JSON.parse(atob(mprincipioRecibe));
        $("#mod_slcMolecula").val(mprincipio.IdMolecula).trigger("change.select2");
        $("#mod_slcPrincipio").val(mprincipio.IdPrincipio).trigger("change.select2");
        $("#txtIdMoleculaPrincipio").val(mprincipio.Id);
        $("#modalMoleculaPrincipio").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalMoleculaPrincipio');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModFormaFarma(formaRecibe) {
    try {
        var forma =JSON.parse(atob(formaRecibe));
        $("#txtNombreForma").val(forma.Nombre);
        $("#txtDescripcionForma").val(forma.Descripcion);
        $("#txtIdForma").val(forma.Id);
        $("#modalForma").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalForma');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModFormaTipoProd(FormaProdRecibe) {
    try {
        var FormaProd =JSON.parse(atob(FormaProdRecibe));
        $("#mod_slcForma").val(FormaProd.IdForma).trigger("change.select2");
        $("#mod_slcTipo").val(FormaProd.IdTipoPresentacion).trigger("change.select2");
        $("#txtIdFormaTipo").val(FormaProd.Id);
        $("#modalFormaTipo").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalFormaTipo');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModComposicionProd(ComposicionRecibe) {
    try {
        var composicion =JSON.parse(atob(ComposicionRecibe));
        $("#mod_slcMoleculaPrincipio").val(composicion.IdMolecula).trigger("change.select2");
        $("#mod_slcPrincipio").val(composicion.IdPrincipio).trigger("change.select2");
        $("#txtIdComposicionProd").val(composicion.Id);
        $("#modalComposicionProd").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalComposicionProd');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

function showModArte(arteRecibe) {

    try {
        var arte =JSON.parse(atob(arteRecibe));
        console.log(arte);
        $("#txtNombreArte").val(arte.Nombre);
        $("#txtDescripcionArte").val(arte.Descripcion);
        $("#mod_slcProducto").val(arte.IdProducto).trigger("change.select2");
        $("#mod_slcTipoArte").val(arte.IdTipoArte).trigger("change.select2");
        $("#txtIdArte").val(arte.Id);
        $("#modalArte").modal({backdrop:
                'static', keyboard: true,});
        setTimeout(function () {
            loadSelect2ByModal('modalArte');
        }, 200);
    }catch (e) {
        alert(e.message())
    }
}

//  estados

function estadoUnidad(id) {

    swal({
        title: 'Activar/Desactivar Unidad de Medida',
        text: "Desea modificar el estado de la Unidad de medida en el sistema?",
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

            $.post("/pointex/gestion/catalogos/unidad/estado_unidad/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos de la unidad de medida fueron modificados!!',
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

function estadoFranquicia(id) {

    swal({
        title: 'Activar/Desactivar Franquicia',
        text: "Desea modificar el estado de la Franquicia en el sistema?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Si',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {
            cargando(1);
            var datos = {
                id: id,
                _token: $("#_token").val()
            };

            $.post("/pointex/gestion/catalogos/franquicia/estado_franquicia/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del estado Franquicia fueron modificados!!',
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

function estadoTipoArte(id) {

    swal({
        title: 'Activar/Desactivar Tipo Arte',
        text: "Desea modificar el estado dela Tipo de Arte en el sistema?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Si',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {
            cargando(1);
            var datos = {
                id: id,
                _token: $("#_token").val()
            };

            $.post("/pointex/gestion/catalogos/tipo_arte/estado_arte/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del Tipo de Arte fueron modificados!!',
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

function estadoTipoPresentacion(id) {

    swal({
        title: 'Activar/Desactivar Tipo Presentacion',
        text: "Desea modificar el estado del Tipo de Presentación en el sistema?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Si',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {
            cargando(1);
            var datos = {
                id: id,
                _token: $("#_token").val()
            };

            $.post("/pointex/gestion/catalogos/tipo_presentacion/estado_presentacion/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del Estado de Presentación fueron modificados!!',
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

function estadoDistReg(id) {

    swal({
        title: 'Activar/Desactivar Estado de Distribuición Regulatorio',
        text: "Desea modificar el estado Distribuición Regulatorio en el sistema?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Si',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {
            cargando(1);
            var datos = {
                id: id,
                _token: $("#_token").val()
            };

            $.post("/pointex/gestion/catalogos/estado_dist/estado_distReg/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del estado Distribuición Regulatorio fueron modificados!!',
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

function estadoFaseMarca(id) {

    swal({
        title: 'Activar/Desactivar Estado de Fase Marca',
        text: "Desea modificar el estado Fase Marca en el sistema?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Si',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {
            cargando(1);
            var datos = {
                id: id,
                _token: $("#_token").val()
            };

            $.post("/pointex/gestion/catalogos/fase_marca/estado_fase/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del estado Fase Marca fueron modificados!!',
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

function estadoSubFranquicia(id) {

    swal({
        title: 'Activar/Desactivar SubFranquicia',
        text: "Desea modificar el estado de la SubFranquicia en el sistema?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Si',
        cancelButtonText: "No, Cancelar"
    }).then(function (isConfirm) {
        if (isConfirm) {
            cargando(1);
            var datos = {
                id: id,
                _token: $("#_token").val()
            };

            $.post("/pointex/gestion/catalogos/sub_franquicia/estado_subfranquicia/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del estado SubFranquicia fueron modificados!!',
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

function estadoProyecto(id) {

    swal({
        title: 'Activar/Desactivar Proyecto',
        text: "Desea modificar el estado del Proyecto en el sistema?",
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

            $.post("/pointex/gestion/catalogos/proyecto/estado_proyecto/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del proyecto fueron modificados!!',
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

function estadoProducto(id) {

    swal({
        title: 'Activar/Desactivar Estado Producto',
        text: "Desea modificar el estado del Producto en el sistema?",
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

            $.post("/pointex/gestion/catalogos/estado_producto/status_producto/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del Estado fueron modificados!!',
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

function estadoMolecula(id) {
    swal({
        title: 'Activar/Desactivar Molécula',
        text: "Desea modificar el estado de Molécula en el sistema?",
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

            $.post("/pointex/gestion/catalogos/molecula/estado_molecula/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del Estado fueron modificados!!',
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

function estadoPrincipio(id) {
    swal({
        title: 'Activar/Desactivar Principio Activo',
        text: "Desea modificar el estado de Principio Activo en el sistema?",
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

            $.post("/pointex/gestion/catalogos/principio_activo/estado_principio/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del Estado fueron modificados!!',
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

function estadoMoleculaPrincipio(id) {
    swal({
        title: 'Activar/Desactivar Principio Activo',
        text: "Desea modificar el estado de Molecula Principio en el sistema?",
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

            $.post("/pointex/gestion/catalogos/molecula_principio/estado_mprincipio/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos de molecula y principio fueron modificados!!',
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

function estadoFormaFarmaceutica(id) {
    swal({
        title: 'Activar/Desactivar Forma Farmaceutica',
        text: "Desea modificar el estado de Forma Farmaceutica en el sistema?",
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

            $.post("/pointex/gestion/catalogos/forma_farma/estado_forma/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del Estado fueron modificados!!',
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

function estadoFormaTipoProd(id) {
    swal({
        title: 'Activar/Desactivar Forma Tipo Producto',
        text: "Desea modificar el estado de Forma Tipo Producto en el sistema?",
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

            $.post("/pointex/gestion/catalogos/forma_tipo/estado_forma/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos del Estado fueron modificados!!',
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

function estadoComposicionProd(id) {
    swal({
        title: 'Activar/Desactivar Composicion de Producto',
        text: "Desea modificar el estado de Composicion de Producto en el sistema?",
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

            $.post("/pointex/gestion/catalogos/composicion_prod/estado_composicion/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos de Composición Producto fueron modificados!!',
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

function estadoArte(id) {

    swal({
        title: 'Activar/Desactivar Arte',
        text: "Desea modificar el estado de Arte en el sistema?",
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

            $.post("/pointex/gestion/catalogos/arte/estado_arte/" + id, datos, function (res) {
                if (res === "OK") {

                    cargando(2);
                    swal(
                        'Modificado!',
                        'Los datos de Arte fueron modificados!!',
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



// update

function modUnidad() {


    var nombre = $("#txtNombreMedida");
    var descripcion = $("#txtDescripcionMedida");
    var id = $("#txtIdUnidadMedida");

    //validacion de nombre
    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre de Unidad de Medida es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/unidad/validar_unidad", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de la unidad de medida ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de Unidad de Medida',
                    text: "Confirma que desea crear los datos de la unidad de medida?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Unidad de Medida',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/unidad/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos de la unidad de medida fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };

        console.log(data);
        $.post("/pointex/gestion/catalogos/unidad/validar_unidad", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de la unidad de medida ingresado ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar Unidad de Medida',
                    text: "Confirma que desea modificar los datos de la unidad de medida?",
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
                            Descripcion: descripcion.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/unidad/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de la unidad de medida fueron modificados correctamente!!',
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

function modFranquicia() {

    var nombre = $("#txtLineaNombre");
    var descripcion = $("#txtDescripcionLinea");
    var id = $("#txtIdLinea");


    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre de Franquicia es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (descripcion.val() == "") {
        descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Descripción de Franquicia es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        descripcion.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/franquicia/validar_franquicia", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de la Franquicia ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de Franquicia',
                    text: "Confirma que desea crear los datos de Franquicia?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Franquicia',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/franquicia/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos de Franquicia fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };

        console.log(data);
        $.post("/pointex/gestion/catalogos/franquicia/validar_franquicia", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Franquicia ingresada ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar franquicia',
                    text: "Confirma que desea modificar los datos de la Franquicia?",
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
                            Descripcion: descripcion.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/franquicia/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de la Franquicia fueron modificados correctamente!!',
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

function modTipoArte() {

    var nombre = $("#txtArteNombre");
    var descripcion = $("#txtDescripcionArte");
    var id = $("#txtIdArte");


    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre de Tipo de Arte es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (descripcion.val() == "") {
        descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Descripción de Tipo de Arte es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        descripcion.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/tipo_arte/validar_arte", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre del Tipo de Arte ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación del tipo del Arte',
                    text: "Confirma que desea crear los datos del Tipo de Arte?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Tipo de Arte',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/tipo_arte/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos del Tipo de Arte fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/tipo_arte/validar_arte", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre del Tipo de Arte ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar el Tipo de Arte',
                    text: "Confirma que desea modificar los datos del Tipo de Arte?",
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
                            Descripcion: descripcion.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/tipo_arte/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos del Tipo de Arte fueron modificados correctamente!!',
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

function modTipoPresentacion() {

    var nombre = $("#txtPresentacionNombre");
    var descripcion = $("#txtDescripcionPresentacion");
    var id = $("#txtIdPresentacion");


    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre de Tipo de Presentación es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/tipo_presentacion/validar_presentacion", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre del Tipo de Presentacion ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación del tipo de Presentación',
                    text: "Confirma que desea crear los datos del Tipo de Presentación?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Tipo de Presentación',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/tipo_presentacion/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos del Tipo de Presentación fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/tipo_presentacion/validar_presentacion", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre del Tipo de Presentacion ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar el Tipo de Arte',
                    text: "Confirma que desea modificar los datos del Tipo de Presentación?",
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
                            Descripcion: descripcion.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/tipo_presentacion/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos del Tipo de Presentacion fueron modificados correctamente!!',
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

function modDistReg() {

    var nombre = $("#txtDistRegNombre");
    var descripcion = $("#txtDescripcionDistReg");
    var id = $("#txtIdDistReg");


    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre de Distribuicion Registro es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/estado_dist/validar_distReg", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Distribuición Registro ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de Distribuicion Registro',
                    text: "Confirma que desea crear los datos de Distribuición Registro?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Distribuición Registro',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/estado_dist/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos de Distribuición Registro fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/estado_dist/validar_distReg", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Distribuición Registro ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar Distribuición Registro',
                    text: "Confirma que desea modificar los datos de Distribuición Registro?",
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
                            Descripcion: descripcion.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/estado_dist/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de Distribuición Registro fueron modificados correctamente!!',
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

function modFaseMarca() {

    var nombre = $("#txtFaseMarcaNombre");
    var descripcion = $("#txtDescripcionFaseMarca");
    var id = $("#txtIdFaseMarca");


    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre de Fase Marca es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/fase_marca/validar_fase", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Fase Marca ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de Fase Marca',
                    text: "Confirma que desea crear los datos de Fase Marca?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Fase Marca',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/fase_marca/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos de Fase Marca fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/fase_marca/validar_fase", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Fase Marca ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar Fase Marca',
                    text: "Confirma que desea modificar los datos de Fase Marca?",
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
                            Descripcion: descripcion.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/fase_marca/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de Fase Marca fueron modificados correctamente!!',
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

function modSubFranquicia() {

    var nombre = $("#txtSubFranquiciaNombre");
    var descripcion = $("#txtDescripcionSubFranquicia");
    var IdFranquicia = $("#mod_slcFranquicia");
    var id = $("#txtIdSubFranquicia");


    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre de Franquicia es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (descripcion.val() == "") {
        descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Descripción de Franquicia es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        descripcion.removeClass("has-error");
    }

    if (IdFranquicia.val() == "") {
        IdFranquicia.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "Seleccione Franquicia, es requerida!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'
        });
        return false;

    } else {
        IdFranquicia.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/sub_franquicia/validar_subfranquicia", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de la SubFranquicia ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de SubFranquicia',
                    text: "Confirma que desea crear los datos de la SubFranquicia?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear SubFranquicia',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),
                            IdFranquicia: IdFranquicia.val(),

                        };
                        $.post("/pointex/gestion/catalogos/sub_franquicia/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos de la SubFranquicia fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            IdFranquicia: IdFranquicia.val(),
            id: id.val(),
            _token: $("#_token").val()
        };

        console.log(data);
        $.post("/pointex/gestion/catalogos/sub_franquicia/validar_subfranquicia", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de la SubFranquicia ingresada ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar franquicia',
                    text: "Confirma que desea modificar los datos de la SubFranquicia?",
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
                            Descripcion: descripcion.val(),
                            IdFranquicia: IdFranquicia.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/sub_franquicia/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de la SubFranquicia fueron modificados correctamente!!',
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

function modProyecto() {

    var nombre = $("#txtNombreProyecto");
    var descripcion = $("#txtDescripcionProyecto");
    var id = $("#txtIdProyecto");


    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre del Proyecto es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (descripcion.val() == "") {
        descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Descripción del Proyecto es requerida!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        descripcion.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/proyecto/validar_proyecto", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre del Proyecto ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de Proyecto',
                    text: "Confirma que desea crear los datos de Proyecto?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Proyecto',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/proyecto/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos de Proyecto fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };

        console.log(data);
        $.post("/pointex/gestion/catalogos/proyecto/validar_proyecto", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Proyecto ingresado ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar Proyecto',
                    text: "Confirma que desea modificar los datos de Proyecto?",
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
                            Descripcion: descripcion.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/proyecto/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de Proyecto fueron modificados correctamente!!',
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

function modEstadoProducto() {

    var nombre = $("#txtNombreEstado");
    var descripcion = $("#txtDescripcionEstado");
    var id = $("#txtIdEstado");


    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre del Estado es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (descripcion.val() == "") {
        descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Descripción del Estado es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        descripcion.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/estado_producto/validar_status", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre del Estado ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación del Estado Producto',
                    text: "Confirma que desea crear los datos de Estado?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Estado',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/estado_producto/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos del Estado fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };

        console.log(data);
        $.post("/pointex/gestion/catalogos/estado_producto/validar_status", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Estado ingresado ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar Estado Producto',
                    text: "Confirma que desea modificar los datos del Estado Producto?",
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
                            Descripcion: descripcion.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/estado_producto/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos del Estado fueron modificados correctamente!!',
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

function modMolecula() {

    var nombre = $("#txtNombreMolecula");
    var descripcion = $("#txtDescripcionMolecula");
    var id = $("#txtIdMolecula");


    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre de Molécula es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (descripcion.val() == "") {
        descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Descripción del Estado es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        descripcion.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/molecula/validar_molecula", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Molécula ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de Molécula',
                    text: "Confirma que desea crear los datos de Molécula?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Molécula',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/molecula/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos de Molécula fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };

        console.log(data);
        $.post("/pointex/gestion/catalogos/molecula/validar_molecula", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Molécula  ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar Molécula',
                    text: "Confirma que desea modificar los datos de Molécula?",
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
                            Descripcion: descripcion.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/molecula/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de Molécula fueron modificados correctamente!!',
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

function modPrincipio() {

    var nombre = $("#txtNombrePrincipio");
    var descripcion = $("#txtDescripcionPrincipio");
    var id = $("#txtIdPrincipio");


    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre de Principio Activo es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (descripcion.val() == "") {
        descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Descripción de Principio Activo es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        descripcion.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/principio_activo/validar_principio", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Principio Activo ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de Principio Activo',
                    text: "Confirma que desea crear los datos de Principio Activo?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Principio Activo',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/principio_activo/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos de Principio Activo fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };

        console.log(data);
        $.post("/pointex/gestion/catalogos/principio_activo/validar_principio", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Principio Activo ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar Principio Activo',
                    text: "Confirma que desea modificar los datos de Principio Activo?",
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
                            Descripcion: descripcion.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/principio_activo/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de Principio Activo fueron modificados correctamente!!',
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

function modMoleculaPrincipio() {

    var IdMolecula = $("#mod_slcMolecula");
    var IdPrincipio = $("#mod_slcPrincipio");
    var id = $("#txtIdMoleculaPrincipio");


    if (IdMolecula.val() == "") {
        IdMolecula.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo  Molécula es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        IdMolecula.removeClass("has-error");
    }

    if (IdPrincipio.val() == "") {
        IdPrincipio.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo  Principio Activo es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        IdPrincipio.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            IdMolecula: IdMolecula.val(),
            IdPrincipio: IdPrincipio.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/molecula_principio/validar_mprincipio", data, function (res) {
            if (res === "SI") {
                cargando(2);
                id.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "La relación ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de Molécula y Principio',
                    text: "Confirma que desea crear los datos para la gestión de molécula y principio?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Principio Activo',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            IdMolecula: IdMolecula.val(),
                            IdPrincipio: IdPrincipio.val(),

                        };
                        $.post("/pointex/gestion/catalogos/molecula_principio/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos para la gestión de Molécula y Principio fueron creados correctamente!!',
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


            IdMolecula: IdMolecula.val(),
            IdPrincipio: IdPrincipio.val(),
            id: id.val(),
            _token: $("#_token").val()
        };

        console.log(data);
        $.post("/pointex/gestion/catalogos/molecula_principio/validar_mprincipio", data, function (res) {
            if (res === "SI") {

                cargando(2);
                id.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "La gestión de Molécula Principio ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar Molecula Principio',
                    text: "Confirma que desea modificar los datos de Gestión entre Molécula y Principio?",
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
                            IdMolecula: IdMolecula.val(),
                            IdPrincipio: IdPrincipio.val(),
                            id: id.val(),
                        };
                        $.post("/pointex/gestion/catalogos/molecula_principio/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de Gestión para molécula y principio fueron modificados correctamente!!',
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

function modFormaFarma() {

    var nombre = $("#txtNombreForma");
    var descripcion = $("#txtDescripcionForma");
    var id = $("#txtIdForma");


    if (nombre.val() == "") {
        nombre.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Nombre de Forma Farmacéutica es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });
        return false;
    } else {
        nombre.removeClass("has-error");
    }

    if (descripcion.val() == "") {
        descripcion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo Descripción de Forma Farmacéutica Activo es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        descripcion.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            Nombre: nombre.val(),
            Descripcion: descripcion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/forma_farma/validar_forma", data, function (res) {
            if (res === "SI") {
                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Forma Farmacéutica ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de Forma Farmacéutica',
                    text: "Confirma que desea crear los datos de Forma Farmacéutica?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Forma Farmacéutica',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            Nombre: nombre.val(),
                            Descripcion: descripcion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/forma_farma/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos de Forma Farmacéutica fueron creados correctamente!!',
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
            Descripcion: descripcion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };

        console.log(data);
        $.post("/pointex/gestion/catalogos/forma_farma/validar_forma", data, function (res) {
            if (res === "SI") {

                cargando(2);
                nombre.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "El Nombre de Forma Farmacéutica ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar Forma Farmacéutica',
                    text: "Confirma que desea modificar los datos de Forma Farmacéutica?",
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
                            Descripcion: descripcion.val(),
                            id: id.val(),


                        };
                        $.post("/pointex/gestion/catalogos/forma_farma/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de Forma Farmacéutica fueron modificados correctamente!!',
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

function modFormaTipoProd() {

    var IdForma = $("#mod_slcForma");
    var IdTipoPresentacion = $("#mod_slcTipo");
    var id = $("#txtIdFormaTipo");


    if (IdForma.val() == "") {
        IdForma.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo  Forma Farmacéutica es requerido!",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        IdForma.removeClass("has-error");
    }

    if (IdTipoPresentacion.val() == "") {
        IdTipoPresentacion.addClass("has-error");
        swal({
            type: 'error',
            title: "Requerido!",
            text: "El campo  Tipo Producto es requerido",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar'

        });

        return false;
    } else {
        IdTipoPresentacion.removeClass("has-error");
    }

    if (id.val() == "") {
        cargando(1);
        var data = {

            IdForma: IdForma.val(),
            IdTipoPresentacion: IdTipoPresentacion.val(),
            _token: $("#_token").val()
        };
        $.post("/pointex/gestion/catalogos/forma_tipo/validar_forma", data, function (res) {
            if (res === "SI") {
                cargando(2);
                id.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "La relación ya existe en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;
            } else {

                cargando(2);
                swal({
                    title: 'Creación de Forma Tipo Prodcuto',
                    text: "Confirma que desea crear los datos para la gestión de Forma Tipo Producto?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Crear Forma Tipo Producto',
                    cancelButtonText: "No, Cancelar"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        cargando(1);
                        var datos = {
                            _token: $("#_token").val(),
                            IdForma: IdForma.val(),
                            IdTipoPresentacion: IdTipoPresentacion.val(),

                        };
                        $.post("/pointex/gestion/catalogos/forma_tipo/crear", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Creación!',
                                    'Los datos para la gestión de Forma Tipo Producto fueron creados correctamente!!',
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

            IdForma: IdForma.val(),
            IdTipoPresentacion: IdTipoPresentacion.val(),
            id: id.val(),
            _token: $("#_token").val()
        };

        console.log(data);
        $.post("/pointex/gestion/catalogos/forma_tipo/validar_forma", data, function (res) {
            if (res === "SI") {

                cargando(2);
                id.addClass("has-error");
                swal({
                    type: 'error',
                    title: "Requerido!",
                    text: "La gestión de Forma Tipo Producto en la base de datos",
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar'

                });

                return false;

            } else {
                cargando(2);
                swal({
                    title: 'Modificar Forma',
                    text: "Confirma que desea modificar los datos de Gestión Forma Tipo Producto?",
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
                            IdForma: IdForma.val(),
                            IdTipoPresentacion: IdTipoPresentacion.val(),
                            id: id.val(),
                        };
                        $.post("/pointex/gestion/catalogos/forma_tipo/modificar", datos, function (res) {
                            if (res.ESTADO === "OK") {

                                cargando(2);
                                swal(
                                    'Modificado!',
                                    'Los datos de Gestión Forma Tipo Producto fueron modificados correctamente!!',
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

