<!DOCTYPE html>
<html lang="en" class="loading">
<!-- BEGIN : Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="POINTEX">
    <title>Visita Médica</title>

    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
@include("Sistema.Pointex.LayOuts.styles")
<!-- END APEX CSS-->
    <!-- BEGIN Page Level CSS-->
    <!-- END Page Level CSS-->

    <style>
        body.layout-dark {
            background-color: #0288d1 !important;
            color: #008b8e !important;
            height: 100% !important;
        }

        a.text-primary:hover, a.text-primary:focus {
            color: white !important;
        }

        .hero-image {
            background-image: url("data:image/jpeg;base64,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") !important;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .main-panel .main-content {
            padding-left: 0 !important;
        }
    </style>
</head>
<!-- END : Head-->

<!-- BEGIN : Body-->
<body data-col="1-column" class=" 1-column  layout-dark layout-transparent {{--bg-glass-1--}} hero-image">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="wrapper">
    <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
            <div class="content-wrapper"><!--Login Page Starts-->
                <section id="login">

                    <div class="container-fluid">


                        <div class="row full-height-vh m-0">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body login-img">
                                            <div class="row m-0">
                                                <div class="col-lg-6 d-lg-block d-none py-2 text-center align-middle">
                                                    <img src="/Vendor/Plantillas/Apex/app-assets/img/gallery/login3.png"
                                                         alt="" class="img-fluid" style="margin-top: 10px;">
                                                </div>

                                                <div class="col-lg-6 col-md-12 bg-white px-4 pt-3">

                                                    <div class="col-md-12 text-center align-middle">
                                                        <img style="width: 60%;"
                                                             src="{{asset("Sistema/Pointex/Modulo/img/exeltis.png")}}">
                                                    </div>
                                                    <div class="clearfix">&nbsp;</div>
                                                    <p class="card-text mb-3">
                                                        ¡Bienvenidos!, Ingrese los datos de su cuenta
                                                    </p>

                                                    <form name="frmLogin" id="frmLogin" method="post"
                                                          action="{{url("pointex/validar")}}">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <input value="{{ $request->txtUsuario }}" autocomplete="off"
                                                               type="text" name="txtUsuario"
                                                               id="txtUsuario" required
                                                               class="form-control mb-3" placeholder="Usuario"/>
                                                        <input value="{{ $request->txtClave }}" autocomplete="off"
                                                               type="password"
                                                               name="txtClave" id="txtClave" required
                                                               class="form-control mb-1" placeholder="Contraseña"/>
                                                        <div class="d-flex justify-content-center mt-2">

                                                            <div class="forgot-password-option">
                                                                <a href="{{url("pointex/recuperar")}}"
                                                                   class="text-decoration-none text-primary">Recuperar
                                                                    Contraseña</a>
                                                            </div>
                                                        </div>
{{--                                                        <div class="d-flex justify-content-center mt-2">--}}

{{--                                                            <div class="forgot-password-option">--}}
{{--                                                                <a href="{{url("/archivos/ver")}}"--}}
{{--                                                                   class="text-decoration-none text-primary">Ver--}}
{{--                                                                    Procesos--}}
{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                            <br>--}}
{{--                                                        </div>--}}
                                                        <div class="fg-actions d-flex justify-content-center">

                                                            <button class="btn btn-outline-primary" type="submit">
                                                                INGRESAR
                                                            </button>

                                                        </div>
                                                    </form>
                                                    <hr class="m-0">
{{--                                                    <div class="d-flex justify-content-center mt-3">--}}
{{--                                                        <div class="option-login">--}}
{{--                                                            <h6 class="text-decoration-none text-primary">--}}
{{--                                                                POINTEX {{date("Y")}}</h6>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--Login Page Ends-->

            </div>
        </div>
        <!-- END : End Main Content-->
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<!-- BEGIN VENDOR JS-->

@include("Sistema.Pointex.LayOuts.scripts")
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
<script type="text/javascript">
    $('#txtUsuario').on('focus click', function () {
        $(this)[0].setSelectionRange(0, 0);
    })
    setTimeout(function () {
        $('input[name="txtUsuario"]').focus()
    }, 1);
</script>
<!-- END APEX JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- END PAGE LEVEL JS-->
</body>
<!-- END : Body-->
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
