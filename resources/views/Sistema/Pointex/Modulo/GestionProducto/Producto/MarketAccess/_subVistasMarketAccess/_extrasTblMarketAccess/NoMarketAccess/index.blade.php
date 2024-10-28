<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#sub31" class="nav-link" onmousemove="datatableViews.draw();">Aprobados</a>
        </li>
        <li><a href="#sub32" class="nav-link" onmousemove="datatableViews.draw();">Rechazados</a>
        </li>
        <li><a href="#sub33" class="nav-link" onmousemove="datatableViews.draw();">Arbol de Aprobacion</a>
        </li>
        <li><a href="#sub34" class="nav-link" onmousemove="datatableViews.draw();">Creados</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="sub31">
            @include("Sistema.Pointex.Modulo.GestionProducto.Producto.MarketAccess._subVistasMarketAccess._extrasTblMarketAccess.NoMarketAccess._tblAprobados")
        </div>
        <div class="tab-pane fade" id="sub32">
            @include("Sistema.Pointex.Modulo.GestionProducto.Producto.MarketAccess._subVistasMarketAccess._extrasTblMarketAccess.NoMarketAccess._tblRechazados")
        </div>
        <div class="tab-pane fade" id="sub33">
            @include("Sistema.Pointex.Modulo.GestionProducto.Producto.MarketAccess._subVistasMarketAccess._extrasTblMarketAccess.NoMarketAccess._tblPendientes")
        </div>
        <div class="tab-pane fade" id="sub34">
            @include("Sistema.Pointex.Modulo.GestionProducto.Producto.MarketAccess._subVistasMarketAccess._extrasTblMarketAccess.NoMarketAccess._tblCreados")
        </div>
    </div>
</div>




















<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
            Aprobados</a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
            Rechazados</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"></div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
</div>



<div class="card-content">
    <div class="card-body">
        <div class="nav-vertical">
            <ul class="nav nav-tabs nav-left flex-column">
                <li class="nav-item">
                    <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                       href="#tab1" aria-expanded="true">Aprobados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
                       href="#tab2" aria-expanded="false">Rechazados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"
                       href="#tab3" aria-expanded="false">Pendientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4"
                       href="#tab4" aria-expanded="false">Creados</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true"
                     aria-labelledby="base-tab1">
                    @include("Sistema.Pointex.Modulo.GestionProducto.Producto.MarketAccess._subVistasMarketAccess._extrasTblMarketAccess.MarketAccess._tblAprobados")
                </div>
                <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                    @include("Sistema.Pointex.Modulo.GestionProducto.Producto.MarketAccess._subVistasMarketAccess._extrasTblMarketAccess.MarketAccess._tblRechazados")
                </div>
                <div class="tab-pane" id="tab3" aria-labelledby="base-tab3">
                    @include("Sistema.Pointex.Modulo.GestionProducto.Producto.MarketAccess._subVistasMarketAccess._extrasTblMarketAccess.MarketAccess._tblPendientes")
                </div>
                <div class="tab-pane" id="tab4" aria-labelledby="base-tab4">
                    @include("Sistema.Pointex.Modulo.GestionProducto.Producto.MarketAccess._subVistasMarketAccess._extrasTblMarketAccess.MarketAccess._tblCreados")
                </div>
            </div>
        </div>
    </div>
</div>
