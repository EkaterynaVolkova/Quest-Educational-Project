<?php

namespace App\Http\Controllers\Users;


use App\Models\ExecuteTask;
use App\Models\Quest;
use App\Models\Team;
use App\Models\Task;
use App\Models\User;
use App\Models\Result;
use App\Models\UserQuest;
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

    protected function view()
    {
        $quests = Quest::where('status', '>', 0)->get();
        return view('Users.viewQuests', ['quests' => $quests]);
    }

    protected function more($id)
    {
        $q = Quest::find($id);
        $team = Team::all();
        return view('Users.moreQuest')->with(['q' => $q, 'team' => $team]);
    }

    protected function play($id)
    {
        $u = User::find(Auth::user()->id)->quest($id);
        if (count($u) == 0) {
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

    protected function outQuest($idQuest)
    {
        $idUser = Auth::user()->id;
        $userQuest = UserQuest::ofWhereWhere('idQuest', $idQuest, 'idUser', $idUser);
        $userQuest[0]->delete();
        return redirect()->action('Users\UsersQuestController@userProfile');
    }

    protected function ok($id)
    {
        $d = Input::all();
        $ok = UserQuest::updateOrCreate(['idUser' => Auth::user()->id, 'idQuest' => $id], ['idTeam' => $d['input']]);
        $ok->save();
        return redirect()->action('Users\UsersQuestController@userProfile');
    }


    protected function userProfile()
    {
        $idUser = Auth::user()->id;
        $questUser = User::find($idUser)->quests;
        $questGeneral = array();
        $questFuture = array();
        $questLast = array();
        $tasksGeneral = array();
        $tasksLast = array();
        $status = "";
        $idTeam = "";
        $exTask = "";
        $teamGeneral = "";
        $teamFuture = array();
        $teamLast = array();
        $result = array();
        $executeTask = array();

        foreach ($questUser as $key => $value) {  // перебор по всем квестам
            $idQuest = $value->id;
            $status = $value->status;

            if ($status == 2) {                   // будущий
                $questFuture[] = $value;          // массив будущих квестов
                $array = User::find($idUser)->teams($idQuest)->get();
                foreach ($array as $k => $v) {
                    $teamId = $v->id;
                    $teamFuture[] = Team::find($teamId)->name;   // массив названий команд
                }
            } elseif ($status == 0) {             // прошедший
                $questLast[] = $value;
                $tasksLast[] = Quest::find($idQuest)->tasks; // массив прошедших квестов

                $team = UserQuest::ofWhereWhere('idUser', $idUser, 'idQuest', $idQuest);
                $idTeam = $team[0]->idTeam;
                $teamLast[] = Team::find($idTeam)->name;     // массив названий команд

                $results = Result::ofWhereWhere('idQuest', $idQuest, 'idTeam', $idTeam);
                $result[] = $results[0]->result;

                $t = Quest::find($idQuest)->tasks; // задания для квеста прошедшего
                if (count($t)) {
                    $execute = array();
                    foreach ($t as $v) {
                        $userQuest = UserQuest::ofWhereWhere('idTeam', $idTeam, 'idQuest', $idQuest);
                        foreach ($userQuest as $user) {
                            $exTask = ExecuteTask::ofWhereWhere('idUserQuest', $user->id, 'idTask', $v->id);
                            if (count($exTask) == 0) {
                                continue;
                            } else {
                                break;
                            }
                        }

                        if ((count($exTask) == 0) || ($exTask[0]->status == 0)) {
                            $execute[] .= 0;
                        } else {
                            $execute[] .= 1;
                        }
                    }
                    $executeTask[] = $execute; // массив меток выполнения заданий
                }
            } elseif ($status == 1) {                              // текущий
                $questGeneral[] = $value;                          // массив текущих квестов
                $tasksGeneral[] = Quest::find($idQuest)->tasks;    // массив заданий
                $array = User::find($idUser)->teams($idQuest)->get();
                foreach ($array as $k => $v) {
                    $teamId = $v->id;
                    $teamGeneral = Team::find($teamId)->name;
                }
            }

        }

        return view('Users.usersQuestProfile')->with(['questGeneral' => $questGeneral, 'questFuture' => $questFuture,
            'questLast' => $questLast, 'teamGeneral' => $teamGeneral, 'teamLast' => $teamLast, 'teamFuture' => $teamFuture, 'tasksGeneral' => $tasksGeneral,
            'tasksLast' => $tasksLast, 'result' => $result, 'executeTask' => $executeTask]);
    }


    protected function playQuest($idQuest)
    {
        $etStatus = "";
        $statusQuest = "";
        $idUsers = array();
        $idTeam = "";
        $idUserQuest = array();
        $idUserQuestOne = "";
        $execTask = "";

        $idUser = Auth::user()->id;
        $status = Quest::find($idQuest)->status;


        if ($status == 1) {                         // проверка текущий квест или нет таблица quests

            // для зашедшего на страницу пользователя команду, статус для команды, id userQuest
            $userQuest = UserQuest::ofWhereWhere('idQuest', $idQuest, 'idUser', $idUser);
            foreach ($userQuest as $v) {
                $statusQuest = $v->statusQuest;
                $idTeam = $v->idTeam;
                $idUserQuestOne = $v->id;
            }

            // все пользователи учавствующие в квесте
            $users = Quest::find($idQuest)->users;
            foreach ($users as $u) {
                $idUQ = UserQuest::ofWhereWhere('idQuest', $idQuest, 'idUser', $u->id);
                foreach ($idUQ as $v) {
                    $idUserQuest[] .= $v->id; // массив idUserQuest для всех участников квеста
                }
            }

            if ($statusQuest == 0) {               // если квест активен для команды таблица userQuests
                $tasksQuest = Quest::find($idQuest)->tasks()->orderBy('orderBy', 'Asc')->get();
                $max = $tasksQuest->max('orderBy');


                foreach ($tasksQuest as $key => $value) {
                    //поиск текущей задачи в таблице executeTasks

                    $eT = "";
                    foreach ($idUserQuest as $v) {
                        if (count(ExecuteTask::ofWhereWhere('idTask', $value->id, 'idUserQuest', $v)) != 0) {
                            $eT = ExecuteTask::ofWhereWhere('idTask', $value->id, 'idUserQuest', $v);
                        }
                    }

                    if (!empty($eT)) {

                        foreach ($eT as $val) {
                            $etStatus = $val->status;
                        }

                        if ($etStatus == 1) {
                            if ($value->orderBy != $max) {
                                continue;
                            } elseif ($value->orderBy == $max) {
                                $uQ = UserQuest::ofWhereWhere('idTeam', $idTeam, 'idQuest', $idQuest);
                                foreach ($uQ as $v) {
                                    $v->statusQuest = 1;
                                    $v->save();
                                }
                                return redirect()->route('start');
                            }
                        } else {
                            return view('Users.usersQuestPlay')->with(['task' => $value]);
                        }
                    } elseif (empty($eT)) {
                        $exTask = new ExecuteTask();// делаем новую запись в табл. executeTasks
                        $exTask->idTask = $value->id;
                        $exTask->idUserQuest = $idUserQuestOne;
                        $exTask->status = 0;
                        $exTask->save();
                        return view('Users.usersQuestPlay')->with(['task' => $value]); //выводим страничку с этим заданием

                    }
                }
            }
        }

        return redirect()->route('userProfile');
    }

    protected function qrInput($qr, $idTask)
    {
        $idUsers = array();
        $qrCode = Task::find($idTask)->QR;
        $idQuest = Task::find($idTask)->idQuest;
        $idUser = Auth::user()->id;
        $idUserQuest = array();
        $execTask = "";

        $users = Quest::find($idQuest)->users;
        foreach ($users as $u) {
            //   $idUsers[] .= $u->id; // массив id пользователей учавствующих в квесте
            $idUQ = UserQuest::ofWhereWhere('idQuest', $idQuest, 'idUser', $u->id);
            foreach ($idUQ as $v) {
                $idUserQuest[] .= $v->id;
            }
        }

        if ($qr == $qrCode) {
            foreach ($idUserQuest as $v) {
                $execTask = ExecuteTask::ofWhereWhere('idTask', $idTask, 'idUserQuest', $v);
                if (count($execTask)) {
                    $idTask = $execTask[0]->id;
                    break;
                } else {
                    continue;
                }
            }

            if ($execTask[0]->status == 0) {
                $execTask[0]->status = 1;
                $execTask[0]->save();

            } elseif (($execTask[0]->status) && ($execTask[0]->coordX != 0) && ($execTask[0]->coordY != 0)) {
                return redirect()->action('Users\UsersQuestController@playQuest', ['idQuest' => $idQuest]);
            }
        }

        return view('Users.usersLocation')->with(['idExecuteTask' => $idTask]);
    }


    public function savePosition($id)
    {
        $data = Input::all();
        $execTask = ExecuteTask::find($id);
        $execTask->coordX = $data['coordX'];
        $execTask->coordY = $data['coordY'];
        $execTask->date = date("Y-m-d");
        $execTask->time = date("H:i:s");
        // dd(date("d.m.Y H:i:s"));
        $execTask->save();
        return redirect()->route('userProfile');
    }

    public function maps($idQuest)
    {
        $coord = array();
        $exTask = array();
        $coord = array();

        $idUser = Auth::user()->id;
        $team = User::find($idUser)->teams($idQuest)->get();
        $idTeam = $team[0]->id;
        $userQuests = UserQuest::ofWhereWhere('idQuest', $idQuest, 'idTeam', $idTeam);
        foreach ($userQuests as $value) {
            $userQuest = $value->id;
            $executeTask = ExecuteTask::ofWhereWhere('idUserQuest', $userQuest, 'status', 1)->sortBy('time');
            if(count($executeTask)) {
                foreach ($executeTask as $v) {
                    $exTask[] = $v;
                    $coord[] = [$v->coordX, $v->coordY];
                }
            }
        }
        $datetime =array();
        foreach ($exTask as $key => $value){
            $datetime[$key] =  "[Дата: ".strval($value->date)."  Время: ".strval($value->time)."]";
        }
        $datetime = implode(',', $datetime);
        $coord = json_encode($coord);

        return view('Users.markers')->with(['coord' => $coord, 'dateTime' => $datetime]);
    }

    public function selectTeam(){
        $data = Input::all();

        return response()->json(array('msg'=> 'Все ок)'), 200);
    }
}
