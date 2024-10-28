@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header">Sell In</div>
        </div>
    </div>
{{--    {!! $vista !!}--}}
    {!! $tbl !!}
@stop

@section("js")
    <script type="text/javascript">
        $(".eventoClickElimina").on("click", function () {
            var getNo = this.id;
            swal({
                title: '<i class="far fa-dizzy fa-7x danger"></i><br>¿Deseas Eliminar la información?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Deseo Eliminarlo!',
                cancelButtonText: 'No',
            }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href = "/pointex/gestion/sell_in/destroy/" + getNo
                    }
                });
        });
    </script>
@endsection
