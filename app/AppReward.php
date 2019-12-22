<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppReward extends Model
{
    
	protected $table = "app_rewards";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeInactive($query) {
    	return $query->where('is_active', 0);
    }

    public function user() {
    	return $this->hasOne('App\AppUser', 'user_id', 'id');
    }

}
