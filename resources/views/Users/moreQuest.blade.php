@extends('layouts.dashboard')
@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/User/userMoreQuests.css">
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/UserGeneral/headerNav.css">
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
                           <img src="{{$q->avatar}}" class="thum" alt="image">
                        </div>
                        <div class="moreQuestInfo">
                               <div class="links">
                                <a class="icon-arrow-left right" href="#" onclick="play()">Играть</a>
                                <a href="{{ route('view quest') }}" class=""><i
                                            class="icon-arrow-left"></i>Назад в галерею</a>
                               </div>

                            <div class="select" id="sel-team">
                                    <label for="msg"> Выберите команду: </label>
                                    <select id="msg" onchange="getMessage()">;
                                        @foreach($team as $value)
                                            <option name="option" id="option" value="{!! $value->id !!}">
                                                {!! $value->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                            </div>
                            <div id="res"></div>
                            <div class="moreQuestAbout">
                                <h2>{!! $q->name !!}</h2>
                                <p class="lead-m">{!! $q->description !!}</p>
                                 <ul class="project-info">
                                    <li><h6>Дата Старта:</h6> {!! $q->date !!}</li>
                                    <li><h6>Время Старта:</h6> {!! $q->time !!}</li>
                                    <li><h6>Сложность:</h6> {!! $q->hard !!}</li>
                                    <li><h6>Автор Квеста:</h6> {!! $q->author !!}</li>
                                    <li><h6>Описание:</h6>{!!$q->fullDescription !!}</li>
                                </ul>

                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- End gallery-single-->
        </div><!-- End container row -->
        </div> <!-- End Container -->

    </main>
    <footer></footer>

    <script>

        function play() {
            document.getElementById('sel-team').style.visibility = 'visible';
        }

        function getMessage($q) {
            var a = "<?php echo $q->id ?>";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/public/users/selectTeam',
                data: {"team": $('#msg').val(), "quest": a},
                success: function (data) {
                    $("#res").html(data.msg);
                }
            });
        }
    </script>

@stop