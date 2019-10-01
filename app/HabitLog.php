<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HabitLog extends Model
{
	
    protected $table = "habit_logs";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('is_active', 0);
    }

    public function user() {
    	return $this->belongsTo('App\HAUser', 'user_id', 'id');
    }

    public function habit() {
    	return $this->belongsTo('App\Habit', 'habit_id', 'id');
    }

}
