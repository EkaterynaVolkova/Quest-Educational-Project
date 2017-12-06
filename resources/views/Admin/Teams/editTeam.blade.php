@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/AdminGeneral/formForCreating.css')!!}
    {!!HTML::style('css/forms.css')!!}
@stop
@section('content')

    <h2>Редактирование</h2>

    <?php
    echo "<br>";
    echo Form::open(array('url' => route('updateTeam', $team), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));

    echo Form::label('name', 'Название') . Form::text('name', $team->name);
    echo "<br>";

    echo Form::submit('Применить');

    echo Form::token().Form::close();

    ?>

@stop


