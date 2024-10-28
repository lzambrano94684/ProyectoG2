<h6 class="card-title">Arboles Activos</h6> <br> <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}"> <table class="table text-center " id="example2">
    <thead class="darken-4 bg-dark text-white">
    <tr>
        <th>Acciones</th>
        <th>Nombre del Arbol</th>
        <th>Pantalla</th>
        <th>Usuarios Asignados</th>
        <th>Aprobadores</th>
    </tr>
    </thead>
    <tbody>
    @foreach($activos as $value)
        @php($kco = $value->first())
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
        <tr>
            <td>
                <a href="#" onclick="estadoArbolDesactivado({{$kco->Id}})" class="overRed"
                   title="Desactivar Arbol" data-placement="top">
                    <i class="fas fa-toggle-on fa-lg"></i>
                </a>
            </td>
            <td>{{$kco->NombreArbol}}</td>
            <td>{{$kco->Tipo}}</td>
            <td class="text-left" >
                @php($listaUsuarios = $value ? $value->sortBy("Oreden")->pluck("Usuarios")->filter()->unique()->join("<br>* ") : null)
                    * {!! $listaUsuarios !!}
            </td>

	 <td  class="text-left" >
                @php($listaAprobadores = $value ? $value->sortBy("Oreden")->pluck("Aprobadores")->filter()->unique()->join("<br>* ") : null)
                    * {!! $listaAprobadores !!}
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
