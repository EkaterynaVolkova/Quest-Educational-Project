<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AdminTeamsController extends Controller
{
    //просмотр всех существующих команд
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

    //добавление команды в таблицу teams
    protected function create()
    {
        $data = Input::all();
        $task = Team::create($data);
        $task->save();
        return redirect()->action('Admin\AdminTeamsController@show');
    }



}
