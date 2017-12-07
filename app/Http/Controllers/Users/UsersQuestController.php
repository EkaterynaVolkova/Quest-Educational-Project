<?php

namespace App\Http\Controllers\Users;

use App\Models\Quest;
use App\Models\Team;
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
        $q= Quest::find($id);
         return view('Users.moreQuest')->with(['q' => $q]);
    }

    protected function play($id){
       $team =Team::all();
       return view('Users.usersTeamsQuest')->with( ['idQuest'=> $id, 'team' => $team]);
    }

    protected function ok($id){
        $d = Input::all();
        $data['idTeam'] =$d['input'];
        $data['idUser'] = Auth::user()->id;
        $data['idQuest'] = $id;
        $ok = UserTeamQuest::create($data);
        $ok->save();
        return view('Users.usersQuestProfile');
    }
}
