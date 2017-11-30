<?php

namespace App\Models;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'nickname', 'age', 'gender', 'remember_token',   'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function isAdmin() //1 - возвращает, если админ (указано в таблице поле role = 1
    {
        if ($this->role == 1) {
            return true; // поле role в таблице users
        }
        return false;
    }

}
