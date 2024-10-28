<!-- Modal -->
<div class="modal fade" id="mdlInsertRegSanitario" tabindex="-1" role="dialog" aria-labelledby="mdlInsertRegSanitarioTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark white">
                <h5 class="modal-title" id="mdlInsertRegSanitarioTitle">Crear Nuevo Registro Sanitario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="frmIngresoRegistro">@include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasRegulatorio._frmRegSanitario")</div>
                        <div class="col-md-12" id="vistaIngresoRegistro"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="groupBtnSubmitModal"></div>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                    <i class="far fa-times-circle"></i> Cerrar
                </button>
                <button type="button" class="btn btn-primary" id="btnGuardar">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>



