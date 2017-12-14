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
        $t = DB::table('tasks')->where('idQuest','=',$idQuest)->max('orderBy');
        $task->orderBy = $t+1;
        $task->QR = $this->generateCode(8);
        $task->save();
        return redirect()->action('Admin\AdminTaskController@showByOne', ['idQuest' => $idQuest]);
    }

    //сортировка
    protected function order($id, $sign, $idQuest)
    {
        $max = DB::table('tasks')->where('idQuest','=',$idQuest)->max('orderBy');
        $task1 = Task::find($id);
        $order = $task1->orderBy;

        if (($sign == 'plus')&&($order<$max)){
            $task2 = Task::all()->where('idQuest','=',$idQuest)->where('orderBy', '=', ($order+1));
            $key = 0;
            foreach ($task2 as $k => $value) {
                $key = $k;
            }
            $name = $task1->name;
            $description = $task1->description;
            $duration = $task1->duration;
            $weight = $task1->weight;
            $qr = $task1->QR;
            $task1->name =  $task2[$key]->name;
            $task1->description =  $task2[$key]->description;
            $task1->duration =  $task2[$key]->duration;
            $task1->weight =  $task2[$key]->weight;
            $task1->QR =  $task2[$key]->QR;
            $task1->save();
            $task2[$key]->name =  $name;
            $task2[$key]->description =  $description;
            $task2[$key]->duration =  $duration;
            $task2[$key]->weight =  $weight;
            $task2[$key]->QR =  $qr;
            $task2[$key]->save();

        } elseif (($sign == 'minus')&&($order>1)) {
            $task2 = Task::all()->where('idQuest','=',$idQuest)->where('orderBy', '=', ($order-1));
            $key = 0;
            foreach ($task2 as $k => $value) {
               $key =$k;
            }
            $name = $task1->name;
            $description = $task1->description;
            $duration = $task1->duration;
            $weight = $task1->weight;
            $qr = $task1->QR;
            $task1->name =  $task2[$key]->name;
            $task1->description =  $task2[$key]->description;
            $task1->duration =  $task2[$key]->duration;
            $task1->weight =  $task2[$key]->weight;
            $task1->QR =  $task2[$key]->QR;
            $task1->save();
            $task2[$key]->name =  $name;
            $task2[$key]->description =  $description;
            $task2[$key]->duration =  $duration;
            $task2[$key]->weight =  $weight;
            $task2[$key]->QR =  $qr;
            $task2[$key]->save();
        }

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