<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class BookClubBook extends Model
{

    protected $table = "book_club_books";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeInactive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeCurrent($query) {
    	return $query->whereDate('start_date', '>', Carbon::now())->whereDate('end_date', '<=', Carbon::now());
    }

}
