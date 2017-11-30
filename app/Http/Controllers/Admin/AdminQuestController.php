<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AdminQuestController extends Controller
{

    // Открытие страницы с квестами
    protected function edit(Request $request){
        $id=$request->input('id');
        $quest = Quest::find($id);
        return view('Admin.editQuests', ['quest' => $quest]);
    }

    // Обновление квеста
    protected function update($id)
    {
        $data = Input::all();
        $quest = Quest::find($id);
        $quest->name = $data['name'];
        $quest->description = $data['description'];
        $quest->date = $data['date'];
        $quest->time = $data['time'];

         $quest->save();
        return redirect()->action(
            'Admin\AdminQuestController@show'
        );
    }

    // Открытие страницы с квестами
    protected function show(){
        $quests = Quest::all();
        return view('Admin.viewQuests', ['quests' => $quests]);
    }

    // Открытие формы для создания квеста

    protected function add()
    {
        return view('Admin.createQuest');
    }

    protected function create()
    {
        $data = Input::all();
        $quest = Quest::create($data);
        $quest->save();
        return redirect()->action(
            'Admin\AdminTaskController@viewTasks', ['idQuest' => $quest]
        );
    }
}
