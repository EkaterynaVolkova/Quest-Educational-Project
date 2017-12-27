<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    public $timestamps = false;

    protected $fillable = ['idQuest', 'idTeam', 'result', 'position'];
    protected $guarded = ['id'];
}