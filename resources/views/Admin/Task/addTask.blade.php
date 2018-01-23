@extends('layouts.dashboard')
@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/AdminGeneral/forms.css">
@stop

@section('content')

    <h2>Новaя Задача!</h2>

    <?php
    echo "<br>";
    echo Form::open(array('url' => route('postTask', ['idQuest'=>$idQuest]), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));

    echo Form::label('name', 'Название') . Form::text('name');
    echo "<br>";
    echo Form::label('description', 'Описание') . Form::text('description');
    echo "<br>";
    echo Form::label('weight', 'Вес задачи:') . Form::number('weight', 10, array('min' => 10, 'max'=> 100, 'step' => 10));
    echo "<br>";
    echo Form::submit('Добавить');
    Form::close();

    ?>

@stop
