<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quest;

class AdminController extends Controller
{
    private function dateQuest(){
        $quest = Quest::all();
        $date =  date("Y-m-d");
        $time = date("H:i:s");
        foreach($quest as $key => $value) {
            if (($value->status)  != 0) {
                if (strtotime($value->date) < strtotime($date)) {
                    $value->status = 0;
                    $value->save();
                } elseif (strtotime($value->date) > strtotime($date)) {
                    $value->status = 2;
                    $value->save();
                } else {

                    if (($value->time) < $time) {
                        $value->status = 2;
                        $value->save();
                    } elseif (($value->time) >= $time) {
                        $value->status = 1;
                        $value->save();
                    }

                }
            } elseif(($value->status) == 0){
                continue;
            }
        }
    }

    public function show(){
        $this->dateQuest();
        return view('Admin.startAdminka')->with(['msg' => null]);
    }

}
