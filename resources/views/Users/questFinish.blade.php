@extends('layouts.dashboard')
@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/User/userProfile.css">
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/UserGeneral/headerNav.css">
@stop
@section('content')
    <header>
        @include('Users.General.headerNav')
    </header>
    <main>
        <div class="menu-container">
            <div id="logo-container">
                <img src="{{Auth::user()->avatar}}" class="logo-container-pict">
            </div>
            <div class="menu-main-container">
                <ul class="menu">
                    <li>
                        <div class="about">
                            <p>{{Auth::user()->name}}</p>
                            <p>Возраст: {{Auth::user()->age}}</p>
                            <p> Пол: {{Auth::user()->gender}}</p>
                        </div>
                    </li>
                    <li><a href="{{route('userProfile')}}">Профиль</a></li>
                </ul>
            </div>

        </div>

        <section class="section">
            <div id="section_inner">
                <h2> Поздравляем! Вы прошли квест!</h2>
            </div>
        </section>
    </main>

    @stop