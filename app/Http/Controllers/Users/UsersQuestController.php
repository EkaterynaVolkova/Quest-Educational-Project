<?php

namespace App\Http\Controllers\Users;

use App\Models\Quest;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    protected function ok(Request $request){
        dd($request);
        //$team =Team::all();
      //  return view('Users.usersTeamsQuest')->with( ['idQuest'=> $id, 'team' => $team]);
    }
}
