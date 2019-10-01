<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HAUser extends Model
{
    
	protected $table = "ha_users";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('is_active', 0);
    }
    
}
