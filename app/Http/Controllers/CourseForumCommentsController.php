<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseForumComment;

class CourseForumCommentsController extends Controller
{
    public function create(Request $data) {
    	$comment = new CourseForumComment;
    	$comment->user_id = $data->user_id;
    	$comment->forum_id = $data->forum_id;
    	$comment->comment = $data->comment;
    	$comment->save();

    	return $comment->id;
    }

    public function read($comment_id) {
    	$comment = CourseForumComment::find($comment_id);
    	$page_title = "View Comment";
    	return view('members.courses.view-comment')->with('page_title', $page_title)->with('comment', $comment);
    }

    public function update(Request $data) {
    	$comment = CourseForumComment::find($data->comment_id);
    	$comment->comment = $data->comment;
    	$comment->save();

    	return true;
    }

    public function delete(Request $data) {
    	$comment = CourseForumComment::find($data->comment_id);
    	$comment->is_active = 0;
    	$comment->save();

    	return true;
    }
}
