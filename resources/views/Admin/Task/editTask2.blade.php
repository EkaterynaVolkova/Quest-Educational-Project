@extends('layouts.dashboard')
@section('style')
       {!!HTML::style('css/AdminGeneral/forms.css')!!}
@stop
@section('content')

    <h2>Редактирование!</h2>

    <?php
    echo "<br>";
    echo Form::open(array('url' => route('updateOneTask', $task), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));

    echo Form::label('name', 'Название') . Form::text('name', $task->name);
    echo "<br>";
    echo Form::label('description', 'Описание') . Form::text('description', $task->description);
    echo "<br>";
    echo Form::label('duration', 'Длительность:') . Form::time('duration', $task->duration);
    echo "<br>";
    echo Form::label('weight', 'Вес задачи:') . Form::number('weight', $task->weight);
    echo "<br>";
    echo Form::submit('Edit');
    Form::close();

    ?>

@stop
