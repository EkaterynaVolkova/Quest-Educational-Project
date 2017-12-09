@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/Admin/adminViewQuests.css')!!}
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
            <h1>Список квестов</h1>

            <submit class="btn btn-default btn-sm"><a href="{{route('admin_add_quest')}}"
                                                      class="glyphicon glyphicon-plus"></a></submit>
            <?php
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
            ?>
            <submit class="btn btn-default btn-sm"><a href="{{route('editQuest', $value->id)}}"
                                                      class="glyphicon glyphicon-pencil"></a></submit>
            <submit class="btn btn-default btn-sm"><a href="{{route('deleteQuest', $value->id)}}"
                                                      class="glyphicon glyphicon-trash"></a></submit>
            <submit class="btn btn-default btn-sm"><a href="{{route('showTasksByQuest', $value->id)}}"
                                                      class="glyphicon glyphicon-th-list"></a></submit>
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