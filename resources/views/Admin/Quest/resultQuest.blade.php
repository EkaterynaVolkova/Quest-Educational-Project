@extends('layouts.adminLayouts')
@section('content')
           <main>
            <h1>Результаты</h1>

            <button class="btn btn-link"><a
                        href="{{route('finishQuest', ['id'=>$results[0]->idQuest])}}"
                        class="glyphicon glyphicon-ok"></a>
            </button>

            <?php
            echo "<table>";
            echo "<tr><th>id</th><th>idQuest</th><th>idTeam</th><th>result</th><th>position</th></tr>";
            foreach ($results as $key => $value) {
            echo "<tr>";
            echo "<td> <div>" . $value->id . "</div> </td>";
            echo "<td> <div>" . $value->idQuest . "</div> </td>";
            echo "<td> <div >" . $value->idTeam . "</div> </td>";
            echo "<td> <div >" . $value->result . "</div> </td>";
            echo "<td> <div >" . $value->position . "</div> </td>";
            echo "<td>";
            ?>
            <button class="btn btn-link"><a
                        href="{{route('selectPosition', ['id'=>$value->id])}}"
                        class="glyphicon glyphicon-pencil"></a>
            </button>
            <?php
            echo "</td>";
            echo "</tr> ";
            }
            echo "</table>";
            ?>

        </main>
@stop