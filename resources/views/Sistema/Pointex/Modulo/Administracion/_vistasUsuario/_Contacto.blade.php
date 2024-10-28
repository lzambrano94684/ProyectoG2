<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbPais">País:</label>
        <select id="cmbPais" name="cmbPais" required class="form-control select2_single" style="width: 100%;"  data-trigger="hover" data-placement="top" data-title="Priority">
            <option value="">Seleccione País</option>
            @foreach($paises as $pais)
                <option value="{{$pais->Id}}">{{$pais->Nombre}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbEntidad">Entidad &nbsp;del&nbsp;País:</label>
        <select id="cmbEntidad" name="cmbEntidad" required class="form-control select2_single" style="width: 100%;"  data-trigger="hover" data-placement="top" data-title="Priority">

        </select>
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbDepartamento">Departamento&nbsp;por&nbsp;Entidad:</label>
        <select id="cmbDepartamento" name="cmbDepartamento" class="form-control select2_single"   data-trigger="hover" data-placement="top" data-title="Priority">

        </select>
    </div>
</div>


<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbPuesto">Puesto&nbsp;por&nbsp;Departamento:</label>
        <select id="cmbPuesto" name="cmbPuesto" class="form-control form-control select2_single"   data-trigger="hover" data-placement="top" data-title="Priority">

        </select>
    </div>
</div>
