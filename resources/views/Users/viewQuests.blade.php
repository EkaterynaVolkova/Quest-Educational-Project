@extends('layouts.dashboard')
@section('style')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quests</title>
    {!!HTML::style('css/User/userViewQuests1.css')!!}
@stop
@section('content')
<header>
    @include('Users.General.headerNav')
</header>

<main>
    <div class="container-fluid">
        <ul class="gallery-post-grid holder">
            <div class='row'>

                @foreach($quests as $key => $q)
                    @if(count($quests) == 1)
                        <div class='col-xs-12 col-sm-12 col-md-12 dQ'><li class='quest' data-id='id-<?= $key ?>' data-type='illustration'>
                        <span class='gallery-hover-3col hidden-phone hidden-tablet'>
                            <span class='gallery-icons'>
                                <a href='img/gallery/gallery-img-1-full.jpg' class='item-zoom-link lightbox' title='Просмотр' data-rel='prettyPhoto'></a>
                                <a href='{{route('more', ['id'=>$q->id])}}' class='item-details-link' title='Играть'></a>
                            </span>
                        </span>
                        <span class='project-details'><a href='gallery-single.htm'>{!! $q->name !!}</a>{!! $q->description !!}<br>{!! $q->date !!}.</span>
                    </li></div>
                    @elseif(count($quests) < 3)
                        <div class='col-xs-12 col-sm-6 col-md-6 dQ'><li class='quest' data-id='id-<?= $key ?>' data-type='illustration'>
                        <span class='gallery-hover-3col hidden-phone hidden-tablet'>
                            <span class='gallery-icons'>
                                <a href='img/gallery/gallery-img-1-full.jpg' class='item-zoom-link lightbox' title='Просмотр' data-rel='prettyPhoto'></a>
                                <a href='{{route('more', ['id'=>$q->id])}}' class='item-details-link' title='Играть'></a>
                            </span>
                        </span>
                        <span class='project-details'><a href='gallery-single.htm'>{!! $q->name !!}</a>{!! $q->description !!}<br>{!! $q->date !!}.</span>
                    </li></div>
                    @else
                        <div class='col-xs-12 col-sm-6 col-md-4 dQ'><li class='quest' data-id='id-<?= $key ?>' data-type='illustration'>
                            <span class='gallery-hover-3col hidden-phone hidden-tablet'>
                            <a href='#' class='pp'></a>
                                <span class='gallery-icons'>
                                    <a href='img/gallery/gallery-img-1-full.jpg' class='item-zoom-link lightbox' title='Просмотр' data-rel='prettyPhoto'></a>
                                    <a href='{{route('more', ['id'=>$q->id])}}' class='item-details-link' title='Играть'></a>
                                </span>
                            </span>
                            <span class='project-details'><a href='gallery-single.htm'>{!! $q->name !!}</a>{!! $q->description !!}<br>{!! $q->date !!}.</span>
                        </li></div>
                    @endif
                @endforeach

            </div>
        </ul>
    </div>
</main>
@stop