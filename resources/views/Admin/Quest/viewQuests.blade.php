@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/Admin/adminViewQuests.css')!!}
    {!!HTML::style('css/AdminGeneral/tables.css')!!}
    {!!HTML::style('css/AdminGeneral/adminNav.css')!!}
@stop
@section('content')

    <header>
 @include('Admin.nav');
    </header>

    <div class="row">

        @include('Admin.leftNav');

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
                echo "<td> <div>" . $value->id . "</div> </td>";
                echo "<td> <div>" . $value->name . "</div> </td>";
                echo "<td class='description'> <div >" . $value->description . "</div> </td>";
                echo "<td class='date'> <div>" . $value->date . "</div> </td>";
                echo "<td> <div>" . $value->time . "</div> </td>";
                echo "<td> ";
                echo Form::open(array('url' => route('editQuest', $value->id), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
                echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>';
                echo Form::close();
                echo Form::open(array('url' => route('deleteQuest', $value->id), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
                echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-trash"></span></button>';
                echo Form::close();
                echo Form::open(array('url' => route('showTasksByQuest', $value->id), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
                echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span></button>';
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