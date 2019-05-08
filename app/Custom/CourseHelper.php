<?php

namespace App\Custom;

use App\Course;
use App\CourseModule;
use App\CourseVideo;
use App\CourseMembership;
use App\CourseReview;
use App\CourseForum;
use App\CourseForumComment;
use App\CourseCompletion;

class CourseHelper {

	public static function viewCourses() {
		return Course::where('is_active', 1)->get();
	}
	
	public static function getModules($course_id) {
		return CourseModule::where('course_id', $course_id)->get();
	}

	public static function getNumMembers($course_id) {
		return CourseMembership::where('course_id', $course_id)->count();
	}

	public static function getCourseCompletion($course_id, $user_id) {
		$completed_videos = CourseCompletion::where('user_id', $user_id)->where('course_id', $course_id)->count();
		$total_videos = $this->numberOfVideos($course_id);
		return $completed_videos / $total_videos;
	}

	public static function getReviews($course_id) {
		return CourseReview::where('course_id', $course_id)->get();
	}

	public static function getVideos($module_id) {
		return CourseVideo::where('module_id', $module_id)->get();
	}

	public static function getComments($forum_id) {
		return CourseForumComment::where('forum_id', $forum_id)->get();
	}

	private function numberOfVideos($course_id) {
		$total = 0;
		$modules = CourseModule::where('course_id', $course_id)->get();
		foreach ($modules as $module) {
			$videos = CourseVideo::where('module_id', $module_id)->count();
			$total += $videos;
		}
		return $total;
	}

}

?>