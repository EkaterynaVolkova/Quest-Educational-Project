@extends('layouts.dashboard')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link media="all" type="text/css" rel="stylesheet" href="/public/css/UserGeneral/headerNav.css">
<link media="all" type="text/css" rel="stylesheet" href="/public/css/Creator/createQuest.css">
@stop
@section('content')
    <header>
        @include('Users.General.headerNav');
    </header>
<div class="container">
    <div class="row" id="form">
        <div class="col-xs-12 col-md-8 col-md-offset-4">
            <h2>Новый Квест!</h2>
        </div>
    </div>
    <div class="row" id="form">
        <div class="col-xs-12 col-md-9 col-md-offset-3">
             <div class="modal-content" id="modal">
                 <div class="form-group">
                     {!!  Form::open(array('action' => 'Creator\CreateController@addQuest')) !!}

                     {!!Form::label('name', 'Название') . Form::text('name', "", array('required' => 'require', 'class' => 'form-control')) !!}
<br>
                     {!! Form::label('description', 'Описание') . Form::text('description', "", array('required' => 'require', 'class' => 'form-control')) !!}
<br>
                    {!! Form::label('fullDescription', 'Полное описание') . Form::text('fullDescription', "", array('required' => 'require', 'class' => 'form-control')) !!}

    {{--{{Form::label('date', 'Дата планируемого проведения проведения:') . Form::date('date') }}--}}

                   {{Form::hidden('status', '-1')}}
                   {{Form::hidden('author_id', Auth::id())}}
                    <br>
                    {!!  Form::submit('Добавить', array('class' => 'btn btn-success', 'id' => 'Add_btn')) !!}
                     <a href="{{ route("view quest") }}">{{ Form::button('Назад', array('class' => 'btn btn-secondary', 'route' => 'view quest')) }} </a>
                     {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@stop
