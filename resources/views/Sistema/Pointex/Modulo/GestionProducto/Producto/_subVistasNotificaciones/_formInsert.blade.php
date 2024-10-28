<form class="form form-horizontal">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
    <div class="form-body">
        <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
        @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasNotificaciones._inputFormInsert")
    </div>

    <div class="form-actions">
        <button type="button" class="btn btn-raised btn-warning mr-1">
            <i class="ft-x"></i> Cancel
        </button>
        <button type="button" class="btn btn-raised btn-primary">
            <i class="fa fa-check-square-o"></i> Save
        </button>
    </div>
</form>