@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/Admin/adminShowTeams.css')!!}
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

            <h1>Список команд</h1>

            <?php

            echo Form::open(array('url' => route('createTeam'), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
            echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span></button>';
            echo Form::close();

            echo "<table>";
            echo "<tr><th>id</th><th>name</th><th>created_at</th><th>updated_at</th></tr>";
            foreach ($teams as $key => $value) {
                echo "<tr>";
                echo "<td> <div>" . $value->id . "</div>  </td>";
                echo "<td> <div>" . $value->name . "</div> </td>";
                echo "<td> <div>" . $value->created_at . "</div>  </td>";
                echo "<td> <div>" . $value->updated_at . "</div> </td>";
                echo "<td>";

                echo Form::open(array('url' => route('editTeam', ['id' => $value->id]), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
                echo '<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>';
                echo Form::close();

                echo Form::open(array('url' => route('deleteTeam', ['id' => $value->id]), 'method' => 'get', 'role' => 'form', 'class' => 'form-vertical'));
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
