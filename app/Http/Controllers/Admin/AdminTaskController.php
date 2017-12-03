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
    //просмотр всех существующих заданий
    protected function show()
    {
        $tasks = Task::all();
        return view('Admin.showAllTasks', ['tasks' => $tasks]);
    }

    //просмотр  существующих заданий для определённого квеста
    protected function showByOne(Request $request)
    {
        $idQuest = $request->input('idQuest');
        $tasks = Quest::find($idQuest)->allTasks;
        return view('Admin.adminViewTasks', ['idQuest' => $idQuest])->with(['tasks' => $tasks]);
    }







    //переадресация на форму добавления нового задания
    protected function add($idQuest)
    {
        return view('Admin.addTask', ['idQuest' => $idQuest]);
    }

    //добавление задания в таблицу Tasks и роут на просмотр  существующих заданий для квеста (смотреть выше)
    protected function create($idQuest)
    {
        $data = Input::all();
        $data['idQuest'] = $idQuest;
        $task = Task::create($data);
        $task->save();
        $tasks = Quest::find($idQuest)->allTasks;
        return view('Admin.adminViewTasks', ['idQuest' => $idQuest])->with(['tasks' => $tasks]);
    }

// редактирование квестов
    protected function edit($id)
    {
        //$id = $request->input('id');
        $task = Task::find($id);
        return view('Admin.editTask', ['task' => $task]);
    }

    // Обновление задания
    protected function update($id)
    {
        $data = Input::all();
        $task = Task::find($id);
        $task->name = $data['name'];
        $task->description = $data['description'];
        $task->duration = $data['duration'];
        $task->weight = $data['weight'];
        $task->QR = $data['QR'];
        $task->save();
        $idQuest = $task->idQuest;
        $tasks = Quest::find($idQuest)->allTasks;
        return view('Admin.adminViewTasks', ['idQuest' => $idQuest])->with(['tasks' => $tasks]);

    }

    // Удаление задания определённого квеста
    protected function delete($id, $idQuest)
    {
        $task = Task::find($id);
        $task->delete();
        $tasks = Quest::find($idQuest)->allTasks;
        return view('Admin.adminViewTasks', ['idQuest' => $idQuest])->with(['tasks' => $tasks]);
    }
// Удаление задания
    protected function deleteTask($id)
    {
        $tasks = Task::find($id);
        $tasks->delete();
        //$tasks = Task::all();
        //return view('Admin.showAllTasks', ['tasks' => $tasks]);
        return redirect()->action(
            'Admin\AdminTaskController@showAllTasks'
        );
    }




}