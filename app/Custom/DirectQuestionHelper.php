<?php

namespace App\Custom;

use App\DirectQuestion;
use App\DirectQuestionEnrollment;

class DirectQuestionHelper {
	
	public static function getOpenForUser($user_id) {
		return DirectQuestion::where('user_id', $user_id)->where('status', 1)->orderBy('created_at', 'DESC')->get();
	}

	public static function getAllOpen() {
		return DirectQuestion::where('status', 1)->orderBy('created_at', 'DESC')->get();
	}

	public static function getAllForUser($user_id) {
		return DirectQuestion::where('user_id', $user_id)->get();
	}

	public static function answerQuestion($question_id, $answer) {
		$question = DirectQuestion::find($question_id);
		$question->answer = $answer;
		$question->save();

		return true;
	}

	public static function getCreditsForUser($user_id) {
		return DirectQuestionEnrollment::where('user_id', $user_id)->where('status', 1)->first()->credits;
	}

	public static function enroll($data) {
		// TODO: Implement Stripe function
	}

}

?>