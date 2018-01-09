<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    public $timestamps = false;

    protected $fillable = ['idQuest', 'idTeam', 'result', 'position'];
    protected $guarded = ['id'];

    public function scopeOfWhereWhere($query, $name, $type, $name2, $type2)
    {
        return $query->where($name, '=', $type)->where($name2,'=' , $type2)->get();
    }
}