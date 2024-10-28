<div class="row" matchheight="card">
    @foreach($arrayColorEstatus as $k => $v)
        @php($class = 12/count($arrayColorEstatus))
        <div class="col-md-{{ $class }}">
            <div class="card">
                <div class="card-content">
                    <div
                        class="px-3 py-1 {{ $k == $request->estado ? "btn-raised btn-outline-$v" : "btn-flat btn-$v" }} "
                        style="cursor: pointer;"
                        onclick="nuevaUrl('{{ "/pointex/aprobaciones?tipoSelect=$tipoSelect&estado=$k&txtAnio=$anio&txtMes=$mes" }}');">
                        <div class="media">
                            @if($k == 1)
                                <div class="media-body text-left">
                                    <b><span>{{ $estatos[$k] }}</span></b><br>
                                    <br>
                                    <b><span>{{ $aprobacionesCountAll->where("IdTipoDoc", $tipoSelect)->where("Estatus", "$k")
                                                ->count("Total") }}</span></b><br>
                                    <b><span>${{ number_format($aprobacionesCountAll->where("IdTipoDoc", $tipoSelect)->where("Estatus", $k)->sum("TotalLimpio"), 2, '.', ',') }}</span></b>
                                </div>
                            @else
                                <div class="media-body text-left">
                                    <b><span>{{ $estatos[$k] }}</span></b><br>
                                    <span>{{ $mesNombre }}</span>
                                    <br>
                                    <b><span>{{ $aprobacionesCount->where("IdTipoDoc", $tipoSelect)->where("Estatus", "$k")
                                                ->count("Total") }}</span></b><br>
                                    <b><span>${{ number_format($aprobacionesCount->where("IdTipoDoc", $tipoSelect)->where("Estatus", $k)->sum("TotalLimpio"), 2, '.', ',') }}</span></b>
                                </div>
                                <div class="media-body text-left">
                                    <br>
                                    <span>{{ $anio }}</span><br>
                                    <b><span>{{ $aprobacionesCountAnio->where("IdTipoDoc", $tipoSelect)->where("Estatus", "$k")
                                                ->count("Total") }}</span></b><br>
                                    <b><span>${{ number_format($aprobacionesCountAnio->where("IdTipoDoc", $tipoSelect)->where("Estatus", $k)->sum("TotalLimpio"), 2, '.', ',') }}</span></b>
                                </div>
                            @endif
                            <div class="media-right align-self-center">
                                <i class="{{ $arrayIconEstatus[$k] }} {{ $v }} font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
