<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HAPasswordReset extends Model
{
    
	protected $table = "habits";
    public $primaryKey = "id";

    public function scopeCompleted($query) {
    	return $query->where('status', 2);
    }

    public function scopeActive($query) {
    	return $query->where('status', 1);
    }

    public function scopeExpired($query) {
    	return $query->where('status', 0);
    }

    public function user() {
    	return $this->belongsTo('App\HAUser', 'user_id', 'id');
    }

}
