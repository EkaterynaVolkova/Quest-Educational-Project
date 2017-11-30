<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Response;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if (Auth::guest()) {
            return redirect(route('login'));}
        elseif ($user && $user->isAdmin() == 0){
            return redirect(route('start'));}
        return $next($request);

    }
}




