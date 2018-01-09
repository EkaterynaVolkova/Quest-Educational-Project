<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = ['name'];
    public $timestamps = false;

    protected $guarded = ['id'];

    public function users($idQuest)
    {
        return $this->belongsToMany('App\Models\User', 'UserQuests' , 'idTeam', 'idUser')->wherePivot('idQuest', $idQuest);
    }


    /**
     * Получить все записи к квесту из тиблицы QTU
     */
   /* public function allQTU()
    {
        return $this->hasMany('App\Models\UserQuest', 'idTeam');
    }*/

}
