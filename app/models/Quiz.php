<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['name', 'teacher_id'];

    public function questations()
    {
        return $this->hasMany(Questation::class, 'quiz_id');
    }
}
