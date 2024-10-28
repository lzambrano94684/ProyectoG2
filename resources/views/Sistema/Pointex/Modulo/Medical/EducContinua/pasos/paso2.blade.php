<fieldset>
    <div class="row">
        <div class="col-md-6">
            @if(isset($modelEvento->Honorarios))
                <div class="form-group">
                    <label for="txtMontoHonorario">Precio Honorarios:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control square decimal" id="txtMontoHonorario"
                               name="txtMontoHonorario" value="{{ number_format($modelEvento->Honorarios,2) }}" required
                               maxlength="5" size="5">
                    </div>
                </div>
            @else
                <div class="form-group">
                    <label for="txtMontoHonorario">Ingrese Precio Honorarios:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control square decimal" id="txtMontoHonorario"
                               name="txtMontoHonorario" placeholder="$00.00" required maxlength="5" size="5">
                    </div>
                </div>
            @endif
            @if(isset($modelEvento->Hospedaje))
                <div class="form-group" id="MontoHospedaje">
                    <label for="txtMontoHospedaje">Precio Hospedaje:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control square decimal" id="txtMontoHospedaje"
                               name="txtMontoHospedaje" value="{{ number_format($modelEvento->Hospedaje,2)}}" required
                               maxlength="5" size="5">
                    </div>
                </div>
            @else
                <div class="form-group" id="MontoHospedaje">
                    <label for="txtMontoHospedaje">Ingrese Precio Hospedaje:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control square decimal" id="txtMontoHospedaje"
                               name="txtMontoHospedaje" placeholder="$00.00" maxlength="5" size="5" required>
                    </div>
                </div>
            @endif
            @if(isset($modelEvento->CantInvitados))
                <div class="form-group" id="CantInvidados">
                    <label for="txtCantInvidados">Cantidad Invitados:</label>
                    <input type="text" class="form-control entero" id="txtCantInvidados" name="txtCantInvidados"
                           value="{{ $modelEvento->CantInvitados }}" required size="2">
                </div>
            @else
                <div class="form-group" id="CantInvidados">
                    <label for="txtCantInvidados">Ingrese Cantidad Invitados:</label>
                    <input type="text" class="form-control entero" id="txtCantInvidados" name="txtCantInvidados"
                           placeholder="Cantidad" required size="2">
                </div>
            @endif
            @if(isset($modelEvento->CantStaff))
                <div class="form-group" id="CantStaff">
                    <label for="txtCantidadStaff">Cantidad Staff:</label>
                    <input type="text" class="form-control entero" id="txtCantStaff" name="txtCantStaff" maxlength="1"
                           size="1" value="{{ $modelEvento->CantStaff}}" required max="2">
                </div>
            @else
                <div class="form-group" id="CantStaff">
                    <label for="txtCantidadStaff">Ingrese Cantidad Staff:</label>
                    <input type="text" class="form-control entero" id="txtCantStaff" name="txtCantStaff" maxlength="1"
                           size="1" placeholder="Cantidad" required max="2">
                </div>
            @endif
            @if(isset($modelEvento->CostoPlatoComida))
                <div class="form-group">
                    <label for="txtMontoComida">Costo Aliminentación:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <label for="txtMontoComida" hidden>Costo Aliminentación:</label>
                        <input type="text" class="form-control decimal" id="txtMontoComida" name="txtMontoComida"
                               value="{{ number_format($modelEvento->CostoPlatoComida,2) }}" required maxlength="5"
                               size="5">
                    </div>
                </div>
            @else
                <div class="form-group" id="MontoComida">
                    <label for="txtMontoComida">Alimentación Por Persona:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <label for="txtMontoComida" hidden>Alimentación Por Persona:</label>
                        <input type="text" class="form-control decimal" id="txtMontoComida" name="txtMontoComida"
                               placeholder="$ 00.00" required maxlength="5" size="5">

                    </div>
                </div>
            @endif
            <div class="form-group" id="txtMetodoPago">
                <label for="txtMetodoPago">Forma de Pago al lugar del Evento:</label>
                @foreach($MetodoPago as $k => $pago)
                    <div class="custom-control custom-radio">
                        <input type="radio" value="{{ $pago->Id }}" id="check_list{{ $k }}" name="checkMetodoPago"
                               class="custom-control-input" {{ $modelEvento->IdMetodoPago == $pago->Id ? 'checked' : null }}>
                        <label class="custom-control-label" for="check_list{{ $k }}">{{ $pago->Nombre }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" id="TotalComida">
                <label for="meetingName2">Total Alimentación:</label>
                <input type="text" class="form-control" id="txtTotalComida" readonly>
            </div>
            <div class="form-group">
                <label for="meetingName2">Total Evento:</label>
                <input type="text" class="form-control" id="txtTotalEvento" readonly>
            </div>
            <div class="form-group">
                <label for="">Total Presupuestado:</label>
                @if(isset($sumaPresupuesto))
                    <input type="hidden" class="form-control" id="txtTotalPresupueto"
                           value="{{$sumaPresupuesto}}">
                    <input type="text" class="form-control" id="txtPresupueto" readonly value="${{$sumaPresupuesto}}">
                @else
                    <input type="hidden" class="form-control" name="txtTotalPresupuesto" id="txtTotalPresupueto">
                    <input type="text" class="form-control" id="txtPresupueto" readonly>
                @endif
            </div>
            <div class="form-group">
                <label for="meetingName2">Desviación:</label>
                <input type="text" class="form-control" id="txtDesviacion" readonly>
            </div>
        </div>
    </div>
</fieldset>
