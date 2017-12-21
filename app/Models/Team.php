<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = ['name'];
    public $timestamps = false;

    protected $guarded = ['id'];

    /**
     * Получить все записи к квесту из тиблицы QTU
     */
    public function allQTU()
    {
        return $this->hasMany('App\Models\UserTeamQuest', 'idTeam');
    }

}
