<?php

namespace App\Custom;

use Auth;
use App\User;
use Carbon\Carbon;
use App\Charts\UsersJoinedChart;

class UserHelper {

	public static function getUsersJoinedChart() {
		$chart = new UsersJoinedChart;
		$days = array();
		$user_count = array();
		for ($i = 8; $i > 0; $i--) {
			$date = Carbon::today()->subDays($i)->format('M jS, Y');
			array_push($days, $date);
			$num_users = User::whereDate('created_at', Carbon::today()->subDays($i))->count();
			array_push($user_count, $num_users);
		}
		$chart->labels($days);
		$chart->dataset('Number of Users', 'line', $user_count);
		return $chart;
	}
	
	public static function logout() {
		Auth::logout();
	}

}

?>