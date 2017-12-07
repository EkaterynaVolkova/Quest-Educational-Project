@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/Admin/adminViewTask.css')!!}
    {!!HTML::style('css/AdminGeneral/tables.css')!!}
    {!!HTML::style('css/AdminGeneral/adminNav.css')!!}
    {!!HTML::style('css/AdminGeneral/adminBody.css')!!}
@stop

@section('content')

    <header>
        @include('Admin.nav');
    </header>


    <div class="row">

        @include('Admin.leftNav');

        <main>

        <h1>Список заданий</h1>

        <?php

        echo Form::open(array('url' => action('Admin\AdminTaskController@add', ['idQuest' => $idQuest]), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
        echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span></button>';
        echo Form::close();

        echo "<table>";
        echo "<tr><th>id</th><th>name</th><th>description</th><th>duration</th><th>weight</th><th>QR</th></tr>";
        foreach ($tasks as $key => $value) {
            echo "<tr>";
            echo "<td> <div>" . $value->id . "</div> </td>";
            echo "<td> <div class='name'>" . $value->name . "</div> </td>";
            echo "<td> <div class='description'>" . $value->description . "</div> </td>";
            echo "<td> <div>" . $value->duration . "</div> </td>";
            echo "<td> <div>" . $value->weight . "</div> </td>";
            echo "<td> <div>" . $value->QR . "</div> </td>";

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
