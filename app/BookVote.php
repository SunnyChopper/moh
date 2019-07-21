<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookVote extends Model
{
    protected $table = "book_votes";
    public $primaryKey = "id";
}
