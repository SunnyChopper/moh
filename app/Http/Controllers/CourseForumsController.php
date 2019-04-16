<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseForum;

class CourseForumsController extends Controller
{
    public function create(Request $data) {
    	$forum = new CourseForum;
    	$forum->user_id = $data->user_id;
    	$forum->course_id = $data->course_id;
    	$forum->title = $data->title;
    	$forum->description = $data->description;
    	$forum->save();

    	return $forum->id;
    }

    public function read($forum_id) {
    	$forum = CourseForum::find($forum_id);
    	$page_title = $forum->title;
    	$page_header = $page_title;
    	return view('members.courses.view-forum')->with('forum', $forum)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update(Request $data) {
    	$forum = CourseForum::find($data->forum_id);
    	$forum->description = $data->description;
    	$forum->save();

    	return true;
    }

    public function delete(Request $data) {
    	$forum = CourseForum::find($data->forum_id);
    	$forum->is_active = 0;
    	$forum->save();

    	return true;
    }
}
