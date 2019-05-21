<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $table = "blog_posts";
    public $primaryKey = "id";
}
