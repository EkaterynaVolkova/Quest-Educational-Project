<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AdminUsersController extends Controller{

    // Открытие страницы с пользователями
    protected function show()
    {
        $users = User::all();
        return view('Admin.User.viewUsers', ['users' => $users]);
    }

}