@extends('layouts.dashboard')
@section('style')
{!!HTML::style('css/stylesAdminViewTask.css')!!}
{!!HTML::style('css/table.css')!!}
@stop

@section('content')

<header></header>
<div class="row">
    <nav>
        <a href="{{route('showUsers')}}">Users</a>
        <a href="{{route('showQuests')}}">Quests</a>
        <a href="{{route('showTasks')}}">Tasks</a>
    </nav>

    <main>

        <h1>Список заданий</h1>

        <?php
        echo "<table>";
        echo "<tr><th>id</th><th>idQuest</th><th>name</th><th>description</th><th>duration</th><th>weight</th><th>QR</th></tr>";
        foreach ($tasks as $key => $value) {
            echo "<tr>";
            echo "<td> " . $value->id . " </td>";
            echo "<td> " . $value->idQuest . " </td>";
            echo "<td> " . $value->name . " </td>";
            echo "<td> " . $value->description . " </td>";
            echo "<td> " . $value->duration . " </td>";
            echo "<td> " . $value->weight . " </td>";
            echo "<td> " . $value->QR . " </td>";

            echo "<td> ";
            echo Form::open(array('url' => route('editOneTask', ['id'=>$value->id]), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
            echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>';
            echo Form::close();

            echo Form::open(array('url' => route('deleteOneTask', ['id'=>$value->id]), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
            echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-trash"></span></button>';
            echo Form::close();
            echo " </td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </main>
</div>
<footer></footer>
@stop
