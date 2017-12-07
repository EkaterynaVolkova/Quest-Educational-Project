<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Closure;

class IndexController extends Controller
{
    public function start()
    {
        return view('Start.start');
    }

    public function login()
    {
        return view('auth.login');
    }
}