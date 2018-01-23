@extends('layouts.dashboard')
@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/User/userProfile.css">
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/UserGeneral/headerNav.css">
@stop
@section('content')
    <header>
        @include('Users.General.headerNav')
    </header>
    <main>
        <div class="menu-container">
            <div id="logo-container">
                <img src="{{Auth::user()->avatar}}" class="logo-container-pict">
            </div>
            <div class="menu-main-container">
                <ul class="menu">
                    <li>
                        <div class="about">
                            <p>{{Auth::user()->name}}</p>
                            <p>Возраст: {{Auth::user()->age}}</p>
                            <p> Пол: {{Auth::user()->gender}}</p>
                        </div>
                    </li>
                    <li><a href="{{route('userProfile')}}">Назад</a></li>
                </ul>
            </div>

        </div>

        <section class="section">
            <div id="section_inner">
                <div id="floating-panel">
                    <button id="drop" onclick="drop()">Drop Markers</button>
                </div>
                <div id="map"></div>
            </div> <!-- div section inner-->
        </section>
    </main>
    <footer></footer>
    <script type="text/javascript">
        //        window.onload = function () {
        //            initMap();
        //        };
        var map;
        var t = 0;
        var startDestination;
        var endDestination;
        var centerDestination = [];
        var center = [];
        var b;
        var pos = [];
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var labelIndex = 0;
        var markers = [];
        function initMap($coord, $dateTime) {
            var a = "<?php echo $coord ?>";
            console.log(a);
            console.log(a);
            var dt = "<?php echo $dateTime ?>";
            arr = dt.split(',');
            b = JSON.parse(a);
            map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: b[0][0], lng: b[0][1]},
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.RoadMap
            });
        }
        function drop($coord, $dateTime) {
            var a = "<?php echo $coord ?>";
            var dt = "<?php echo $dateTime ?>";
            arr = dt.split(',');
            console.log(a);
            b = JSON.parse(a);
            map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: b[0][0], lng: b[0][1]},
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.RoadMap
            });
            clearMarkers();
            for (var i = 0; i < b.length; i++) {
                addMarkerWithTimeout(b[i], i * 300, arr);
            }

            window.setTimeout(function () {
                getDirections(map, b);
            }, b.length * 300);
        }


        function addMarkerWithTimeout(position, timeout, arr) {
            window.setTimeout(function () {
                markers.push(new google.maps.Marker({
                    position: {lat: position[0], lng: position[1]},
                    label: labels[labelIndex++ % labels.length],
                    map: map,
                    animation: google.maps.Animation.DROP,
                    title: arr[t++ % arr.length]
                }));
            }, timeout);
        }
        function clearMarkers() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
            pos = [];
            t = 0;
            labelIndex = 0;
            center = [];
        }
        function moveMarker(map, marker, latlng) {
            marker.setPosition(latlng);
//            map.panTo(latlng);
        }
        function autoRefresh(map, pathCoords) {
            var i, route, marker;
            route = new google.maps.Polyline({
                path: [],
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: .5,
                strokeWeight: 2,
                editable: false,
                map: map
            });
            marker = new google.maps.Marker({map: map, icon: "http://maps.google.com/mapfiles/ms/micons/blue.png"});
            interpolatePathBetween(pathCoords, 10);
            var timeout = 1 * 10; // seconds
            for (i = 0; i < pathCoords.length; i++) {
                setTimeout(function (coords) {
                    route.getPath().push(coords);
                    moveMarker(map, marker, coords);
                }, timeout * i, pathCoords[i]);
            }
        }
        function interpolatePathBetween(path, step, curIndex) {
            var curIndex = curIndex || 0;
            //verify path contains at least 2 coordinates
            if (path.length == 0 || path.length == 1) {
                return;
            }
            step = Math.max(step, 10); //ensure the step at least 10 meters
            var start = path[curIndex];
            var end = path[curIndex + 1];
            var dist = google.maps.geometry.spherical.computeDistanceBetween(start, end);
            if (dist > step) {
                var intCoord = google.maps.geometry.spherical.interpolate(start, end, .5);
                path.splice(curIndex + 1, 0, intCoord);
                interpolatePathBetween(path, step, curIndex);
            }
            if (curIndex < path.length - 2) {
                interpolatePathBetween(path, step, curIndex + 1);
            }
        }
        function getDirections(map, b) {
            var directionsService = new google.maps.DirectionsService();
            var start = new google.maps.LatLng(b[0][0], b[0][1]);
            for (var k = 1; k <= (b.length - 2); k++) {
                center.push(new google.maps.LatLng(b[k][0], b[k][1]));
            }


            for (var l = 0; l < center.length; l++) {
                pos[l] = {location: center[l], stopover: false};
            }
            var end = new google.maps.LatLng(b[b.length - 1][0], b[b.length - 1][1]);
            var request = {
                origin: start,
                destination: end,
                travelMode: google.maps.TravelMode.WALKING,
                waypoints: pos
            };
            directionsService.route(request, function (result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    autoRefresh(map, result.routes[0].overview_path);
                }
            });
        }
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
    <script async defer type="text/javascript"
            src="https://maps.google.com/maps/api/js?key=AIzaSyDL1sGQvZosVlgfL5TqdXvMqpeXa_YBgxg&v=3&libraries=geometry,places&callback=initMap"></script>
@stop