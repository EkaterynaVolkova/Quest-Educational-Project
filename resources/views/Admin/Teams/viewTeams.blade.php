@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/Admin/adminShowTeams.css')!!}
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

            <h1>Список команд</h1>

            <submit class="btn btn-default btn-sm"><a
                        href="{{route('createTeam')}}"
                        class="glyphicon glyphicon-plus"></a></submit>

            <?php

            echo "<table>";
            echo "<tr><th>id</th><th>name</th></tr>";
            foreach ($teams as $key => $value) {
            echo "<tr>";
            echo "<td> <div>" . $value->id . "</div>  </td>";
            echo "<td> <div>" . $value->name . "</div> </td>";
            echo "<td>";
            ?>
            <submit class="btn btn-default btn-sm"><a
                        href="{{route('editTeam', ['id' => $value->id])}}"
                        class="glyphicon glyphicon-pencil"></a></submit>
            <submit class="btn btn-default btn-sm"><a
                        href="{{route('deleteTeam', ['id' => $value->id])}}"
                        class="glyphicon glyphicon-trash"></a></submit>
            <?php

            echo " </td>";
            echo "</tr>";
            }
            echo "</table>";
            ?>
        </main>
    </div>
    <footer></footer>
@stop
