<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'idQuest', 'name', 'description', 'duration', 'weight', 'QR', 'dependancy','id', 'orderBy', 'created_at', 'updated_at'
    ];


    protected $guarded = array(


    );

    public function quest()
    {
        return $this->belongsTo('App\Models\Quest');
    }

}
