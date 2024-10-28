<fieldset>
    <div class="row">
        <div class="col-md-6">
            <fieldset class="form-group">
                <label for="slcConferencista">Seleccione Conferencista:</label>
                <a href="/pointex/medical/eventos/educ/conferencista" target="_blank">Nuevo</a>
                <i title="Actualizar Catálogo " class="fas fa-sync-alt"
                   onclick="loadItemsToSelect('/pointex/medical/eventos/educ/speaker')" style="cursor:pointer;"></i>
                <select id="slcConferencista" name="slcConferencista" required class="form-control select2_single"
                        style="width: 100%;" data-toggle="tooltip" data-trigger="hover" data-placement="top"
                        data-title="Priority">
                    <option value="">Seleccione Speaker</option>
                </select>

            <!-- <input type="text" class="form-control" id="txtNombreConferencista" name="txtNombreConferencista" required value="{{$modelEvento->NombreSpeaker}}">-->
            </fieldset>
        </div>

        <div class="col-md-6">
            <div class="form-group">
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
    </div>
</fieldset>
