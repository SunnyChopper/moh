<?php

namespace App\Custom;

use Auth;
use App\Pomodoro;

class PomodoroHelper {

	public static function getSessionsForUser($user_id) {
		return Pomodoro::where('user_id', $user_id)->get();
	}

	public static function getStatsForUser($user_id) {
		$average_cycles = PomodoroHelper::getAverageCycles($user_id);
		$average_seconds = PomodoroHelper::getAverageSessionTime($user_id);
		return array("average_cycles" => $average_cycles, "average_seconds" => $average_seconds);
	}

	private static function getAverageCycles($user_id) {
		$sessions = Pomodoro::where('user_id', $user_id)->get();

		if (count($sessions) > 0) {
			$cycles = 0;
			foreach($sessions as $session) {
				$cycles += $session->cycles;
			}
			return (float) $cycles / (float) count($sessions);
		} else {
			return 0;
		}
	}

	private static function getAverageSessionTime($user_id) {
		$sessions = Pomodoro::where('user_id', $user_id)->get();

		if (count($sessions) > 0) {
			$seconds = 0;
			foreach($sessions as $session) {
				$seconds += $session->session_seconds;
			}
			return (float) $seconds / (float) count($sessions);
		} else {
			return 0;
		}
	}
	
}

?>