@extends('layouts.dashboard')
@section('style')
    {{HTML::style('css/errors.css')}}
@stop
@section('content')

       <div class="cont">
        <header>
            <nav>
                <a href="/public/" class="active">Home</a>
                @if (!(Auth::check()))
                    <a href="/public/login">Login</a>
                @else
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit()"> Logout </a>
                @endif
                <a href="contact-form">Contacts</a>
            </nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">{{ csrf_field() }}</form>
            <div class="shadow"></div>
        </header>

        <main class="errors">
            <h1 class ="errors">OOPS!!! Такой страницы не существует</h1>
        </main>


      </div>

@stop
