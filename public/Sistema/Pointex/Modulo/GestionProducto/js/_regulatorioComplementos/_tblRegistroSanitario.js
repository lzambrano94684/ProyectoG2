jQuery(document).ready(function () {
    var mapPageArray = [
        {
            Titulo: "Listado de Registros Sanitarios"
        }
    ];
    mapPage(mapPageArray);
});

function deleteRegSanitario(id, nombre) {
    swal({
        title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información del Registro Sanitario <b class="text-danger">' + nombre + '</b>?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Deseo Eliminarlo!',
        cancelButtonText: 'No',
    }).then(function (isConfirm) {
        if (isConfirm) {
            url = '/pointex/gestion/regulatorio/eliminar_registro_sanitario/' + id;
            redirect()
        }
    });
}