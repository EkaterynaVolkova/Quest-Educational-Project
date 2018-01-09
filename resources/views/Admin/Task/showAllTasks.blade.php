@extends('layouts.adminLayouts')
@section('style')
    {{HTML::style('css/Admin/adminViewTask.css')}}
@stop

@section('content')
    <main>
        <h1>Список заданий</h1>

        <?php
        echo "<table>";
        echo "<tr><th>id</th><th>idQuest</th><th>name</th><th>description</th><th>weight</th><th>QR</th></tr>";
        foreach ($tasks as $key => $value) {
        echo "<tr>";
        echo "<td> <div> " . $value->id . "</div> </td>";
        echo "<td> <div>" . $value->idQuest . "</div> </td>";
        echo "<td> <div class='name'>" . $value->name . "</div> </td>";
        echo "<td> <div class='description'>" . $value->description . "</div> </td>";
        echo "<td> <div>" . $value->weight . "</div> </td>";
        echo "<td> <div>" . $value->QR . "</div> </td>";

        echo "<td> ";
        ?>
        <submit class="btn btn-default btn-sm"><a
                    href="{{route('printQR', ['id'=>$value->id])}}"
                    class="glyphicon glyphicon-qrcode"></a></submit>
        <submit class="btn btn-default btn-sm"><a
                    href="{{route('editOneTask', ['id' => $value->id])}}"
                    class="glyphicon glyphicon-pencil"></a></submit>
        <submit class="btn btn-default btn-sm"><a
                    href="{{route('deleteOneTask', ['id' => $value->id])}}"
                    class="glyphicon glyphicon-trash"></a></submit>
        <?php
        echo " </td>";
        echo "</tr>";
        }
        echo "</table>";
        ?>
    </main>
@stop
