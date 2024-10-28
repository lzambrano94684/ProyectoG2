<section class="basic-select">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{--                    <h4 class="card-title mb-0">Filtro de Búsqueda</h4>--}}
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" id="frmBuscar">
{{--                        <form class="form form-horizontal" method="post" action="" novalidate="novalidate" id="form">--}}
                            <div class="form-group row">
                                <label class="label-control">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pais: </label>
                                    <div class="col-md-2">
                                    <input type="text" name="txtCodPais" id="txtCodPais" class="form-control" value="{{$txtCodPais}}" readonly>
                                </div>
                                <div class="col-md-4">
                                    {!! $cmbPais !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="label-control">Distribuidor: </label>
                                <div class="col-md-2">
                                    <input type="text" name="txtDistribuidor" id="txtDistribuidor" class="form-control" value="{{$txtDistribuidor}}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <select id="cmbDistribuidor" name="cmbDistribuidor" class="select2_single">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="label-control">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Farmacia: </label>
                                <div class="col-md-2">
                                    <input type="text" name="txtFarmacia" id="txtFarmacia" class="form-control" value="{{$txtFarmacia}}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <select id="cmbFarmacia" name="cmbFarmacia" class="select2_single">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="label-control">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <div class="col-md-2">
                                    {!! $cmbMeses !!}
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control groupAlmenosUno" id="txtAnio"
                                           name="txtAnio"
                                           placeholder="Año" value="{{ $request->txtAnio }}"
                                           max="{{ date("Y") }}">
                                </div>

                                <div class="col-md-2">
                                    <a class="form-control text-white btn btn-info"
                                       href="{{ request()->url()  }}">
                                        Limpiar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
