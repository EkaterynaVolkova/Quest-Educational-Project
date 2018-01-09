<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AdminUsersController extends Controller
{
    /**
     *   Открытие страницы с пользователями
     **/
    protected function show()
    {
        $users = User::all();
        return view('Admin.User.viewUsers', ['users' => $users]);
    }

    /**
     *   Назначение роли администратора
     **/
    protected function admin($id)
    {
        $user = User::find($id);
        if ($user->role == 0) {
            $user->role = 1;
        } else  $user->role = 0;
        $user->save();
        return redirect()->action('Admin\AdminUsersController@show');
    }
}