<?php

namespace App\Http\Controllers;

use App\AppHabit;

use Illuminate\Http\Request;

class AppHabitsController extends Controller
{
    
	public function create(Request $data) {
		return response()->json([
			'success' => false,
			'error' => $data["postVariables"]
		], 200);

		$habit = new AppHabit;
		$habit->user_id = $data["postVariables"]["user_id"];
		$habit->points = $data["postVariables"]["points"];
		$habit->title = $data["postVariables"]["title"];
		$habit->description = $data["postVariables"]["description"];
		$habit->why = $data["postVariables"]["why"];
		$habit->save();

		return response()->json([
			'success' => true,
			'habit' => $habit
		], 200);
	}

	public function read() {
		return response()->json([
			'success' => true,
			'habit' => AppHabit::find($_GET['habit_id'])->toArray()
		], 200);
	}

	public function update(Request $data) {
		$habit = AppHabit::find($data->habit_id);

		if (isset($data->current_level)) {
			$habit->current_level = $data->current_level;
		}

		if (isset($data->points)) {
			$habit->points = $data->points;
		}

		if (isset($data->title)) {
			$habit->title = $data->title;
		}

		if (isset($data->description))
		$habit->description = $data->description;
		$habit->why = $data->why;

		return response()->json([
			'success' => true,
			'habit' => $habit->toArray()
		], 200);
	}

	public function delete(Request $data) {
		$habit = AppHabit::find($data->habit_id);
		$habit->is_active = 0;
		$habit->save();

		return response()->json([
			'success' => true
		], 200);
	}

	public function getForUser() {
		$count = AppHabit::where('user_id', $_GET['user_id'])->active()->count();
		$habits = AppHabit::where('user_id', $_GET['user_id'])->active()->get()->toArray();

		$returnHabits = array();
		$habitIDs = array();

		foreach ($habits as $habit) {
			array_push($habitIDs, $habit["id"]);
			$returnHabits[$habit["id"]] = $habit;
		}

		return response()->json([
			'success' => true,
			'count' => $count,
			'habits' => $return_habits,
			'habit_ids' => $habitIDs
		], 200);
	}

}
