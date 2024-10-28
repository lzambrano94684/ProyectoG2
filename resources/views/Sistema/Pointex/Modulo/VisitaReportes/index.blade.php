@extends('Sistema.Pointex.LayOuts.layout')
@section('title', $titleMsg)

@section("css")

@endsection

@section('content')
    <div class="row">
        <div class="col-12">fe
            <div id="map" style=" height: 600px;
        width: 100%;
        margin: 0px;
        padding: 0px;"></div>
        </div>
    </div>
@stop
@section('js')

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        navigator.geolocation.getCurrentPosition(success => {
            /* Do some magic. */
        }, failure => {
            if (failure.message.startsWith("Only secure origins are allowed")) {
                // Secure Origin issue.
            }
        });


        var markers = [];

        function initialize() {

            var beaches = [
                ['Hola Mundo', 14.629189415017104, -90.5754053383074]
            ];

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: new google.maps.LatLng(14.6343, -90.5155),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            for (var i = 0; i < beaches.length; i++) {

                var newMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(beaches[i][1], beaches[i][2]),
                    map: map,
                    title: beaches[i][0]
                });

                google.maps.event.addListener(newMarker, 'click', (function (newMarker, i) {
                    return function () {
                        infowindow.setContent(beaches[i][0]);
                        infowindow.open(map, newMarker);
                    }
                })(newMarker, i));

                markers.push(newMarker);
            }
        }

        initialize();
    </script>
@endsection

