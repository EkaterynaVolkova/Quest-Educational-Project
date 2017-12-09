@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/User/userContact.css')!!}
@stop


@section('content')
    <header>
        @include('Admin.nav');
    </header>

    <h1>ОБРАТНАЯ СВЯЗЬ</h1>

    <div class="contact_info">

        <div class="detail">
            <h4>О нас</h4>
            <p>г. Харьков пл. Свободы</p>

            <h4>Связаться с нами</h4>
            <p>+38 066 0085535</p>

            <h4>Email us</h4>
            <p>realwindrunner@gmail.com</p>
        </div>

        {{ Form::open(array('url' => 'contact-form')) }}
        {{ Form::email('email') }}
        {{ Form::textarea('message') }}
        {{ Form::submit('send') }}
        {{ Form::close() }}

    </div>
@stop
