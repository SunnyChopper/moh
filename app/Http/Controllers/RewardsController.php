<?php

namespace App\Http\Controllers;

use App\Reward;

use Illuminate\Http\Request;

class RewardsController extends Controller
{
    
	/* --------------------- *\
        CRUD Functions
    \* --------------------- */

    public function create(Request $data) {
    	$reward = new Reward;
    	$reward->user_id = $data->user_id;
    	$reward->title = $data->title;
    	$reward->description = $data->description;
    	$reward->category = $data->category;
    	$reward->points = $data->points;
    	$reward->duration = $data->duration;
    	$reward->save();

    	return response()->json(true, 200);
    }

    public function read() {
    	return response()->json(Reward::find($_GET['reward_id'])->toArray(), 200);
    }

    public function update(Request $data) {
    	$reward = Reward::find($data->reward_id);
    	$reward->title = $data->title;
    	$reward->description = $data->description;
    	$reward->category = $data->category;
    	$reward->points = $data->points;
    	$reward->duration = $data->duration;
    	$reward->save();

    	return response()->json(true, 200);
    }

    public function delete(Request $data) {
    	$reward = Reward::find($data->reward_id);
    	$reward->is_active = 0;
    	$reward->save();

    	return response()->json(true, 200);
    }

}
