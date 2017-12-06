@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/User/userMoreQuests.css')!!}
    {!!HTML::style('css/User/headerNav.css')!!}
@stop
@section('content')

    <header>
    @include('Users.General.headerNav');
    </header>

    <main>
        <div class="row">
            <div class="column1">
                <h3 class="text-center name">{!! $q->name !!}</h3>
                <p class="text-center date">{!! $q->date!!}</p>
                <p class="text-center time">{!! $q->time!!}</p>
            </div>
            <div class="column2">
                <p class="text-center">{!! $q->description !!}</p>
            </div>
        </div>

        <p>
            <?php
            echo Form::open(array('url' => route('play', ['id' => $q->id]), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
            echo '<button type="submit" class="btn btn-link">Учавствовать</button>';
            echo Form::close();
            ?>
        </p>


    </main>

    <footer></footer>
@stop