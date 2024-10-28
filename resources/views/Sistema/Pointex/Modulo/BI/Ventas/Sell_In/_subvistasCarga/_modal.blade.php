<div class="modal fade text-left" id="bootstrap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h3 class="modal-title" id="myModalLabel35"> Emparejar Inputs</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <input type="hidden" value="{{ base64_encode($dataFiltrada->toJson()) }}"
                   name="txtVentaFiltrada">
            @php($inputsArray = $inputs->transform(function ($v, $k){ return $k; })->toArray())
            <div class="modal-body">
                <form action="/pointex/bi/ventas/save_ventas" method="post" id="frmVentaFiltrada">
                    <input type="hidden" value="{{ base64_encode($dataFiltrada->toJson()) }}"
                           name="txtVentaFiltrada">
                    <input type="hidden"  name="Tpost" id="modalTpost">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" max="{{ date("Y-m") }}" id="txtFecha" name="txtFecha" readonly>
                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbFecha">Fecha</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Fecha" => $inputsArray]), "FechaFact_",
                                    false, ["name" => "cmbFecha", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbPais">Pais</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Pais" => $inputsArray]), "País CLF",
                                    false, ["name" => "cmbPais", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbProducto">Codigo SAP</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Producto" => $inputsArray]), "Material",
                                    false, ["name" => "cmbProducto", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbDistribuidor">Distribuidor</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Distribuidor" => $inputsArray]), "Cliente",
                                    false, ["name" => "cmbDistribuidor", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbFactura">Factura</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Factura" => $inputsArray]), "Factura",
                                    false, ["name" => "cmbFactura", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbFechaVencimiento">Fecha Vencimiento</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["FechaVencimiento" => $inputsArray]), "Fecha Caducidad",
                                    false, ["name" => "cmbFechaVencimiento", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbNPedido">No.Pedido</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Nº Ped_ Cliente cab" => $inputsArray]), "Nº Ped_ Cliente cab",
                                    false, ["name" => "cmbNPedido", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbReferencia">Referencia</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Referencia" => $inputsArray]), "Referencia",
                                    false, ["name" => "cmbReferencia", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbPrecio">Precio</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Precio" => $inputsArray]), "Precio VTA_BRUTA",
                                    false, ["name" => "cmbPrecio", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbUnidades">Unidades</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Unidades" => $inputsArray]), "Ctd_facturada",
                                    false, ["name" => "cmbUnidades", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbVenta100">Venta100</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Venta100" => $inputsArray]), "VENTA BRUTA USD",
                                    false, ["name" => "cmbVenta100", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbIncoterm">Incoterm</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Incoterm" => $inputsArray]), "incoterm",
                                    false, ["name" => "cmbIncoterm", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbVenta97">Venta97</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Venta97" => $inputsArray]), "Venta 97",
                                    false, ["name" => "cmbVenta97", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbFechaVencimiento">Lote</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["Lote" => $inputsArray]), "Lote",
                                    false, ["name" => "cmbLote", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="cmbFechaVencimiento">Tipo de Venta</label><br>
                                {!!
                                $thisController->SelectedUniversales(collect(["cmbTipoVenta" => $inputsArray]), "CDis",
                                    false, ["name" => "cmbTipoVenta", "class", "form-control"], false, false, false, false, false);
                                    !!}
                            </fieldset>
                        </div>
                    </div>


                </form>
                <br>
            </div>
            <div class="modal-footer bg-dark">
                <input type="reset" class="btn btn-secondary btn-lg" data-dismiss="modal" value="Cerrar">
                <input type="button" class="btn btn-primary btn-lg" value="Guardar" id="btnGuardaVentaModal">
            </div>
        </div>
    </div>
</div>
