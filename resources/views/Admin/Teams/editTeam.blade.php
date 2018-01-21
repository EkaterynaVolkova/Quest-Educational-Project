@extends('layouts.dashboard')
@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/AdminGeneral/forms.css">
@stop
@section('content')

    <h2>Редактирование</h2>

    <?php
    echo "<br>";
    echo Form::open(array('url' => route('updateTeam', $team), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));

    echo Form::label('name', 'Название') . Form::text('name', $team->name);
    echo "<br>";

    echo Form::submit('Edit');

    echo Form::token() . Form::close();

    ?>

@stop


