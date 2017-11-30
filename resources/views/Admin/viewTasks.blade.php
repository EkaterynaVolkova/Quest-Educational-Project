@extends('header')
<link href={{ asset('css/stylesVT.css') }} rel="stylesheet">
</head>
<body>
<div class="container">

    <h1>Список заданий</h1>
    <?php


    echo Form::open(array('url' => route('createTask', $idQuest), 'method' => 'post', 'role' => 'form', 'class' => 'form-vertical'));
    echo Form::submit('Добавить');
    echo Form::token() . Form::close();

    echo Form::open(array('url' => route('showQuests'), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
    echo Form::submit('Назад');
    Form::close();


    ?>

    <?php

    echo "<table>";
    echo "<tr><th>id</th><th>name</th><th>description</th><th>duration</th><th>weight</th><th>QR</th></tr>";
    foreach ($tasks as $key => $value) {
        echo "<tr>";
        echo "<td> " . $value->id . " </td>";
        echo "<td> " . $value->name . " </td>";
        echo "<td> " . $value->description . " </td>";
        echo "<td> " . $value->duration . " </td>";
        echo "<td> " . $value->weight . " </td>";
        echo "<td> " . $value->QR . " </td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>


</div>
</body>
</html>