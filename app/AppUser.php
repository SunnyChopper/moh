<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    
	protected $table = "app_users";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeInactive($query) {
    	return $query->where('is_active', 0);
    }

    public function habits() {
    	return $this->hasMany('App\AppHabit', 'id', 'user_id');
    }

    public function levels() {
    	return $this->hasMany('App\AppHabitLevel', 'id', 'user_id');
    }

    public function logs() {
    	return $this->hasMany('App\AppHabitLog', 'id', 'user_id');
    }

    public function rewards() {
    	return $this->hasMany('App\AppReward', 'id', 'user_id');
    }

}
