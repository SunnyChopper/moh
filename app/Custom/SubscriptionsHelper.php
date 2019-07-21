<?php

namespace App\Custom;

use App\CourseMembership;
use App\DirectQuestionEnrollment;
use App\MentorEnrollment;
use App\RICEEnrollment;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;

class SubscriptionsHelper {

	public static function getSubscriptions($user_id) {
		$subscriptions = array(
			"courses" => SubscriptionsHelper::getCourseSubscriptions($user_id),
			"direct_question" => SubscriptionsHelper::getDirectQuestionsSubscription($user_id),
			"mentor" => SubscriptionsHelper::getMentorshipSubscription($user_id),
			"rice" => SubscriptionsHelper::getRICESubscription($user_id)
		);

		return $subscriptions;
	}

	private static function getCourseSubscriptions($user_id) {
		return CourseMembership::where('user_id', $user_id)->get();
	}

	private static function getDirectQuestionsSubscription($user_id) {
		return DirectQuestionEnrollment::where('user_id', $user_id)->first();
	}

	private static function getMentorshipSubscription($user_id) {
		return MentorEnrollment::where('user_id', $user_id)->first();
	}

	private static function getRICESubscription($user_id) {
		return RICEEnrollment::where('user_id', $user_id)->first();
	}

	private static function isSubscriptionActive($customer_id, $subscription_id) {
		$stripe = Stripe::make(env('STRIPE_SECRET'));
		$subscription = $stripe->subscriptions()->find($customer_id, $subscription_id);

		if ($subscription["status"] != "active" || $subscription["status"] != "trialing") {
			return false;
		} else {
			return true;
		}
	} 

}

?>