<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserTeamQuest extends Authenticatable
{
    protected $table = 'userTeamQuests';
    public $timestamps = false;

    use Notifiable;

    protected $fillable = ['idQuest', 'idTeam', 'idUser'];
    protected $guarded = ['id'];


    /**
     * Получить все записи из таблицы Team по idTeam
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'idTeam');
    }

    /**
     * Получить все записи из таблицы Quest по idQuest
     */
    public function quest()
    {
        return $this->belongsTo('App\Models\Quest', 'idQuest');
    }

    /**
     * Получить все записи из таблицы User по idUser
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'idUser');
    }

    public function scopeOfWhere($query, $name, $type)
    {
        return $query->where($name, $type);
    }

    public function scopeOfWhereWhere($query, $name, $type, $name2, $type2)
    {
        return $query->where($name, '=', $type)->where($name2,'=' , $type2)->get();
    }
}
