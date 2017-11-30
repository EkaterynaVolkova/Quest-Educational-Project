<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Quest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AdminTaskController extends Controller
{
    //сюда пока что поступают id нового созданного квеста (роут с
    //Route::post('/create/quest', ['uses' => 'Admin\AdminQuestController@create', 'as' => 'post']);

    //просмотр  существующих заданий для квеста
    protected function viewTasks($idQuest)
    {

        $tasks = Quest::find($idQuest)->allTasks;
        return view('Admin.viewTasks')->with(['tasks' => $tasks, 'idQuest' => $idQuest]);
    }

    //переадресация на форму добавления нового задания
    protected function add($idQuest)
    {
        return view('Admin.addTask')->with(['idQuest' => $idQuest]);
    }

    //добавление задания в таблицу Tasks и роут на просмотр  существующих заданий для квеста (смотреть выше)
    protected function create($idQuest)
    {
        $data = Input::all();
        $data['idQuest'] = $idQuest;
        $task = Task::create($data);
        $task->save();
        return redirect()->route('viewTask', $idQuest);

    }

}