@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/User/userViewQuests.css')!!}
    {!!HTML::style('css/UserGeneral/headerNav.css')!!}
@stop
@section('content')

    <header>
        @include('Users.General.headerNav')
    </header>

    <main>
        <div class="row">
            @foreach($quests as $q)
                <div class="quest">
                    <h3 class="text-center">{!! $q->name !!}</h3>
                    <h3 class="text-center">{!! $q->date !!}</h3>
                    <button class="btn btn-link"><a href="{{route('more', ['id'=>$q->id])}}">More</a></button>
                </div>
            @endforeach
        </div>
    </main>

    <footer></footer>
@stop