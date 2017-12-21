<?php

namespace App\Models;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [ 'name', 'email', 'nickname', 'age', 'gender', 'remember_token',   'password'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function isAdmin() //1 - возвращает, если админ (указано в таблице поле role = 1
    {
        if ($this->role == 1) {
            return true; // поле role в таблице users
        }
        return false;
    }

    /**
     * Получить все записи из тиблицы QTU по idUser
     */
    public function allQTU()
    {
        return $this->hasMany('App\Models\UserTeamQuest', 'idUser');
    }
}
