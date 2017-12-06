@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/Quests/userTeamQuest.css')!!}
    {!!HTML::style('css/User/headerNav.css')!!}
@stop
@section('content')

    <header>
        @include('Users.General.headerNav');
    </header>

    <main>
        <p> Выбор команды для участия в {{$idQuest}} квесте</p>
        <p> Вы пользователь с id {{Auth::user()->id}}</p>

        <?php
        echo Form::open(array('url' => route('ok',['idQuest' => $idQuest ]), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));
        ?>
        <label for="select"> Выбирайте вашу команду: )))</label> <select id="select">;
            @foreach($team as $value)
                <option class="text-center">
                    {!! $value->id !!}{!! $value->name !!}
                </option>
            @endforeach
        </select>
        <input type="hidden" id="input">
        <script>document.querySelector('#input').value = document.querySelector('option').value;</script>

        <button type="submit" class="btn btn-link"><span>Выбрать</span></button>
        ;
        <?php
        echo Form::close();
        ?>
    </main>

    <footer></footer>
@stop