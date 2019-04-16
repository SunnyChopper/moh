<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseModule;

class CourseModulesController extends Controller
{
    public function create(Request $data) {
    	$module = new CourseModule;
    	$module->course_id = $data->course_id;
    	$module->order = $data->order;
    	$module->title = $data->title;
    	$module->description = $data->description;
    	$module->save();

    	return $module->id;
    }

    public function read($module_id) {
    	$module = CourseModule::find($module_id);
    	$page_title = $module->title;
    	$page_header = $page_title;
    	return view('members.courses.view-module')->with('module', $module)->with('page_header', $page_header)->with('page_title', $page_title);
    }

    public function update(Request $data) {
    	$module = CourseModule::find($data->module_id);
    	$module->order = $data->order;
    	$module->title = $data->title;
    	$module->description = $data->description;
    	$module->save();

    	return true;
    }

    public function delete(Request $data) {
    	$module = CourseModule::find($data->module_id);
    	$module->is_active = 0;
    	$module->save();
    }
}
