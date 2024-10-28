<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="Nombres">Persona:</label>
        {!! $cmbPersona !!}
    </div>
</div>

{{--<div class="row">--}}
{{--    <div class="form-group col-12 mb-2">--}}
{{--        <label class="text-info" for="Nombres">Nombres:</label>--}}
{{--        <input type="text" id="txtNombres" name="txtNombres" class="form-control" placeholder="Nombres" required>--}}
{{--    </div>--}}
{{--</div>--}}


{{--<div class="row">--}}
{{--    <div class="form-group col-12 mb-2">--}}
{{--        <label class="text-info" for="Apellidos">Apellidos:</label>--}}
{{--        <input type="text" id="txtApellidos" name="txtApellidos" class="form-control"--}}
{{--               placeholder="Apellidos" required>--}}
{{--    </div>--}}
{{--</div>--}}


<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="Teléfono">Teléfono:</label>
        <input type="text" id="txtTelefono" name="txtTelefono" class="form-control datos"
               placeholder="56842563" min="8" max="8">
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="Dirección">Dirección:</label>
        <input type="text" id="txtDireccion" name="txtDireccion" class="form-control"
               placeholder="Dirección">
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="correo">e-mail:</label>
        <input type="email" class="form-control" id="txtEmail" name="txtEmail"
               placeholder="luis.zambrano@gmail.com" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info">Género:</label>
        <div class="input-group">
            <div class="custom-control custom-radio d-inline-block ml-1">
                <input type="radio" id="customRadioInline1" name="txtGenero"
                       class="custom-control-input checkGenero" value="M">
                <label class="custom-control-label" for="customRadioInline1">Hombre</label>
            </div>
            <div class="custom-control custom-radio d-inline-block ml-2">
                <input type="radio" id="customRadioInline2" checked="" name="txtGenero"
                       class="custom-control-input checkGenero" value="F">
                <label class="custom-control-label" for="customRadioInline2">Mujer</label>
            </div>
        </div>
    </div>
</div>

