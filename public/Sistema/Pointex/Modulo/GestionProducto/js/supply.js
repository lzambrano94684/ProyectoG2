var url = "";
var mensaje = "";
var jsonMessage = {};

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
    );
    mensaje = "";
}

function msgJson() {
    return swal(jsonMessage).catch(swal.noop);
}

function redirect() {
    location.href = url;
}

function deleteRegistro(id) {
    swal({
        title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Deseo Eliminarlo!',
        cancelButtonText: 'No',
    }).then(function (isConfirm) {
        if (isConfirm) {
            url = '/pointex/gestion/producto/supply/delete/' + id;
            redirect()
        }
    });
}
$(".select2_single").select2({
    selectOnClose: true,
    placeholder: "Seleccione Opción",
    allowClear: true
});
