<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseVideo;

class CourseVideosController extends Controller
{
    public function create(Request $data) {
    	$video = new CourseVideo;
    	$video->module_id = $data->module_id;
    	$video->order = $data->order;
    	$video->title = $data->title;
    	$video->description = $data->description;
    	$video->video_url = $data->video_url;
    	$video->save();

    	return $video->id;
    }

    public function read($video_id) {
    	$video = CourseVideo::find($video_id);
    	$page_title = $video->title;
    	$page_header = $page_title;
    	return view('members.courses.view-video')->with('video', $video)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update(Request $data) {
    	$video = CourseVideo::find($data->video_id);
    	$video->module_id = $data->module_id;
    	$video->order = $data->order;
    	$video->title = $data->title;
    	$video->description = $data->description;
    	$video->video_url = $data->video_url;
    	$video->save();

    	return true;
    }

    public function delete(Request $data) {
    	$video = CourseVideo::find($data->video_id);
    	$video->is_active = 0;
    	$video->save();

    	return true;
    }
}
