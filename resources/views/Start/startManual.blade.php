@extends('layouts.dashboard')
@section('style')
    {{HTML::style('css/manual.css')}}
@stop
@section('content')

    <div class="cont"></div>
    <header>
        <nav>
            <a href="{{ route('start') }}" class="active">Главная</a>
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

    <main>
        <div name="one"><h2>Участие в квесте</h2>
            <p>Для того, чтобы участвовать в квесте, необходимо зарегистрироваться на сайте
                или позвонить администратору по телефону 1-1111-111-11.
                Участники обязаны оставить свои реальные Имя, Фамилию и номера телефонов,
                чтобы администраторы квеста имели обратную связь.</p>
        </div>
        <div name="two"><h2>Рекомендации игроку</h2>
            <ul>
                <li>Рекомендуем надевать комфортную одежду и обувь (casual, не маркая, свободная, удобная одежда).</li>
                <li>На игру необходимо прибыть заранее для прохождения инструктажа. В случае опоздания,
                    мы будем вынуждены сократить время игры на время опоздания.
                </li>
                <li>В момент прохождения квеста командой, нахождение других игроков, зрителей и иных третьих лиц
                    в комнате администратора – ЗАПРЕЩАЕТСЯ.
                </li>
                <li>Если у Вас хронические заболевания сердца, эпилепсия, болезни нервной системы,
                    беременность – мы не рекомендуем прохождение квеста. Если же Вы решились пройти квест,
                    обязательно проконсультируйтесь с врачом.
                </li>
            </ul>
        </div>
        <div name="three"><h2>Lorem ipsum dolor sit amet</h2>
            <p>consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium
                ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</p>
        </div>
        <div name="four"><h2>Что запрещается</h2>
            <ul>
                <li>– Участвовать в квесте в алкогольном и наркотическом опьянении.</li>
                <li>– Ломать мебель, двери и другие атрибуты квеста. Основа квеста – логика и наблюдательность, грубая
                    физическая сила в квесте
                    <b>НЕ ТРЕБУЕТСЯ и КАТЕГОРИЧЕСКИ ЗАПРЕЩАЕТСЯ.</b></li>
            </ul>
        </div>
        <div name="five"><h2>Lorem ipsum dolor sit amet</h2>
            <p>consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium
                ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</p>
        </div>
        <div name="six"><h2>Lorem ipsum dolor sit amet</h2>
            <p>consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium
                ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</p>
        </div>
        <div name="seven"><h2>Lorem ipsum dolor sit amet</h2>
            <p>consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium
                ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</p>
        </div>
        <div name="eight"><h2>Lorem ipsum dolor sit amet</h2>
            <p>consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium
                ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</p>
        </div>
        <div name="nine"><h2>Lorem ipsum dolor sit amet</h2>
            <p>consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium
                ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</p>
        </div>
    </main>


    <script>
        var elem = document.getElementsByName("<?php echo $link ?>");
        elem[0].scrollIntoView();
    </script>

@stop
