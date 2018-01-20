<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class Quest extends Model
{
    protected $table = 'quests';

    public $timestamps = false;

    protected $fillable = ['name', 'description', 'fullDescription', 'hard', 'author', 'avatar', 'date', 'time', 'status'];
    protected $guarded = ['id'];

    /**
     * Получить всех пользователей, участвующих в квесте
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'userQuests' , 'idQuest', 'idUser');
    }

    /**
     * Получить все команды, участвующие в квесте
     */
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team', 'userQuests' , 'idQuest', 'idTeam');
    }


    /**
     * Получить задания к квесту
     */
    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'idQuest');
    }



}
