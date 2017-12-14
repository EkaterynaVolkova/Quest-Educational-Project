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
        <h1>{{Auth::user()->name}}</h1>
        <h1>Текущий квест</h1>
        <div class="column">
            <div class="row">
                <div class="text-center">Название</div>
                <div class="text-center">Дата</div>
                <div class="text-center">Время</div>
                <div></div>
            </div>
            @foreach($quests as $key => $q)
                @if($status[$key] == 1)
                    <div class="row quest">
                        <div class="text-center">{!! json_decode($q)->name !!}</div>
                        <div class="text-center">{!! json_decode($q)->date !!}</div>
                        <div class="text-center">{!! json_decode($q)->time !!}</div>
                        <div>
                            <button class="btn btn-link"><a href="" class="glyphicon glyphicon-th-list"
                                                            onclick="openbox('id'); return false"></a></button>
                        </div>
                    </div>
                    <div class="column task" id="id">
                        <div class="row">
                            <div class="text-center">Название</div>
                            <div class="text-center">Описание</div>
                            <div class="text-center">Длительность</div>
                            <div class="text-center">Вес</div>
                        </div>
                        @foreach(json_decode($tasks[$key]) as $t)
                            <div class="row">
                                <div class="text-center">{!! $t->name !!}</div>
                                <div class="text-center">{!! $t->description !!}</div>
                                <div class="text-center">{!! $t->duration !!}</div>
                                <div class="text-center">{!! $t->weight !!}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>

        <h1>Грядущие квесты</h1>

        <div class="column">
            <div class="row">
                <div class="text-center">Название</div>
                <div class="text-center">Дата</div>
                <div class="text-center">Время</div>
                <div></div>
            </div>
            @foreach($quests as $key => $q)
                @if($status[$key] == 0)
                    <div class="row quest">
                        <div class="text-center">{!! json_decode($q)->name !!}</div>
                        <div class="text-center">{!! json_decode($q)->date !!}</div>
                        <div class="text-center">{!! json_decode($q)->time !!}</div>
                        <div></div>
                    </div>
                @endif
            @endforeach
        </div>

        <h1>Архив</h1>

        <div class="column">
            <div class="row">
                <div class="text-center">Название</div>
                <div class="text-center">Дата</div>
                <div class="text-center">Время</div>
                <div></div>
            </div>
            @foreach($quests as $key => $q)
                @if($status[$key] == 2)
                    <div class="row quest">
                        <div class="text-center">{!! json_decode($q)->name !!}</div>
                        <div class="text-center">{!! json_decode($q)->date !!}</div>
                        <div class="text-center">{!! json_decode($q)->time !!}</div>
                        <div>
                            <button class="btn btn-link"><a href="" class="glyphicon glyphicon-th-list"
                                                            onclick="openbox('id3'); return false"></a></button>
                        </div>
                    </div>
                    <div class="column task" id="id3">
                        <div class="row">
                            <div class="text-center">Название</div>
                            <div class="text-center">Описание</div>
                            <div class="text-center">Длительность</div>
                            <div class="text-center">Вес</div>
                        </div>
                        @foreach(json_decode($tasks[$key]) as $t)
                            <div class="row">
                                <div class="text-center">{!! $t->name !!}</div>
                                <div class="text-center">{!! $t->description !!}</div>
                                <div class="text-center">{!! $t->duration !!}</div>
                                <div class="text-center">{!! $t->weight !!}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
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