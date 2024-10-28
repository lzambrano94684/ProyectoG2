<section id="configuration">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <legend class="fieldset-marco text-muted"><h4 class="form-section"><i
                                    class="ft-file-text"></i> @if(isset($titleMsg)){{$titleMsg}}@endif</h4></legend>
                        <form id="formNotaSalesExpenses" name="formNotaSalesExpenses" method="POST"
                              action="/pointex/gestion/descontinuados/crear" enctype="multipart/form-data">
                            <input type="hidden" id="txtId" name="txtId" value="{{$id}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="text-info required" for="cmbDistribuidor">Seleccione
                                        el mes:</label>
                                    {!! $cmbMes!!}
                                </div>
                                <div class="col-md-4">
                                    <label class="text-info required" for="cmbDistribuidor">AÑO:</label>
                                    <input type="number" class="form-control" max="{{ date("Y") }}" min="2020"
                                           value="{{$anio}}" name="txtAnio" id="txtAnio" autocomplete="off">
                                </div>
                                <div class="col-md-4">
                                    <label class="text-info required" for="cmbPais">Seleccione País:</label>
                                    {!! $cmbPais !!}
                                </div>

{{--                                @if($id)--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <label class="text-info required" for="cmbDistribuidor">Seleccione--}}
{{--                                            Distribuidor:</label>--}}
{{--                                        {!! $cmbDistribuidor!!}--}}
{{--                                    </div>--}}
                                    <div class="col-md-4">
                                        <label class="text-info required" for="cmbDistribuidor">Seleccione
                                            los Productos:</label>
                                        {!! $cmbProducto!!}
                                    </div>

{{--                                @else--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <label class="text-info required" for="cmbDistribuidor">Seleccione--}}
{{--                                            Distribuidor:</label>--}}
{{--                                        <select id="cmbDistribuidor" name="cmbDistribuidor" class="select2_single"--}}
{{--                                                required>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <label class="text-info required" for="cmbDistribuidor">Seleccione--}}
{{--                                            los Productos:</label>--}}
{{--                                        <select id="cmbProducto" name="cmbProducto[]" class="select2_single" multiple>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}

{{--                                @endif--}}
                            </div>
                            <!--footer -->
                            <div class="form-actions">
                                <a type="button" class="btn btn-raised btn-warning mr-1"
                                   href="{{  url()->current() }}">
                                    <i class="ft-arrow-left"></i> Regresar
                                </a>
                                <button class="btn btn-raised btn-primary" id="Idbtn" onclick="ShowSelected();">
                                    <i class="ft-save"></i> Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
