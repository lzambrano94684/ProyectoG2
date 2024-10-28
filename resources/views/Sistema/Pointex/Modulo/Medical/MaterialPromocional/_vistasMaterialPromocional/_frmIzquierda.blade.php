<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbMaterialPromocional">Material &nbsp;Promocional:</label>
        {!!  $cmbMaterialPromocional !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="txtObjetivo">Objetivo:</label>
        <textarea  id="txtObjetivo" rows="3" name="txtObjetivo" class="form-control"
                   placeholder="Ingrese Objetivo" required minlength="10" maxlength="250" >{{trim($modelSolicitudMateriales->Objetivo)}}</textarea>
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="txtMaterial">Descripción del Material:</label>
        <input type="text" id="txtMaterial" name="txtMaterial" class="form-control"
               placeholder="Descripción del Material" required value="{{$modelSolicitudMateriales->DescripcionMaterial}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="slcFranquicia">Franquícia:</label>
        <select required class=" select2_single form-control" id="slcFranquicia"
                name="slcFranquicia" >
            <option value="">Seleccione Franquicia</option>
            @foreach($franquicias as $franquicia)
                <option
                        @if($franquicia->Codigo)
                    codigo = {{ $franquicia->Codigo }}
                    @endif
                        value="{{$franquicia->Id}}" {{ $modelSolicitudMateriales->IdFranquicia == $franquicia->Id ? 'selected=selected' : '' }}>{{$franquicia->Nombre}}</option>
            @endforeach
        </select>

    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbProducto">Marca:</label>
        <select id="cmbProducto" name="cmbProducto" class="form-control form-control select2_single" required>

        </select>
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbDuracion">Duracion del Material:</label>
        <select id="cmbDuracion" name="cmbDuracion" class="form-control form-control select2_single" required>
            <option value="">Seleccione</option>
            <option value="1">1 MES</option>
            <option value="2">2 MESES</option>
            <option value="3">3 MESES</option>
            <option value="4">4 MESES</option>
            <option value="5">5 MESES</option>
            <option value="6">6 MESES</option>
            <option value="7">7 MESES</option>
            <option value="8">8 MESES</option>
            <option value="9">9 MESES</option>
            <option value="10">10 MESES</option>
            <option value="11">11 MESES</option>
            <option value="12">12 MESES</option>
            <option value="13">13 MESES</option>
            <option value="14">14 MESES</option>
            <option value="15">15 MESES</option>
            <option value="16">16 MESES</option>
            <option value="17">17 MESES</option>
            <option value="18">18 MESES</option>
            <option value="19">19 MESES</option>
            <option value="20">20 MESES</option>
            <option value="21">21 MESES</option>
            <option value="22">22 MESES</option>
            <option value="23">23 MESES</option>
            <option value="24">24 MESES</option>
        </select>
    </div>
</div>
