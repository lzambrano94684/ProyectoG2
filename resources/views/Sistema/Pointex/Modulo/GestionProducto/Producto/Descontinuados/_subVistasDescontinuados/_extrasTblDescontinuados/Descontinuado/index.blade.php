<div class="tabbable">
    <ul class="nav nav-tabs">
        <li ><a href="#sub11" class="nav-link" onmousemove="datatableViews.draw();">Aprobados</a>
        </li>
        <li><a href="#sub12"  class="nav-link" onmousemove="datatableViews.draw();">Rechazados</a>
        </li>
        <li><a href="#sub13" class="nav-link" onmousemove="datatableViews.draw();">Arbol de Aprobacion</a>
        </li>
        <li><a href="#sub14" class="nav-link" onmousemove="datatableViews.draw();">Creados</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="sub11">
            @include("Sistema.Pointex.Modulo.GestionProducto.Producto.Descontinuados._subVistasDescontinuados._extrasTblDescontinuados.Descontinuado._tblAprobados")
        </div>
        <div class="tab-pane" id="sub12">
            @include("Sistema.Pointex.Modulo.GestionProducto.Producto.Descontinuados._subVistasDescontinuados._extrasTblDescontinuados.Descontinuado._tblRechazados")
        </div>
        <div class="tab-pane fade" id="sub13">
            @include("Sistema.Pointex.Modulo.GestionProducto.Producto.Descontinuados._subVistasDescontinuados._extrasTblDescontinuados.Descontinuado._tblPendientes")
        </div>
        <div class="tab-pane fade" id="sub14">
            @include("Sistema.Pointex.Modulo.GestionProducto.Producto.Descontinuados._subVistasDescontinuados._extrasTblDescontinuados.Descontinuado._tblCreados")
        </div>
    </div>
</div>
