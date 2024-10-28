<div class="row">
    <div class="col-md-5">
        <label  class="text-info required" for="cmbEspecialidad">Especialidad:</label>
        {!! $cmbEspecialidad!!}
    </div>

    <div class="col-md-5">
        <label  class="text-info required" for="cmbPais">País:</label>
        {!! $cmbPais !!}
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="text-info required" for="txtStatus">Estado:</label>
            @foreach($arrayEstatus as $k => $status)
                <div class="custom-control custom-radio">
                    <input type="radio" value="{{ $status->Id }}" id="check_list{{ $k }}" name="checkStatus" class="custom-control-input" required {{ $IdEstado == $status->Id ? 'checked' : null }}>
                    <label class="custom-control-label" for="check_list{{$k}}">{{ $status->Nombre }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="row" >
    <div class="col-md-4">
        <label  class="text-info required" for="txtNombre">Nombres:</label>
        <input type="text" class="form-control " name="txtNombre" id="txtNombre" placeholder="Ingrese Nombre" required value="{{$modelMDGrow->Nombre}}" minlength="2" maxlength="99">
    </div>

    <div class="col-md-4">
        <label  class="text-info required" for="txtApellido">Apellido:</label>
        <input type="text"class="form-control" name="txtApellido" id="txtApellido" placeholder="Ingrese Apellido" required value="{{$modelMDGrow->Apellido}}" minlength="2" maxlength="149">
    </div>

    <div class="col-md-2">
        <label  class="text-info required" for="slcGenero">Género:</label>
        <select class="form-control select2_single " name="slcGenero" id="slcGenero" required>
            <option value="">Seleccione..</option>
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
        </select>
    </div>
    <div class="col-md-2">
        <label  class="text-info required" for="txtArea"> Área Telefónica:</label>
        <input type="text" class="form-control entero" name="txtArea" id="txtArea" placeholder="ejemplo 502" required value="{{$modelMDGrow->CodigoArea}}"minlength="1" maxlength="3">
    </div>
</div> <br>

<div class="row" >
    <div class="col-md-2">
        <label  class="text-info required" for="txtNoCelular">Celular:</label>
        <input type="text" class="form-control entero" name="txtNoCelular" id="txtNoCelular" placeholder=" Celular" required minlength="8" maxlength="15" value="{{$modelMDGrow->Celular}}">
    </div>


    <div class="col-md-2">
        <label  class="text-info" for="txtTelefono">Teléfono:</label>
        <input type="text" class="form-control entero" name="txtTelefono" id="txtTelefono" placeholder=" Teléfono" minlength="8" maxlength="15" value="{{$modelMDGrow->Telefono}}">
    </div>


    <div class="col-md-3">
        <label  class="text-info" for="txtColegiado">No. Colegiado:</label>
        <input type="text"class="form-control" name="txtColegiado" id="txtColegiado" placeholder="Ingrese No. Colegiado"value="{{$modelMDGrow->NoColegiado}}">
    </div>
    <div class="col-md-3">
        <label  class="text-info required" for="txtCorreo">Email:</label>
        <input type="email"class="form-control" name="txtCorreo" id="txtCorreo" placeholder="Ingrese Email" required value="{{$modelMDGrow->Correo}}">
    </div>

    <div class="col-md-2">
        <label  class="text-info" for="txtNoConsultorio"> Tel. Consultorio:</label>
        <input type="text" class="form-control entero" name="txtNoConsultorio" id="txtNoConsultorio" placeholder="Tel. Consultorio" minlength="8" maxlength="15"  value="{{$modelMDGrow->TelConsultorio}}">
    </div>

</div> <br>

<div class="row">
    <div class="col-md-4">
        <label  class="text-info" for="txtDireccion">Dirección de Consultorio:</label>
        <textarea class="form-control" name="txtDireccion" id="txtDireccion" cols="20" rows="2" placeholder="Ingrese dirección de consultorio" minlength="10" maxlength="118">{{$modelMDGrow->DireccionConsultorio}}</textarea>
    </div>

    <div class="col-md-2">
        <label  class="text-info required" for="slcCarta">Carta Firmada:</label>
        <select class="form-control select2_single " name="slcCarta" id="slcCarta" required>
            <option value="">Seleccione...</option>
            <option value="S">SI</option>
            <option value="N">No</option>
        </select>
    </div>

    <div class="col-md-3">
        <label  class="text-info required" for="slcConsultorio">Consultorio Listo:</label>
        <select class="form-control select2_single " name="slcConsultorio" id="slcConsultorio" required>
            <option value="">Seleccione...</option>
            <option value="S">SI</option>
            <option value="N">No</option>
        </select>
    </div>

    <div class="col-md-3">
        <label  class="text-info" for="txtFechaConsultorio">Fecha Consultorio:</label>
        <input  type="date" class="form-control" name="txtFechaConsultorio" id="txtFechaConsultorio" value="{{$modelMDGrow->FechaConsultorio}}">
    </div>
</div> <br>

<div class="row" >
    <div class="col-md-3">
        <label  class="text-info" for="txtConsultas">Consultas Acumuladas:</label>
        <input type="text" class="form-control entero" name="txtConsultas" id="txtConsultas" value="{{$modelMDGrow->ConsultasAcumuladas}}">
    </div>
    <div class="col-md-3">
        <label  class="text-info" for="txtEncuesta">Encuesta Satifacción:</label>
        <input type="text" class="form-control" name="txtEncuesta" id="txtEncuesta" value="{{$modelMDGrow->EncuestaSatisfaccion}}">
    </div>
    <div class="col-md-6">
        <label  class="text-info" for="txtObservacion">Ingrese Obesrvación:</label>
        <textarea class="form-control" name="txtObservacion" id="txtObservacion" cols="20" rows="2" placeholder="Ingrese observación..." minlength="10" maxlength="149">{{$modelMDGrow->Observaciones}}</textarea>
    </div>
</div> <br>
