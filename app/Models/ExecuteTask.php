<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExecuteTask extends Model
{
    protected $table = 'executeTasks';

    protected $fillable = [
        'idTasks', 'idUserTeamQuest', 'coordX', 'coordY', 'timestamp', 'status'
    ];


    protected $guarded = array(
        'id', 'created_at', 'updated_at'

    );

}
