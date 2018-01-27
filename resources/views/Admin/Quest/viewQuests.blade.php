@extends('layouts.adminLayouts')
@section('style')
    <link media="all" type="text/css" rel="stylesheet" href="/public/css/Admin/adminViewQuests.css">
@stop
@section('content')
    <main>
        <h1>Список квестов</h1>

        <submit class="btn btn-default btn-sm"><a href="{{route('admin_add_quest')}}"
                                                  class="glyphicon glyphicon-plus"></a></submit>
        <?php
        echo "<div class='table'>";
        echo "<table>";

        echo 
"<tr><th>id</th><th>name</th><th>description</th><th>fullDescription</th><th>hard</th><th>author</th><th>date</th><th>time</th><th>status</th><th>author_id</th>
</tr>";

        foreach ($quests as $key => $value) {
        echo "<tr>";
        echo "<td> <div>" . $value->id . "</div> </td>";
        echo "<td> <div>" . $value->name . "</div> </td>";
        echo "<td class='description'> <div >" . $value->description . "</div> </td>";
        echo "<td class='description'> <div >" . $value->fullDescription . "</div> </td>";
        echo "<td> <div>" . $value->hard . "</div> </td>";
        echo "<td> <div >" . $value->author . "</div> </td>";
        echo "<td class='date'> <div>" . $value->date . "</div> </td>";
        echo "<td> <div>" . $value->time . "</div> </td>"; ?>
        @if ($value->status == 0)
            <?php echo "<td> <div>" . "прошедший" . "</div> </td>"; ?>
        @elseif ($value->status == 1)
            <?php echo "<td> <div>" . "текущий" . "</div> </td>"; ?>
        @elseif ($value->status == 2)
            <?php echo "<td> <div>" . "будущий" . "</div> </td>"; ?>
        @elseif ($value->status == -1)
            <?php echo "<td> <div>" . "авторский" . "</div> </td>"; ?>
        @endif
        @if ($value->author_id)
            <?php  echo "<td> <div >" . $value->author_id . "</div> </td>"; ?>
        @else
            <?php  echo "<td> <div > </div> </td>"; ?>
        @endif
       <?php echo "<td> ";?>
        <submit class="btn btn-default btn-sm"><a href="{{route('editQuest', $value->id)}}"
                                                  class="glyphicon glyphicon-pencil"></a></submit>
        <submit class="btn btn-default btn-sm"><a href="{{route('deleteQuest', $value->id)}}"
                                                  class="glyphicon glyphicon-trash"></a></submit>
        <submit class="btn btn-default btn-sm"><a href="{{route('showTasksByQuest', $value->id)}}"
                                                  class="glyphicon glyphicon-th-list"></a></submit>
        <?php
        echo "</td>";
        echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        ?>
    </main>

@stop
