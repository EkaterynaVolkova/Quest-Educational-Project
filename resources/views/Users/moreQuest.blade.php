@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/User/userMoreQuests.css')!!}
    {!!HTML::style('css/UserGeneral/headerNav.css')!!}
@stop
@section('content')

    <header>
        @include('Users.General.headerNav');
    </header>

    <main>
        <div class="row">
            <div class="column1">

            </div>
            <div class="column2">
                <div class="name text-center">
                    <h1 class="text-center"> НАВАНИЕ </h1>
                    <p class="text-center">{!! $q->name !!}</p>
                </div>
                <div class="date text-center">
                    <h1 class="text-center"> ДАТА СТАРТА </h1>
                    <p class="text-center">{!! $q->date!!}</p>
                </div>
                <div class="time text-center">
                    <h1 class="text-center"> ВРЕМЯ СТАРТА </h1>
                    <p class="text-center">{!! $q->time !!}</p>
                </div>
                <div class="description text-center">
                    <h1 class="text-center"> ОПИСАНИЕ </h1>
                    <p class="text-center">{!! $q->description !!}</p>
                </div>

                <p>
                    <?php
                    echo Form::open(array('url' => route('play', ['id' => $q->id]), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
                    echo '<button type="submit">Учавствовать</button>';
                    echo Form::close();
                    ?>
                </p>

            </div>
    </main>

    <footer></footer>
@stop