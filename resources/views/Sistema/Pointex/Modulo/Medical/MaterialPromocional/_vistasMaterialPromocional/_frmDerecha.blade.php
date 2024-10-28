<input type="hidden" id="txtIdArbol" name="txtIdArbol" value="{{$IdArbol}}">
<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbPais">País/Región:</label>
        {!!  $cmbPais !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="CodMaterialPromocional">Código:</label>
        <input type="text" id="CodMaterialPromocional" name="CodMaterialPromocional" class="form-control"
               readonly value="{{$modelSolicitudMateriales->Codigo}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbPersona">Solicitante:</label>
        {!! $cmbPersona !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <label class="text-info" for="cmbPublico">Dirigido A:</label>
        {!! $cmbPublicoDirigido !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-12 mb-2">
        <div class="form-group">
            <label  class="text-info" for="txtFecha">Fecha de Solicitud:</label>
            <input type="date" id="txtFecha" class="form-control"
                   name="txtFecha" data-toggle="tooltip" required
                   data-trigger="hover" data-placement="top"
                   data-title="Date Opened"
                   value="{{$modelSolicitudMateriales->FechaSolicitud}}">
        </div>
    </div>
</div>


@if($ver==1)
    @include("Sistema.Pointex.Modulo.Medical.MaterialPromocional._vistasMaterialPromocional._archivos._verArchivo")
@elseif($id)
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="baseIcon-tab2" data-toggle="tab" aria-controls="tabIcon2" href="#tabIcon2"
               aria-expanded="false"><i class="icon-cloud-download"></i> Ver Archivo</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="baseIcon-tab1" data-toggle="tab" aria-controls="tabIcon1" href="#tabIcon1"
               aria-expanded="true"><i class="icon-cloud-upload"></i> Subir Archivo</a>
        </li>
    </ul>
    <div class="tab-content px-1 pt-1">
        <div class="tab-pane active" id="tabIcon2" aria-labelledby="baseIcon-tab2">
            @include("Sistema.Pointex.Modulo.Medical.MaterialPromocional._vistasMaterialPromocional._archivos._verArchivo")
        </div>

        <div role="tabpanel" class="tab-pane " id="tabIcon1" aria-expanded="true" aria-labelledby="baseIcon-tab1">
            <div class="row">
                <div class="form-group col-6 mb-2">
                    <label class="text-info" for="txtSubirImagen">Subir Imágen:</label>
                    <input type='file' name='filename' accept="image/png, .jpeg, .jpg, application/pdf"/>
                </div>
            </div>
        </div>
    </div>
@else
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="baseIcon-tab1" data-toggle="tab" aria-controls="tabIcon1" href="#tabIcon1"
               aria-expanded="true"><i class="icon-cloud-upload"></i> Subir Archivo</a>
        </li>
    </ul>
    <div class="tab-content px-1 pt-1">
        <div role="tabpanel" class="tab-pane active" id="tabIcon1" aria-expanded="true" aria-labelledby="baseIcon-tab1">
            <div class="row">
                <div class="form-group col-6 mb-2">
                    <label class="text-info" for="txtSubirImagen">Subir Imágen:</label>
                    <input type='file' name='filename' accept="image/png, .jpeg, .jpg, application/pdf"/>
                </div>
            </div>
        </div>
    </div>
@endif

