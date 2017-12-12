<?php

namespace App\Http\Controllers\Users;

use App\Models\Quest;
use App\Models\Team;
use App\Models\Task;
use App\Models\UserTeamQuest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class UsersQuestController extends Controller
{
    public function view()
    {
        $quests = Quest::all();
        return view('Users.viewQuests', ['quests' => $quests]);
    }

    public function more($id)
    {
        $q = Quest::find($id);
        return view('Users.moreQuest')->with(['q' => $q]);
    }

    protected function play($id)
    {
        $team = Team::all();
        return view('Users.usersTeamsQuest')->with(['idQuest' => $id, 'team' => $team]);
    }

    protected function ok($id)
    {
        $d = Input::all();
        $data['idTeam'] = $d['input'];
        $data['idUser'] = Auth::user()->id;
        $data['idQuest'] = $id;
        $ok = UserTeamQuest::create($data);
        $ok->save();
        return redirect()->action('Users\UsersQuestController@userProfile');
    }

    protected function showTasksFromQuest()
    {
        /*   $idUser = Auth::user()->id;
           $idQuest = UserTeamQuest::where('idUser', '=', $idUser);
           dd($idQuest);
           $tasks = Task::where('idQuest', '=', $idQuest)->get();
           dd($tasks);
           return view('Users.usersQuestProfile')->with(['tasks'=>$tasks]);*/
    }

    protected function userProfile()
    {
        $idUser = Auth::user()->id;
        $quests = UserTeamQuest::where('idUser', '=', $idUser)->get();
        $quest = array();
        $tasks = array();
        foreach ($quests as $key => $value) {
            $idQuest = $value['idQuest'];
            $quest[] .= Quest::find($idQuest);
            $tasks[] .= Task::where('idQuest', '=', $idQuest)->get();
        }
         /*  $tasks = Task::where('idQuest', '=', $idQuest)->get();
        dd($tasks);*/
        return view('Users.usersQuestProfile')->with(['quests' => $quest, 'tasks' => $tasks]);
    }
}
