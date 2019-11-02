<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body', 'questation_id', 'is_correct'];
}
