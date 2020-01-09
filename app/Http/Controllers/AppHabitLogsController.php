<?php

namespace App\Http\Controllers;

use App\AppHabitLog;
use App\AppHabit;
use App\AppUser;

use Illuminate\Http\Request;

class AppHabitLogsController extends Controller
{
    
	public function create(Request $data) {
		$data = $data["postVariables"];

		$log = new AppHabitLog;
		$log->user_id = $data["user_id"];
		$log->habit_id = $data["habit_id"];
		$log->level_id = $data["level_id"];
		$log->save();

		$habit = AppHabit::find($data["habit_id"]);
		$user = AppUser::find($data["user_id"]);

		$user->points = $user->points + $habit->points;
		$user->save();

		return response()->json([
			'success' => true,
			'log' => $log->toArray()
		], 200);
	}

	public function delete(Request $data) {
		$data = $data["postVariables"];

		$log = AppHabitLog::find($data["log_id"]);
		$log->is_active = 0;
		$log->save();

		return response()->json([
			'success' => true
		], 200);
	}

	public function getForUser() {
		$count = AppHabitLog::where('user_id', $_GET['user_id'])->active()->count();
		$logs = AppHabitLog::where('user_id', $_GET['user_id'])->active()->get()->toArray();

		$return_logs = array();
		$log_ids = array();

		foreach ($logs as $log) {
			array_push($log_ids, $log["id"]);
			$return_logs[$log["id"]] = $log;
		}

		return response()->json([
			'success' => true,
			'count' => $count,
			'logs' => $return_logs,
			'log_ids' => $log_ids
		], 200);
	}

	public function getForHabit() {
		$count = AppHabitLog::where('habit_id', $_GET['habit_id'])->active()->count();
		$logs = AppHabitLog::where('habit_id', $_GET['habit_id'])->active()->get()->toArray();

		$return_logs = array();
		$log_ids = array();

		foreach ($logs as $log) {
			array_push($log_ids, $log["id"]);
			$return_logs[$log["id"]] = $log;
		}

		return response()->json([
			'success' => true,
			'count' => $count,
			'logs' => $return_logs,
			'log_ids' => $log_ids
		], 200);
	}

	public function getForLevel() {
		$count = AppHabitLog::where('level_id', $_GET['level_id'])->active()->count();
		$logs = AppHabitLog::where('level_id', $_GET['level_id'])->active()->get()->toArray();

		$return_logs = array();
		$log_ids = array();

		foreach ($logs as $log) {
			array_push($log_ids, $log["id"]);
			$return_logs[$log["id"]] = $log;
		}

		return response()->json([
			'success' => true,
			'count' => $count,
			'logs' => $return_logs,
			'log_ids' => $log_ids
		], 200);
	}

}
