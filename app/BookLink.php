<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookLink extends Model
{
    protected $table = "book_links";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }
}
