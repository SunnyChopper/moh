<?php

namespace App\Custom;

use Auth;
use Carbon\Carbon;

use App\StudentClass;
use App\StudentTask;

class StudentPlannerHelper {

	public static function getTasksForUser($user_id) {
		$classes = StudentPlannerHelper::getClassesForUser($user_id);
		$tasks = array();
		foreach ($classes as $class) {
			$class_tasks = StudentPlannerHelper::getTaskForClass($class->id);
			foreach($class_tasks as $task) {
				array_push($tasks, $task);
			}
		}
		return $tasks;
	}

	public static function getClassesForUser($user_id) {
		return StudentClass::where('user_id', $user_id)->where('is_active', 1)->get();
	}

	public static function getTaskForClass($class_id) {
		return StudentTask::where('class_id', $class_id)->whereDate('due_date', '>=', Carbon::now())->where('is_active', 1)->get();
	}

	public static function getPastTasksForUser($user_id) {
		return StudentTask::where('user_id', $user_id)->whereDate('due_date', '<', Carbon::now())->get();
	}

}

?>