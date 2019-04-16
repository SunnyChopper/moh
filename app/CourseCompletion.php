<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCompletion extends Model
{
    protected $table = "course_completions";
    public $primaryKey = "id";
}
