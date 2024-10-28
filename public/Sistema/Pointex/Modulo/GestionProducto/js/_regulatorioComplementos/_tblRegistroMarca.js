jQuery(document).ready(function () {
    var mapPageArray = [
        {
            Titulo: "Marca Propiedad Intelectual"
        }
    ];
    mapPage(mapPageArray);
});

function deleteRegMarca(id, nombre) {
    swal({
        title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información del Registro de Marca <b class="text-danger">' + nombre + '</b>?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Deseo Eliminarlo!',
        cancelButtonText: 'No',
    }).then(function (isConfirm) {
        if (isConfirm) {
            url = '/pointex/gestion/regulatorio/eliminar_registro_marca/' + id;
            redirect()
        }
    });
}