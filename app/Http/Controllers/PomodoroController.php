<?php

namespace App\Http\Controllers;

use Auth;

use App\Pomodoro;
use App\Custom\PomodoroHelper;

use Illuminate\Http\Request;

class PomodoroController extends Controller
{
    public function view_sessions() {
    	if (Auth::guest()) {
    		return redirect(url('/login?redirect_action=/members/pomodoro'));
    	}

    	$sessions = PomodoroHelper::getSessionsForUser(Auth::id());
    	$stats = PomodoroHelper::getStatsForUser(Auth::id());

    	$page_title = "Pomodoro Tool";
    	$page_header = $page_title;

    	return view('members.pomodoro.view')->with('page_header', $page_header)->with('page_title', $page_title)->with('sessions', $sessions)->with('stats', $stats);
    }

    public function new_session() {
    	if (Auth::guest()) {
    		return redirect(url('/login?redirect_action=/members/pomodoro/session'));
    	}

    	$page_title = "New Pomodoro Session";
    	$page_header = $page_title;

    	return view('members.pomodoro.new')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function create_session(Request $data) {
    	$pomodoro = new Pomodoro;
    	$pomodoro->user_id = Auth::id();
    	$pomodoro->session_date = $data->session_date;
    	$pomodoro->session_seconds = $data->session_seconds;
    	$pomodoro->cycles = $data->cycles;
    	$pomodoro->save();

 		return response()->json(['success' => 'Successfully created session.'], 200);
    }
}
