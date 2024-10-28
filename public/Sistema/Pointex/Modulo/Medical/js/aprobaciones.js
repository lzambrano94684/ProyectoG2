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

function Aprobaciones(id, nombre, estatus, Icono,mens) {
    swal({
        title: '<i class="'+Icono+' fa-7x warning"></i><br>¿Deseas '+mens+' <b class="text-danger">' + nombre + '</b>?',
        input: 'text',
        inputPlaceholder: 'Agregar Observaciones',
        inputAttributes: {
            autocapitalize: 'off',
            maxlength: 300,
            required: 'false'
        },
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, Deseo '+mens+'!',
        cancelButtonText: 'No'
    }).then(function (observacion) {
        url = "/pointex/multiples/canbia_estatus/"+id+"/"+estatus+"/UFhfTUVEX0V2ZW50bw==/"+observacion;
        redirect()
    });;
}
