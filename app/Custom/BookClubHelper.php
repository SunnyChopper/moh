<?php

namespace App\Custom;

use Auth;
use Carbon\Carbon;

use App\BookClubBook;
use App\BookClubMembership;

use App\Charts\NewBookClubMembersChart;

use App\Custom\StripeHelper;

class BookClubHelper {

	public static function isUserAuthorized($user_id) {
		if (BookClubMembership::where('user_id', $user_id)->where('status', 1)->count() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public static function checkStripeMembership($user_id) {
		$membership = BookClubMembership::where('user_id', $user_id)->first();
		$customer_id = $membership->customer_id;
		$subscription_id = $membership->subscription_id;

		if (StripeHelper::checkSubscription($customer_id, $subscription_id) == 1) {
			return true;
		} else {
			return false;
		}
	}

	public static function getNewBookClubMembersChart() {
		$chart = new NewBookClubMembersChart;
		$days = array();
		$members_count = array();
		for ($i = 8; $i > -1; $i--) {
			// Push the date to the days array
			$date = Carbon::today()->subDays($i)->format('M jS, Y');
			array_push($days, $date);

			// Get memberships within time range
			$num_users = BookClubMembership::whereDate('created_at', Carbon::today()->subDays($i))->count();
			array_push($members_count, $num_users);
		}
		$chart->labels($days);
		$chart->dataset('Number of Book Club Registrations', 'line', $members_count);
		$chart->displayLegend(false);
		return $chart;
	}

	public static function getCurrentBook() {
		if (BookClubBook::active()->current()->count() > 0) {
			return BookClubBook::active()->current()->first();
		} else {
			return null;
		}
	}

}

?>