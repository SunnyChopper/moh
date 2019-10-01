<?php

namespace App\Http\Controllers;

use App\Habit;

use Illuminate\Http\Request;

class HabitsController extends Controller
{
    
	/* --------------------- *\
        CRUD Functions
    \* --------------------- */

    public function create(Request $data) {
    	$habit = new Habit;
    	$habit->user_id = $data->user_id;
    	$habit->title = $data->title;
    	$habit->description = $data->description;
    	$habit->category = $data->category;
    	$habit->reward_points = $data->reward_points;
    	$habit->save();

    	return response()->json(true, 200);
    }

    public function read() {
    	return response()->json(Habit::find($_GET['habit_id'])->toArray(), 200);
    }

    public function update(Request $data) {
    	$habit = Habit::find($data->habit_id);
    	$habit->title = $data->title;
    	$habit->description = $data->description;
    	$habit->category = $data->category;
    	$habit->reward_points = $data->reward_points;
    	$habit->save();

    	return response()->json(true, 200);
    }

    public function delete(Request $data) {
    	$habit = Habit::find($data->habit_id);
    	$habit->is_active = 0;
    	$habit->save();

    	return response()->json(true, 200);
    }

}
