@extends('layouts.dashboard')
@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/stylesStart.css">
@stop
@section('content')

    <div class="splash fade-in">
        <a href="#" class="splash-arrow fade-in"><img src="/public/img/down-arrow.png" alt=""/></a>
    </div>

    <div class="cont">
        <header>
            <nav>
                <a href="" class="active">Главная</a>
                @if (!(Auth::check()))
                    <a href="/public/login">Вход</a>
                @else
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit()"> Выход </a>
                @endif
                <a href="{{ route('contact-form') }}">Контакты</a>
            </nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">{{ csrf_field() }}</form>
            <div class="shadow"></div>
        </header>

        <main class="cover">
            <p class="lead button">
                <a href="users/view" class="start-button">Далее...</a>
            </p>
        </main>

        <footer>
            <div class="footer">
                <div class="rows">
                    <div class="img img1"></div>
                    <div class="desc">QR-код получил в наши дни широкое распространение за счет того, что информацию,
                        содержащуюся в нём, легко можно прочесть с помощью камеры мобильного телефона.
                        Для этого достаточно иметь одну из программ-распознавалок QR-кодов, которых
                        множество в сети. Поэтому, при создании наших квестов, Мы внедрили возможность подтверждения
                        прохождения заданий по скану QR.
                    </div>
                </div>
                <div class="rows">
                    <div class="desc">Геолокация — это определение реального местоположения электронного устройства,
                        которым в нашем случае выступает смартфон или телефон. Геолокация не привязана к спутниковым
                        системам, местоположение может
                        определяться по расположению станций сотовых сетей. Или, к примеру, с помощью подключения к сети
                        интернет. Мы используем геолокацию для определения местоположения команды при
                        выполнении задания.
                    </div>
                    <div class="img img2"></div>
                </div>
                <div class="rows">
                    <div class="img img3"></div>
                    <div class="desc">Квест — это приключение-аттракцион, который перенесет вас в самый центр хорошо
                        знакомых историй и даст возможность побыть в роли известных персонажей. Испытайте себя — успейте
                        разыскать все тайники и разгадать все головоломки, следуя подсказкам.
                    </div>
                </div>
            </div>

            <div class="block-link">
                <div class="column">
                    <a href="{{route('info', ['idLink'=> 'one'])}}" class="footer-link">Участие в квесте</a>
                    <a href="{{route('info', ['idLink'=> 'two'])}}" class="footer-link">Рекомендации игроку</a>
                    <a href="{{route('info', ['idLink'=> 'three'])}}" class="footer-link">Правила игры</a>
                    <a href="{{route('info', ['idLink'=> 'four'])}}" class="footer-link">Что запрещается</a>
                </div>
                <div class="column">
                    <a href="{{route('info', ['idLink'=> 'five'])}}" class="footer-link">QR-код</a>
                    <a href="{{route('info', ['idLink'=> 'six'])}}" class="footer-link">Геолокация</a>
                    <a href="{{route('info', ['idLink'=> 'seven'])}}" class="footer-link">Добавить квест</a>
                    <a href="{{route('info', ['idLink'=> 'eight'])}}" class="footer-link">Акции</a>
                </div>
                <div class="column">
                    <a href="{{route('contact-form')}}" class="footer-link">Контакты</a>
                </div>
            </div>
            <p class="copyrite text-center"><b>C© 2017. Все права защищены</b></p>
        </footer>
    </div>

    </div>

    <script>
        $(document).ready(function () {
            if ($(".splash").is(":visible")) {
                $(".content").css({"opacity": "0"});
            }

            $(".splash-arrow").click(function () {
                $(".splash").slideUp("800", function () {
                    $(".content").delay(100).animate({"opacity": "1.0"}, 800);
                });
            });
        });

        $(window).scroll(function () {
            $(window).off("scroll");
            $(".splash").slideUp("800", function () {
                $("html, body").animate({"scrollTop": "0px"}, 100);
                $(".content").delay(100).animate({"opacity": "1.0"}, 800);
            });
        });
    </script>

@stop
