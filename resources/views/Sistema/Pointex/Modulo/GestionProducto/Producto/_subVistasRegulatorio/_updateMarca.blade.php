@if($request->actualiza_marca_lista)
    @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasRegulatorio._extrasUpdateMarca._tblUpdateMarca")
@else
    @include("Sistema.Pointex.Modulo.GestionProducto.Producto._subVistasRegulatorio._extrasUpdateMarca._updateMarca")
@endif