<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $table = 'quests';
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'fullDescription', 'date', 'time', 'status'];
    protected $guarded = ['id'];

    /**
     * Получить задания к квесту
     */
    public function allTasks()
    {
        return $this->hasMany('App\Models\Task', 'idQuest');
    }

    /**
     * Получить все записи к квесту из тиблицы QTU
     */
    public function allQTU()
    {
        return $this->hasMany('App\Models\UserTeamQuest', 'idQuest');
    }
}
