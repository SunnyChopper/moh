<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
    	$page_title = "Welcome";

    	return view('pages.index')->with('page_title', $page_title);
    }
}
