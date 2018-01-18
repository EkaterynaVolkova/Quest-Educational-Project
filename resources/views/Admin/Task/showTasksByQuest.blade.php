@extends('layouts.adminLayouts')
@section('style')
    {!!HTML::style('css/Admin/adminViewTask.css')!!}
@stop

@section('content')
    <main>

        <h1>Список заданий для квеста "{!! $nameQuest !!}"</h1>
        <submit class="btn btn-default btn-sm"><a
                    href="{{action('Admin\AdminTaskController@add', ['idQuest' => $idQuest])}}"
                    class="glyphicon glyphicon-plus"></a></submit>

        <?php
        echo "<div class='table'>";
        echo "<table>";
        echo "<tr><th>id</th><th>name</th><th>description</th><th>weight</th><th>QR</th></tr>";
        foreach ($tasks as $key => $value) {
        echo "<tr>";
        echo "<td> <div>" . $value->id . "</div> </td>";
        echo "<td> <div class='name'>" . $value->name . "</div> </td>";
        echo "<td> <div class='description'>" . $value->description . "</div> </td>";
        echo "<td> <div>" . $value->weight . "</div> </td>";
        echo "<td> <div>" . $value->QR . "</div> </td>";
        echo "<td> <div>" . $value->orderBy . "</div> </td>";

        echo "<td> ";
        ?>

        <submit class="btn btn-default btn-sm"><a
                    href="{{route('orderTask', ['id'=>$value->id, 'sign'=> 'plus', 'idQuest'=>$idQuest])}}"
                    class="glyphicon glyphicon-plus"></a></submit>
        <submit class="btn btn-default btn-sm"><a
                    href="{{route('orderTask', ['id'=>$value->id, 'sign'=> 'minus', 'idQuest'=>$idQuest])}}"
                    class="	glyphicon glyphicon-minus"></a></submit>

        <submit class="btn btn-default btn-sm"><a
                    href="{{route('printQR', ['id'=>$value->id])}}"
                    class="glyphicon glyphicon-qrcode"></a></submit>
        <submit class="btn btn-default btn-sm"><a
                    href="{{route('editTask', ['id'=>$value->id, 'idQuest'=>$idQuest])}}"
                    class="glyphicon glyphicon-pencil"></a></submit>
        <submit class="btn btn-default btn-sm"><a
                    href="{{route('deleteTask', ['id'=>$value->id, 'idQuest'=>$idQuest])}}"
                    class="glyphicon glyphicon-trash"></a></submit>
        <?php
        echo " </td>";
        echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        ?>
    </main>
@stop
