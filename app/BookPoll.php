<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookPoll extends Model
{
    protected $table = "book_polls";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }
}
