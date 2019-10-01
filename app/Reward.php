<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    
	protected $table = "rewards";
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

    public function purchases() {
    	return $this->hasMany('App\RewardPurchase', 'id', 'reward_id');
    }

}
