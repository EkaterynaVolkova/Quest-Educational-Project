@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/Admin/adminQR.css')!!}
    {!!HTML::style('css/AdminGeneral/tables.css')!!}
    {!!HTML::style('css/AdminGeneral/adminNav.css')!!}
    {!!HTML::style('css/AdminGeneral/adminBody.css')!!}
@stop
@section('content')

    <header>
        @include('Admin.nav');
    </header>

    <div class="row">

        @include('Admin.leftNav');

        <main>
            <div class="text-center">
                {!! QrCode::size(300)->generate(/*Request::url()*/ $qr ); !!}
                <p>Scan me...</p>
            </div>
        </main>
    </div>
    </body>
    </html>