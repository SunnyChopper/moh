<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorApplication extends Model
{
    
	protected $table = "pc_applications";
    public $primaryKey = "id";

    public function scopeContacted($query) {
    	return $query->where('status', 2);
    }

    public function scopeActive($query) {
    	return $query->where('status', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('status', 0);
    }

    public function scopeOrdered($query) {
    	return $query->orderBy('created_at', 'DESC');
    }

}
