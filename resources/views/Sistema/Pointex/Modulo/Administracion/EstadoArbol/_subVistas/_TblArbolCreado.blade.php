<h6 class="card-title">Arboles Creados</h6>
<br>
<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
<table class="table text-center" id="example">
    <thead class="darken-4 bg-dark text-white">
    <tr>
        <th>Acciones</th>
        <th>Nombre del Arbol</th>
        <th>Pantalla</th>
        <th>Usuarios Asignados</th>
        <th>Aprobadores</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($creados as $value)
        @php($kco = $value->first())
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
        <tr>
            <td>
                <a href="/pointex/multiples/arbol/edit/{{base64_encode($kco->NombreArbol)}}/{{ $kco->IdEje }}"
                   class="btn btn-flat btn-info overOrange"
                   data-frm="marca">
                    <i class="ft-edit-2"></i>
                </a>
            </td>
            <td>{{$kco->NombreArbol}}</td>
            <td>{{$kco->Tipo}}</td>
            <td  class="text-left" >
                @php($listaUsuarios = $value ? $value->sortBy("Oreden")->pluck("Usuarios")->filter()->unique()->join("<br>- ") : null)
                
                    - {!! $listaUsuarios !!}
                
            </td>
            <td  class="text-left" >
                @php($listaAprobadores = $value ? $value->sortBy("Oreden")->pluck("Aprobadores")->filter()->unique()->join("<br>- "): null)
                
                    - {!! $listaAprobadores !!}
                
            </td>
            <td>
                @php($clase = $kco->Estado == 1 ? "bg-success" : "bg-danger")
                <p  class="{{ $clase }}"><b class="text-white">{{ $arrayEstado->get($kco->Estado)  }}</b></p>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

