<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserQuest extends Authenticatable
{
    protected $table = 'userQuests';
    public $timestamps = false;

    use Notifiable;

    protected $fillable = ['idQuest', 'idTeam', 'idUser', 'statusQuest'];
    protected $guarded = ['id'];

    /*
    public function scopeOfWhere($query, $name, $type)
    {
        return $query->where($name, $type);
    }*/

    public function scopeOfWhereWhere($query, $name, $type, $name2, $type2)
    {
        return $query->where($name, '=', $type)->where($name2,'=' , $type2)->get();
    }


}
