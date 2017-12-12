@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/User/userTeamQuest.css')!!}
    {!!HTML::style('css/UserGeneral/headerNav.css')!!}
@stop
@section('content')

    <header>
        @include('Users.General.headerNav')
    </header>

    <main>
        <p>Здравствуйте, пользователь {{Auth::user()->name}}</p>
        <p> Вы принимаете участвие в квесте {{App\Models\Quest::find($idQuest)->name}}</p>

        <?php
        echo Form::open(array('url' => route('ok',['idQuest' => $idQuest]), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));
        ?>
        <label for="select"> Выбирайте вашу команду: </label> <select id="select" onchange="document.querySelector('#input').value =this.options[this.selectedIndex].value;" >;
            @foreach($team as $value)
                <option name="option" id="option" value="{!! $value->id !!}">
                {!! $value->name !!}
                </option>
            @endforeach
            </select>
        <input type="hidden" id="input" name="input">
        <script>document.querySelector('#input').value = document.querySelector('#option').value</script>
        <button type="submit" class="btn btn-link"><a>Выбрать</a></button>

        <?php
        echo Form::close();
        ?>
    </main>

    <footer></footer>
@stop