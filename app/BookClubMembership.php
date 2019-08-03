<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class BookClubMembership extends Model
{
    protected $table = "book_club_memberships";
    public $primaryKey = "id";

    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function scopeActive($query) {
    	return $query->where('status', 1);
    }
}
