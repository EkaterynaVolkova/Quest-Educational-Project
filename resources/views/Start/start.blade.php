@extends('layouts.dashboard')
@section('style')
       {{HTML::style('css/stylesStart.css')}}
@stop
@section('content')


    <header>
        <nav>
            <ul class="nav masthead-nav">
                <li class="active"><a href="">Home</a></li>
                <li><a href="/public/login">Login</a></li>
                <li><a href="contact-form">Contacts</a></li>
            </ul>
        </nav>
    </header>

    <main class="cover">
        <h1 class="cover-heading">Cover your page.</h1>
        <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download,
            edit the text, and add your own fullscreen background photo to make it your own.</p>
        <p class="lead button">
            <a href="users/view" class="btn btn-lg btn-default">GET STARTED</a>
        </p>
    </main>

    <footer>
        <p class="footer">C© 2017. Все права защищены</p>
    </footer>



@stop
