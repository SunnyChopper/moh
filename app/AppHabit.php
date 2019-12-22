<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppHabit extends Model
{

	protected $table = "app_habits";
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

    public function level() {
    	return $this->hasOne('App\AppHabitLevel', 'current_level', 'id');
    }

    public function levels() {
    	return $this->hasMany('App\AppHabitLevel', 'id', 'habit_id');
    }

    public function logs() {
    	return $this->hasMany('App\AppHabitLog', 'id', 'habit_id');
    }

}
