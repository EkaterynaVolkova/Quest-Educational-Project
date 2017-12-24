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
            'questLast' => $questLast, 'teamGeneral' => $teamGeneral, 'teamFuture' => $teamFuture, 'tasksGeneral' => $tasksGeneral,
            'tasksLast' => $tasksLast]);
    }


    protected function playQuest($idQuest)
    {
        $idUser = Auth::user()->id;
        $etStatus = "";
        $statusQuest = "";
        $idUTQ = "";
        $tasks = Quest::find($idQuest)->allTasks()->orderBy('orderBy', 'Asc')->get();
        $max = Task::where('idQuest', '=', $idQuest)->max('orderBy');
        //$userTeamQuest = UserTeamQuest::all()->where('idQuest', '=', $idQuest);
        $userTeamQuest = UserTeamQuest::ofWhere('idQuest', $idQuest)->where('idUser', $idUser)->get();

        foreach ($userTeamQuest as $v) {
            $idUTQ = $v->id;
        }

        foreach ($tasks as $key => $value) {

            //статус квеста для текущей команды из табл. userTeamQuests
            $userTeamQuest = UserTeamQuest::ofWhere('idQuest', $idQuest)->where('idUser', $idUser)->get();
            foreach ($userTeamQuest as $v) {
                $statusQuest = $v->statusQuest;
            }

            //поиск текущей задачи в таблице executeTasks
            $et = ExecuteTask::all()->where('idTasks', '=', $value->id)->where('idUserTeamQuest', '=', $idUTQ);

            foreach ($et as $v) {
                $etStatus = $v->status;
            }

            if ($statusQuest == 0) {  // если квест активен из таблицы userTeamQuests для команды
                if (count($et) == 0) { // если задание было открыто в 1-ый раз любым участником команды
                    $exTask = new ExecuteTask();// делаем новую запись в табл. executeTasks
                    $exTask->idTasks = $value->id;
                    $exTask->idUserTeamQuest = $idUTQ;
                    $exTask->status = 0;
                    $exTask->save();
                    return view('Users.usersQuestPlay')->with(['task' => $value]); //выводим страничку с этим заданием
                } elseif ((count($et) != 0) && ($value->orderBy == $max)) {// если запись уже есть и она последняя
                    if ($etStatus == 0) { //но не выполнена
                        return view('Users.usersQuestPlay')->with(['task' => $value]);//выводим страничку с этим заданием
                    } elseif ($etStatus == 1) { //и выполнена
                        $userTQ = UserTeamQuest::find($idUTQ);// находим запись в UserTeamQuest и присваиваем status квеста =1 для команды
                        $team = $userTQ->idTeam;
                        $all = UserTeamQuest::all()->where('idTeam', '=', $team)->where('idQuest', '=', $idQuest);
                        foreach ($all as $v) {
                            $v->statusQuest = 1;
                            $v->save();
                        }
                        return redirect()->route('start'); //квест выполнен
                    }

                } elseif ((count($et) != 0) && ($value->orderBy != $max)) { // запись о задании есть в табл. executeTask и оно не последнее
                    if ($etStatus == 0) { //и не выполнено
                        return view('Users.usersQuestPlay')->with(['task' => $value]);
                    } else { // выполнено - переходим к другой итерации
                        continue;
                    }
                }

            } elseif ($statusQuest == 1) {  // если квест неактивен из таблицы userTeamQuests для команды
                return redirect()->route('start'); //квест закончен для всех
            }

        }

        return redirect()->route('start');

    }

    protected function qrInput($qr, $idTask)
    {
        $idUTQ = "";
        $qrCode = Task::find($idTask)->QR;
        $idQuest = Task::find($idTask)->idQuest;
        $idUser = Auth::user()->id;
        $utq = UserTeamQuest::all()->where('idQuest', '=', $idQuest)->where('idUser', '=', $idUser);
        foreach ($utq as $value) {
            $idUTQ = $value->id;
        }
        if ($qr == $qrCode) {
            $execTask = ExecuteTask::all()->where('idTasks', '=', $idTask)->where('idUserTeamQuest', '=', $idUTQ);
            if (count($execTask) > 0) {
             //   dd(count($execTask));
                foreach ($execTask as $value) {
                    $value->status = 1;
                    $value->save();
                }

                return redirect()->action('Users\UsersQuestController@playQuest', ['idQuest' => $idQuest]);
            }
        }
        return redirect()->route('start');

    }

}
