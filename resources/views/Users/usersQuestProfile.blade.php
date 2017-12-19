@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/User/userProfile.css')!!}
    {!!HTML::style('css/UserGeneral/headerNav.css')!!}
@stop
@section('content')

    <header>
        @include('Users.General.headerNav')
    </header>

    <main>
        <aside>
            <div class="avatar"></div>
            <p class="name">Имя: {{Auth::user()->name}}</p>
            <p class="name">Возраст: {{Auth::user()->age}}</p>
            <p class="name">Пол: {{Auth::user()->gender}}</p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <button class="btn btn-link link"><a href="" onclick="openbox('idTQ'); return false">Текущий
                    квест</a>
            </button>
            <button class="btn btn-link link"><a href="" onclick="openbox('idFQ'); return false">Грядущие квесты</a>
            </button>
            <button class="btn btn-link link"><a href="" onclick="openbox('idLQ'); return false">Архив</a>
            </button>
        </aside>

        <section class="section">

            <div id="section_inner">

                <div class="column" id="idTQ">

                    <div class="row">
                        <div class="text-center">Название</div>
                        <div class="text-center">Дата</div>
                        <div class="text-center">Время</div>
                        <div class="text-center">Команда</div>
                        <div></div>
                    </div>
                    @foreach($questGeneral as $key => $q)
                        @foreach(json_decode($q) as $k => $v)
                            <div class="row quest">
                                <div class="text-center">{!! $v->name !!}</div>
                                <div class="text-center">{!! $v->date !!}</div>
                                <div class="text-center">{!! $v->time !!}</div>
                                <div class="text-center">{!! $teamGeneral !!}</div>
                                <div>
                                    <button class="btn btn-link"><a href="{{route('playQuest', ['idQuest'=>$v->id])}}"
                                                                    class="glyphicon glyphicon-play"></a>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>


                <div class="column" id="idFQ">
                    <div class="row">
                        <div class="text-center">Название</div>
                        <div class="text-center">Дата</div>
                        <div class="text-center">Время</div>
                        <div class="text-center">Команда</div>
                        <div></div>
                    </div>
                    @foreach($questFuture as $key => $q)
                        @foreach(json_decode($q) as $k => $v)
                            <div class="row quest">
                                <div class="text-center">{!! $v->name !!}</div>
                                <div class="text-center">{!! $v->date !!}</div>
                                <div class="text-center">{!! $v->time !!}</div>
                                <div class="text-center">{!! $teamFuture[$key] !!}</div>
                                <div>
                                    <button class="btn btn-link"><a href="" class="glyphicon glyphicon-pencil"></a>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>


                <div class="column" id="idLQ">
                    <div class="row">
                        <div class="text-center">Название</div>
                        <div class="text-center">Дата</div>
                        <div class="text-center">Время</div>
                        <div class="text-center">Команда</div>
                        <div></div>
                    </div>
                    @foreach($questLast as $key => $q)
                        @foreach(json_decode($q) as $k => $v)

                            <div class="row quest">
                                <div class="text-center">{!! $v->name !!}</div>
                                <div class="text-center">{!! $v->date !!}</div>
                                <div class="text-center">{!! $v->time !!}</div>
                                <div class="text-center">{!! json_decode($teamGeneral) !!}</div>
                                <div>
                                    <button class="btn btn-link"><a href="" class="glyphicon glyphicon-th-list"
                                                                    onclick="openbox('id{{$key}}'); return false"></a>
                                    </button>
                                </div>
                            </div>

                            <div class="column task" id="id{{$key}}">
                                <div class="row">
                                    <div class="text-center">Название</div>
                                    <div class="text-center">Описание</div>
                                    <div class="text-center">Длительность</div>
                                    <div class="text-center">Вес</div>
                                </div>
                                @foreach($tasksLast as $kk => $task)
                                    @if($kk == $key)
                                        @foreach(json_decode($task) as $k2 => $t)

                                            <div class="row">
                                                <div class="text-center">{!! $t->name !!}</div>
                                                <div class="text-center">{!! $t->description !!}</div>
                                                <div class="text-center">{!! $t->duration !!}</div>
                                                <div class="text-center">{!! $t->weight !!}</div>
                                            </div>

                                        @endforeach
                                    @endif
                                @endforeach
                            </div>

                        @endforeach
                    @endforeach

                </div>


            </div> <!-- div section inner-->
        </section>

    </main>

    <footer></footer>

    <script type="text/javascript">
        function openbox(id) {
            display = document.getElementById(id).style.display;
            if (display == 'none') {
                document.getElementById(id).style.display = 'block';
            } else {
                document.getElementById(id).style.display = 'none';
            }
        }
    </script>

@stop