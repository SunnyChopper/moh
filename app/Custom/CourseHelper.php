<?php

namespace App\Custom;

use Auth;
use Carbon\Carbon;

use App\Course;
use App\CourseModule;
use App\CourseVideo;
use App\CourseMembership;
use App\CourseReview;
use App\CourseForum;
use App\CourseForumComment;
use App\CourseCompletion;

use App\Custom\StripeHelper;

class CourseHelper {

	public static function getNextVideo($video_id) {
		$video = CourseVideo::find($video_id);
		$module_id = $video->module_id;
		$order = $video->order;

		if (CourseVideo::where('module_id', $module_id)->where('order', $order + 1)->where('is_active', 1)->count() > 0) {
			return CourseVideo::where('module_id', $module_id)->where('order', $order + 1)->where('is_active', 1)->first();
		} else {
			$module = CourseModule::find($module_id);
			$course = Course::find($module->course_id);

			// Check if there's a next module
			if (CourseModule::where('course_id', $course->id)->where('order', $module->order + 1)->where('is_active', 1)->count() > 0) {
				$new_module = CourseModule::where('course_id', $course->id)->where('order', $module->order + 1)->where('is_active', 1)->first();
				// Check if module has any videos
				if (CourseVideo::where('module_id', $new_module->id)->where('order', 1)->where('is_active', 1)->count() > 0) {
					return CourseVideo::where('module_id', $new_module->id)->where('order', 1)->where('is_active', 1)->first();
				} else {
					return null;
				}
			} else {
				return null;
			}			
		}
	}

	public static function getPrevVideo($video_id) {
		$video = CourseVideo::find($video_id);
		$module = CourseModule::find($video->module_id);

		// Check if previous video in module
		if (CourseVideo::where('module_id', $module->id)->where('order', $video->order - 1)->where('is_active', 1)->count() > 0) {
			return CourseVideo::where('module_id', $module->id)->where('order', $video->order - 1)->where('is_active', 1)->first();
		} else {
			// Get course modules
			$course = Course::find($module->course_id);
			
			// Check if there's a previous module
			if (CourseModule::where('course_id', $course->id)->where('order', $module->order - 1)->where('is_active', 1)->count() > 0) {
				$new_module = CourseModule::where('course_id', $course->id)->where('order', $module->order - 1)->where('is_active', 1)->first();

				// Get max order of module
				$max_order = CourseVideo::where('module_id', $new_module->id)->where('is_active', 1)->count();

				// Check if module has any videos
				if ($max_order != 0) {
					return CourseVideo::where('module_id', $new_module->id)->where('order', $max_order)->where('is_active', 1)->first();
				} else {
					return null;
				}
			}
		}
	}

	public static function isVideoComplete($user_id, $video_id) {
		if (CourseCompletion::where('user_id', $user_id)->where('video_id', $video_id)->count() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public static function enroll($data) {
		$course = Course::find($data["course_id"]);
		$plan_id = $course->plan_id;
		$stripe_helper = new StripeHelper();

		if ($plan_id == "") {
			$membership = new CourseMembership;
	    	$membership->user_id = $data["user_id"];
	    	$membership->course_id = $data["course_id"];
	    	$membership->save();

	    	return true;
		} else {
			$return_data = StripeHelper::subscribe($data);

			$membership = new CourseMembership;
	    	$membership->user_id = $data["user_id"];
	    	$membership->course_id = $data["course_id"];
	    	$membership->customer_id = $return_data["customer_id"];
	    	$membership->subscription_id = $return_data["subscription_id"];

	    	// Calulcate first next payment date
	    	$plan = $stripe_helper->getPlan($plan_id);
	    	$next_payment_date = Carbon\Carbon::now();
	    	if ($plan["trial_period_days"] > 0) {
	    		$next_payment_date->addDays($plan["trial_period_days"]);
	    	} else {
	    		if ($plan["interval"] == "month") {
	    			$next_payment_date->addMonth();
	    		}
	    	}

	    	$membership->next_payment_date = $next_payment_date->toDateTimeString();
	    	$membership->save();

	    	return true;
		}
	}

	public static function getTitle($course_id) {
		return Course::find($course_id)->title;
	}

	public static function numberOfCourses() {
		return Course::where('is_active', 1)->count();
	}

	public static function viewCourses() {
		return Course::where('is_active', 1)->get();
	}
	
	public static function getModules($course_id) {
		return CourseModule::where('course_id', $course_id)->where('is_active', 1)->get();
	}

	public static function getNumMembers($course_id) {
		return CourseMembership::where('course_id', $course_id)->count();
	}

	public static function getCourseCompletion($course_id, $user_id) {
		$completed_videos = CourseCompletion::where('user_id', $user_id)->where('course_id', $course_id)->count();
		$total_videos = CourseHelper::numberOfVideos($course_id);
		return (float)$completed_videos / (float)$total_videos;
	}

	public static function getReviews($course_id) {
		return CourseReview::where('course_id', $course_id)->get();
	}

	public static function getVideos($module_id) {
		return CourseVideo::where('module_id', $module_id)->where('is_active', 1)->get();
	}

	public static function getForums($course_id) {
		return CourseForum::where('course_id', $course_id)->where('is_active', 1)->orderBy('created_at', 'DESC')->get();
	}

	public static function getUserForums($user_id) {
		return CourseForum::where('user_id', $user_id)->where('is_active', 1)->get();
	}

	public static function getComments($forum_id) {
		return CourseForumComment::where('forum_id', $forum_id)->where('is_active', 1)->get();
	}

	public static function getNumberOfReplies($forum_id) {
		return CourseForumComment::where('forum_id', $forum_id)->where('is_active', 1)->count();
	}

	public static function isUserAuthorizedForCourse($course_id) {
		if (CourseMembership::where('user_id', Auth::id())->where('course_id', $course_id)->where('status', 1)->count() > 0) {
			return true;
		} else {
			return false;
		}
	}

	private static function numberOfVideos($course_id) {
		$total = 0;
		$modules = CourseModule::where('course_id', $course_id)->where('is_active', 1)->get();
		foreach ($modules as $module) {
			$videos = CourseVideo::where('module_id', $module->id)->where('is_active', 1)->count();
			$total += $videos;
		}
		return $total;
	}

}

?>