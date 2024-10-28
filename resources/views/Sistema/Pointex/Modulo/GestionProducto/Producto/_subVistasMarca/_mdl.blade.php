<!-- Modal -->
<div class="modal fade" id="mdlMarca" tabindex="-1" role="dialog" aria-labelledby="mdlTitleMarca" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark white">
                <h5 class="modal-title" id="mdlTitleMarca"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="frmMarca" style="display: none;">
                            <form action="/pointex/gestion/marca/mod_marca" id="frmEditMarca" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._wizard._paso1")
                            </form>
                        </div>
                        <div class="col-md-12" id="frmProducto" style="display: none;">
                            <form action="/pointex/gestion/marca/mod_producto" id="frmEditProducto" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._wizard._paso2")
                                @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._wizard._paso3")
                            </form>
                        </div>
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



