<?php

namespace App\Custom;

use Auth;
use App\BookBoxBook;
use App\BookBoxCategory;
use App\BookBoxProfile;
use App\BookBoxRecommendation;

class BookBoxHelper {

	public static function generateScores($data) {
		// TODO
	}

	public static function getAllCategories() {
		return BookBoxCategory::where('status', 1)->get();
	}

	public static function getAllBooks() {
		return BookBoxBook::where('status', 1)->get();
	}

	public static function getRecommendations($user_id) {
		return BookBoxRecommendation::where('user_id', $user_id)->get();
	}

	public static function uploadDocument($data) {
		// TODO
	}

	public static function getOpenOrders($user_id) {
		return BookBoxRecommendation::where('user_id', $user_id)->where('shipping_status', 1)->get();
	}

	public static function getPastOrders($user_id) {
		return BookBoxRecommendation::where('user_id', $user_id)->where('shipping_status', 3)->get();
	}

	public static function isUserAuthorized($user_id) {
		if (BookBoxProfile::where('user_id', $user_id)->where('status', 1)->count() > 0) {
			return true;
		} else {
			return false;
		}
	}

}

?>