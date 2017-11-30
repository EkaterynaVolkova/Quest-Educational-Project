@extends('header')
<link href={{ asset('css/stylesVQ.css') }} rel="stylesheet">

</head>
<body>
    <div class="container">

        <nav>
            <ul class="nav masthead-nav">
                <li class="active"><a href="/public/">Home</a></li>
                <li><a href="/public/login">Login</a></li>
                <li><a href="">Contacts</a></li>
            </ul>
        </nav>

    <div class="row ">
    @foreach($quests as $q)
        <div class="quest">
            <h3 class="text-center">{!! $q->name !!}</h3>
            <h3 class="text-center">{!! $q->date !!}</h3>
            <button class="btn btn-default btn-lg active"><a href="{{route('more')}}">More...</a></button>
        </div>
       @endforeach
    </div>
    </div>
</body>
</html>