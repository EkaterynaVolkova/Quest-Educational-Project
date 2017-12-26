@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/User/userProfile.css')!!}
    {!!HTML::style('css/UserGeneral/headerNav.css')!!}
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

                <div class="column">
                    <div class="row">
                        <div class="text-center">Название</div>
                        <div class="text-center">Описание</div>
                        <div class="text-center">Длительность</div>
                        <div class="text-center">Вес</div>
                    </div>
                    <div class="row">
                        <div class="text-center">{!! $task->name !!}</div>
                        <div class="text-center">{!! $task->description !!}</div>
                        <div class="text-center">{!! $task->duration !!}</div>
                        <div class="text-center">{!! $task->weight !!}</div>
                    </div>
                </div>

                @if($ok)
                    <p>Click the button to get your coordinates.</p>
                    <button onclick="getLocation()">Try It</button>
                    <p id="demo"></p>
                @endif
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
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
        }
    </script>

@stop