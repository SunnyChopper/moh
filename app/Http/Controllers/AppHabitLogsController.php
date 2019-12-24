<?php

namespace App\Http\Controllers;

use App\AppHabitLog;

use Illuminate\Http\Request;

class AppHabitLogsController extends Controller
{
    
	public function create(Request $data) {
		$log = new AppHabitLog;
		$log->user_id = $data->user_id;
		$log->habit_id = $data->habit_id;
		$log->level_id = $data->level_id;
		$log->save();

		return response()->json([
			'success' => true,
			'log_id' => $log->id
		], 200);
	}

	public function delete(Request $data) {
		$log = AppHabitLog::find($data->log_id);
		$log->is_active = 0;
		$log->save();

		return response()->json([
			'success' => true
		], 200);
	}

	public function getForUser() {
		return response()->json([
			'success' => true,
			'count' => AppHabitLog::where('user_id', $_GET['user_id'])->active()->count(),
			'logs' => AppHabitLog::where('user_id', $_GET['user_id'])->active()->get()->toArray()
		], 200);
	}

	public function getForHabit() {
		return response()->json([
			'success' => true,
			'count' => AppHabitLog::where('habit_id', $_GET['habit_id'])->active()->count(),
			'logs' => AppHabitLog::where('habit_id', $_GET['habit_id'])->active()->get()->toArray()
		], 200);
	}

	public function getForLevel() {
		return response()->json([
			'success' => true,
			'count' => AppHabitLog::where('level_id', $_GET['level_id'])->active()->count(),
			'logs' => AppHabitLog::where('level_id', $_GET['level_id'])->active()->get()->toArray()
		], 200);
	}

}
