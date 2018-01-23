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

        <section class="section">u7
            <div id="section_inner">

                @if($msg)
                    <h2>{{$msg}}</h2>
                @else
                    <h1>Задание на выполнение</h1>
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
@stop