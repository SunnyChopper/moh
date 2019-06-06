<?php

namespace App\Custom;

use Auth;
use Carbon\Carbon;

use App\StudentClass;
use App\StudentTask;

class StudentPlannerHelper {

	public static function getClassesForUser($user_id) {
		return StudentClass::where('user_id', $user_id)->get();
	}

	public static function getTaskForClass($class_id) {
		return StudentTask::where('class_id', $class_id)->whereDate('due_date', '>=', Carbon::now())->get();
	}

	public static function getPastTasksForUser($user_id) {
		return StudentTask::where('user_id', $user_id)->whereDate('due_date', '<', Carbon::now())->get();
	}

}

?>