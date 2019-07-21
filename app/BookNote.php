<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookNote extends Model
{
    protected $table = "book_notes";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }
}
