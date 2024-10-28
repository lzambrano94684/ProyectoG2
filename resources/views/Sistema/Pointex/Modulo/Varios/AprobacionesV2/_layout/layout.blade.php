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
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    <link rel="shortcut icon" type="image/png" href="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}">
    @include("Sistema.Pointex.LayOuts.styles")
    <style>
        table, caption, tbody, tfoot, thead, tr, th, td {
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            font-size: 100%;
            vertical-align: baseline;
            background: transparent;
        }
    </style>
    {!! HTML::style('https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css') !!}
    @php($libs2Load = ["DataTables" => true, "SweetAlert" => true, "Select2" => true])
</head>
<body data-col="2-columns" class=" 2-columns  pace-done">
<div class="wrapper sidebar-sm">
    @if(!isset($request->form))
        <div data-active-color="white" data-background-color="exeltis" class="app-sidebar">
            <div class="sidebar-header">
                <div class="logo clearfix">
                    <a href="{{url("/pointex/inicio")}}" class="logo-text float-left">
                        <div class="logo-img">
                            <img style="width: 35px;" src="{{asset("Sistema/Pointex/Modulo/img/Logo.png")}}"/>
                        </div>
                        <span class="text align-middle"
                              style="font-family: unset !important; text-transform: capitalize !important;">Pointex {{ env("NAME") }}
                            {!! env("DB_PASSWORD") == 'ExeltisD1sarr0ll0' ? "<br>Desarrollo" : NULL !!}
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
        @include('Sistema.Pointex.Modulo.Varios.AprobacionesV2._listado')
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

    <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
            <div class="content-wrapper"><!-- Basic Elements start -->
                @yield('estados')
                @yield('table')
            </div>
        </div>

        <!-- BEGIN : Footer-->
    @include('Sistema.Pointex.Modulo.Varios.AprobacionesV2._layout.footer')
        <!-- End : Footer-->
    </div>


</div>
@include('Sistema.Pointex.Modulo.Varios.AprobacionesV2._layout._extras')

</body>


@include("Sistema.Pointex.LayOuts.scripts")
@yield('scripts')


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
    @php(session()->forget('msg'))
@endif
