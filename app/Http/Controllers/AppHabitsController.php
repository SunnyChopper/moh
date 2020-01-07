<?php

namespace App\Http\Controllers;

use App\AppHabit;

use Illuminate\Http\Request;

class AppHabitsController extends Controller
{
    
	public function create(Request $data) {
		$data = $data["postVariables"];

		$habit = new AppHabit;
		$habit->user_id = $data["user_id"];
		$habit->points = $data["points"];
		$habit->title = $data["title"];
		$habit->description = $data["description"];
		$habit->why = $data["why"];
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
		$data = $data["postVariables"];

		$habit = AppHabit::find($data["habit_id"]);

		if (isset($data["current_level"])) {
			$habit->current_level = $data["current_level"];
		}

		if (isset($data["points"])) {
			$habit->points = $data["points"];
		}

		if (isset($data["title"])) {
			$habit->title = $data["title"];
		}

		if (isset($data["description"])) {
			$habit->description = $data["description"];
		}

		if (isset($data["why"])) {
			$habit->why = $data["why"];
		}

		$habit->save();

		return response()->json([
			'success' => true,
			'habit' => $habit->toArray()
		], 200);
	}

	public function delete(Request $data) {
		$data = $data["postVariables"];

		$habit = AppHabit::find($data["habit_id"]);
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
			'habits' => $returnHabits,
			'habit_ids' => $habitIDs
		], 200);
	}

}
