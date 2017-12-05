<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = [
        'name'
    ];


    protected $guarded = array(
        'id', 'created_at', 'updated_at'

    );

}
