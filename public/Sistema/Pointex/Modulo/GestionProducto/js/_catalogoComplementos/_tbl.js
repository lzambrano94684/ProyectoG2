jQuery(document).ready(function () {
    var mapPageArray = [
        {
            Titulo: "Listado de datos ingresados"
        }
    ];
    mapPage(mapPageArray);
});

function deleteData(id) {
    swal({
        title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Deseo Eliminarlo!',
        cancelButtonText: 'No',
    }).then(function (isConfirm) {
        if (isConfirm) {
            url = '/pointex/gestion/catalogos/delete/' + tabla+'/'+id;
            redirect()
        }
    });
}