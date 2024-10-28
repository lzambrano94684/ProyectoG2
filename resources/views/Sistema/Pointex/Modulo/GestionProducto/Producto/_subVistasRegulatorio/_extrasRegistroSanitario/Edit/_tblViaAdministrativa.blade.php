@extends('Sistema.Pointex.LayOuts.layout')

@section('title', 'Listado de las Vias Administrativa')

@section('content')
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><button style="background-color:#ff8000" ><a href="/pointex/gestion/regulatorio/crear_listar?cmVnaXN0cm9TYW5pdGFyaW89MQ=="  style="color: black"><i class="fas fa-chevron-left"></i></a></button>Via Administrativa</h4>
                        <p class="card-text">A continuación un listado de las vias de administracion, si deseas
                            crear
                            más
                            favor dar click
                            <a class="btn btn-flat btn-danger" href="/pointex/gestion/regulatorio/agregar_via_administracion">aquí</a>
                        </p>
                        <table class="table zero-configuration datatablePointer">
                            <thead>
                            <tr class="headings darken-4 bg-dark">
                                <th style="color: white; width: 135.75px;" class="text-center">Acciones</th>
                                <th style="color: white; width: 135.75px;" class="text-center">Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datos as $Key)
                                <tr>
                                    <th class="text-center">
                                        <a href="{{ url("/pointex/gestion/regulatorio/agregar_via_administracion/{$Key->Id}/edit")}}">
                                            <i class="ft-edit-2"></i>
                                        </a>
                                        &nbsp
                                        <a href="javascript:void(0)" class="eventoClickElimina" id="{{ $Key->Id }}">
                                            <i class="ft-trash danger"></i>
                                        </a>
                                    </th>
                                    <th class="text-center">{{$Key->Nombre}}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section("js")
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">

        $(".eventoClickElimina").on("click", function () {
            var getNo = this.id;
            swal({
                title: "¿Desea Eliminar la informacion?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = "/pointex/gestion/regulatorio/Eliminarvia_administracion/" + getNo
                    }
                });
        });
    </script>
@endsection
