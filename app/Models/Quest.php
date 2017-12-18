<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $table = 'quests';

    protected $fillable = [
        'name', 'description', 'fullDescription', 'date', 'time', 'status'
    ];


    protected $guarded = array(
        'id', 'created_at', 'updated_at'

    );

    /**
     * Получить задания к квесту
     */
    public function allTasks()
    {
        return $this->hasMany('App\Models\Task', 'idQuest');
    }
}
