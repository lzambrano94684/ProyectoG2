<div class="sidebar-content">
    <div class="nav-container">
        <ul id="main-menu-navigation" data-menu="menu-navigation" data-scroll-to-active="true"
            class="navigation navigation-main">
            <li class="nav-item">
                <a href="{{url("pointex/inicio")}}">
                    <i class="fa fa-home"></i>
                    <span class="menu-title">Inicio</span>
                </a>
            </li>
            @if($aprobacionesCountAll->count()>0)
                @foreach($aprobacionesCountAll->transform(function ($v, $k){
                        if ($v->Estatus ==1)
                            {
                                $v->TotalPendiente = $v->Total;
                            }else{
                                $v->TotalPendiente = 0;
                            }
                        return $v;
                    })->groupBy("IdTipoDoc") as $k => $v)
                    @php($numeroAprobacionesTl = $v->where("Estatus", "1")->sum("TotalLimpio"))
                    @php($numeroAprobaciones = $v->where("Estatus", "1")->count("TotalLimpio"))
                    @php($ejecucionTipo = $v->first() ? $v->first()->EjecucionTipo : null)

                    <li class="nav-item {{ $k == $tipoSelect ? 'active' : null }}">
                        <a href="/pointex/aprobaciones?tipoSelect={{ $k }}">
                            @if($numeroAprobaciones > 0)
                                <span class="badge badge-danger"> {{ $numeroAprobaciones  }}</span>
                                <span
                                    class="badge badge-success">${{ number_format( $numeroAprobacionesTl, 2, '.', ',')  }}</span>
                                <br>
                            @endif
                            <span
                                class="menu-title">{{ str_replace("LQ LQ", "LQ",str_replace("Perfil", "LQ", str_replace("Liquidación", "LQ", $ejecucionTipo))) }}</span>
                        </a>
                    </li>
                @endforeach
            @endif


            @if($menuUniversal->count()>0)
                @foreach ($menuUniversal as $krs => $vrs)
                    <li class="nav-item {{ $tipoSelect == $vrs->IdTipoDoc ? 'active' : null }}">
                        <a href="/pointex/aprobaciones?tipoSelect={{$vrs->IdTipoDoc}}">
                            <span class="menu-title">{{$vrs->Nombre}}</span>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
