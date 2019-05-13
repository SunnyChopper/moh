<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\CourseHelper;
use App\Course;
use App\CourseModule;
use App\CourseForum;

class CoursesController extends Controller
{

    public function dashboard($course_id) {
        if (CourseHelper::isUserAuthorizedForCourse($course_id) == false) {
            return redirect(url('/courses/' . $course_id));
        }

        $course = Course::find($course_id);
        $modules = CourseModule::where('course_id', $course_id)->get();
        $forums = CourseForum::where('course_id', $course_id)->orderBy('created_at', 'DESC')->get();

        $page_title = $course->title;
        $page_header = $page_title;

        return view('members.courses.dashboard')->with('course', $course)->with('modules', $modules)->with('forums', $forums)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function create(Request $data) {
    	$course = new Course;
    	$course->title = $data->title;
    	$course->description = $data->description;
    	$course->price = $data->price;
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
    	return view('pages.view-course')->with('course', $course)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update(Request $data) {
    	$course = Course::find($data->course_id);
    	$course->title = $data->title;
    	$course->description = $data->description;
    	$course->price = $data->price;
    	$course->monthly = $data->monthly;

    	if (isset($data->image_url)) {
    		$course->image_url = $data->image_url;
    	}

    	if (isset($data->youtube_id)) {
    		$course->youtube_id = $data->youtube_id;
    	}

    	$course->save();

    	return true;
    }

    public function delete(Request $data) {
		$course = Course::find($data->course_id);
		$course->is_active = 0;
		$course->save();

		return true;
    }
}
