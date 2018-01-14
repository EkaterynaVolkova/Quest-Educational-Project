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