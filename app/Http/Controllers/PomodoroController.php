<?php

namespace App\Http\Controllers;

use Auth;

use App\Custom\PomodoroHelper;

use Illuminate\Http\Request;

class PomodoroController extends Controller
{
    public function view_sessions() {
    	if (Auth::guest()) {
    		return redirect(url('/login?redirect_action=/members/pomodoro'));
    	}

    	$sessions = PomodoroHelper::getSessionsForUser(Auth::id());

    	$page_title = "Pomodoro Tool";
    	$page_header = $page_title;

    	return view('members.pomodoro.view')->with('page_header', $page_header)->with('page_title', $page_title)->with('sessions', $sessions);
    }

    public function new_session() {
    	if (Auth::guest()) {
    		return redirect(url('/login?redirect_action=/members/pomodoro/session'));
    	}

    	$page_title = "New Pomodoro Session";
    	$page_header = $page_title;

    	return view('members.pomodoro.new')->with('page_title', $page_title)->with('page_header', $page_header);
    }
}
