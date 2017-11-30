@extends('header')
<link href={{ asset('css/stylesAT.css') }} rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Новaя Задача!</h2>

    <?php
    echo "<br>";
    echo Form::open(array('url' => route('postTask', $idQuest), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));

    echo Form::label('name', 'Название') . Form::text('name');
    echo "<br>";
    echo Form::label('description', 'Описание') . Form::text('description');
    echo "<br>";
    echo Form::label('duration', 'Длительность:') . Form::time('duration');
    echo "<br>";
    echo Form::label('weight', 'Вес задачи:') . Form::number('weight');
    echo "<br>";
    echo Form::label('QR', 'Текст для QR-кода:') . Form::text('QR');
    echo "<br>";
    echo Form::submit('Добавить');

    echo Form::token() . Form::close();

    ?>


</div>
</body>
</html>