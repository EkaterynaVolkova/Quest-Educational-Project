@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/User/userProfile.css')!!}
    {!!HTML::style('css/UserGeneral/headerNav.css')!!}
@stop
@section('content')

    <header>
        @include('Users.General.headerNav');
    </header>

    <main>
        <div class="column">
            @foreach($quests as $key => $q)
                <div class="row">
                    <span class="text-center">{!! json_decode($q)->name !!}</span>
                    <span class="text-center">{!! json_decode($q)->date !!}</span>
                    <button class="btn btn-link"><span class="glyphicon glyphicon-th-list"></span></button>
                </div>
                <div class="column task">
                    @foreach(json_decode($tasks[$key]) as $t)
                        <div class="row">
                            <span class="text-center">{!! $t->id !!}</span>
                            <span class="text-center">{!! $t->name !!}</span>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </main>

    <footer></footer>
@stop