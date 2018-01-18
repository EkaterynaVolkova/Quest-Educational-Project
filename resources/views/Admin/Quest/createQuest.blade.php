@extends('layouts.dashboard')
@section('style')
       {{HTML::style('css/AdminGeneral/forms.css')}}
@stop
@section('content')

    <h2>Новый Квест!</h2>

    <?php
    echo "<br>";
    echo Form::open(array('url' => route('post'), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));

    echo Form::label('name', 'Название') . Form::text('name');
    echo "<br>";
    echo Form::label('description', 'Описание') . Form::text('description');
    echo "<br>";
    echo Form::label('fullDescription', 'Полное описание') . Form::text('fullDescription');
    echo "<br>";
    echo Form::label('date', 'Дата проведения:') . Form::date('date');
    echo "<br>";
    echo Form::label('time', 'Время начала:') . Form::time('time');
    echo "<br>";

    echo Form::submit('Добавить');

    echo  Form::close();
    ?>
@stop