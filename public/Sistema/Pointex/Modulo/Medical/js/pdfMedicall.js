function pdfMedicall(id) {
    var data = JSON.parse(atob(dataCuentas));
    $("#IdDetalle").empty()
    $("#row1").empty()
    $("#row2").empty()
    $("#IdFooter").empty()
    $.each(data, function (key, value) {
        if (id == key) {
            var d = value[0].FechaHoraEvento.slice(0, 10).split('-');
            var dt = new Date(value[0].FechaHoraEvento);
            dt.setMonth(value[0].Mes-1);
            const month = dt.toLocaleString('default', {month: 'long'});
            var hora = dt.toLocaleString('en-US', {hour: 'numeric', minute: 'numeric', hour12: true})
            var options2 = {style: 'currency', currency: 'USD'};
            var numberFormat2 = new Intl.NumberFormat('en-US', options2);
            var honorarios = numberFormat2.format(value[0].Honorarios);

            if (value.length > 1) {
                var marcas = value[0].Marca.concat(",", value[1].Marca);
                $("#IdFooter").append('<h5 class="text-muted"><strong>Franquíca: ' + value[0].Franquicia + '</strong></h5><h6 class="text-info"><strong>Marca(s): ' + marcas + '</strong></h6>');
            } else {
                $("#IdFooter").append('<h5 class="text-muted"><strong>Franquíca: ' + value[0].Franquicia + '</strong></h5><h6 class="text-info"><strong>Marca(s): ' + value[0].Marca + '</strong></h6>');
            }
            if (value.length > 1) {
                var paises = value[0].Pais.concat(",", value[1].Pais);
                $("#IdDetalle").append('<h6 class="form-section">Código: ' + value[0].Codigo + '</h6><h6 class="form-section">Países: ' + paises + '</h6><h6 class="form-section">Mes: ' + month + '</h6>');
            } else {
                $("#IdDetalle").append('<h6 class="form-section">Código: ' + value[0].Codigo + '</h6><h6 class="form-section">País: ' + value[0].Pais + '</h6><h6 class="form-section">Mes: ' + month + '</h6>');
            }
            $("#row1").append('<div class="col-4">' +
                '                            <div class="form-group">' +
                '                                <label class="info">Ciudad/Depto/Provincia:</label>' +
                '                                <input type="text" class="form-control" readonly value="' + value[0].Ciudad + '">' +
                '                        </div></div>' + '<div class="col-4">' +
                '                            <div class="form-group">' +
                '                                <label class="info">Nombre del Evento:</label>' +
                '                                <input type="text" class="form-control" readonly value="' + value[0].NombreEvento + '">' +
                '                        </div></div>' + '<div class="col-2">' +
                '                            <div class="form-group">' +
                '                                <label class="info">Fecha:</label>' +
                '                                <input type="text" class="form-control" readonly value="' + d[2] + '/' + d[1] + '/' + d[0] + '">' +
                '                        </div></div>' + '<div class="col-2">' +
                '                            <div class="form-group">' +
                '                                <label class="info">Hora:</label>' +
                '                                <input type="text" class="form-control" readonly value="' + hora + '">' +
                '                        </div></div>');
            //fila 2
            $("#row2").append('<div class="col-5">' +
                // '                            <div class="form-group">' +
                // '                                <label class="info">Nombre del Speaker:</label>' +
                // '                                <input type="text" class="form-control" readonly value="' + value[0].NombreConferencista + '">' +
                // '                        </div>' +
                // '</div>' + '<div class="col-5">' +
                '                            <div class="form-group">' +
                '                                <label class="info">Honorarios del Speaker:</label>' +
                '                                <input type="text" class="form-control" readonly value="' + honorarios + '">' +

                '                        </div></div>');
        }
    });

    $("#modalCapex").modal({backdrop:
            'static', keyboard: true,});
    setTimeout(function () {
        loadSelect2ByModal('modalCapex');
    }, 200);
}
