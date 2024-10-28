@extends('Sistema.Pointex.LayOuts.layout')

@section('title',$titleMsg)

@section("css")
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 47px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 13px;
            width: 13px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            /*background-color: #2196F3;*/
            background-color: #21F396;
        }

        input:focus + .slider {
            /*box-shadow: 0 0 1px #2196F3;*/
            box-shadow: 0 0 1px #21F396;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection

@section("content")
    <section id="horizontal-vertical">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="horz-layout-basic">{{ $titleMsg }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard table-responsive">
                            <div class="card">
                                <table id="dtHorizontalVerticalExample"
                                       class="table table-striped table-bordered table-sm "
                                       cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>Médico</th>
                                        <th>Especialidad</th>
                                        <th>Dirección</th>
                                        <th>Frecuencia</th>
                                        <th>Categoria</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($fichero->count()>0)
                                        @foreach ($fichero as $krs => $vrs)
                                            <tr>
                                                <td>{{$vrs->Medico}}</td>
                                                <td>{{$vrs->Especialidad}}</td>
                                                <td>{{$vrs->Direccion}}</td>
                                                <td>{{$vrs->Frecuencia}}</td>
                                                <td>{{$vrs->Cat}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section("js")
    <script>
        $(document).ready(function () {
            $('#dtHorizontalVerticalExample').DataTable({
                "scrollX": true,
                "scrollY": 390,
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endsection
