<div class="form-group row">
    <label class="col-md-3 label-control" for="txtNombre">Titulo: </label>
    <div class="col-md-9">
        <input type="text" id="txtNombre" class="form-control" name="txtNombre" value="{{ trim($request->txtNombre) }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 label-control" for="txtDescripcionNoti">Descripcion: </label>
    <div class="col-md-9">
        <textarea id="txtDescripcionNoti" rows="5" class="form-control"
                  name="txtDescripcionNoti">{{ trim($request->txtDescripcionNoti) }}</textarea>
    </div>
</div>


<div class="form-group row">
    <label class="col-md-3 label-control" for="textarea">Avisar a: </label>
    <div class="col-md-9">
        <div id="textarea">
        </div>
        <input type="hidden" name="correos" id="correos" value="{{ $request->correos }}"/>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 label-control" for="txtMes">Alertar : </label>
    <div class="col-md-9">
        <div class="input-group">
            <input type="number" id="txtMes" name="txtMes"
                   onkeypress="return isNumber(event)" class="form-control"
                   value="{{ trim($request->txtMes) }}">
            <div class="input-group-append">
                <span class="input-group-text">Meses antes de vencer</span>
            </div>
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 label-control" for="txtRepetir">Avisar cada: </label>
    <div class="col-md-9">
        <div class="input-group">
            <input type="number" id="txRepetir" name="txtRepetir"
                   onkeypress="return isNumber(event)" class="form-control"
                   value="30" readonly>
            <div class="input-group-append">
                <span class="input-group-text">Dias</span>
            </div>
        </div>
    </div>
</div>