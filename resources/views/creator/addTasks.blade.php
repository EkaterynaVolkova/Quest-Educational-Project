@extends('layouts.dashboard')
@section('style')
{{--    {{HTML::style('css/AdminGeneral/forms.css')}}--}}
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link media="all" type="text/css" rel="stylesheet" href="/public/css/Creator/addTask.css">
<link media="all" type="text/css" rel="stylesheet" href="/public/css/UserGeneral/headerNav.css">
<style>
    #description{
        height: 80px;
        resize: vertical;
    }
</style>
@stop
@section('content')
    <header>
        @include('Users.General.headerNav')
    </header>
    <div class="container">
        <div class="row" id="form-1">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-4">
                <h2>Задания!</h2>
            </div>
        </div>
        <div class="row" id="form">
            <div class="col-xs-12 col-md-9 col-md-offset-3">
                <div class="modal-content" id="modal">
                    <div class="form-group">
                        <?php
                        echo "<br>";
                        echo Form::open(array('action' => 'Creator\CreateController@saveTasks'));
                            for($i = 1; $i <= $number; $i++){
                                echo Form::label('name'.$i, 'Название '.$i.' задания') . Form::text('name'.$i,'' ,array('required' => 'required', 'class' => 'form-control'));
                                echo "<br>";
                                echo Form::label('description'.$i, 'Описание '.$i.' задания') . Form::textarea('description'.$i, '',array('required' => 'required', 'class' => 'form-control', 'id' => 'description'));
                                echo "<br><hr><br>";
                             }
                        ?>
                        {{Form::hidden('author_id', $author_id)}}
                        {{Form::hidden('QR')}}
                        <?php
                        echo "<br>";
                        echo Form::submit('Добавить', array('class' => 'btn btn-success', 'id' => 'add_btn'));
                        ?>
<a href="{{ route("view quest") }}">{{ Form::button('Назад', array('class' => 'btn btn-secondary', 'route' => 'view quest')) }} </a>
                            <?php
                        echo  Form::close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop