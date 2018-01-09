<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    public $timestamps = false;

    protected $fillable = ['idQuest', 'name', 'description', 'duration', 'weight', 'QR', 'dependancy','id', 'orderBy'];
    protected $guarded = ['id'];

    /**
     * Получить квест к которому относится задание
     */
    public function quest()
    {
        return $this->belongsTo('App\Models\Quest', 'idQuest');
    }

}
