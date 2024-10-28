<section id="striped-light">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <h4 class="card-title">Lista de presentaciones</h4>
                        <p>A continuación un listado de presentaciones y formas farmaceuticas que pertenecen a la Marca:
                            <strong id="strgMarca">{{ strtoupper($nombreMarca) }}</strong>, si quieres agregar más
                            presentaciones y concentraciones por favor dar click <a class="btn btn-flat btn-danger"
                                                                                    data-toggle="tooltip"
                                                                                    data-title="Crear Nueva Marca"
                                                                                    href="{{  "/pointex/gestion/marca/crear_listar?".base64_encode("crear=1&cmbMarca=$request->idMarca") }}">aquí</a>
                        </p>
                    </div>
                    <div class="card-body card-dashboard table-responsive">
                        @if($dataProductosJson->count()>0)
                            <table class="table " id="dataProducto">
                                <thead>
                                <tr class="headings bg-dark">
                                    <th class="column-title">PRESENTACIÓN</th>
                                    <th class="column-title">FORMA F.</th>
                                    <th class="column-title">CONCENTRACIÓN</th>
                                </tr>
                                </thead>

                            </table>
                        @else
                            <div class="alert alert-danger" role="alert">
                                No se encotraron productos disponibles
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
