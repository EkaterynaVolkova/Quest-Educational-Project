@extends('layouts.dashboard')
@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/AdminGeneral/forms.css">
@stop
@section('content')

    <h2>Редактирование</h2>

    <?php
    echo "<br>";
    echo Form::open(array('url' => route('edit', $quest), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));

    echo Form::label('name', 'Название') . Form::text('name', $quest->name);
    echo "<br>";
    echo Form::label('description', 'Описание') . Form::text('description', $quest->description);
    echo "<br>";
    echo Form::label('fullDescription', 'Полное описание') . Form::text('fullDescription', $quest->fullDescription);
    echo "<br>";
    echo Form::label('date', 'Сложность:') . Form::text('hard', $quest->hard);
    echo "<br>";
    echo Form::label('time', 'Автор:') . Form::text('author', $quest->author);
    echo "<br>";
    echo Form::label('date', 'Дата проведения:') . Form::date('date', $quest->date);
    echo "<br>";
    echo Form::label('time', 'Время начала:') . Form::time('time', $quest->time);
    echo "<br>";

    echo Form::submit('Edit');

    echo Form::token() . Form::close();

    ?>

@stop


