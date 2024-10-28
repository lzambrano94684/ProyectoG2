<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEOPLE | Día mundial de la seguridad del paciente</title>
    {!! HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') !!}
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- https://fonts.google.com/ -->
    {!! HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css') !!}
    {!! HTML::style('/css/templatemo-video-catalog.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/fonts/feather/style.min.css') !!}
    {!! HTML::style('/Vendor/Plantillas/Apex/app-assets/fonts/simple-line-icons/style.css') !!}
    {{--{!! HTML::style('/Vendor/Plantillas/Apex/app-assets/fonts/font-awesome/css/font-awesome.min.css') !!}--}}
    <link href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/v4-shims.css">
<!--

    TemplateMo 552 Video Catalog

    https://templatemo.com/tm-552-video-catalog

    -->
</head>

<body>
<div class="tm-page-wrap mx-auto">
    <div class="position-relative">
        <div class="position-absolute tm-site-header">
            <div class="container-fluid position-relative">
                <div class="row">
                    <div class="col-6 col-md-6">

                        <p class="tm-welcome-text mb-1 text-white"><B>PEOPLE</B> | Día mundial de la seguridad del
                            paciente <a href="https://exeltiscard.com/">
                                <i class="fas fa-mouse"></i> Sitio Web
                            </a>
                        </p>

                    </div>
                    <div class="col-6 col-md-6">

                        <p class="tm-welcome-text mb-1 text-white text-right"><a href="javascript:void(0)" class="text-white" id="reproducir" onclick="playVid()">
                                <i class="far fa-play-circle"></i> Reproducir Video
                            </a>
                        </p>

                    </div>

                </div>
            </div>
        </div>


        <video controls loop id="tm-video">
            <!-- <source src="video/sunset-timelapse-video.mp4" type="video/mp4"> -->
            <source src="/video/PatientSafety_ES.webm" type="video/webm">
        </video>

        <i id="tm-video-control-button" class="fas fa-pause"></i>
    </div>


</div> <!-- .tm-page-wrap -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
{!! HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css') !!}
<script>

    var vidClip = document.getElementById("tm-video");

    // play video event
    function playVid() {
        $("#reproducir").hide()
        vidClip.play();
    }

</script>
</body>

</html>
