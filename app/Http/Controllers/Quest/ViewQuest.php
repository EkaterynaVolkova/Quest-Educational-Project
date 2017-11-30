<?php

namespace App\Http\Controllers\Quest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\quest;

class ViewQuest extends Controller
{

    public function view()
    {
        $quests = quest::all();
        return view('quest.view', ['quests' => $quests]);

    }


}
