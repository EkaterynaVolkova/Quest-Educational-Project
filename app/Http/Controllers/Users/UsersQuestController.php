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
use Illuminate\Database\Eloquent;

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

        foreach ($quests as $key => $value) {
            $idQuest = $value->idQuest;
            $quest = Quest::where('id', '=', $idQuest)->get();
            foreach ($quest as $v) {
                $status = $v->status;
            }

            if ($status == 2) {
                $questFuture[] .= $quest;
            } elseif ($status == 0) {
                $questLast[] .= $quest;
                $tasksLast[] .= Quest::find($idQuest)->allTasks;
            } elseif ($status == 1) {
                $questGeneral[] .= $quest;
                $tasksGeneral[] .= Quest::find($idQuest)->allTasks;
                $array = UserTeamQuest::all()->where('idUser', '=', $idUser)->where('idQuest', '=', $idQuest);
                foreach ($array as $k => $v) {
                    $teamGeneral = $v->idTeam;
                }
            }

        }
        return view('Users.usersQuestProfile')->with(['questGeneral' => $questGeneral, 'questFuture' => $questFuture,
            'questLast' => $questLast, 'teamGeneral' => $teamGeneral, 'tasksGeneral' => $tasksGeneral, 'tasksLast' => $tasksLast]);
    }
}
