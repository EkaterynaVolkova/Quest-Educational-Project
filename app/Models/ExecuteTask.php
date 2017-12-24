<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExecuteTask extends Model
{

    protected $table = 'executeTasks';
    public $timestamps = false;

    protected $fillable = ['idTasks', 'idUserTeamQuest', 'coordX', 'coordY', 'timestamp', 'status'];
    protected $guarded = ['id'];

    /**
     * Получить задание по idTask
     */
    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'idTask');
    }

    public function allQTU()
    {
        return $this->belongsTo('App\Models\UserTeamQuest', 'idUserTeamQuest');
    }

}
