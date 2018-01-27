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
                    <div class="team">Команда: {{$teamName}}</div>
                </div>
                <div id="map"></div>
            </div> <!-- div section inner-->
        </section>
    </main>
    <footer></footer>
    <script type="text/javascript">

        var map;
        var t = 0;
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
            b = JSON.parse(a);
            map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: b[0][0], lng: b[0][1]},
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.RoadMap
            });
            clearMarkers();
            for (var i = 0; i < b.length; i++) {
                addMarkerWithTimeout(b[i], i * 300, arr);
            }

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