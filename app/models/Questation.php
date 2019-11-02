<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Questation extends Model
{
    protected $fillable = ['body', 'quiz_id'];
    
    public function answers()
    {
        return $this->hasMany(Answer::class, 'questation_id');
    }
}
