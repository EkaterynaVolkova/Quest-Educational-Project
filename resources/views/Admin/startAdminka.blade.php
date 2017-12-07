@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/AdminGeneral/adminBody.css')!!}
    {!!HTML::style('css/AdminGeneral/adminNav.css')!!}
@stop
@section('content')

    <header>
        @include('Admin.nav');
    </header>

    <div class="row">

        @include('Admin.leftNav');

        <main>
        <h1>Ура! Ты - админ!</h1>
        </main>

    </div>
    <footer></footer>

@stop