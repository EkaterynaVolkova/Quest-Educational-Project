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
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Request as Request2;

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
        if (count(UserTeamQuest::ofWhereWhere('idQuest', $id, 'idUser', (Auth::user()->id))) == 0) {
            $team = Team::all();
            return view('Users.usersTeamsQuest')->with(['idQuest' => $id, 'team' => $team]);

        } else {
            return redirect()->action('Users\UsersQuestController@view');
        }
    }

    protected function editTeam($id)
    {
        $team = Team::all();
        return view('Users.usersTeamsQuest')->with(['idQuest' => $id, 'team' => $team]);
    }

    protected function ok($id)
    {
        $d = Input::all();
        $ok = UserTeamQuest::updateOrCreate(['idUser' => Auth::user()->id, 'idQuest' => $id], ['idTeam' => $d['input']]);
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
                $array = UserTeamQuest::ofWhereWhere('idUser', $idUser, 'idQuest', $idQuest);
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
                $array = UserTeamQuest::ofWhereWhere('idUser', $idUser, 'idQuest', $idQuest);
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


    protected function playQuest($idQuest, $ok = 0)
    {
        $etStatus = "";
        $statusQuest = "";
        $idUTQ = "";
        $idTeam = "";
        $idUser = Auth::user()->id;
        $status = Quest::find($idQuest)->status;

        if ($status == 1) {                         // проверка текущий квест или нет
            $userTeamQuest = UserTeamQuest::ofWhereWhere('idQuest', $idQuest, 'idUser', $idUser);
            foreach ($userTeamQuest as $v) {
                $idUTQ = $v->id;
                $statusQuest = $v->statusQuest;
                $idTeam = $v->idTeam;
            }

            if ($statusQuest == 0) {               // если квест активен для команды
                $tasks = Quest::find($idQuest)->allTasks()->orderBy('orderBy', 'Asc')->get();
                $max = $tasks->max('orderBy');

                foreach ($tasks as $key => $value) {
                    //поиск текущей задачи в таблице executeTasks
                    $et = ExecuteTask::ofWhereWhere('idTasks', $value->id, 'idUserTeamQuest', $idUTQ);
                    foreach ($et as $v) {
                        $etStatus = $v->status;
                    }

                    if (count($et) == 0) {          // если задание было открыто в 1-ый раз любым участником команды
                        $exTask = new ExecuteTask();// делаем новую запись в табл. executeTasks
                        $exTask->idTasks = $value->id;
                        $exTask->idUserTeamQuest = $idUTQ;
                        $exTask->status = 0;
                        $exTask->save();
                        return view('Users.usersQuestPlay')->with(['task' => $value, 'ok' => $ok]); //выводим страничку с этим заданием
                    } elseif ((count($et) != 0) && ($value->orderBy == $max)) {// если запись уже есть и она последняя

                        if ($etStatus == 0) { //но не выполнена
                            return view('Users.usersQuestPlay')->with(['task' => $value, 'ok' => $ok]);//выводим страничку с этим заданием
                        } elseif ($etStatus == 1) { //и выполнена
                            $all = UserTeamQuest::ofWhereWhere('idTeam', $idTeam, 'idQuest', $idQuest);
                            foreach ($all as $v) {
                                $v->statusQuest = 1;
                                $v->save();
                            }
                            return redirect()->route('userProfile'); //квест выполнен
                        }

                    } elseif ((count($et) != 0) && ($value->orderBy != $max)) { // запись о задании есть в табл. executeTask и оно не последнее
                        if ($etStatus == 0) { //и не выполнено
                            return view('Users.usersQuestPlay')->with(['task' => $value, 'ok' => $ok]);
                        } else { // выполнено - переходим к другой итерации
                            continue;
                        }
                    }
                }
            } elseif ($statusQuest == 1) {  // если квест неактивен из таблицы userTeamQuests для команды
                return redirect()->route('userProfile'); //квест закончен для всех
            }


        }
        return redirect()->route('userProfile');

    }

    protected function qrInput($qr, $idTask)
    {
        $idUTQ = "";
        $qrCode = Task::find($idTask)->QR;
        $idQuest = Task::find($idTask)->idQuest;
        $idUser = Auth::user()->id;
        $utq = UserTeamQuest::ofWhereWhere('idQuest', $idQuest, 'idUser', $idUser);
        foreach ($utq as $value) {
            $idUTQ = $value->id;
        }
        if ($qr == $qrCode) {
            $execTask = ExecuteTask::ofWhereWhere('idTasks', $idTask, 'idUserTeamQuest', $idUTQ);
            if (count($execTask) > 0) {
                foreach ($execTask as $value) {
                    $value->status = 1;
                    $value->save();
                }

                return redirect()->action('Users\UsersQuestController@playQuest', ['idQuest' => $idQuest, 'ok' => 1]);
            }
        }
        return redirect()->route('start');

    }

}
