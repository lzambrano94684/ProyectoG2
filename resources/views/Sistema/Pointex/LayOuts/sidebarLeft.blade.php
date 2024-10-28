@php
    $path= request()->path();
    $inicioActivo = $path == "pointex/inicio" ? "active" : null;
    $helodeskActivo = $path == "pointex/ticket/osticket" ? "active" : null;
    $reservar = $path == "pointex/reservar" ? "active" : null;
    $perfiles = session()->get("Accesos.perfiles");
    $path = "/$path";
@endphp
<div class="sidebar-content">
    <div class="nav-container">
        <ul id="main-menu-navigation" data-menu="menu-navigation" data-scroll-to-active="true"
            class="navigation navigation-main">
            <li class="nav-item {{ $inicioActivo }}">
                <a href="{{url("pointex/inicio")}}">
                    <i class="fa fa-home"></i>
                    <span class="menu-title">Inicio</span>
                </a>
            </li>

{{--            <li class="nav-item {{ $inicioActivo }}">--}}
{{--                <a href="{{url("/pointex/visita_medica/dashboard")}}">--}}
{{--                    <i class="fa fa-bar-chart"></i>--}}
{{--                    <span class="menu-title">DASHBOARD</span>--}}
{{--                </a>--}}
{{--            </li>--}}

            @if($perfiles)
                @foreach($perfiles->sortBy('Nombre')->values()->all() as $kp => $vp)
                    @php
                        $urlArray = collect([]);
                        if ($vp->Menu && $vp->Menu->count() > 0){
                            $vp->Menu->each(function ($v)use($urlArray){
                                $urlArray->push(trim($v->URL));
                                if ($v->SubMenu){
                                    if ($v->SubMenu->count()>0){
                                        $v->SubMenu->each(function ($vi) use($urlArray){
                                            $urlArray->push(trim($vi->URL));
                                        });
                                    }
                                }
                            });
                        }
                        $subMenuUrl =[];
                        $moduloActive = in_array($path,$urlArray->toArray()) ? "open" : null;
                    @endphp
                    <li class="has-sub nav-item {{ $moduloActive }}">
                        <a href="javascript:void(0)">
                            <i class="{{ trim($vp->Icono) }}"></i>
                            <span data-i18n="" class="menu-title">{{ trim($vp->Nombre) }}</span>
                        </a>
                        @if($vp->Menu)
                            <ul class="menu-content">

                                @foreach($vp->Menu->sortBy('Nombre')->values()->all() as $km => $vm)
                                    @if(isset($vm->SubMenu) && $vm->SubMenu->count()>0)
                                        @php
                                            $urlMenu="javascript:void(0)";
                                            $menuActivo = in_array($path,$vm->SubMenu->pluck("URL")->toArray()) ? "open" : null
                                        @endphp
                                        <li class="has-sub {{ $menuActivo }}">
                                            <a href="{{ $urlMenu }}" class="menu-item">{{ trim($vm->Nombre) }}</a>
                                            <ul class="menu-content">
                                                @foreach($vm->SubMenu->sortBy('Nombre')->values()->all() as $ksm => $vsm)
                                                    @php
                                                        $urlSubMenu=trim($vsm->URL);
                                                        $subMenuActivo = $urlSubMenu == $path ? "active" : null
                                                    @endphp
                                                    <li class="{{ $subMenuActivo }}">
                                                        <a href="{{ $urlSubMenu }}" class="menu-item">
                                                            <i class="{{ trim($vsm->Icono) }}"></i>
                                                            {{ trim($vsm->Nombre) }}
                                                        </a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </li>
                                    @else
                                        @php
                                            $urlMenu=trim($vm->URL);
                                            $menuActivo = $path == $urlMenu ? "active" : null
                                        @endphp
                                        <li class="has-sub {{ $menuActivo }}">
                                            <a href="{{ $urlMenu }}" class="menu-item {{ $menuActivo }}">
                                                <i class="{{ trim($vm->Icono) }}"></i>
                                                {{ trim($vm->Nombre) }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif
            <li class="nav-item">
                <a href="javascript:void(0)">
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)">
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)">
                </a>
            </li>
        </ul>
    </div>
</div>



