<section id="icon-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="icons-tab-steps wizard-circle" method="post" action="nueva_marca"
                              id="frmIngresoMarca">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <!-- Step 1 -->
                            <h6>Datos de la Marca</h6>
                            @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._wizard._paso1")
                            <!-- Step 2 -->
                            <h6>Presentaciones</h6>
                            @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._wizard._paso2")
                            <!-- Step 3 -->
                            <h6>Formas Farmacéuticas</h6>
                            @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasMarca._wizard._paso3")
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>