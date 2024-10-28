
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="horz-layout-basic">Franquicia</h4>
            <p class="mb-0">Por favor completar los campos.</p>
        </div>
        <div class="card-content">
            <div class="px-3">
                <form class="form form-horizontal" id="form" method="post" action="/pointex/gestion/catalogos/Franquicias" novalidate="novalidate" id="form">

                    <input type="hidden" name="Id" value="{{$datos->Id}}">
                    @csrf
                    <div class="form-body">
                    <br>
                        <table>

                            <tr>
                                <div class="form-group row">

                                <th><label class=" label-control" >Franquicia: </label></th>
                                <th></th>
                                <th><label class=" label-control" >Producto Cod: </label></th>
                                <th></th>
                                <th><label class=" label-control">Periodo: </label></th>

                                </div>
                            </tr>
                            <tr>
                                <div class="col-md-9">
                                    <th></th>
                                <th>{!!$cmbFranquicia!!}</th>
                                    <th></th>
                                <th>{!!$cmbProductoCod!!}</th>
                                    <th></th>
                                <th><input name="Periodo" value="{{$datos->Periodo}}" class="form-control" id="Periodo" ></th>

                                </div>
                            </tr>

                        </table>

                        <div class="form-actions">
                            <a type="button" class="btn btn-raised btn-warning mr-1"
                               href="/pointex/gestion/catalogos/Franquicias">
                                <i class="ft-arrow-left"></i> Regresar
                            </a>
                            <button class="btn btn-raised btn-primary eventoClickGuardar">
                                <i class="ft-save"></i> Guardar
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section("js")
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {!! HTML::script('/Vendor/Plantillas/Apex/app-assets/js/jquery.validate.js') !!}
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2_single ').select2();

            $(document).ready(function() {
                $("#form").validate();
            });
            var form = $("#form");
            var pivote = 0;
            var isValid = false;
            $.validator.setDefaults({
                showErrors: function(errorMap, errorList) {
                    var summary = "";
                    $.each(errorList, function() {
                        summary += this.message + "\n";
                    });
                    if (pivote && !isValid)
                    {
                        swal({
                            title: "Error",
                            text: summary,
                            icon: "error",
                            buttons: true,
                            dangerMode: true,
                        })
                    }
                    pivote =0;
                    console.log(isValid);
                }
            });
            form.validate({
                rules: {
                    "cmbNombre": {
                        required: true,
                    },
                    "cmbProductoCod[]": {
                        required: true,
                    } ,
                    "Periodo": {
                        required: true,
                    }
                },
                messages: {
                    "cmbNombre": {
                        required: "Seleccione una Franquicia",
                    },
                "cmbProductoCod[]": {
                    required: "Seleccione el Producto",
                },
                    "Periodo": {
                        required: "Seleccione el Periodo",
                    }
                }
            });
            $("#form :input:selected").change(function() {
                isValid = form.valid();
                console.log(isValid)
            });
            form.on("submit", function (){
                pivote =1;
            });
        });
    </script>
@endsection
