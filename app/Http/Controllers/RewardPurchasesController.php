<?php

namespace App\Http\Controllers;

use App\RewardPurchase;
use App\HAUser;

use Illuminate\Http\Request;

class RewardPurchasesController extends Controller
{
    
	/* --------------------- *\
        CRUD Functions
    \* --------------------- */

    public function create(Request $data) {
    	$purchase = new RewardPurchase;
    	$purchase->user_id = $data->user_id;
    	$purchase->reward_id = $data->reward_id;

    	$user = HAUser::find($data->user_id);
    	$purchase->previous_balance = $user->reward_points;

    	$reward = Reward::find($data->reward_id);
    	$purchase->after_balance = $user->points - $reward->points;
    	$purchase->save();

    	return response()->json(true, 200);
    }

    public function read() {
    	return response()->json(RewardPurchase::find($_GET['purchase_id'])->toArray(), 200);
    }

}
