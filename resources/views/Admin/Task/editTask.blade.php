@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/AdminGeneral/formForCreating.css')!!}
    {!!HTML::style('css/AdminGeneral/forms.css')!!}
@stop
@section('content')

    <h2>Редактирование Задания!</h2>

    <?php
    echo "<br>";
    echo Form::open(array('url' => route('updateTask', $task), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));

    echo Form::label('name', 'Название') . Form::text('name', $task->name);
    echo "<br>";
    echo Form::label('description', 'Описание') . Form::text('description', $task->name);
    echo "<br>";
    echo Form::label('duration', 'Длительность:') . Form::time('duration', $task->duration);
    echo "<br>";
    echo Form::label('weight', 'Вес задачи:') . Form::number('weight', $task->weight);
    echo "<br>";
    echo Form::label('QR', 'Текст для QR-кода:') . Form::text('QR', $task->QR);
    echo "<br>";
    echo Form::submit('Применить');
    Form::close();

    ?>

@stop
