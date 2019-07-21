<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookDownload extends Model
{
    protected $table = "book_downloads";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }
}
