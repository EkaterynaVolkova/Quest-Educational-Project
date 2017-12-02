@extends('header')
<link href={{ asset('css/stylesCQ.css') }} rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Редактирование</h2>

    <?php
    echo "<br>";
    echo Form::open(array('url' => route('edit', $quest), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));

    echo Form::label('name', 'Название') . Form::text('name', $quest->name);
    echo "<br>";
    echo Form::label('description', 'Описание') . Form::text('description', $quest->description);
    echo "<br>";
    echo Form::label('date', 'Дата проведения:') . Form::date('date', $quest->date);
    echo "<br>";
    echo Form::label('time', 'Время начала:') . Form::time('time', $quest->time);
    echo "<br>";

    echo Form::submit('Добавить');

    echo Form::token() . Form::close();

    ?>
</div>
</body>
</html>



