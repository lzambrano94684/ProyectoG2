<p class="card-text"> si deseas
    crear
    más
    favor dar click
    <a class="btn btn-flat btn-danger" href="/pointex/visita_medica/paneles/asignar?{{ base64_encode("crear=1") }}">aquí</a>
</p>
<div class="card-content">
    <div class="card-body card-dashboard table-responsive ">
        <table class="table zero-configuration datatablePointer">
            <thead>
            <tr class="headings darken-4 bg-dark">
                <th style="color: white;width: 50.75px" class="text-center">Acciones</th>
                <th style="color: white; width: 135.75px;">Representante</th>
                <th style="color: white;" class="text-center">Entidad</th>
                <th style="color: white;" class="text-center">Pais</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $Key)
                <tr>
                    <td class="text-center">
                        <a href="{{ "/pointex/visita_medica/paneles/asignar?".base64_encode("editar=$Key->Id") }}">
{{--                        <a href="{{ url("/EditarExtencion/{$Key->Id}/edit")}}">--}}
                            <i class="ft-edit-2"></i>
                        </a>
                    </td>
                    <td class="">{{$Key->Representante}}</td>
                    <td class="text-center">{{$Key->Entidad}}</td>
                    <td class="text-center">{{$Key->Pais}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@section('jsExtras')
<script></script>
@endsection
