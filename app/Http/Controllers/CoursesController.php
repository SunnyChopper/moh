<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Custom\CourseHelper;
use App\Custom\StripeHelper;

use App\Course;
use App\CourseModule;
use App\CourseForum;
use App\CourseVideo;
use App\CourseMembership;
use App\CourseForumComment;

class CoursesController extends Controller
{

    public function dashboard($course_id) {
        if (CourseHelper::isUserAuthorizedForCourse($course_id) == false) {
            return redirect(url('/courses/' . $course_id));
        }

        $course = Course::find($course_id);
        $modules = CourseHelper::getModules($course_id);
        $forums = CourseHelper::getForums($course_id);

        $page_title = $course->title;
        $page_header = $page_title;

        return view('members.courses.dashboard')->with('course', $course)->with('modules', $modules)->with('forums', $forums)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function view_module($course_id, $module_id) {
        if (CourseHelper::isUserAuthorizedForCourse($course_id) == false) {
            return redirect(url('/courses/' . $course_id));
        }

        $course = Course::find($course_id);
        $videos = CourseHelper::getVideos($module_id);
        $module = CourseModule::find($module_id);

        $page_title = $module->title;
        $page_header = $page_title;

        return view('members.courses.view-module')->with('course', $course)->with('module', $module)->with('videos', $videos)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function view_video($course_id, $module_id, $video_id) {
        if (CourseHelper::isUserAuthorizedForCourse($course_id) == false) {
            return redirect(url('/courses/' . $course_id));
        }

        $course = Course::find($course_id);
        $module = CourseModule::find($module_id);
        $video = CourseVideo::find($video_id);

        $page_title = $video->title;
        $page_header = $page_title;

        return view('members.courses.view-video')->with('course', $course)->with('module', $module)->with('video', $video)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function new_forum($course_id) {
        if (CourseHelper::isUserAuthorizedForCourse($course_id) == false) {
            return redirect(url('/courses/' . $course_id));
        }

        $course = Course::find($course_id);

        $page_title = "New Forum Post";
        $page_header = $page_title;

        return view('members.courses.new-forum')->with('course', $course)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function create_forum(Request $data) {
        $forum = new CourseForum;
        $forum->user_id = Auth::id();
        $forum->course_id = $data->course_id;
        $forum->title = $data->title;
        $forum->description = $data->description;
        $forum->save();

        return redirect(url('/members/courses/' . $data->course_id . '/dashboard'));
    }

    public function view_forum($course_id, $forum_id) {
        if (CourseHelper::isUserAuthorizedForCourse($course_id) == false) {
            return redirect(url('/courses/' . $course_id));
        }

        $course = Course::find($course_id);
        $forum = CourseForum::find($forum_id);
        $comments = CourseHelper::getComments($forum->id);

        $page_title = $forum->title;
        $page_header = $page_title;

        return view('members.courses.view-forum')->with('course', $course)->with('forum', $forum)->with('comments', $comments)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function create_comment(Request $data) {
        $comment = new CourseForumComment;
        $comment->user_id = Auth::id();
        $comment->forum_id = $data->forum_id;
        $comment->comment = $data->comment;
        $comment->save();

        return redirect()->back();
    }

    public function enroll(Request $data) {
        // Check if monthly or one-time
        $course = Course::find($data->course_id);
        if ($course->monthly == 1) {
            $stripe_data = array(
                'card_number' => $data->card_number,
                'ccExpiryMonth' => $data->ccExpiryMonth,
                'ccExpiryYear' => $data->ccExpiryYear,
                'cvvNumber' => $data->cvvNumber,
                'email' => $data->email,
                'plan_id' => $course->plan_id
            );

            $response = StripeHelper::checkout($stripe_data);
            if (array_key_exists("subscription_id", $response)) {
                // Successful, store the data
                $membership = new CourseMembership;
                $membership->user_id = $data->user_id;
                $membership->customer_id = $response["customer_id"];
                $membership->subscription_id = $response["subscription_id"];
                $membership->course_id = $data->course_id;

                // Calculate next payment date
                $subscription = StripeHelper::getPlan($course->plan_id);
                $trial_days = $subscription["items"]["data"]["plan"]["trial_period_days"];
                $now = Carbon::now();
                $add_trial_days = $now->addDays($trial_days);
                $add_month = $now->addMonth();
                $membership->next_payment_date = $now->toDateString();
                $membership->save();

                return response()->json(true, 200);
            } else {
                return response()->json($response, 200);
            }
        } else {
            $stripe_data = array(
                'card_number' => $data->card_number,
                'ccExpiryMonth' => $data->ccExpiryMonth,
                'ccExpiryYear' => $data->ccExpiryYear,
                'cvvNumber' => $data->cvvNumber,
                'email' => $data->email,
                'amount' => $course->price,
                'description' => 'Mind of Habit' 
            );

            $response = StripeHelper::checkout($stripe_data);
            if (array_key_exists("charge_id", $response)) {
                // Successful, store the data
                $membership = new CourseMembership;
                $membership->user_id = $data->user_id;
                $membership->customer_id = $response["customer_id"];
                $membership->charge_id = $response["charge_id"];
                $membership->course_id = $data->course_id;
                $membership->save();

                return response()->json(true, 200);
            } else {
                return response()->json($response, 200);
            }
        }
    }

    public function create(Request $data) {
    	$course = new Course;
    	$course->title = $data->title;
    	$course->description = $data->description;
    	$course->price = $data->price;
        $course->plan_id = $data->plan_id;
    	$course->monthly = $data->monthly;

    	if (isset($data->image_url)) {
    		$course->image_url = $data->image_url;
    	}

    	if (isset($data->youtube_id)) {
    		$course->youtube_id = $data->youtube_id;
    	}

    	$course->save();

    	return $course->id;
    }

    public function read($course_id) {
    	$course = Course::find($course_id);
    	$page_title = $course->title;
    	$page_header = $page_title;

        $course_modules = CourseModule::where('course_id', $course->id)->get();

    	return view('pages.view-course')->with('course', $course)->with('page_title', $page_title)->with('page_header', $page_header)->with('modules', $modules);
    }

    public function update(Request $data) {
    	$course = Course::find($data->course_id);
    	$course->title = $data->title;
    	$course->description = $data->description;
    	$course->price = $data->price;
        $course->plan_id = $data->plan_id;
    	$course->monthly = $data->monthly;

    	if (isset($data->image_url)) {
    		$course->image_url = $data->image_url;
    	}

    	if (isset($data->youtube_id)) {
    		$course->youtube_id = $data->youtube_id;
    	}

    	$course->save();

    	return redirect(url('/admin/courses'));
    }

    public function delete(Request $data) {
		$course = Course::find($data->course_id);
		$course->is_active = 0;
		$course->save();

		return true;
    }
}
