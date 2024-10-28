var datatableViews;
var JsonDatatableViews = {
    autoWidth: false,
    stateSave: true,
    //fixedHeader: true,
    dom: "Bfrtip",
    order: [],
    buttons: [
        {
            text: '<i class="far fa-copy"></i>',
            extend: "copy",
            className: "btn btn-raised btn-icon btn-outline-success dtbBtnTooltip",
            titleAttr: 'Copiar',
            exportOptions: {
                columns: ':not(.th-acciones)'
            }

        },
        {
            text: '<i class="fas fa-file-csv"></i>',
            extend: "csv",
            className: "btn btn-raised btn-icon btn-outline-primary dtbBtnTooltip",
            titleAttr: 'Exportar a CSV',
            exportOptions: {
                columns: ':not(.th-acciones)'
            }

        },
        {
            text: '<i class="far fa-file-excel"></i>',
            extend: "excel",
            className: "btn btn-raised btn-icon btn-outline-warning dtbBtnTooltip",
            titleAttr: 'Exportar a Excel',
            exportOptions: {
                columns: ':not(.th-acciones)'
            }

        },
        {
            text: '<i class="far fa-file-pdf"></i>',
            extend: "pdfHtml5",
            className: "btn btn-raised btn-icon btn-outline-danger dtbBtnTooltip",
            titleAttr: 'Exportar a PDF',
            exportOptions: {
                columns: ':not(.th-acciones)'
            }

        },
        {
            text: '<i class="fas fa-print"></i>',
            extend: "print",
            className: "btn btn-raised btn-icon btn-outline-info dtbBtnTooltip",
            titleAttr: 'Imprimir',
            exportOptions: {
                columns: ':not(.th-acciones)'
            }

        },
        {
            text: '<i class="icon-refresh"></i>',
            className: "btn btn-raised btn-icon btn-outline-success clearCache",
            titleAttr: 'Refrescar Limpiar Filtros de Búsqueda',
            exportOptions: {
                columns: ':not(.th-acciones)'
            }

        },

    ],
    language: {
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
    },
    scrollX: true,
};
JsonDatatableViews.paging = false;
JsonDatatableViews.scrollY = "400px";
$(document).ready(function () {
    var datatablePointer = $(".datatablePointer");
    if (datatablePointer.length) {
        datatableViews = datatablePointer.DataTable(JsonDatatableViews);
    }
    $(".clearCache").on("click",function () {
        datatableViews.state.clear();
        location.reload(true);
    });
});
