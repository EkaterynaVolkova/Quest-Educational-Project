@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/Admin/adminViewQuests.css')!!}
    {!!HTML::style('css/AdminGeneral/tables.css')!!}
    {!!HTML::style('css/AdminGeneral/adminNav.css')!!}
    {!!HTML::style('css/AdminGeneral/adminBody.css')!!}
@stop
@section('content')

    <header>
        @include('Admin.nav')
    </header>

    <div class="row">

        @include('Admin.leftNav')

        <main>
            <h1>Результаты</h1>
            <?php
            echo "<table>";
            echo "<tr><th>id</th><th>idQuest</th><th>idTeam</th><th>result</th><th>position</th></tr>";
            foreach ($results as $key => $value) {
            echo "<tr>";
            echo "<td> <div>" . $value->id . "</div> </td>";
            echo "<td> <div>" . $value->idQuest . "</div> </td>";
            echo "<td> <div >" . $value->idTeam . "</div> </td>";
            echo "<td> <div >" . $value->result . "</div> </td>";
            echo "<td> <div>" . $value->position . "</div> </td>";
            echo "<td>";
            ?>
            <submit class="btn btn-default btn-sm"><a href="{{route('editQuest', $value->id)}}"
                                                      class="glyphicon glyphicon-pencil"></a></submit>

            <?php
            echo " </td>";
            echo "</tr> ";
            }
            echo "</table>";
            ?>

        </main>
    </div>
    <footer></footer>

@stop