<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pomodoro extends Model
{
    protected $table = "pomodoro_sessions";
    public $primaryKey = "id";
}
