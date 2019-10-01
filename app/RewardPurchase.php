<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardPurchase extends Model
{
    
	protected $table = "reward_purchases";
    public $primaryKey = "id";

    public function user() {
    	return $this->belongsTo('App\HAUser', 'user_id', 'id');
    }

    public function reward() {
    	return $this->belongsTo('App\Reward', 'reward_id', 'id');
    }

}
