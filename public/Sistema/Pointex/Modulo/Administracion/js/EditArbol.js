var jsonLaguaje = {
    "emptyTable":     "No existen datos en la tabla",
        "info":           "Mostrando _START_ de _END_ de _TOTAL_ entradas",
        "infoEmpty":      "Mostrando 0 de 0 de 0 entradas",
        "infoFiltered":   "(Friltrado de _MAX_ total entradas)",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No se encontraron coincidencias",
        buttons: {
        copyTitle: 'Datos Copiados',
            copyKeys: 'La tabla se ha copiado en el portapapeles',
            copySuccess: {
            _: '%d filas copiadas en el portapapeles',
                1: '1 fila copiada en el portapapeles'
        }
    },
    "paginate": {
        "first":      "Primera",
            "last":       "Última",
            "next":       "Siguiente",
            "previous":   "Anterior"
    }
};
$(document).ready(function () {
    //Campo Desbloqueo
    $(".select2_single").select2({
        width: '100%',
    });

    if (!document.getElementById('idArbol')) {
        $("#bloque").prop("hidden", true);
    } else {
        $("#bloque").prop("hidden", false);
    }

    //Primera Tabla
    var stockTable = $('#table1').dataTable({
        "scrollY": "200px",
        "scrollCollapse": true,
        "paging": false,
        "ordering": false,
        language: jsonLaguaje
    });

    //Seleccionar Fila
    stockTable.on('click', 'tbody tr', function () {
        $(this).toggleClass('selected darken-4 bg-secondary');
        if ($(this).hasClass("selected")) {
            $(this).find(':input').attr("disabled", false);
        } else {
            $(this).find(':input').attr("disabled", true);
        }
    });

    //Enviar Tabla 1
    $('#RightMove').on('click', function () {
        stockTable.dataTable().fnFilter('');
        $("#frm1").submit();
    });

    //Segunda Tabla
    var Table = $('#table2').dataTable({
        "scrollY": "200px",
        "scrollCollapse": true,
        "paging": false,
        language: jsonLaguaje
    });

    //Seleccionar Fila
    Table.on('click', 'tbody tr', function () {
        $(this).toggleClass('selected darken-4 bg-secondary');
        if ($(this).hasClass("selected")) {
            $(this).find(':input').attr("disabled", false);
        } else {
            $(this).find(':input').attr("disabled", true);
        }
    });

    //Enviar Tabla 2
    $('#LeftMove').on('click', function () {
        Table.dataTable().fnFilter('');
        $("#frm2").submit();
    });
});


function SaveSolicitante() {
    var datos = {
        _token: $("#_token").val(),
        cmbPersona: $('#cmbPersona').val(),
        arbol: $('#NombreArbol').val(),
        perfil: $('#Perfil').val()
    };
    $.post("/pointex/multiples/arbol/save_solicitante", datos, function (res) {
        console.log(res)
        if (res === "OK") {
            cargando(2);
            swal(
                'Modificado!',
                'Arbol modificado!!',
                'success'
            );
        } else {
            cargando(2);
            swal(
                'Error!',
                res,
                'error'
            );
        }
    });
}

 function Required(){
    if (document.FrmSolicitante.cmbPersona.value == 0 || document.FrmSolicitante.cmbPersona.value == "") {
        cargando(2);
        swal(
            'Error!',
            'Seleccione la persona del arbol',
            'error'
        );
        document.FrmSolicitante.cmbPersona.focus();
    }else {
        window.location.href = "/pointex/multiples/arbol"
    }
}
