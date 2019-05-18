<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\CourseModule;
use App\CourseVideo;
use App\MentorTask;
use App\MentorVideo;
use App\MentorDocument;
use App\MentorEnrollment;
use App\MentorRecommendation;
use App\Custom\UserHelper;
use App\Custom\AdminHelper;
use App\Custom\CourseHelper;
use App\Custom\MentorHelper;
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

    public function view_personal_coaching() {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $mentees = MentorHelper::getAllMentees();

        $page_title = "Your Mentees";
        $page_header = $page_title;

        return view('admin.personal-coaching.view')->with('mentees', $mentees)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function view_mentee($mentee_id) {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $mentee = User::find(MentorEnrollment::find($mentee_id)->user_id);
        $appointments = MentorHelper::getFutureAppointmentsForUser($mentee->id);
        $documents = MentorHelper::getDocumentsForUser($mentee->id);
        $recommendations = MentorHelper::getRecommendationsForUser($mentee->id);
        $tasks = MentorHelper::getOpenTasksForUser($mentee->id);
        $videos = MentorHelper::getVideosForUser($mentee->id);

        $page_title = $mentee->first_name . " " . $mentee->last_name;
        $page_header = $page_title;

        return view('admin.personal-coaching.dashboard')->with('page_title', $page_title)->with('page_header', $page_header)->with('mentee', $mentee)->with('appointments', $appointments)->with('documents', $documents)->with('recommendations', $recommendations)->with('tasks', $tasks)->with('videos', $videos)->with('mentee_id', $mentee_id);
    }

    public function new_mentee_document($mentee_id) {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $mentee = User::find(MentorEnrollment::find($mentee_id)->user_id);

        $page_title = "Share New Document";
        $page_header = $page_title;

        return view('admin.personal-coaching.documents.new')->with('page_title', $page_title)->with('page_header', $page_header)->with('mentee', $mentee)->with('mentee_id', $mentee_id);
    }

    public function create_mentee_document(Request $data) {
        $mentee = MentorEnrollment::find($data->mentee_id);

        $doc = new MentorDocument;
        $doc->user_id = $mentee->user_id;
        $doc->title = $data->title;
        $doc->description = $data->description;
        $doc->link = $data->link;
        $doc->save();

        return redirect(url('/admin/personal-coaching/mentee/' . $data->mentee_id));
    }

    public function edit_mentee_document($mentee_id, $document_id) {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $document = MentorDocument::find($document_id);

        $page_title = "Edit " . $document->title;
        $page_header = $page_title;

        return view('admin.personal-coaching.documents.edit')->with('page_title', $page_title)->with('page_header', $page_header)->with('mentee_id', $mentee_id)->with('document', $document);
    }

    public function update_mentee_document(Request $data) {
        $document = MentorDocument::find($data->doc_id);
        $document->title = $data->title;
        $document->description = $data->description;
        $document->link = $data->link;
        $document->save();

        return redirect(url('/admin/personal-coaching/mentee/' . $data->mentee_id));
    }

    public function delete_mentee_document(Request $data) {
        $document = MentorDocument::find($data->doc_id);
        $document->status = 0;
        $document->save();

        return redirect()->back();
    }

    public function new_recommendation($mentee_id) {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $page_title = "New Recommendation";
        $page_header = $page_title;

        return view('admin.personal-coaching.recommendations.new')->with('page_title', $page_title)->with('page_header', $page_header)->with('mentee_id', $mentee_id);
    }

    public function create_recommendation(Request $data) {
        $mentee = MentorEnrollment::find($data->mentee_id);

        $r = new MentorRecommendation;
        $r->user_id = $mentee->user_id;
        $r->title = $data->title;
        $r->description = $data->description;
        $r->link = $data->link;
        $r->type = $data->type;
        $r->save();

        return redirect(url('/admin/personal-coaching/mentee/' . $data->mentee_id));
    }

    public function edit_recommendation($mentee_id, $r_id) {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $r = MentorRecommendation::find($r_id);

        $page_title = "Edit " . $r->title;
        $page_header = $page_title;

        return view('admin.personal-coaching.recommendations.edit')->with('recommendation', $r)->with('page_title', $page_title)->with('page_header', $page_header)->with('mentee_id', $mentee_id);    
    }

    public function update_recommendation(Request $data) {
        $r = MentorRecommendation::find($data->r_id);
        $r->title = $data->title;
        $r->description = $data->description;
        $r->link = $data->link;
        $r->type = $data->type;
        $r->save();

        return redirect(url('/admin/personal-coaching/mentee/' . $data->mentee_id));
    }

    public function delete_recommendation(Request $data) {
        $r = MentorRecommendation::find($data->r_id);
        $r->is_active = 0;
        $r->save();

        return redirect()->back();
    }

    public function new_task($mentee_id) {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $page_title = "Assign New Task";
        $page_header = $page_title;

        return view('admin.personal-coaching.tasks.new')->with('page_title', $page_title)->with('page_header', $page_header)->with('mentee_id', $mentee_id);
    }

    public function create_task(Request $data) {
        $mentee = MentorEnrollment::find($data->mentee_id);
        $task = new MentorTask;
        $task->user_id = $mentee->user_id;
        $task->title = $data->title;
        $task->description = $data->description;
        $task->due_date = $data->due_date;
        $task->save();

        return redirect(url('/admin/personal-coaching/mentee/' . $data->mentee_id));    
    }

    public function edit_task($mentee_id, $task_id) {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $task = MentorTask::find($task_id);

        $page_title = "Edit " . $task->title;
        $page_header = $page_title;

        return view('admin.personal-coaching.tasks.edit')->with('page_title', $page_title)->with('page_header', $page_header)->with('mentee_id', $mentee_id)->with('task', $task);
    }

    public function update_task(Request $data) {
        $task = MentorTask::find($data->task_id);
        $task->title = $data->title;
        $task->description = $data->description;
        $task->due_date = $data->due_date;
        $task->save();

        return redirect(url('/admin/personal-coaching/mentee/' . $data->mentee_id));
    }

    public function delete_task(Request $data) {
        $task = MentorTask::find($data->task_id);
        $task->status = 0;
        $task->save();

        return redirect()->back();
    }

    public function new_video($mentee_id) {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $page_title = "Create New Video";
        $page_header = $page_title;

        return view('admin.personal-coaching.videos.new')->with('page_title', $page_title)->with('page_header', $page_header)->with('mentee_id', $mentee_id);
    }

    public function create_video(Request $data) {
        $mentee = MentorEnrollment::find($data->mentee_id);

        $video = new MentorVideo;
        $video->user_id = $mentee->user_id;
        $video->title = $data->title;
        $video->description = $data->description;
        $video->video_id = $data->video_id;
        $video->save();

        return redirect(url('/admin/personal-coaching/mentee/' . $data->mentee_id));
    }

    public function edit_video($mentee_id, $video_id) {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $video = MentorVideo::find($video_id);

        $page_title = "Edit " . $video->title;
        $page_header = $page_title;

        return view('admin.personal-coaching.videos.edit')->with('video', $video)->with('mentee_id', $mentee_id)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update_video(Request $data) {
        $video = MentorVideo::find($data->vid_id);
        $video->title = $data->title;
        $video->description = $data->description;
        $video->video_id = $data->video_id;
        $video->save();

        return redirect(url('/admin/personal-coaching/mentee/' . $data->mentee_id));
    }

    public function delete_video(Request $data) {
        $video = MentorVideo::find($data->video_id);
        $video->status = 0;
        $video->save();

        return redirect()->back();
    }

}
