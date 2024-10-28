@php
    $disp = 0;
        try {
            $useragent = $_SERVER["HTTP_USER_AGENT"];
            $disp = stripos($useragent, "mobile")!== false ? 1 : 0;
        }catch (\Exception $e){
        }
@endphp
@php($persona = session("Accesos.usuario.Persona"))
<!DOCTYPE html>
<html lang="es" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="POINTEX">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PX @yield('title') - {{ $persona ? $persona->Nombres.".".$persona->Apellidos : null}}</title>

   
    @include("Sistema.Pointex.LayOuts.styles")
    @yield('css')
</head>
<body data-col="2-columns" class=" 2-columns  pace-done">
<div class="wrapper sidebar-sm">
    @if(!isset($request->form))
        <div data-active-color="white" data-background-color="exeltis" class="app-sidebar">
            <div class="sidebar-header">
                <div class="logo clearfix">
                    <a href="{{url("/pointex/inicio")}}" class="logo-text float-left">
                        <div class="logo-img">
                            <img style="width: 150px;height: 110px" src="{{asset("Sistema/Pointex/Modulo/img/Logovm.png")}}"/>
                        </div>
                        <br><br>
                        <span class="text align-middle"
                              style="font-family: unset !important; text-transform: capitalize !important;">Visita Médica {{ env("NAME") }}
                            {!! config("entorno.ENTORNO") == 'DESARROLLO' ? "<br>Desarrollo" : NULL !!}
                            <br>
                            @if($persona)
                                <h6 style="text-align: center;margin-top: 15px"><b>{{ $persona->Nombres." ".$persona->Apellidos }}</b></h6>
                            @endif
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
        @include('Sistema.Pointex.LayOuts.sidebarLeft')
        <!-- main menu content-->
        </div>
        <!-- / main menu-->

        <nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
        </nav>
    @endif
    @if(!isset($request->form))
        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
                <div class="content-wrapper"><!-- Basic Elements start -->
                    @yield('content')
                </div>
            </div>
            <!-- END : End Main Content-->
        @if(!isset($request->form))
            <!-- BEGIN : Footer-->
                <footer class="footer footer-static footer-light">
                   
                </footer>
                <!-- End : Footer-->
            @endif
        </div>
    @else
        @yield('content')
    @endif


</div>


{{--Modal para el gift cargando--}}
<div id="divCargando" class="">
    <button id="buttonRC">X</button>
</div>
{{--Token--}}
<input type="hidden" id="_token" value="{{csrf_token()}}">
@if(!isset($request->form))
    <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block">
        <a class="customizer-close"><i class="ft-x font-medium-3"></i></a>

        <a id="customizer-toggle-icon" class="customizer-toggle bg-danger">
            <i class="ft-settings font-medium-4 fa fa-spin white align-middle"></i>
        </a>
        <div class="customizer-content p-3 ps-container ps-theme-dark">
            <h4 class="text-uppercase mb-0 text-bold-400">Acciones </h4>
            <hr>
            <!-- Layout Options-->
            <h6 class="text-center text-bold-500 mb-3 text-uppercase" style="cursor: pointer"
                onclick="window.location.href='{{url("pointex/perfil")}}'"><i class="fas fa-user-edit"></i> Perfil</h6>
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
@endif
</body>


@include("Sistema.Pointex.LayOuts.scripts")
@yield('js')

</html>
@if(!env("APP_ENTORNO"))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZD7HJYQ3CW"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-ZD7HJYQ3CW');
    </script>
@endif
@if(session()->get('msg.0'))
    @php($description = session()->get('msg.0.Descripcion'))
    @if(isset($activaModalPedido))
        <script>
            var modals = [];
            modals.push({title: '{{ session()->get('msg.0.Tipo') }}', text: '{{$description}}'});
            swal.queue(modals);
        </script>
    @else
        <script>
            toastr.options.showMethod = 'slideDown';
            toastr.options.progressBar = true;
            @switch(session()->get('msg.0.Tipo'))
            @case("error")
            toastr.error('{{$description}}', 'Mensaje Del Sistema!');
            @break
            @case("info")
            toastr.info('{{$description}}', 'Mensaje Del Sistema!');
            @break
            @case("success")
            toastr.success('{{$description}}', 'Mensaje Del Sistema!');
            @break
            @case("warning")
            toastr.warning('{{$description}}', 'Mensaje Del Sistema!');
            @break
            @endswitch
        </script>
    @endif
    @php(session()->forget('msg'))
@endif
