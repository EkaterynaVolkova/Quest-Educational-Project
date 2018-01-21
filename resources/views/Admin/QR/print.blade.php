@extends('layouts.adminLayouts')
@section('content')
    <header>
        @include('Admin.nav');
    </header>

    <div class="row">
        @include('Admin.leftNav');
        <main>
            <div class="text-center">
                {!! QrCode::size(300)->generate( $qr ); !!}
                <p>Scan me...</p>
            </div>
        </main>
    </div>
    @stop