@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/Quests/UserViewQuests.css')!!}
@stop
@section('content')

    <header>
        <nav>
            <ul class="nav">
                <li class="active"><a href="/public/">Home</a></li>
                <li><a href="/public/login">Login</a></li>
                <li><a href="">Contacts</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="row">
            @foreach($quests as $q)
                <div class="quest">
                    <h3 class="text-center">{!! $q->name !!}</h3>
                    <h3 class="text-center">{!! $q->date !!}</h3>
                    <button class="btn btn-link"><a href="{{route('more')}}">More</a></button>
                </div>
            @endforeach
        </div>
    </main>

    <footer></footer>
@stop