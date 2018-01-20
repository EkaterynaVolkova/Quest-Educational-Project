@extends('layouts.dashboard')
@section('style')
    {{HTML::style('css/stylesStart.css')}}
@stop
@section('content')

    <div class="splash fade-in">
        <a href="#" class="splash-arrow fade-in"><img src="img/down-arrow.png" alt=""/></a>
    </div> <!-- END .splash -->

    <div class="cont">
        <header>
            <nav>
                <a href="" class="active">Главная</a>
                @if (!(Auth::check()))
                    <a href="/public/login">Вход</a>
                @else
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()"> Выход </a>
                @endif
                <a href="{{ route('contact-form') }}">Контакты</a>
            </nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
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
                    <div class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate tempore
                        perferendis, quo delectus quidem nesciunt praesentium ut sequi reiciendis, laboriosam sit nemo!
                        Alias, maxime, atque! Nam sequi quia saepe cupiditate.
                    </div>
                </div>
                <div class="rows">
                    <div class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione ab error
                        distinctio nesciunt, id qui laboriosam, quod veritatis nam, repellendus quaerat. Rerum placeat,
                        illum, iusto eius maiores eos accusantium repellendus!
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
                    <a href="{{route('info', ['idLink'=> 'three'])}}" class="footer-link">Lorem ipsum</a>
                    <a href="{{route('info', ['idLink'=> 'four'])}}" class="footer-link">Что запрещается</a>
                </div>
                <div class="column">
                    <a href="{{route('info', ['idLink'=> 'five'])}}" class="footer-link">Lorem ipsum</a>
                    <a href="{{route('info', ['idLink'=> 'six'])}}" class="footer-link">Lorem ipsum</a>
                    <a href="{{route('info', ['idLink'=> 'seven'])}}" class="footer-link">Lorem ipsum</a>
                    <a href="{{route('info', ['idLink'=> 'eight'])}}" class="footer-link">Lorem ipsum</a>
                </div>
                <div class="column">
                    <a href="{{route('info', ['idLink'=> 'nine'])}}" class="footer-link">Lorem ipsum</a>
                </div>
            </div>
            <p class="copyrite text-center"><b>C© 2017. Все права защищены</b></p>
        </footer>
    </div>

    </div>

    <script>
        window.onload(function(){
           document.keydown(function(){
               alert('down');
           });
        });
    </script>

@stop
