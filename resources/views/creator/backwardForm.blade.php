<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    {!! HTML::style('css/Creator/backwardForm.css') !!}
    {{HTML::style('css/UserGeneral/headerNav.css')}}
    <title>Форма обратной связи</title>
</head>
<body>
<header>
    @include('Users.General.headerNav')
</header>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
            <h1>Если вы хотите создать квест напишите нам...</h1>
        </div>
    </div>
    <div class="row" id="form">
        <div class="col-xs-12 col-md-6 col-md-offset-1">
            <div class="modal-content" id="modal">
                {!! Form::open() !!}

                <div class="form-group">
                     {{Form::label('email', 'email адресс')}}
                     {{ Form::email('email','',array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'name@example.com')) }}
                </div>

                <div class="form-group">
                     {{Form::label('message', 'Ваше сообщение')}}
                     {{ Form::textarea('message','',array('required' => 'required', 'class' => 'form-control', 'rows' => '3', 'id' => 'textarea')) }}
                </div>

                 {{ Form::submit('Отправить', array('class' => 'btn btn-primary mb-2', 'id' => 'send')) }}
                    <a href="{{ route("start") }}">{{ Form::button('Назад', array('class' => 'btn btn-secondary', 'route' => 'start')) }} </a>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
</body>
</html>
