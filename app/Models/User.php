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
     * Получить все квесты в которых учавствует пользователь
     */
    public function quests()
    {
        return $this->belongsToMany('App\Models\Quest', 'UserQuests' , 'idUser', 'idQuest');
    }

    /**
     * Получить квест в котором учавствует пользователь по id
     */
    public function quest($idQuest)
    {
        return $this->belongsToMany('App\Models\Quest', 'UserQuests' , 'idUser', 'idQuest')->wherePivot('idQuest', $idQuest)->get();
    }

    /**
     * Получить команду, в которой участвовал пользователь, в квесте
     */
    public function teams($idQuest)
    {
        return $this->belongsToMany('App\Models\Team', 'UserQuests' , 'idUser', 'idTeam')->wherePivot('idQuest', $idQuest);
    }

    /**
     * Получить все задания, выполненные пользователем в квесте
     */
    public function tasks($idQuest)
    {
        return $this->belongsToMany('App\Models\Task', 'executeTasks' , $idUserQuest, 'idTask')->wherePivot('idQuest', $idQuest);
    }


}
