
<div class="card-header">
    <h4 class="card-title">Control de Franquicias</h4>

    <p class="card-text">A continuación un listado de los productos con sus respectivas franquicias  cread@s, si deseas crear más favor dar
        click
        <a class="btn btn-flat btn-danger"
           href="/pointex/gestion/catalogos/Franquicias?{{ base64_encode("crear=1") }}">aquí</a>
    </p>
</div>
<div class="card-content">
    <div class="card-body card-dashboard table-responsive ">
        <table class="table zero-configuration datatablePointer">

            <thead>
            <tr class="headings darken-4 bg-dark">
                <th style="color: white; width: 135.75px;">Acciones</th>
                <th style="color: white; width: 135.75px;">Franquicia</th>
                <th style="color: white; width: 135.75px;"> Producto Cod</th>
                <th style="color: white; width: 135.75px;">Periodo</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datos as $Key)
                <tr>
                    <td>
                        <a href="?{{ base64_encode("editar=$Key->Id") }}">
                            <i class="ft-edit-2"></i>
                        </a>
                        <a href="javascript:void(0)" class="eventoClickElimina" id="{{ $Key->Id }}" onclick="deleteRegistro({{ $Key->Id  }}">
                            <i class="ft-trash danger"></i>
                        </a>
                    </td>
                    <td>{{$arrayFranquicia->get($Key->IdFranquicia)}}</td>
                    @if(isset($Key->AsigProductos->IdProducto))
                        <td>{{$arrayProducto->get($Key->AsigProductos->IdProducto)}}</td>
                    @else
                        <td></td>
                    @endif
                    <td>{{$Key->Periodo}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@section("js")
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
         $(".eventoClickElimina").on("click", function () {
             var getid = this.id;
            swal({
                title: "¿Desea Eliminar la informacion?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(function (isConfirm) {
                if (isConfirm) {
                    window.location.href = '/pointex/gestion/catalogos/borrar/' + getid;
                    redirect()
                }
            });
        });
    </script>
@endsection
