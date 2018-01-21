@extends('layouts.adminLayouts')
@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/Admin/adminViewQuests.css">
@stop
@section('content')
        <main>
            @if ($msg)
                <h1>{{$msg}}</h1>
                <?php $msg = 0; ?>
            @else
                <h1>Ура! Ты - админ!</h1>
            @endif
        </main>

@stop