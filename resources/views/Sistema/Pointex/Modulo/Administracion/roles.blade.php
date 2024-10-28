@extends('Sistema.Pointex.LayOuts.layout')

@section("css")

@stop
@section('content')


    <section class="basic-elements">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">@if(isset($titleMsg)){{$titleMsg}}@endif</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Filtros de Búsqueda</h4>
                    </div>
                    <div class="card-content">
                        <div class="px-3">
                            <form class="form" method="post" action="{{url("/pointex/administracion/accesos/roles")}}">
                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="txtCUI">CUI</label>
                                                <input type="number" class="form-control" value="@if(isset($data->txtCUI)){{$data->txtCUI}}@endif" id="txtCUI" name="txtCUI" placeholder="Búsqueda por CUI">
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="txtUser">Usuario</label>
                                                <input type="text" class="form-control" value="@if(isset($data->txtUser)){{$data->txtUser}}@elseif(isset($usuarioShearch)){{$usuarioShearch}}@endif" id="txtUser" name="txtUser" placeholder="Búsqueda por Usuario">
                                            </fieldset>
                                        </div>


                                        <div class="col-xl-12 col-lg-12 col-md-12 mb-1 text-center">
                                            <button type="submit" onclick="cargando(1);" class="btn btn-info"><i class="fa fa-search"></i>  Buscar Usuarios</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--/.Accordion wrapper-->

    <section class="basic-elements">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title mb-0">
                            <label class="font-medium-3 text-bold-500">LISTADO DE MODULOS</label>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="card collapse-icon accordion-icon-rotate">

                            @if(isset($modulos))
                                @foreach($modulos as $modulo)
                                    <div id="headingCollapse11" class="card-header pb-3">
                                        <a data-toggle="collapse" href="#mod-{{$modulo->Id}}" aria-expanded="false" aria-controls="collapse11" class="card-title lead collapsed">Módulo {{$modulo->Nombre}} <span class="badge badge-warning mr-2"><i class="{{$modulo->Icono}}"></i></span></a>
                                    </div>
                                    <div id="mod-{{$modulo->Id}}" role="tabpanel" aria-labelledby="headingCollapse11" class="collapse">
                                        <div class="card-content">
                                            <div class="card-body">

                                                @if(isset($modulo->menu))

                                                    @foreach($modulo->menu as $menu)

                                                        @if($menu->IdModulo==$modulo->Id)
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <ul class="list-group">
                                                                        <li class="list-group-item">
                                                                           <span class="badge badge-info mr-2"><i class="{{$menu->Icono}}"></i></span>Menú: <label class="warning">{{trim($menu->Nombre)}}&nbsp;</label>
                                                                            <div class="custom-control-inline custom-switch warning">

                                                                                <input type="checkbox" value="I" onchange="activarMenu(this,'{{$menu->Id}}','{{$idUsuario}}')" class="custom-control-input" id="chk-Menu-{{$menu->Id}}" name="chk-Menu-{{$menu->Id}}" />
                                                                                <label class="custom-control-label warning" for="chk-Menu-{{$menu->Id}}">&nbsp;</label>
                                                                                @if(isset($roles["Menus"]))

                                                                                    @foreach($roles["Menus"] as $rolMenu)
                                                                                        @if($rolMenu->IdMenu==$menu->Id)
                                                                                            <script>
                                                                                                var menus=document.getElementById("chk-Menu-{{$menu->Id}}");
                                                                                                menus.value="A";
                                                                                                menus.checked=true;
                                                                                            </script>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif


                                                                            </div>
                                                                            <ul class="list-group">
                                                                                @if(isset($menu->sub_menu))
                                                                                    @foreach($menu->sub_menu as $sub)

                                                                                        @if($sub->IdMenu==$menu->Id)
                                                                                            <li class="list-group-item" id="li-men-{{$menu->Id}}">

                                                                                                <span class="badge badge-primary mr-2"><i class="{{$sub->Icono}}"></i></span>
                                                                                                <div class="custom-control-inline custom-switch warning">

                                                                                                    <input type="checkbox" value="I" onchange="activarSubMenu(this,'{{$menu->Id}}','{{$sub->Id}}','{{$idUsuario}}')" class="custom-control-input" id="chk-menu-{{$menu->Id}}-sub-{{$sub->Id}}" name="chk-menu-{{$menu->Id}}-sub-{{$sub->Id}}" />
                                                                                                    <label class="custom-control-label warning" for="chk-menu-{{$menu->Id}}-sub-{{$sub->Id}}">{{trim($sub->Nombre)}}</label>

                                                                                                    @if(isset($roles["SubMenus"]))
                                                                                                        @foreach($roles["SubMenus"] as $rolSubMenu)
                                                                                                            @if($rolSubMenu->IdSubMenu==$sub->Id && $rolSubMenu->IdMenu==$menu->Id)
                                                                                                                <script>
                                                                                                                    var submenus=document.getElementById("chk-menu-{{$menu->Id}}-sub-{{$sub->Id}}");
                                                                                                                    submenus.value="A";
                                                                                                                    submenus.checked=true;
                                                                                                                </script>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    @endif

                                                                                                    <script>
                                                                                                        var menus=document.getElementById("chk-Menu-{{$menu->Id}}");
                                                                                                        if(menus.value=="I")
                                                                                                        {
                                                                                                            var submenus=document.getElementById("chk-menu-{{$menu->Id}}-sub-{{$sub->Id}}");
                                                                                                            submenus.disabled=true;
                                                                                                            console.log(menus.value);
                                                                                                        }

                                                                                                    </script>

                                                                                                </div>
                                                                                            </li>

                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            </ul>
                                                                        </li>
                                                                    </ul>

                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <div class="card-footer">
                                    <div class="alert alert-icon-right alert-warning-base-datos alert-dismissible mb-2 " role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Información!</strong> No se encontraron datos, realice una nueva búsqueda por favor
                                    </div>
                                </div>

                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('js')

    {!! HTML::script('/Sistema/Pointex/Modulo/Administracion/js/roles.js') !!}

@stop