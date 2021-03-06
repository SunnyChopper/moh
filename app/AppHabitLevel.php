<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppHabitLevel extends Model
{
    
	protected $table = "app_habit_levels";
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

    public function habit() {
    	return $this->hasOne('App\AppHabit', 'habit_id', 'id');
    }

    public function logs() {
    	return $this->hasMany('App\AppHabitLog', 'id', 'level_id');
    }

}
