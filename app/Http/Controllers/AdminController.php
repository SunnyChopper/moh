<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseModule;
use App\CourseVideo;
use App\Custom\UserHelper;
use App\Custom\AdminHelper;
use App\Custom\CourseHelper;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login() {
    	if (AdminHelper::redirectAdmin() == true) {
    		return redirect(url('/admin/dashboard'));
    	}

    	$page_title = "Admin Login";
    	$page_header = $page_title;

    	return view('admin.login')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function attempt_login(Request $data) {
    	$login_result = AdminHelper::attempt_login($data->username, $data->password);
    	if ($login_result == 1) {
    		return redirect(url('/admin/dashboard'));
    	} elseif ($login_result == -1) {
    		return redirect()->back()->with('error', 'Username not found in system.');
    	} else {
    		return redirect()->back()->with('error', 'Password is incorrect.');
    	}
    }

    public function dashboard() {
    	if (AdminHelper::isAuthorized() == false) {
    		return redirect(url('/admin'));
    	}

    	$users_joined_chart = UserHelper::getUsersJoinedChart();

    	$page_title = "Admin Dashboard";
    	$page_header = $page_title;

    	return view('admin.dashboard')->with('page_title', $page_title)->with('page_header', $page_header)->with('users_joined_chart', $users_joined_chart);
    }

    public function logout() {
    	AdminHelper::logout();
    	return redirect(url('/'));
    }

    public function view_all_courses() {
    	if (AdminHelper::isAuthorized() == false) {
    		return redirect(url('/admin'));
    	}

    	$courses = CourseHelper::viewCourses();

    	$page_title = "Courses";
    	$page_header = $page_title;

    	return view('admin.courses.view')->with('courses', $courses)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function new_course() {
    	if (AdminHelper::isAuthorized() == false) {
    		return redirect(url('/admin'));
    	}

    	$page_title = "New Course";
    	$page_header = $page_title;

    	return view('admin.courses.new')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function create_course(Request $data) {
    	$course = new Course;
    	$course->title = $data->title;
    	$course->description = $data->description;
    	$course->image_url = $data->image_url;
    	$course->youtube_id = $data->youtube_id;
    	$course->price = $data->price;
    	$course->monthly = $data->monthly;
    	$course->save();

    	return redirect(url('/admin/courses'));
    }

    public function edit_course($course_id) {
    	if (AdminHelper::isAuthorized() == false) {
    		return redirect(url('/admin'));
    	}

    	$course = Course::find($course_id);

    	$page_title = $course->title;
    	$page_header = $page_title;

    	return view('admin.courses.edit')->with('page_title', $page_title)->with('page_header', $page_header)->with('course', $course);
    }

    public function update_course(Request $data) {
    	$course = Course::find($data->course_id);
    	$course->title = $data->title;
    	$course->description = $data->description;
    	$course->image_url = $data->image_url;
    	$course->youtube_id = $data->youtube_id;
    	$course->price = $data->price;
    	$course->monthly = $data->monthly;
    	$course->save();

    	return redirect(url('/admin/courses'));
    }

    public function delete_course(Request $data) {
    	$course = Course::find($data->course_id);
    	$course->is_active = 0;
    	$course->save();

    	return redirect()->back();
    }

    public function view_course_modules($course_id) {
    	if (AdminHelper::isAuthorized() == false) {
    		return redirect(url('/admin'));
    	}

    	$course = Course::find($course_id);
    	$modules = CourseHelper::getModules($course_id);

    	$page_title = "Course Content";
    	$page_header = $page_title;

    	return view('admin.courses.modules.view')->with('course', $course)->with('modules', $modules)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function new_course_module($course_id) {
    	if (AdminHelper::isAuthorized() == false) {
    		return redirect(url('/admin'));
    	}

    	$course = Course::find($course_id);

    	$page_title = "New Course Module";
    	$page_header = $page_title;

    	return view('admin.courses.modules.new')->with('page_title', $page_title)->with('page_header', $page_header)->with('course', $course);
    }

    public function create_course_module(Request $data) {
    	$module = new CourseModule;
    	$module->course_id = $data->course_id;
    	$module->title = $data->title;
    	$module->description = $data->description;
    	$module->order = $data->order;
    	$module->save();

    	return redirect(url('/admin/courses/' . $data->course_id . '/modules'));
    }

    public function edit_course_module($course_id, $module_id) {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $course = Course::find($course_id);
        $module = CourseModule::find($module_id);

        $page_title = $module->title;
        $page_header = "Edit Module";

        return view('admin.courses.modules.edit')->with('page_title', $page_title)->with('page_header', $page_header)->with('course', $course)->with('module', $module);
    }

    public function update_course_module(Request $data) {
        $module = CourseModule::find($data->module_id);
        $module->title = $data->title;
        $module->description = $data->description;
        $module->order = $data->order;
        $module->save();

        return redirect(url('/admin/courses/' . $data->course_id . '/modules'));
    }

    public function delete_course_module(Request $data) {
    	$module = CourseModule::find($data->module_id);
    	$module->is_active = 0;
    	$module->save();

    	return redirect()->back();
    }

    public function view_module_content($course_id, $module_id) {
    	if (AdminHelper::isAuthorized() == false) {
    		return redirect(url('/admin'));
    	}

    	$course = Course::find($course_id);
    	$module = CourseModule::find($module_id);
    	$videos = CourseHelper::getVideos($module_id);

    	$page_title = "Module Content";
    	$page_header = $page_title;

    	return view('admin.courses.modules.content.view')->with('page_title', $page_title)->with('page_header', $page_header)->with('course', $course)->with('module', $module)->with('videos', $videos);
    }

    public function new_module_content($course_id, $module_id) {
    	if (AdminHelper::isAuthorized() == false) {
    		return redirect(url('/admin'));
    	}

    	$course = Course::find($course_id);
    	$module = CourseModule::find($module_id);

    	$page_title = "New Module Content";
    	$page_header = $page_title;

    	return view('admin.courses.modules.content.new')->with('page_title', $page_title)->with('page_header', $page_header)->with('course', $course)->with('module', $module);
    }

    public function create_module_content(Request $data) {
    	$content = new CourseVideo;
    	$content->module_id = $data->module_id;
    	$content->title = $data->title;
    	$content->description = $data->description;
    	$content->order = $data->order;
    	$content->youtube_id = $data->youtube_id;
    	$content->save();

    	return redirect(url('/admin/courses/' . $data->course_id . '/modules/' . $data->module_id . '/content'));
    }

    public function edit_content($course_id, $module_id, $content_id) {
    	if (AdminHelper::isAuthorized() == false) {
    		return redirect(url('/admin'));
    	}

    	$course = Course::find($course_id);
    	$module = CourseModule::find($module_id);
    	$content = CourseVideo::find($content_id);

    	$page_title = $content->title;
    	$page_header = "Edit Content";

    	return view('admin.courses.modules.content.edit')->with('page_title', $page_title)->with('page_header', $page_header)->with('course', $course)->with('module', $module)->with('content', $content);
    }

    public function update_content(Request $data) {
    	$content = CourseVideo::find($data->content_id);
    	$content->title = $data->title;
    	$content->description = $data->description;
    	$content->order = $data->order;
    	$content->youtube_id = $data->youtube_id;
    	$content->save();

    	return redirect(url('/admin/courses/' . $data->course_id . '/modules/' . $data->module_id . '/content'));
    }

    public function delete_content(Request $data) {
    	$content = CourseVideo::find($data->content_id);
    	$content->is_active = 0;
    	$content->save();

    	return redirect()->back();
    }
}
