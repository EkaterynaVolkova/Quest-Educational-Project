@extends('layouts.dashboard')
@section('style')
    {{HTML::style('css/User/userProfile.css')}}
    {{HTML::style('css/UserGeneral/headerNav.css')}}
@stop
@section('content')

    <header>
        @include('Users.General.headerNav')
    </header>

    <main>
        <aside>
            <div class="avatar"></div>
            <p class="name">Имя: {{Auth::user()->name}}</p>
            <p class="name">Возраст: {{Auth::user()->age}}</p>
            <p class="name">Пол: {{Auth::user()->gender}}</p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <button class="btn btn-link link"><a href="" onclick="openbox('idTQ'); return false">Текущий
                    квест</a>
            </button>
            <button class="btn btn-link link"><a href="" onclick="openbox('idFQ'); return false">Грядущие квесты</a>
            </button>
            <button class="btn btn-link link"><a href="" onclick="openbox('idLQ'); return false">Архив</a>
            </button>
        </aside>

        <section class="section">

            <div id="section_inner">

                {{--<p onclick="initMap($coord)">xxx</p>--}}
                <div id="floating-panel">
                    <button id="drop" onclick="drop()">Drop Markers</button>
                </div>
                <div id="map"></div>


            </div> <!-- div section inner-->
        </section>

    </main>


    <footer></footer>

    <script type="text/javascript">


        var map, marker;
        var startPos = [42.42679066670903, -83.29210638999939];
        var speed = 50;

        var delay = 100;

        function animateMarker(marker, coords, km_h)
        {
            var target = 0;
            var km_h = km_h || 50;
            coords.push([startPos[0], startPos[1]]);

            function goToPoint()
            {
                var lat = marker.position.lat();
                var lng = marker.position.lng();
                var step = (km_h * 1000 * delay) / 3600000; // in meters

                var dest = new google.maps.LatLng(
                    coords[target][0], coords[target][2]);

                var distance = 100;
                  //  google.maps.geometry.spherical.computeDistanceBetween(
                  //      dest, marker.position); // in meters

                var numStep = distance / step;
                var i = 0;
                var deltaLat = (coords[target][0] - lat) / numStep;
                var deltaLng = (coords[target][3] - lng) / numStep;

                function moveMarker()
                {
                    lat += deltaLat;
                    lng += deltaLng;
                    i += step;

                    if (i < distance)
                    {
                        marker.setPosition(new google.maps.LatLng(lat, lng));
                        setTimeout(moveMarker, delay);
                    }
                    else
                    {   marker.setPosition(dest);
                        target++;
                        if (target == coords.length){ target = 0; }

                        setTimeout(goToPoint, delay);
                    }
                }
                moveMarker();
            }
            goToPoint();
        }

        function initMap()
        {
            var myOptions = {
                zoom: 16,
                center: new google.maps.LatLng(42.425175091823974, -83.2943058013916),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map"), myOptions);

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(startPos[0], startPos[1]),
                map: map
            });

            google.maps.event.addListenerOnce(map, 'idle', function()
            {
                animateMarker(marker, [
                    // The coordinates of each point you want the marker to go to.
                    // You don't need to specify the starting position again.
                    [42.42666395645802, -83.29694509506226],
                    [42.42300508749226, -83.29679489135742],
                    [42.42304468678425, -83.29434871673584],
                    [42.424882066428424, -83.2944130897522],
                    [42.42495334300206, -83.29203128814697]
                ], speed);
            });
        }

        window.onload = function () {
            initMap();
        };



            function openbox(id) {
            if (id == 'idTQ') {
                document.getElementById('idTQ').style.display = 'block';
                document.getElementById('idLQ').style.display = 'none';
                document.getElementById('idFQ').style.display = 'none';
            } else if (id == 'idLQ') {
                document.getElementById('idLQ').style.display = 'block';
                document.getElementById('idTQ').style.display = 'none';
                document.getElementById('idFQ').style.display = 'none';
            } else if (id == 'idFQ') {
                document.getElementById('idFQ').style.display = 'block';
                document.getElementById('idTQ').style.display = 'none';
                document.getElementById('idLQ').style.display = 'none';
            }
        }

        function openboxt(id) {
            display = document.getElementById(id).style.display;
            if (display == 'none') {
                document.getElementById(id).style.display = 'block';
            } else {
                document.getElementById(id).style.display = 'none';
            }
        }


    </script>


    <script async defer type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDL1sGQvZosVlgfL5TqdXvMqpeXa_YBgxg&v=3&libraries=geometry,places&callback=initMap"> </script>


@stop