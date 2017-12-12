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

    protected function generateCode($length = 8){
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }


    //просмотр всех существующих заданий
    protected function show()
    {
        $tasks = Task::all();
        return view('Admin.Task.showAllTasks', ['tasks' => $tasks]);
    }

    //просмотр  существующих заданий для определённого квеста
    protected function showByOne($idQuest)
    {
        $tasks = Quest::find($idQuest)->allTasks;
        return view('Admin.Task.showTasksByQuest', ['idQuest' => $idQuest])->with(['tasks' => $tasks]);
    }

    //переадресация на форму добавления нового задания
    protected function add($idQuest)
    {
        return view('Admin.Task.addTask', ['idQuest' => $idQuest]);
    }

    //добавление задания для квеста в таблицу tasks
    protected function create($idQuest)
    {
        $data = Input::all();
        $data['idQuest'] = $idQuest;
        $task = Task::create($data);
        $task->QR = $this->generateCode(8);
        $task->save();
        return redirect()->action('Admin\AdminTaskController@showByOne', ['idQuest' => $idQuest]);
    }

// редактирование задания
    protected function edit($id)
    {
        $task = Task::find($id);
        return view('Admin.Task.editTask', ['task' => $task]);
    }

    // Обновление задания  в таблице
    protected function updateTask($id)
    {
        $data = Input::all();
        $task = Task::find($id);
        $task->name = $data['name'];
        $task->description = $data['description'];
        $task->duration = $data['duration'];
        $task->weight = $data['weight'];
       /* $task->QR = $this->generateCode(8);*/
        $task->save();
        $idQuest = $task->idQuest;
        return redirect()->action('Admin\AdminTaskController@showByOne', ['idQuest' => $idQuest]);
    }

    // Удаление задания определённого квеста
    protected function delete($id)
    {
        $task = Task::find($id);
        $idQuest = $task->idQuest;
        $task->delete();
        return redirect()->action('Admin\AdminTaskController@showByOne', ['idQuest' => $idQuest]);

    }

// Удаление задания
    protected function deleteTask($id)
    {
        $tasks = Task::find($id);
        $tasks->delete();
        return redirect()->action('Admin\AdminTaskController@show');
    }


    // редактирование задания из общего списка
    protected function editTask($id)
    {
        $task = Task::find($id);
        return view('Admin.Task.editTask2', ['task' => $task]);
    }

    // Обновление задания  в таблице
    protected function update($id)
    {
        $data = Input::all();
        $task = Task::find($id);
        $task->name = $data['name'];
        $task->description = $data['description'];
        $task->duration = $data['duration'];
        $task->weight = $data['weight'];
        $task->save();
        return redirect()->route('showTasks');
    }

 }