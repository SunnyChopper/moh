<?php

namespace App\Custom;

use Auth;
use App\Pomodoro;

class PomodoroHelper {

	public static function getSessionsForUser($user_id) {
		return Pomodoro::where('user_id', $user_id)->get();
	}
	
}

?>