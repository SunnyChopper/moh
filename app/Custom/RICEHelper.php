<?php

namespace App\Custom;
use App\RICETask;
use App\RICEEnrollment;

class RICEHelper {

	public static function hasUserEnrolled($user_id) {
		if (RICEEnrollment::where('user_id', $user_id)->count() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public static function getOpenTasks($user_id) {
		return RICETask::where('user_id', $user_id)->where('status', 1)->orderBy('created_at', 'DESC')->get();
	}
	
	public static function viewAllTasks($user_id) {
		return RICETask::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
	}

	public static function viewStats($user_id) {
		return array(
			"reach_average" => $this->calculateAverageReach(),
			"impact_average" => $this->calculateAverageImpact(),
			"confidence_average" => $this->calculateAverageConfidence(),
			"ease_average" => $this->calculateAverageEase(),
			"completed_score" => $this->calculateCompletedAverageScore(),
			"uncompleted_score" => $this->calculateUncompletedAverageScore()
		);
	}

	public static function viewAllEnrollments() {
		return RICEEnrollment::where('status', 1)->where('status', 2)->get();
	}

	public static function isAuth($user_id) {
		if (RICEEnrollment::where('user_id', $user_id)->count() > 0) {
			$enrollment = RICEEnrollment::where('user_id', $user_id)->first();
			if($enrollment->status == 1 || $enrollment->status == 2) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	private function calculateAverageReach($user_id) {
		$tasks = RICETask::where('user_id', $user_id)->get();
		$total = 0;
		$total_reach = 0;
		foreach($tasks as $task) {
			$total++;
			$total_reach = $task->reach;
		}
		return (float)$total_reach / (float)$total;
	}

	private function calculateAverageImpact($user_id) {
		$tasks = RICETask::where('user_id', $user_id)->get();
		$total = 0;
		$total_impact = 0;
		foreach($tasks as $task) {
			$total++;
			$total_impact = $task->impact;
		}
		return (float)$total_impact / (float)$total;
	}

	private function calculateAverageConfidence($user_id) {
		$tasks = RICETask::where('user_id', $user_id)->get();
		$total = 0;
		$total_confidence = 0;
		foreach($tasks as $task) {
			$total++;
			$total_confidence = $task->confidence;
		}
		return (float)$total_confidence / (float)$total;
	}

	private function calculateAverageEase($user_id) {
		$tasks = RICETask::where('user_id', $user_id)->get();
		$total = 0;
		$total_ease = 0;
		foreach($tasks as $task) {
			$total++;
			$total_ease = $task->ease;
		}
		return (float)$total_ease / (float)$total;
	}

	private function calculateCompletedAverageScore($user_id) {
		$tasks = RICETask::where('user_id', $user_id)->where('status', 2)->get();
		$total = 0;
		$total_score = 0;
		foreach($tasks as $task) {
			$total++;
			$total_score = $task->score;
		}
		return (float)$total_score / (float)$total;
	}

	private function calculateUncompletedAverageScore($user_id) {
		$tasks = RICETask::where('user_id', $user_id)->where('status', 1)->get();
		$total = 0;
		$total_score = 0;
		foreach($tasks as $task) {
			$total++;
			$total_score = $task->score;
		}
		return (float)$total_score / (float)$total;
	}

}

?>