<fieldset>
    <div class="row">
        <div class="col-md-6">
                <div class="form-group" id="txtCiudad">
                    <label for="txtCiudad">Ciudad/Departamento/Provincia:</label>
                    <input type="text" class="form-control" id="txtCiudad"
                           name="txtCiudad">
                </div>
                <div class="form-group" id="Ubicacion">
                    <label for="txtUbuciacionEvento">Ubicación del Evento (Restaurante/Hotel):</label>
                    <input type="text" class="form-control" id="txtUbuciacionEvento"
                           name="txtUbuciacionEvento" value="{{ $modelEvento->LugarEvento }}">
                </div>
                <div class="form-group" id="txtPlataforma">
                    <label for="txtPlataforma">Nombre de la Plataforma:</label>
                    <input type="text" class="form-control" id="txtPlataforma"
                           name="txtPlataforma" value="">
                </div>
            <div class="form-group">
                <label for="txtTituloEvento">Título del Evento:</label>
                <input type="text" class="form-control" id="txtTituloEvento"
                       name="txtTituloEvento" value="{{ $modelEvento->NombreEvento }}" required>
            </div>
            <div class="form-group col-md-10">
                <label for="slcEspecialidad"> Seleccion Especialidad de invitados:</label>
                {!! $slcEspecialidades !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="txtObjetivo">Objetivos del Evento:</label>
                <input name="txtObjetivo" id="txtObjetivo" rows="2" required
                       class="form-control" value="{{$modelEvento->Objetivo}}">
            </div>
            <div class="form-group">
                <label for="txtFecha">Fecha del Evento:</label>
                <input type="date" id="txtFecha" class="form-control"
                       name="txtFecha" data-toggle="tooltip" required
                       data-trigger="hover" data-placement="top"
                       data-title="Date Opened" min="{{date("Y-m-d")}}"
                       value="{{ $modelEvento->convertDate("fecha")->first()}}">
            </div>
            <div class="form-group">
                <label for="txtHora">Hora del Evento:</label>
                <div class="position-relative has-icon-left">
                    <input type="time" id="txtHora" class="form-control"
                           name="txtHora"
                           value="{{ $modelEvento->convertDate("hora")->last() }}" required>
                    <div class="form-control-position">
                        <i class="ft-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
