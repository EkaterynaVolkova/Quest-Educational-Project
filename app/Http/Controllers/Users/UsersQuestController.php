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

    public function selectTeam()
    {
        $data = Input::all();
        $count = count(UserQuest::ofWhereWhere('idQuest', $data['quest'], 'idUser', Auth::user()->id));
        $team = UserQuest::updateOrCreate(['idUser' => Auth::user()->id, 'idQuest' => $data['quest']], ['idTeam' => $data['team']]);
        $team->save();
        if ($count) {
            return response()->json(array('msg' => "Ваша команда успешно изменена!"), 200);
        } else {
            return response()->json(array('msg' => "Вы зарегистрировались в квесте! Удачи!"), 200);
        }
    }

//    protected function play($id)
//    {
//        $u = User::find(Auth::user()->id)->quest($id);
//        if (count($u) == 0) {
//            $team = Team::all();
//            return view('Users.usersTeamsQuest')->with(['idQuest' => $id, 'team' => $team]);
//
//        } else {
//            return redirect()->action('Users\UsersQuestController@view');
//        }
//    }


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
                if (count($results)) {
                    $result[] = $results[0]->result;
                }

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


    /**
     * @param $idQuest
     */
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

            $idUQ = UserQuest::ofWhereWhere('idQuest', $idQuest, 'idTeam', $idTeam);
            foreach ($idUQ as $v) {
                $idUserQuest[] .= $v->id; // массив idUserQuest для всех участников команды
            }

            if ($statusQuest == 0) {               // если квест активен для команды таблица userQuests
                // $tasksQuest = Quest::find($idQuest)->tasks()->orderBy('orderBy', 'Asc')->get();
                $taskQuest = Quest::find($idQuest)->tasks()->get();
                $tasksQuest = $taskQuest->shuffle();
                $countTasks = count($tasksQuest);
                $count = 0;

// вывод задания для команды из таблицы executeTasks со статусом 0, если есть
                foreach ($tasksQuest as $key => $v) {
                    foreach ($idUserQuest as $val) {
                        $t = ExecuteTask::ofWhereWhere('idTask', $v->id, 'idUserQuest', $val);
                        if (count($t) == 0) {
                            continue;
                        } elseif (count($t)) {
                            if ($t[0]->status == 0) {
                                return view('Users.usersQuestPlay')->with(['task' => $v]); //выводим
                            } elseif ($t[0]->status == 1) {
                                $count++; // кол-во выполненных заданий
                            }
                        }
                    }
                }

                // если кол-во заданий равно кол-ву выполненных заданий  - закрываем квест для команды
                if ($count == $countTasks) {
                    $uQ = UserQuest::ofWhereWhere('idTeam', $idTeam, 'idQuest', $idQuest);
                    foreach ($uQ as $val) {
                        $val->statusQuest = 1;
                        $val->save();
                        return redirect()->route('userProfile');
                    }
                }



                foreach ($tasksQuest as $key => $v) {
                    $res = array();
                    foreach ($idUserQuest as $val) {
                        $t = ExecuteTask::ofWhereWhere('idTask', $v->id, 'idUserQuest', $val);
                        if (count($t)) {
                            $res = $t[0];
                        }
                    }

                    if (count($res) == 0) {
                        $exTask = new ExecuteTask();// делаем новую запись в табл. executeTasks
                        $exTask->idTask = $v->id;
                        $exTask->idUserQuest = $idUserQuestOne;
                        $exTask->status = 0;
                        $exTask->save();
                        return view('Users.usersQuestPlay')->with(['task' => $v]); //выводим
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

        $userQuest = UserQuest::ofWhereWhere('idQuest', $idQuest, 'idUser', $idUser);
        $idTeam = $userQuest[0]->idTeam;
        $idUQ = UserQuest::ofWhereWhere('idQuest', $idQuest, 'idTeam', $idTeam);
        foreach ($idUQ as $v) {
            $idUserQuest[] .= $v->id; // массив idUserQuest для всех участников команды
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

        return redirect()->route('usersLocation',['idExecuteTask' => $idTask, 'idQuest' => $idQuest]);
    }


    public function usersLocation($idTask, $idQuest){
        return view('Users.usersLocation')->with(['idExecuteTask' => $idTask, 'idQuest' => $idQuest]);
    }

    public
    function savePosition()
    {
        $data = Input::all();
        $execTask = ExecuteTask::find($data['idExTask']);
        $execTask->coordX = $data['coordX'];
        $execTask->coordY = $data['coordY'];
        $execTask->date = date("Y-m-d");
        $execTask->time = date("H:i:s");
        $execTask->save();
        return response()->json(array('msg' => "Продолжим!"), 200);
    }

    public
    function maps($idQuest)
    {
        $coord = array();
        $exTask = array();
        $idTeams = array();
        $coord = array();
        $idUserQ = array();                                 // участники каждой команды
        $exTasks = array();

//      $questTeams = Quest::find($idQuest)->teams->unique();
//
//        foreach ($questTeams as $k) {
//            $idTeams[] .= $k->id;
//        }
//
//        foreach ($idTeams as $team) {                         // для каждой команды:
//
//            $userTeams = UserQuest::ofWhereWhere('idQuest', $idQuest, 'idTeam', $team);
//            foreach ($userTeams as $u) {
//                $idUserQ[] .= $u->id;
//            }
//
//            foreach ($idUserQ as $v) {                          // выполненные!!! задания для команды
//                $exTask = ExecuteTask::ofWhereWhere('idUserQuest', $v, 'status', 1);
//                foreach ($exTask as $e) {
//                    $exTasks[] .= $e;
//                    $coord[] = [$e->coordX, $e->coordY];
//                }
//            }
//        }
//        dd($idUserQ);
        $idUser = Auth::user()->id;
        $team = User::find($idUser)->teams($idQuest)->get();
        $idTeam = $team[0]->id;
        $userQuests = UserQuest::ofWhereWhere('idQuest', $idQuest, 'idTeam', $idTeam);
        foreach ($userQuests as $value) {
            $userQuest = $value->id;
            $executeTask = ExecuteTask::ofWhereWhere('idUserQuest', $userQuest, 'status', 1)->sortBy('time');
            if (count($executeTask)) {
                foreach ($executeTask as $v) {
                    $exTask[] = $v;
                    $coord[] = [$v->coordX, $v->coordY];
                }
            }
        }
        $datetime = array();
        foreach ($exTask as $key => $value) {
            $datetime[$key] = "[Дата: " . strval($value->date) . "  Время: " . strval($value->time) . "]";
        }
        $datetime = implode(',', $datetime);
        $coord = json_encode($coord);
        return view('Users.markers')->with(['coord' => $coord, 'dateTime' => $datetime]);
    }
}