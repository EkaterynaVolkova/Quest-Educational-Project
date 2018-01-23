<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExecuteTask;
use App\Models\Result;
use App\Models\UserQuest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Task;
use App\Models\Team;
use App\Http\Controllers\Users;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AdminQuestController extends Controller
{
    // Открытие страницы с квестами
    protected function show()
    {
        $quests = Quest::all();
        return view('Admin.Quest.viewQuests', ['quests' => $quests]);
    }

    // Открытие формы для создания квеста
    protected function add()
    {
        return view('Admin.Quest.createQuest');
    }

    protected function create(Request $request)
    {
        $quest = new Quest;
        $filename = "";
        $file ="";
        if($request->hasFile('file')) {
           $file = $request->file('file');
        }
        $data = Input::all();
        $quest->name = $data['name'];
        $quest->description = $data['description'];
        $quest->fullDescription = $data['fullDescription'];
        $quest->date = $data['date'];
        $quest->time = $data['time'];
        $quest->hard = $data['hard'];
        $quest->author = $data['author'];
        $quest->save();
        $questLast = Quest::all()->last();
        $filename = $questLast->id.'.jpg';
        if($file){
            $file->move(public_path() . '/img',$filename);
            $questLast->avatar = 'https://quest.challenge.php.a-level.com.ua/public/img/'.$filename;

        }
//        $questLast->avatar = 'http://quest/public/img/'.$filename;
        $questLast->save();

        return redirect()->action('Admin\AdminQuestController@show');
    }

// редактирование квестов
    protected function edit($id)
    {
        $quest = Quest::find($id);
        return view('Admin.Quest.editQuests', ['quest' => $quest]);
    }

    // Обновление квеста
    protected function update($id)
    {
        $data = Input::all();
        $quest = Quest::find($id);
        $quest->name = $data['name'];
        $quest->description = $data['description'];
        $quest->fullDescription = $data['fullDescription'];
        $quest->date = $data['date'];
        $quest->time = $data['time'];
        $quest->hard = $data['hard'];
        $quest->author = $data['author'];

        $quest->save();
        return redirect()->action('Admin\AdminQuestController@show');
    }

    // Удаление квеста и его заданий
    protected function delete($id)
    {
        $quest = Quest::where('id', $id);
        $quest->delete();
        $tasks = Task::where('idQuest', '=', $id);
        $tasks->delete();
        return redirect()->action('Admin\AdminQuestController@show');
    }

    protected function finish($id){
        $quest = Quest::find($id);
        $quest->status = 0;
        $quest -> save();
        return redirect()->action('Admin\AdminQuestController@show');
    }



}
