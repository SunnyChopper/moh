<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\BookBoxBook;
use App\BookBoxProfile;
use App\BookBoxCategory;
use App\BookBoxRecommendation;

use Illuminate\Http\Request;

class BookBoxController extends Controller
{
    public function create_bb_profile(Request $data) {
    	$bb_profile = new BookBoxProfile;
    	$bb_profile->user_id = Auth::id();
    	// TODO: Algorithm to create scores
    	// TODO: Make Stripe work
    	$bb_profile->next_payment_date = Carbon::now()->addMonth();
    	$bb_profile->save();

    	return redirect(url('/members/book-box'));
    }

    public function read_bb_profile($profile_id) {
    	$enrollment = BookBoxProfile::find($profile_id);
    	$page_title = "Your Boox Box Profile";
    	$page_header = $page_title;

    	return view('members.enrollments.view')->with('enrollment', $enrollment)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update_bb_profile(Request $data) {
    	$bb_profile = BookBoxProfile::find($data->profile_id);

    	if (isset($data->scores)) {
    		$bb_profile->scores = $data->scores;
    	} else {
    		$bb_profile->next_payment_date = $data->next_payment_date;
    		$bb_profile->status = $data->status;
    	}

    	return redierct(url('/members/enrollments'));
    }

    public function delete_bb_profile(Request $data) {
    	$bb_profile = BookBoxProfile::find($data->profile_id);
    	$bb_profile->status = 0;
    	$bb_profile->save();

    	return redierct(url('/members/enrollments'));
    }

    public function create_bb_book(Request $data) {
    	$book = new BookBoxBook;
    	$book->category_id = $data->category_id;
    	$book->title = $data->title;
    	$book->description = $data->description;
    	// TODO: Breakup uploaded URLs by line break
    	$book->upload_urls = $data->upload_urls;
    	$book->save();

    	return redirect(url('/admin/book-box/books'));
    }

    public function read_bb_book($book_id) {
    	$book = BookBoxBook::find($book_id);
    	$page_title = $book->title;
    	$page_header = $page_title;
    	return view('members.book-box.view-book')->with('book', $book)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update_bb_book(Request $data) {
    	$book = BookBoxBook::find($data->book_id);
    	$book->category_id = $data->category_id;
    	$book->title = $data->title;
    	$book->description = $data->description;
    	// TODO: Breakup uploaded URLs by line break
    	$book->upload_urls = $data->upload_urls;
    	$book->save();

    	return redirect(url('/admin/book-box/books'));
    }

    public function delete_bb_book(Request $data) {
    	$book = BookBoxBook::find($data->book_id);
    	$book->status = 0;
    	$book->save();
    }

    public function create_bb_category(Request $data) {
    	$cat = new BookBoxCategory;
    	$cat->title = $data->title;
    	$cat->description = $data->description;
    	$cat->save();

    	return redirect(url('/admin/book-box/categories'));
    }

    public function update_bb_category(Request $data) {
    	$cat = BookBoxCategory::find($data->cat_id);
    	$cat->title = $data->title;
    	$cat->description = $data->description;
    	$cat->save();

    	return redirect(url('/admin/book-box/categories'));
    }

    public function delete_bb_category(Request $data) {
    	$cat = BookBoxCategory::find($data->cat_id);
    	$cat->status = 0;
    	$cat->save();

    	return redirect(url('/admin/book-box/categories'));
    }

    public function create_bb_recommendation(Request $data) {
    	$r = new BookBoxRecommendation;
    	$r->user_id = $data->user_id;
    	// TODO: Algorithm to pick book
    	$r->recommended_date = Carbon::now();
    	$r->save();
    }

    public function read_bb_recommendation($r_id) {
    	$r = BookBoxRecommendation::find($r_id);
    	$page_title = "Recommendation for the Month of " . $r->recommended_date->format('M');
    	$page_header = $page_title;
    	return view('members.book-box.view-recommendation')->with('recommendation', $r)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update_bb_recommendation(Request $data) {
    	$r = BookBoxRecommendation::find($data->r_id);
    	$r->tracking_number = $data->tracking_number;
    	$r->shipping_status = $data->shipping_status;
    	$r->save();

    	return redirect(url('/admin/book-box/orders'));
    }
}
