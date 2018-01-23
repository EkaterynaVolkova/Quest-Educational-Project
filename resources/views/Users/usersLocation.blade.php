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
                    <li><a href="{{route('playQuest',['idQuest' => $idQuest])}}">Продолжить</a></li>
                </ul>
            </div>

        </div>

        <section class="section">
            <div id="section_inner">
                <h2>Поздравляем, Вы выполнили задание!</h2>
                <h2>Подтвердите Ваше местоположение:</h2><br>
                <div id="#res"></div>
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
                coordX.value = latitude;
                coordY.value = longitude;
                posit(idExTask);
            }

            function error() {
                output.innerHTML = "Unable to retrieve your location";
            }

            output.innerHTML = "<p>Locating…</p>";

            navigator.geolocation.getCurrentPosition(success, error);

           function posit(idExTask) {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'GET',
                        url: '/public/users/location',
                        data: {"coordX": $('#x').val(), "coordY": $('#y').val(), "idExTask": idExTask},
                        success: function (data) {
                            $("#res").html(data.msg);
                        },
                        error: function (data) {
                            $("#res").html('OOPS');
                        }
                    });
                }
        }
    </script>

@stop