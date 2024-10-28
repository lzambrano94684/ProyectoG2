<!DOCTYPE html>
<html lang="es" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="POINTEX">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>POINTEX EXELTIS - @yield('title')</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    <link rel="shortcut icon" type="image/png" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    @include("Sistema.Pointex.LayOuts.styles")
    @yield('css')

</head>
<body data-col="2-columns" class=" 2-columns  pace-done">
<div class="wrapper sidebar-sm">
    <div data-active-color="white" data-background-color="exeltis" class="app-sidebar">
        <div class="sidebar-header">
            <div class="logo clearfix">
                <a href="{{url("/pointex/inicio")}}" class="logo-text float-left">
                    <div class="logo-img">
                        <img style="width: 35px;" src="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}"/>
                    </div>
                    <span class="text align-middle"
                          style="font-family: unset !important; text-transform: capitalize !important;">Pointex
                        <br>
                         <h6 style="text-align: center;margin-top: 15px"><b></b></h6>
                    </span>
                </a>
                <a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block">
                    <i data-toggle="expanded" class="toggle-icon ft-toggle-right"></i>
                </a>
                <a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none">
                    <i class="ft-x"></i>
                </a>
            </div>
        </div>
        <div class="sidebar-content">
            <div class="nav-container">
                <ul id="main-menu-navigation" data-menu="menu-navigation" data-scroll-to-active="true"
                    class="navigation navigation-main">
                    <li class="nav-item active">
                        <a href="{{url("/agenda/0")}}">
                            <i class="fa fa-home"></i>
                            <span class="menu-title">Agenda</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- main menu content-->
    </div>
    <!-- / main menu-->

    <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
            <div class="content-wrapper"><!-- Basic Elements start -->
            @yield('content')
            </div>
        </div>
    <!-- END : End Main Content-->

        <!-- BEGIN : Footer-->
        <footer class="footer footer-static footer-light">
            <p class="clearfix text-muted text-sm-center px-2"><span>Copyright  &copy; {{date("Y")}} <a
                            href="https://www.exeltis.com" id="pixinventLink"
                            target="_blank" class="text-bold-800 primary darken-2">POINTEX Exeltis</a>, Rethinking . <i class="fas fa-vial warning"></i></span>
            </p>
        </footer>
        <!-- End : Footer-->

    </div>
</div>


{{--Modal para el gift cargando--}}
<div id="divCargando" class=""></div>
{{--Token--}}
<input type="hidden" id="_token" value="{{csrf_token()}}">
<div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block">
    <a class="customizer-close"><i class="ft-x font-medium-3"></i></a>

    <a id="customizer-toggle-icon" class="customizer-toggle bg-danger">
        <i class="ft-settings font-medium-4 fa fa-spin white align-middle" ></i>
    </a>
    <div class="customizer-content p-3 ps-container ps-theme-dark">
        <h4 class="text-uppercase mb-0 text-bold-400">Acciones </h4>
        <hr>
        <!-- Layout Options-->
        <h6 class="text-center text-bold-500 mb-3 text-uppercase" style="cursor: pointer"
            onclick="window.location.href='{{url("pointex/perfil")}}'"><i class="fas fa-user-edit"></i> Perfil</h6>
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase" style="cursor: pointer"
            onclick="window.location.href='{{url("pointex/ayuda")}}'"><i class="fas fa-life-ring"></i> Ayuda</h6>
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase" style="cursor: pointer"
            onclick="window.location.href='{{url("/salir")}}'"><i class="fas fa-sign-out-alt"></i> Salir</h6>
        <hr>
        <a id="navbar-fullscreen" title="Pantalla Completa" href="javascript:;"
           class="nav-link apptogglefullscreen"><i
                    class="ft-maximize font-medium-3 blue-grey darken-4"></i>
            <p class="d-none">Pantalla Completa</p></a>
    </div>
</div>

</body>



@include("Sistema.Pointex.LayOuts.scripts")
@yield('js')

</html>
@if(session()->get('msg.0'))
    @php($msg = session()->get('msg.0'))
    <script>
        toastr.options.showMethod = 'slideDown';
        toastr.options.progressBar = true;
        @switch($msg["Tipo"])
        @case("error")
        toastr.error('{{$msg["Descripcion"]}}', 'Mensaje Del Sistema!');
        @break
        @case("info")
        toastr.info('{{$msg["Descripcion"]}}', 'Mensaje Del Sistema!');
        @break
        @case("success")
        toastr.success('{{$msg["Descripcion"]}}', 'Mensaje Del Sistema!');
        @break
        @case("warning")
        toastr.warning('{{$msg["Descripcion"]}}', 'Mensaje Del Sistema!');
        @break
        @endswitch
    </script>
    @php(session()->forget('msg'))
@endif
