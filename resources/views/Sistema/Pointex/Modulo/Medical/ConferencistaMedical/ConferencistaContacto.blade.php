<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="txtNombres">Nombres del Conferencista:</label>
        <input type="text" id="txtNombres" name="txtNombres" class="form-control"
               placeholder="Nombres del conferencista" required>
    </div>
</div>


<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="txtApellidos">Apellidos de Conferencista:</label>
        <input type="text" id="txtApellidos" name="txtApellidos" class="form-control"
               placeholder="Apellidos del conferencista" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="txtDireccion">Dirección del Conferencista:</label>
        <input type="text" id="txtDireccion" name="txtDireccion" class="form-control"
               placeholder="Ingrese dirección completa" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbEspecialidad">Especialidad del Médico:</label>
        <select id="cmbEspecialidad" name="cmbEspecialidad" required class="form-control select2_single" style="width: 100%;"data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Priority">
            <option value="">Seleccione Especialidad</option>
            @foreach($especialidades as $especialidad)
                <option value="{{$especialidad->Id}}">{{$especialidad->Nombre}}</option>
            @endforeach
        </select>
    </div>
</div>



<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbPais">País de Residencia:</label>
        <select id="cmbPais" name="cmbPais" required class="form-control select2_single" style="width: 100%;"data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Priority">
            <option value="">Seleccione País</option>
            @foreach($paises as $pais)
                <option codigo = {{$pais->Codigo}}
                    value="{{$pais->Id}}">{{$pais->Nombre}}</option>
            @endforeach
        </select>
    </div>
</div>

<div id="docIdentidad" class="row">

</div>




