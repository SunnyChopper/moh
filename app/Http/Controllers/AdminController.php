<?php

namespace App\Http\Controllers;

use App\Custom\UserHelper;
use App\Custom\AdminHelper;
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
}
