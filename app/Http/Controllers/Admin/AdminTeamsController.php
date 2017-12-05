<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTeamsController extends Controller
{
    public function show()
    {
        $teams = Team::all();
        return view('Admin.Teams.viewTeams', ['teams' => $teams]);
    }


    //переадресация на форму добавления новой команды
    protected function add()
    {
        return view('Admin.Teams.addTeam');
    }




    //добавление задания для квеста в таблицу tasks
    protected function create($idQuest)
    {
        $data = Input::all();
        $data['idQuest'] = $idQuest;
        $task = Task::create($data);
        $task->save();
        return redirect()->action('Admin\AdminTaskController@showByOne', ['idQuest' => $idQuest]);
    }

}
