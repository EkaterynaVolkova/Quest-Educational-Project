@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/stylesAdminViewQuests.css')!!}
    {!!HTML::style('css/table.css')!!}
@stop
@section('content')

    <header></header>
    <div class="row">
        <nav>
            <a href="/html/">HTML</a>
            <a href="/css/">CSS</a>
            <a href="/js/">JavaScript</a>
            <a href="/jquery/">jQuery</a>
        </nav>

        <main>
            <h1>Список квестов</h1>
            <?php

            echo Form::open(array('url' => route('admin_add_quest'), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
            echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span></button>';
            echo Form::close();

            echo "<table>";
            echo "<tr><th>id</th><th>name</th><th>description</th><th>date</th><th>time</th></tr>";
            foreach ($quests as $key => $value) {
                echo "<tr>";
                echo "<td> " . $value->id . " </td>";
                echo "<td> " . $value->name . " </td>";
                echo "<td> " . $value->description . " </td>";
                echo "<td> " . $value->date . " </td>";
                echo "<td> " . $value->time . " </td>";
                echo "<td> ";
                echo Form::open(array('url' => route('editQuest'), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
                echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>';
                echo Form::hidden('id', $value->id);
                echo Form::close();
                echo Form::open(array('url' => route('deleteQuest'), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
                echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-trash"></span></button>';
                echo Form::hidden('id', $value->id);
                echo Form::close();
                echo Form::open(array('url' => route('viewTasksAdmin'), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
                echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span></button>';
                echo Form::hidden('id', $value->id);
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