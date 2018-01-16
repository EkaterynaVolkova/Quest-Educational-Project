@extends('layouts.dashboard')
@section('style')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MoreQuests</title>
    {{HTML::style('css/User/userMoreQuests.css')}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

@stop
@section('content')
    <header>
        @include('Users.General.headerNav');
    </header>
    <main>
        <div class="container" id="main-container">
            <div class="row" id="row">
                <!-- Gallery Items
                ================================================== -->
                <div class="moreQuest">
                    <div class="row" id="row">
                        <div class="moreQuestPicture">
                            <img src="../../../img/moreQuest/cowboy.jpg" class="thum" alt="image">
                        </div>
                        <div class="moreQuestAbout">
                            <h2>{!! $q->name !!}</h2>
                            <p class="lead-m">{!! $q->description !!}</p>
                            <p class="description">{!! $q->fullDescription !!}.</p>
                            <ul class="project-info">
                                <li><h6>Дата Старта:</h6> {!! $q->date !!}</li>
                                <li><h6>Время Старта:</h6> {!! $q->time !!}</li>
                                <li><h6>Конец Квеста:</h6> Дата</li>
                                <li><h6>Сложность:</h6> Хард Басс</li>
                                <li><h6>Автор Квеста:</h6> Сидоров Мойша</li>
                            </ul>
                            <a class="btn btn-inverse pull-left" href="{{route('play', ['id'=>$q->id])}}">Играть</a>
                            <a href="{{ route('user_view_quest') }}" class="pull-right"><i class="icon-arrow-left"></i>Back
                                to Gallery</a>
                        </div>
                    </div>
                </div><!-- End gallery-single-->
            </div><!-- End container row -->
        </div> <!-- End Container -->

    </main>
    <footer>
         <div id="res"></div>
        <label for="select"> Выбирайте вашу команду: </label>
        <select id="msg">;
            @foreach($team as $value)
                <option name="option" id="option" value="{!! $value->id !!}">
                    {!! $value->name !!}
                </option>
            @endforeach
        </select>
        <script>
            function getMessage() {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '/public/users/selectTeam',
                    data: {"team": $('#msg').val()},
                    success: function (data) {
                        $("#res").html(data.msg);
                    }
                });
            }
        </script>


        <?php
        echo Form::button('Выбрать', ['onClick' => 'getMessage()']);
        ?>
    </footer>
@stop