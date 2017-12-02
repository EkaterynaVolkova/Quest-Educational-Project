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


        echo Form::open(array('url' => route('createTask',$idQuest), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
        echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span></button>';
        //echo Form::hidden('idQuest', $idQuest);
        Form::close();

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

            echo "<td> ";
            echo Form::open(array('url' => route('editTask', ['id'=>$value->id, 'idQuest'=>$idQuest]), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
            echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>';
            //echo Form::hidden('id', $value->id);
            echo Form::close();

            echo Form::open(array('url' => route('deleteTask', ['id'=>$value->id, 'idQuest'=>$idQuest]), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
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
