<br>
@if($consultaPuesto <> 2)
<form class="form" action="/pointex/visita_medica/paneles/save_rep" method="post">
    <input type="hidden" id="txtIdRep"name="txtIdRep" value="{{ $id }}">
    @csrf
    <div class="form-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="label-control" for="cmbPersona">Persona</label>
                    {!! $cmbPersona !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="label-control" for="cmbPersona">Linea</label>
                    {!! $cmbLinea !!}
                </div>
            </div>
            <div class="col-md-3">
                <br>
                <button class="form-control text-white btn btn-success">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</form>
<br>
@else
    <input type="hidden" id="txtIdRep"name="txtIdRep" value="{{ $id }}">
@endif
<div class="nav-vertical">
    <ul class="nav nav-tabs navbar-horizontal">
        <li class="nav-item">
            <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
               href="#tab1" aria-expanded="true">Activar / Desactivar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
               href="#tab2" aria-expanded="false"> +Agregar Médico</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"
               href="#tab3" aria-expanded="false"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1" aria-labelledby="base-tab1">
            @include("Sistema.Pointex.Modulo.VisitaAdministracion.Fichero._subVistas._listPanel")
        </div>
        <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
            @include("Sistema.Pointex.Modulo.VisitaAdministracion.Fichero._subVistas._frmAgregar")
        </div>
        <div class="tab-pane" id="tab3" aria-labelledby="base-tab3">
            @include("Sistema.Pointex.Modulo.VisitaAdministracion.Fichero._subVistas._frmUniversoMedico")
        </div>
    </div>
</div>
@section('jsExtras')
    <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->

    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/Swal.js') !!}
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/vendors/js/sweetalert2.min.js') !!}
    {!!HTML::script('/Vendor/Plantillas/Apex/app-assets/js/sweet-alerts.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/tagging.js') !!}
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/tagging_example.js') !!}
    {!! HTML::script('/others/js/tagify.min.js') !!}
    <script>
        var IdPaisRep = "{{ $consultaIdPais }}";
        $(document).ready(function () {
            $("#TblUniversoMedico").DataTable();
            // setInterval(function(){ $("#TblUniversoMedico").draw(); }, 3000);
            // $("#TblUniversoMedico").DataTable().ajax().reload();

            $(".select2_single").select2({
                placeholder: "Seleccione Opción",
                allowClear: true
            });
            // $("#form").validate();
            var form = $("#form");
            var pivote = 0;
            var isValid = false;
            $.validator.setDefaults({
                showErrors: function (errorMap, errorList) {
                    var summary = "";
                    $.each(errorList, function () {
                        summary += this.message + "\n";
                    });
                    if (pivote && !isValid) {
                        swal({
                            title: "Error",
                            text: summary,
                            icon: "error",
                            buttons: true,
                            dangerMode: true,
                        })
                    }
                    pivote = 0;
                }
            });
            form.validate({
                rules: {
                    "txtNombre": {
                        required: true,
                    },
                    "txtEspecialidad": {
                        required: true,
                    },
                    "txtDireccion": {
                        required: true,
                    },
                    "txtFrecuencia": {
                        required: true,
                    },
                    "txtJustificacion": {
                        required: true,
                    },
                },
                messages: {
                    "txtNombre": {
                        required: "Ingrese el Nombre del médico",
                    },
                    "txtEspecialidad": {
                        required: "Ingrese la especialidad del médico",
                    },
                    "txtDireccion": {
                        required: "Ingrese la dirección del médico",
                    },
                    "txtFrecuencia": {
                        required: "Ingrese la frecuencia del médico",
                    },
                    "txtJustificacion": {
                        required: "Ingrese una razón por la cual sea necesario agregar al médico",
                    }
                }
            });
            $("#form :input:selected").change(function () {
                isValid = form.valid();
            });
            form.on("submit", function () {
                pivote = 1;
            });
            // tags();
        });

        function Estatus(id, estado) {

            // var datos = {
            //     id: id,
            //     estado: estado,
            //     _token: $("#_token").val()
            // };
            // cargando(1);
            // $.post("/pointex/visita_medica/paneles/save_estatus", datos, function (res) {
            //     if (res.ESTADO === "OK") {
            //         cargando(2);
            //         $("#".res.Id).classList.remove("danger");
            //         $("#".res.Id).classList.remove("success");
            //
            //         if (res.Estatus == 0) {
            //             $("#".res.Id).addClass('danger');
            //         } else {
            //             $("#".res.Id).addClass('success');
            //         }
            //
            //     } else {
            //         cargando(2);
            //         swal(
            //             'Error!',
            //             'No fue posible realizar la modificación!!',
            //             'error'
            //         );
            //     }
            // });
        }

        function getJson(url) {
            return JSON.parse($.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                global: false,
                async: false,
                success: function (data) {
                    return data;
                }
            }).responseText);
        }

        // function tags(){
        //     var whitelist = getJson("/pointex/visita_medica/paneles/medico/"+IdPaisRep);
        //     var inputElm = document.querySelector('input[name=tags]');
        //     var tagify = new Tagify(inputElm, {
        //         enforceWhitelist: true,
        //         whitelist: inputElm.value.trim().split(/\s*,\s*/),
        //     })
        //     tagify.on('add', onAddTag).on('input', onInput).on('change',function(e){
        //         var tags = $("#tags");
        //         var tagsArray = tags.val();
        //         tagsArray = tagsArray.replaceAll('value', '');
        //         tagsArray = tagsArray.replaceAll('"', '');
        //         tagsArray = tagsArray.replaceAll('{', '');
        //         tagsArray = tagsArray.replaceAll('}', '');
        //         tagsArray = tagsArray.replaceAll(':', '');
        //         tagsArray = tagsArray.replaceAll('[', '');
        //         tagsArray = tagsArray.replaceAll(']', '');
        //         tagsArray = tagsArray.split(',');
        //         // var dataFrm = {_token: $('meta[name="csrf-token"]').attr('content'),Medico: tagsArray}
        //         var formData = new FormData();
        //         formData.append(' _token', $('meta[name="csrf-token"]').attr('content'));
        //         formData.append('Medico', tagsArray);
        //         $.ajax({
        //             url: '/pointex/visita_medica/paneles/dato_medico',
        //             type: 'POST',
        //             data: formData,
        //             processData: false,
        //             contentType: false,
        //             success: function (data) {
        //                 var filas = [];
        //                 $.each(data.datoUniversoMedico, function (k, v) {
        //                     filas.push("<tr>" +
        //                         "<td>"+v.Id+"</td>" +
        //                         "<td>"+v.Medico+"</td>" +
        //                         "<td>"+v.Especialidad+"</td>" +
        //                         "<td>"+v.SegundaEspecialidad+"</td>" +
        //                         "<td>"+v.Domicilio+"</td>" +
        //                         "<td>"+v.Localidad+"</td>" +
        //                         "<td>"+v.Region+"</td>" +
        //                         "</tr>")
        //                 })
        //                 $("#bodyUniversoMedico").html(filas);
        //             }
        //         });
        //     });
        //
        //     var mockAjax = (function mockAjax(){
        //         var timeout;
        //         return function(duration){
        //             clearTimeout(timeout); // abort last request
        //             return new Promise(function(resolve, reject){
        //                 timeout = setTimeout(resolve, duration || 700, whitelist)
        //             })}})()
        //
        //     function onAddTag(e){
        //         tagify.off('add', onAddTag)
        //     }
        //
        //     function onInput(e){
        //         tagify.settings.whitelist.length = 0;
        //         tagify.loading(true).dropdown.hide.call(tagify)
        //         mockAjax()
        //             .then(function(result){
        //                 tagify.settings.whitelist.push(...result, ...tagify.value)
        //                 tagify.loading(false).dropdown.show.call(tagify, e.detail.value);
        //             })
        //     }
        //
        //     // console.log(tagify.createTagElem(Object (tagData)));
        //     // console.log(tagify.getWhitelistItem(tagify));
        //     // function getWhitelistItemsByValue(value) {
        //     //     return this.settings.whitelist.filter(function (item) {
        //     //         if( !item.value ) return false;    // items without "value" key should not be taken into account as "real" whitelist items
        //     //         return sameStr(item.value || item, value);
        //     //     })[0];
        //     // }
        //     // console.log(tagify.getWhitelistItemsByValue());
        //     // console.log(tagify.getWhitelistItem());
        // }

        function addPanelMedico(id) {
            $("#iconPlus" + id).attr("hidden", true);
            // $('#iconSpinner'+id).removeAttr('hidden');
            // var estatus = getJson("/pointex/visita_medica/paneles/agrega_panel/"+id);
            // $("#iconSpinner"+id).attr("hidden",true);
            $('#iconCheck' + id).removeAttr('hidden');
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        var input = document.querySelector('input[name=tags-manual-suggestions]'),
            // init Tagify script on the above inputs
            tagify = new Tagify(input, {
                whitelist: getJson("/pointex/visita_medica/paneles/medico/" + IdPaisRep),
                dropdown: {
                    position: "manual",
                    maxItems: Infinity,
                    enabled: 0,
                    classname: "customSuggestionsList"
                },
                templates: {
                    dropdownItemNoMatch() {
                        return `<div class='empty'>No encontrado</div>`;
                    }
                },
                enforceWhitelist: true
            })

        tagify.on("dropdown:show", onSuggestionsListUpdate)
            .on("dropdown:hide", onSuggestionsListHide)
            .on('dropdown:scroll', onDropdownScroll).on('change', function (e) {
            var tags = $("#tags");
            var tagsArray = tags.val();
            tagsArray = tagsArray.replaceAll('value', '');
            tagsArray = tagsArray.replaceAll('"', '');
            tagsArray = tagsArray.replaceAll('{', '');
            tagsArray = tagsArray.replaceAll('}', '');
            tagsArray = tagsArray.replaceAll(':', '');
            tagsArray = tagsArray.replaceAll('[', '');
            tagsArray = tagsArray.replaceAll(']', '');
            tagsArray = tagsArray.split(',');
            // var dataFrm = {_token: $('meta[name="csrf-token"]').attr('content'),Medico: tagsArray}
            var formData = new FormData();
            formData.append(' _token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('Medico', tagsArray);
            $.ajax({
                url: '/pointex/visita_medica/paneles/dato_medico',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    // var filas = [];
                    var t = $('#TblUniversoMedico').DataTable();
                    t.clear().draw();
                    $.each(data.datoUniversoMedico, function (k, v) {
                        // t.row.add(['<a onclick="addPanelMedico('+v.Id+')" href="javascript:void(0);" class="btn btn-flat btn-warning overOrange tooltip-per delete"><i class="fa fa-user-plus" aria-hidden="true"></i></a>', v.Medico, v.Especialidad, v.SegundaEspecialidad, v.Domicilio, v.Localidad, v.Region]).draw(false);
                        t.row.add([v.Medico, v.Especialidad, v.Domicilio, v.Localidad, v.Region,'<a class="btn btn-flat btn-info overOrange aActiveModal tooltip-per" data-toggle="modal"data-target="#exampleModalLong" onclick="GetDetalleProdMedico('+v.MEDICO_UNICO+',1);"><i class="fa fa-medkit warning" aria-hidden="true"></i></a>']).draw(false);
                        // filas.push("<tr>" +
                        //     "<td>"+v.Id+"</td>" +
                        //     "<td>"+v.Medico+"</td>" +
                        //     "<td>"+v.Especialidad+"</td>" +
                        //     "<td>"+v.SegundaEspecialidad+"</td>" +
                        //     "<td>"+v.Domicilio+"</td>" +
                        //     "<td>"+v.Localidad+"</td>" +
                        //     "<td>"+v.Region+"</td>" +
                        //     "</tr>")
                    })
                    // $("#bodyUniversoMedico").html(filas);
                }
            });
        });

        renderSuggestionsList()  // defined down below

        // ES2015 argument destructuring
        function onSuggestionsListUpdate({detail: suggestionsElm}) {
            // console.log(  suggestionsElm  )
        }

        function onSuggestionsListHide() {
            // console.log("hide dropdown")
        }

        function onDropdownScroll(e) {
            // console.log(e.detail)
        }

        // https://developer.mozilla.org/en-US/docs/Web/API/Element/insertAdjacentElement
        function renderSuggestionsList() {
            tagify.dropdown.show() // load the list
            tagify.DOM.scope.parentNode.appendChild(tagify.DOM.dropdown)
        }


        $("#GuardaD").on("click", function () {
            var tags = $("#tags");
            var idRep = $("#txtIdRep");

            var tagsArray = tags.val();
            tagsArray = tagsArray.replaceAll('value', '');
            tagsArray = tagsArray.replaceAll('"', '');
            tagsArray = tagsArray.replaceAll('{', '');
            tagsArray = tagsArray.replaceAll('}', '');
            tagsArray = tagsArray.replaceAll(':', '');
            tagsArray = tagsArray.replaceAll('[', '');
            tagsArray = tagsArray.replaceAll(']', '');
            tagsArray = tagsArray.split(',');

            var dataFrm = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                idRep: idRep.val(),
                Medico: tagsArray
            };
             $.post("/pointex/visita_medica/paneles/agrega_panel", dataFrm, function (resp) {
                if (resp.STATUS == "OK") {
                    swal(
                        'Ok!',
                        mensaje = "Datos guardados con exito",
                        'success'
                    ).then(function (isConfirm) {
                        window.location.reload();
                    });
                } else {
                    mensaje = "error";
                    errorMsg(mensaje)
                }
                cargando(2);
            })
        });

        function GetDetalleProdMedico(CodCloseUp,asignar){
            var ProdTrim4 = getJson("/pointex/visita_medica/paneles/prod_medico/" + CodCloseUp + "/TRIM_4/"+ asignar);
            var ProdTrim3 = getJson("/pointex/visita_medica/paneles/prod_medico/" + CodCloseUp + "/TRIM_3/"+ asignar);
            var ProdTrim2 = getJson("/pointex/visita_medica/paneles/prod_medico/" + CodCloseUp + "/TRIM_2/"+ asignar);
            var ProdTrim1 = getJson("/pointex/visita_medica/paneles/prod_medico/" + CodCloseUp + "/TRIM_1/"+ asignar);

            var dibujaTablaHead = '';
            var dibujaTablaBody = '';
            var dibujaTablaFooter = '</tbody></table>';
            var posicion = 0;

            if(ProdTrim4){
                // dibujaTablaHead = '<b><h5>Ranking Trim Actual</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                dibujaTablaHead = '<b><h5>TRIM MOV 02/23</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                $.each(ProdTrim4, function (k, v) {
                    posicion = posicion +1;
                    dibujaTablaBody += '<tr><td class="text-left">'+posicion+'</td><td class="text-left">'+v.Mercado+'</td><td class="text-left">'+v.prod+'</td></tr>';
                });
                $("#tblTrim4").html(""+dibujaTablaHead + dibujaTablaBody + dibujaTablaFooter).val();
            }else{
                $("#tblTrim4").html("<h4>Sin Ranking</h4>").val();
            }

            if (ProdTrim3){
                dibujaTablaHead = '';
                dibujaTablaBody = '';
                posicion = 0
                // dibujaTablaHead = '<b><h5>Ranking Trim 3</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                dibujaTablaHead = '<b><h5>TRIM MOV 11/22</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                $.each(ProdTrim3, function (k, v) {
                    posicion = posicion +1;
                    dibujaTablaBody += '<tr><td class="text-left">'+posicion+'</td><td class="text-left">'+v.Mercado+'</td><td class="text-left">'+v.prod+'</td></tr>';
                });
                $("#tblTrim3").html(""+dibujaTablaHead + dibujaTablaBody + dibujaTablaFooter).val();
            }else{
                $("#tblTrim3").html("<h4>Sin Ranking</h4>").val();
            }

            if (ProdTrim2){
                dibujaTablaHead = '';
                dibujaTablaBody = '';
                posicion = 0
                // dibujaTablaHead = '<b><h5>Ranking Trim 2</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                dibujaTablaHead = '<b><h5>TRIM MOV 08/22</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                $.each(ProdTrim2, function (k, v) {
                    posicion = posicion +1;
                    dibujaTablaBody += '<tr><td class="text-left">'+posicion+'</td><td class="text-left">'+v.Mercado+'</td><td class="text-left">'+v.prod+'</td></tr>';
                });
                $("#tblTrim2").html(""+dibujaTablaHead + dibujaTablaBody + dibujaTablaFooter).val();
            }else{
                $("#tblTrim2").html("<h4>Sin Ranking</h4>").val();
            }

            if (ProdTrim1){
                dibujaTablaHead = '';
                dibujaTablaBody = '';
                posicion = 0
                // dibujaTablaHead = '<b><h5>Ranking Trim 1</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                dibujaTablaHead = '<b><h5>TRIM MOV 05/22</h5><br><table class="table" style="font-size: 10px"><thead><tr><th class="text-left">#</th><th class="text-left">Mercado</th><th class="text-left">Producto</th></tr></thead><tbody>';
                $.each(ProdTrim1, function (k, v) {
                    posicion = posicion +1;
                    dibujaTablaBody += '<tr><td class="text-left">'+posicion+'</td><td class="text-left">'+v.Mercado+'</td><td class="text-left">'+v.prod+'</td></tr>';
                });
                $("#tblTrim1").html(""+dibujaTablaHead + dibujaTablaBody + dibujaTablaFooter).val();
            }else {
                $("#tblTrim1").html("<h4>No cuenta</h4>").val();
            }

        }





        addItemSelected($(".codeCrearItem"), false);

        function addItemSelected(selector) {
            selector.on('click', function () {
                var idCmb = $(this).data("id_cmb");
                var estadoCmb = $(this).data("estado_cmb");
                var conditionCmb = $(this).data("condition_cmb");
                var titulo = $(this).data("titulo");
                addNewOptionSelected(idCmb,estadoCmb,conditionCmb,titulo);
            });
        }

        function b64_to_utf8( str ) {
            return decodeURIComponent(escape(window.atob( str )));
        }
        function addNewOptionSelected(idCmb,estadoCmb,conditionCmb,titulo) {
            swal({
                title: titulo,
                html: '<input id="swal-Nombre" class="swal2-input" placeholder="Justificacion">',
                inputPlaceholder: 'Seleccione..',
                showCancelButton: true,
                confirmButtonText: 'Enviar',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                customClass: 'swal-wide'
            }).then(function (result) {
                var nombrevalor = document.getElementById('swal-Nombre').value;
                if (!nombrevalor) {
                    if(estadoCmb){
                        $('#check'+idCmb).prop("checked",false);
                    }else{
                        $('#check'+idCmb).prop("checked",true);
                    }
                    mensaje = "¡Los campos son requeridos!";
                    errorMsg();
                } else {
                     var datos = {
                         id: idCmb,
                         estado: estadoCmb,
                         justificacion: nombrevalor,
                         _token: $("#_token").val()
                     };
                     cargando(1);
                     $.post("/pointex/visita_medica/paneles/save_estatus", datos, function (res) {
                         if (res.ESTADO === "OK") {
                             cargando(2);
                             //$("#".res.Id).classList.remove("danger");
                             //$("#".res.Id).classList.remove("success");
                             //if (res.Estatus == 0) {
                             //  $("#".res.Id).addClass('danger');
                             //} else {
                             //  $("#".res.Id).addClass('success');
                             //}
                             $("#tddiv"+res.Id).html("En Proceso")
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
            })
        }
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
    </script>
@endsection
