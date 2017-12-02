<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Quest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class TaskQuestController extends Controller
{
    protected function add()
    {
        $tasks = Quest::find(1)->allTasks;
        return view('Admin.addTask')->with('tasks', $tasks);
    }

    protected function create()
    {
        $data = Input::all();
        $data['idQuest'] = Quest::find(1)->id;
        $task = Task::create($data);
        $task->save();
        return TaskQuestController::add();

    }

}