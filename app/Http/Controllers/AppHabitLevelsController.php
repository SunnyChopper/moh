<?php

namespace App\Http\Controllers;

use App\AppHabitLevel;

use Illuminate\Http\Request;

class AppHabitLevelsController extends Controller
{
    
	public function create(Request $data) {
		$level = new AppHabitLevel;
		$level->user_id = $data->user_id;
		$level->habit_id = $data->habit_id;
		$level->order = $data->order;
		$level->title = $data->title;
		$level->description = $data->description;
		$level->save();

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
		return response()->json([
			'success' => true,
			'count' => AppHabitLevel::where('user_id', $_GET['user_id'])->active()->count(),
			'levels' => AppHabitLevel::where('user_id', $_GET['user_id'])->active()->get()->toArray()
		], 200);
	}

	public function getForHabit() {
		return response()->json([
			'success' => true,
			'count' => AppHabitLevel::where('habit_id', $_GET['habit_id'])->active()->count(),
			'levels' => AppHabitLevel::where('habit_id', $_GET['habit_id'])->active()->get()->toArray()
		], 200);
	}

}