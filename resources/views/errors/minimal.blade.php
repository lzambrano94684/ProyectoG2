<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->

{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/fonts/feather/style.min.css') !!}
{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/fonts/simple-line-icons/style.css') !!}
{{--{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/fonts/font-awesome/css/font-awesome.min.css') !!}--}}
{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/fonts/fontawesome/css/all.css') !!}
{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/perfect-scrollbar.min.css') !!}
{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/prism.min.css') !!}

{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/vendors/css/toastr.css') !!}
{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/css/app.css') !!}
{!! HTML::style('/Sistema/Pointex/Modulo/css/pointex.css') !!}


</head>
<body data-col="1-column" class=" 1-column  blank-page">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="wrapper">
    <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
            <div class="content-wrapper"><!--Under Maintenance Starts-->
                <section id="maintenance" class="full-height-vh">
                    <div class="container-fluid">
                        <div class="row full-height-vh">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <img src="{{ url("Vendor/Plantillas/Apex/app-assets/img/gallery/maintenance.png") }}" alt="" class="img-fluid maintenance-img mt-2"
                                             height="300" width="400">
                                        <h1 class="text-white mt-4">@yield('code') | @yield('message')</h1>
                                        <div class="w-75 mx-auto maintenance-text mt-3">

                                        </div>
                                        <a href="{{ url()->previous() }}" class="btn btn-danger text-decoration-none text-white">
                                                Regresar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--Under Maintenance Starts-->

            </div>
        </div>
        <!-- END : End Main Content-->
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
</body>
</html>
