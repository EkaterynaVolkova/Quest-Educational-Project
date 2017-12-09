@extends('layouts.dashboard')
@section('style')
    {!!HTML::style('css/AdminGeneral/tables.css')!!}
    {!!HTML::style('css/AdminGeneral/adminBody.css')!!}
    {!!HTML::style('css/AdminGeneral/adminNav.css')!!}
@stop

@section('content')

    <header>
        @include('Admin.nav');
    </header>

    <div class="row">

        @include('Admin.leftNav');

        <main>

            <h1>Пользователи</h1>

            <?php
            echo "<table>";
            echo "<tr><th>id</th><th>name</th><th>nickname</th><th>email</th><th>role</th></tr>";
            foreach ($users as $key => $value) {
                echo "<tr>";
                echo "<td> <div>" . $value->id . "</div> </td>";
                echo "<td> <div>" . $value->name . "</div> </td>";
                echo "<td> <div>" . $value->nickname . "</div> </td>";
                echo "<td> <div>" . $value->email . "</div> </td>";
                echo "<td> <div>" . $value->role . "</div> </td>";

                echo "<td>";
            ?>
            <submit class="btn btn-default btn-sm"><a
                        href="{{route('isAdmin', ['id' => $value->id])}}"
                        class="glyphicon glyphicon-user"></a></submit>

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
