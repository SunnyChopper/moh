<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    
    protected $table = "habits";
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

    public function logs() {
    	return $this->hasMany('App\HabitLog', 'id', 'habit_id');
    }

}
