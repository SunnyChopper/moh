<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use App\Custom\CourseHelper;

class PagesController extends Controller
{
    public function index() {
    	$page_title = "Welcome";

    	return view('pages.index')->with('page_title', $page_title);
    }

    public function courses() {
    	$page_title = "Courses";
    	$page_header = $page_title;

    	$courses = CourseHelper::viewCourses();

    	return view('pages.courses')->with('page_title', $page_title)->with('page_header', $page_header)->with('courses', $courses);
    }

    public function view_course($course_id) {
    	$course = Course::find($course_id);

    	$page_title = $course->title;
    	$page_header = $page_title;

    	return view('pages.view-course')->with('page_title', $page_title)->with('page_header', $page_header)->with('course', $course);
    }

    public function personal_coaching() {
        $page_title = "Personal Coaching";
        $page_header = $page_title;

        return view('pages.personal-coaching')->with('page_title', $page_title)->with('page_header', $page_header);
    }
}
