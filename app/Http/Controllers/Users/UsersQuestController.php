<?php

namespace App\Http\Controllers\Users;

use App\Models\ExecuteTask;
use App\Models\Quest;
use App\Models\Team;
use App\Models\Task;
use App\Models\UserTeamQuest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;

class UsersQuestController extends Controller
{
    public function view()
    {
        $quests = Quest::all()->where('status', '>', 0);
        return view('Users.viewQuests', ['quests' => $quests]);
    }

    public function more($id)
    {
        $q = Quest::find($id);
        return view('Users.moreQuest')->with(['q' => $q]);
    }

    protected function play($id)
    {
        if (count(UserTeamQuest::all()->where('idQuest', '=', $id)->where('idUser', '=', (Auth::user()->id))) == 0) {
            $team = Team::all();
            return view('Users.usersTeamsQuest')->with(['idQuest' => $id, 'team' => $team]);

        } else {
            return redirect()->action('Users\UsersQuestController@view');
        }
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

    protected function userProfile()
    {
        $idUser = Auth::user()->id;
        $quests = UserTeamQuest::where('idUser', '=', $idUser)->get();
        $questGeneral = array();
        $questFuture = array();
        $questLast = array();
        $tasksGeneral = array();
        $tasksLast = array();
        $status = "";
        $teamGeneral = "";
        $teamFuture = array();

        foreach ($quests as $key => $value) {
            $idQuest = $value->idQuest;
            $quest = Quest::where('id', '=', $idQuest)->get();
            foreach ($quest as $v) {
                $status = $v->status;
            }

            if ($status == 2) {
                $questFuture[] .= $quest;
                $array = UserTeamQuest::all()->where('idUser', '=', $idUser)->where('idQuest', '=', $idQuest);
                foreach ($array as $k => $v) {
                    $teamId = $v->idTeam;
                    $teamFuture[] .= Team::find($teamId)->name;
                }
            } elseif ($status == 0) {
                $questLast[] .= $quest;
                $tasksLast[] .= Quest::find($idQuest)->allTasks;
            } elseif ($status == 1) {
                $questGeneral[] .= $quest;
                $tasksGeneral[] .= Quest::find($idQuest)->allTasks;
                $array = UserTeamQuest::all()->where('idUser', '=', $idUser)->where('idQuest', '=', $idQuest);
                foreach ($array as $k => $v) {
                    $teamId = $v->idTeam;
                    $teamGeneral = Team::find($teamId)->name;
                }
            }

        }
        return view('Users.usersQuestProfile')->with(['questGeneral' => $questGeneral, 'questFuture' => $questFuture,
            'questLast' => $questLast, 'teamGeneral' => $teamGeneral,'teamFuture' => $teamFuture, 'tasksGeneral' => $tasksGeneral,
            'tasksLast' => $tasksLast]);
    }



    protected function playQuest($idQuest)
    {
        $idUser = Auth::user()->id;
        $statusQuest = "";
        $tasks = Task::where('idQuest', '=', $idQuest)->orderBy('orderBy', 'Asc')->get();
        $userTeamQuest = UserTeamQuest::all()->where('idQuest', '=', $idQuest);
        foreach ($userTeamQuest as $v) {
            $idUTQ = $v->id;
        }
        foreach ($tasks as $key => $value) {
            foreach ($userTeamQuest as $v) {
                $statusQuest = $v->statusQuest;
                 }
            if ($statusQuest == 0) {
              if (count(ExecuteTask::where('idTasks', '=', $value->id)->get()) == 0){
                  $exTask = new ExecuteTask();
                  $exTask->idTasks=$value->id;
                  $exTask->idUserTeamQuest=$idUTQ;
                  $exTask->status = 0;
                  $exTask->save();
                return view('Users.usersQuestPlay')->with(['task' => $value]);
                            } }
        }

        dd($tasks);
        return view('Users.usersQuestPlay')->with(['task' => $tasks]);

    }
}
