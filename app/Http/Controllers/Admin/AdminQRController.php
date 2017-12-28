<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.12.2017
 * Time: 10:57
 */

namespace App\Http\Controllers\Admin;

use App\Models\ExecuteTask;
use App\Models\UserTeamQuest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Task;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent;

class AdminQRController extends Controller
{
    protected function print($idTask)
    {
        $qr1 = Task::find($idTask)->QR;
      //  $qr = 'http://quest.challenge.php1.a-level.com.ua/public/users/qr/' . $qr1 . '/' . $idTask;
       $qr = 'http://quest/public/users/qr/' . $qr1 . '/' . $idTask;

       // dd($qr);
        return view('Admin.QR.print')->with(['qr' => $qr]);
    }


    }


?>