<!DOCTYPE html>
<html lang="es" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="POINTEX">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trim($request->input("codigo")) }}</title>
    {!! HTML::style('/css/bootstrap.min.css') !!}

</head>
<style>
    body {
        font-size: 12px;
    }
    h3 {
        font-size: 16px;
    }
</style>
<body data-col="2-columns" class=" 2-columns  pace-done">
<div class="wrapper sidebar-sm">

    <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
            <div class="content-wrapper"><!-- Basic Elements start -->
                {!! $str !!}
            </div>
        </div>
        <!-- END : End Main Content-->

    </div>
</div>
</body>
</html>
