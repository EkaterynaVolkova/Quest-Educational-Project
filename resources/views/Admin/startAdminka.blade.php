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
            @if ($msg)
                <h1>{{$msg}}</h1>
                <?php $msg = 0; ?>
            @else
                <h1>Ура! Ты - админ!</h1>
            @endif
        </main>

    </div>
    <footer></footer>

@stop