<?php

namespace App\Http\Controllers\Users;

use App\Models\Quest;
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
        $quest = Quest::find($id);
        return view('Users.moreQuest', ['quest' => $quest]);
    }


}
