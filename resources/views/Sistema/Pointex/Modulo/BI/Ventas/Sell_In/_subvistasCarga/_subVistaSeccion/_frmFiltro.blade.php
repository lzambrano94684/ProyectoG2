<form action="/pointex/bi/ventas/save_filtro" method="post" id="frmFiltro">
    @csrf
    <div class="row">
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-warning btn-block" id="btnGuardaVenta"
                    data-toggle="modal"
                    data-target="#bootstrap">
                <i
                    class="fas fa-save"></i> Guardar Ventas
            </button>
        </div>
        <div class="col-md-6 text-right">
            <button type="submit" class="btn btn-success btn-block" id="btnEnviaFiltro">
                <i
                    class="fas fa-funnel-dollar"></i> Filtrar
            </button>
        </div>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <tbody>
            <tr>
                @foreach($inputs as $k => $v)
                    @php($nombreCmb = "cmb$k")
                    @php($whereInput = $dataGetInput->where("Nombre", $nombreCmb)->first())
                    @php($arraySelect = isset($whereInput->Inputs) ? json_decode(base64_decode($whereInput->Inputs), 1) : [])

                    <th>
                        <b>{{ $k }}</b> Discriminar
                        <input type="checkbox" name="filtro[{{ $nombreCmb }}]"
                               value="1" {{ isset($whereInput->Tipo) ? 'checked' : null }}/>
                        {!!
                $thisController->SelectedUniversales(collect([$k => $v]), $arraySelect,
                    false, [
                        "class" => "form-control select2_single $nombreCmb",
                        "name" => "$nombreCmb"."[]",
                        "id" => "$nombreCmb",
                        "multiple" => "multiple"
                    ], false, false, false, true, false);
                    !!}
                    </th>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
</form>
