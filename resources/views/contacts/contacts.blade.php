@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/User/userContact.css')!!}
    {!!HTML::style('css/UserGeneral/headerNav.css')!!}
@stop


@section('content')
    <header>
        @include('Users.General.headerNav')
    </header>

    <h1>ОБРАТНАЯ СВЯЗЬ</h1>

    <div class="contact_info">

        <div class="detail">
            <h4>Адрес</h4>
            <p>г. Харьков пл. Свободы</p>

            <h4>Связаться с нами</h4>
            <p>+38 066 0085535</p>

            <h4>Email</h4>
            <p>realwindrunner@gmail.com</p>
        </div>

        <div class="form">
        {{ Form::open(array('url' => 'contact-form')) }}
            <div claas="label">Email: </div>
        {{ Form::email('email') }}
            <div class="label">Cooбщение: </div>
        {{ Form::textarea('message') }}
        {{ Form::submit('send') }}
        {{ Form::close() }}
        </div>

    </div>
@stop
