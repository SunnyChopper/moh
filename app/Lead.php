<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    
	protected $table = "leads";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeInactive($query) {
    	return $query->where('is_active', 0);
    }

    public function scopeLandingPage($query, $page_name) {
    	return $query->where('landing_page_name', $page_name);
    }

    public function scopeEmail($query, $email) {
    	return $query->where('email', strtolower($email));
    }

}
