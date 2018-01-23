@extends('layouts.dashboard')
@section('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    {{HTML::style('css/UserGeneral/headerNav.css')}}
    <style>
        body{
            background: #f9f9f9 url(../../../public/img/page-bg-1.jpg);
        }
        #add_btn{
            margin-right: 10px;
        }
        #modal{
            padding: 20px;
            background: #fcfcfc;
        }
    </style>
@stop
@section('content')
    <header>
        @include('Users.General.headerNav');
    </header>

    <?php
    echo "<br>";
    echo Form::open(array('action' => 'Creator\CreateController@addTasks'));
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9 col-md-offset-1">
                <h2>Количество заданий в квесте</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-9 col-md-6 col-md-offset-1">
                <div class="modal-content" id="modal">
                <div class="form-group">
                    <div class="form-group">
                        <label for="number"></label>
                        <select multiple class="form-control" id="exampleFormControlSelect2" name="number">
                            <option value="0" selected>1</option>
                            <option value="1">2</option>
                            <option value="2">3</option>
                            <option value="3">4</option>
                            <option value="4">5</option>
                        </select>
                    </div>
                    {{Form::hidden('user_id', $user_id)}}
                </div>

                {{Form::submit('Выбрать', array('class' => 'btn btn-primary', 'id' => 'add_btn'))}}
                <a href="{{ route("view quest") }}">{{ Form::button('Назад', array('class' => 'btn btn-secondary', 'route' => 'view quest')) }} </a>
                {{Form::close()}}
                </div>
            </div>
        </div>
    </div>




@stop

