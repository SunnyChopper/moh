<?php

namespace App\Custom;

use Carbon\Carbon;
use App\MentorAppointment;
use App\MentorEnrollment;
use App\MentorMessage;
use App\MentorRecommendation;
use App\MentorTask;
use App\MentorVideo;
use App\MentorDocument;
use App\User;

class MentorHelper {
	
	public static function getRecommendationsForUser($user_id) {
		return MentorRecommendation::where('user_id', $user_id)->where('is_active', 1)->get();
	}

	public static function getMessagesForUser($user_id) {
		return MentorMessage::where('user_id', $user_id)->where('is_active', 1)->get();
	}

	public static function getOpenAppointments() {
		return MentorAppointment::whereDate('appointment_date', '>', Carbon::today())->where('user_id', NULL)->get();
	}

	public static function getFutureAppointmentsForUser($user_id) {
		return MentorAppointment::whereDate('appointment_date', '>', Carbon::today())->with('user_id', $user_id)->get();
	}

	public static function getVideosForUser($user_id) {
		return MentorVideo::where('user_id', $user_id)->where('status', '>', 0)->get();
	}

	public static function getDocumentsForUser($user_id) {
		return MentorDocument::where('user_id', $user_id)->where('status', '>', 0)->get();
	}

	public static function getTasksForUser($user_id) {
		return MentorTask::where('user_id', $user_id)->where('status', '>', 1)->get();
	}

	public static function getOpenTasksForUser($user_id) {
		return MentorTask::where('user_id', $user_id)->where('status', 1)->get();
	}

	public static function getAllOpenTasks() {
		return MentorTask::where('status', 1)->get();
	}

	public static function getAllMentees() {
		$users = array();
		$enrolled = MentorEnrollment::where('status', 1)->get();
		foreach ($enrolled as $e) {
			$user = User::find($e->user_id);
			array_push($users, $user);
		}
		return $users;
	}

	public static function enroll($data) {
		// TODO: Implement Stripe feature
	}

}

?>