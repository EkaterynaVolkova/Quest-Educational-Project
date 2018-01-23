@extends('layouts.adminLayouts')
@section('content')

        <main>
            <div class="text-center">
                {!! QrCode::size(300)->generate( $qr ); !!}
                <p>Scan me...</p>
            </div>
        </main>

    @stop