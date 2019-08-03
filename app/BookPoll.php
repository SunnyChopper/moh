<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BookPoll extends Model
{
    protected $table = "book_polls";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('is_active', 0);
    }

    public function scopeCurrent($query) {
    	return $query->where('start_date', '<=', Carbon::now())->where('end_date', '>', Carbon::now());
    }
}
