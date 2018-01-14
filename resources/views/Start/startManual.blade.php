@extends('layouts.dashboard')
@section('style')
    {{HTML::style('css/manual.css')}}
@stop
@section('content')

    <div class="cont"></div>
        <header>
            <nav>
                <a href="" class="active">Home</a>
                <a href="/public/login">Login</a>
                <a href="contact-form">Contacts</a>
            </nav>
            <div class="shadow"></div>
        </header>

        <main>
            <p><a name="one">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</a></p>
            <p><a name="two">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</a></p>
            <p><a name="three">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</a></p>
            <p><a name="four">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</a></p>
            <p><a name="five">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</a></p>
            <p><a name="six">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</a></p>
            <p><a name="seven">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</a></p>
            <p><a name="eight">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</a></p>
            <p><a name="nine">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</a></p>
            <p><a name="ten">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate tempore perferendis, quo delectus quidem nesciunt praesentium ut sequi reiciendis, laboriosam sit nemo! Alias, maxime, atque! Nam sequi quia saepe cupiditate.</a></p>
        </main>


     <script>
        var elem = document.getElementsByName("<?php echo $link ?>");
        elem[0].scrollIntoView();
     </script>

@stop
