<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\quest;

class CreateQuest extends Controller
{
    public function add()
{
    $quests = quest::all();
    return view('admin.add', ['quests' => $quests]);

}

    public function view()
    {
        $quests = quest::all();
        return view('users.view', ['quests' => $quests]);

    }


}
