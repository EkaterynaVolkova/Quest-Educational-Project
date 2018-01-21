@extends('layouts.dashboard')
@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/AdminGeneral/forms.css">
@stop
@section('content')

    <h2>Новая Команда!</h2>

    <?php
    echo "<br>";
    echo Form::open(array('url' => route('postTeam'), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));

    echo Form::label('name', 'Название') . Form::text('name');

    echo "<br>";

    echo Form::submit('Add');

    echo Form::close();
    ?>
@stop