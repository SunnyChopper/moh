<?php

namespace App\Http\Controllers;

use App\AppHabitLevel;

use Illuminate\Http\Request;

class AppHabitLevelsController extends Controller
{
    
	public function create(Request $data) {
		$data = $data["postVariables"];

		$level = new AppHabitLevel;
		$level->user_id = $data["user_id"];
		$level->habit_id = $data["habit_id"];
		$level->title = $data["title"];
		$level->description = $data["description"];

		$levels = AppHabitLevel::where('user_id', $data["user_id"])->where('habit_id', $data["habit_id"])->active()->count();
		$level->order = $levels + 1;

		$level->save();

		$habit = AppHabit::find($data["habit_id"]);
		if ($habit->current_level == null) {
			$habit->current_level = $level->id;
		}
		$habit->save();

		return response()->json([
			'success' => true,
			'level_id' => $level->id
		], 200);
	}

	public function read() {
		return response()->json([
			'success' => true,
			'level' => AppHabitLevel::find($_GET['level_id'])->toArray()
		], 200);
	}

	public function update(Request $data) {
		$level = AppHabitLevel::find($data->level_id);

		if (isset($data->order)) {
			$level->order = $data->order;
		}
		
		if (isset($data->title)) {
			$level->title = $data->title;
		}

		if (isset($data->description)) {
			$level->description = $data->description;
		}

		$level->save();

		return response()->json([
			'success' => true,
			'level' => $level->toArray()
		], 200);
	}

	public function delete(Request $data) {
		$level = AppHabitLevel::find($data->level_id);
		$level->is_active = 0;
		$level->save();

		return response()->json([
			'success' => true
		], 200);
	}

	public function getForUser() {
		$count = AppHabitLevel::where('user_id', $_GET['user_id'])->active()->count();
		$levels = AppHabitLevel::where('user_id', $_GET['user_id'])->active()->get()->toArray();

		$level_ids = array();
		$return_levels = array();

		foreach($levels as $level) {
			array_push($level_ids, $level["id"]);
			$return_levels[$level["id"]] = $level["id"];
		}

		return response()->json([
			'success' => true,
			'count' => $count,
			'levels' => $return_levels,
			'level_ids' => $level_ids
		], 200);
	}

	public function getForHabit() {
		$count = AppHabitLevel::where('habit_id', $_GET['habit_id'])->active()->count();
		$levels = AppHabitLevel::where('habit_id', $_GET['habit_id'])->active()->get()->toArray();

		$level_ids = array();
		$return_levels = array();

		foreach($levels as $level) {
			array_push($level_ids, $level["id"]);
			$return_levels[$level["id"]] = $level;
		}

		return response()->json([
			'success' => true,
			'count' => $count,
			'levels' => $return_levels,
			'level_ids' => $level_ids
		], 200);
	}

}
