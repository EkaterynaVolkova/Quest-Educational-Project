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

            <button class="btn btn-link link"><a href="{{route('userProfile')}}">Назад</a></button>
        </aside>

        <section class="section">
            <div id="section_inner">


                <h1>Поздравляем, Вы выполнили задание!</h1>
                <h1>Подтвердите Ваше местоположение:</h1><br>
                <div><?php var_dump($idExecuteTask) ?></div>
                <?php
                echo Form::open(array('url' => route('savePosition', ['id' => $idExecuteTask]), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));
                ?>
                <input type="text" id="x" name="coordX">
                <input type="text" id="y" name="coordY">
                <p onclick="geoFindMe()">Show my location</p>
                <button>Подтвердить</button>
                <div id="out"></div>
                <?php
                echo Form::close();
                ?>
            </div> <!-- div section inner-->
        </section>

    </main>

    <footer></footer>

    <script type="text/javascript">
        function openbox(id) {
            display = document.getElementById(id).style.display;
            if (display == 'none') {
                document.getElementById(id).style.display = 'block';
            } else {
                document.getElementById(id).style.display = 'none';
            }
        }
    </script>
    <script>

        function geoFindMe() {
            var output = document.getElementById("out");
            var coordX = document.getElementById("x");
            var coordY = document.getElementById("y");

            if (!navigator.geolocation) {
                output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
                return;
            }

            function success(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

             //   output.innerHTML = '<p>Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°</p>';
                coordX.value = longitude;
                coordY.value = latitude;


                var img = new Image();
                img.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";

                output.appendChild(img);
            }

            function error() {
                output.innerHTML = "Unable to retrieve your location";
                var coordX = document.getElementById("x");
                var coordY = document.getElementById("y");
                coordX.value = 49.987670699999995;
                coordY.value = 36.2330605;
            }

            output.innerHTML = "<p>Locating…</p>";

            navigator.geolocation.getCurrentPosition(success, error);

        }

    </script>

@stop