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
        <aside>
            <div class="avatar"></div>
            <p class="name">Имя: {{Auth::user()->name}}</p>
            <p class="name">Возраст: {{Auth::user()->age}}</p>
            <p class="name">Пол: {{Auth::user()->gender}}</p>

            <button class="btn btn-link link"><a href="{{route('playQuest',['idQuest'=>$idQuest])}}">Продолжить</a>
            </button>
        </aside>

        <section class="section">
            <div id="section_inner">
                <h2>Поздравляем, Вы выполнили задание!</h2>
                <h2>Подтвердите Ваше местоположение:</h2><br>
                <input type="text" id="x" name="coordX">
                <input type="text" id="y" name="coordY">
                <button onclick="geoFindMe()">Моё положение</button>
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

        function geoFindMe($idExecuteTask) {
            var idExTask = "<?php echo $idExecuteTask ?>";
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
                posit(idExTask);

                var img = new Image();
                img.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";
                output.appendChild(img);
            }

            function error() {
                output.innerHTML = "Unable to retrieve your location";
                coordX = document.getElementById("x");
                coordY = document.getElementById("y");
                coordX.value = 49.987670699999995;
                coordY.value = 36.2330605;
                posit(idExTask);
            }

            output.innerHTML = "<p>Locating…</p>";

            navigator.geolocation.getCurrentPosition(success, error);


            function posit(idExTask) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '/public/users/location',
                    data: {"coordX": $('#x').val(), "coordY": $('#y').val(), "idExTask": idExTask},
                    success: function (data) {
                        $("#res").html(data.msg);
                    }
                });
            }
        }
    </script>

@stop