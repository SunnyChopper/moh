<?php

namespace App\Http\Controllers;

use Auth;

use App\BookClubBook;
use App\BookVote;
use App\BookNote;
use App\BookLink;

use App\Custom\AdminHelper;
use App\Custom\BookClubHelper;

use Illuminate\Http\Request;

class BookClubController extends Controller
{
    
    /* --------------------- *\
		Admin views
    \* --------------------- */

	public function admin_dashboard_book($book_id) {
		if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $book = BookClubBook::find($book_id);
        $notes = BookNote::where('book_id', $book->id)->first();

        $page_title = $book->title;
        $page_header = $page_title;

        return view('admin.book-club.book-dashboard')->with('page_title', $page_title)->with('page_header', $page_header)->with('book', $book)->with('notes', $notes);
	}

	/* --------------------- *\
		Client views
    \* --------------------- */

    public function book_dashboard($book_id) {
    	if (BookClubHelper::isUserAuthorized(Auth::id()) == false) {
    		return redirect(url('/book-club'));
    	}

    	$book = BookClubBook::find($book_id);
    	$notes = BookNote::where('book_id', $book->id)->first();
        $links = BookLink::where('book_id', $book->id)->get();

    	$page_title = $book->title;
    	$page_header = $page_title;

    	return view('members.book-club.book.dashboard')->with('page_title', $page_title)->with('page_header', $page_header)->with('book', $book)->with('notes', $notes)->with('links', $links);
    }

	/* --------------------- *\
		Get functions
    \* --------------------- */

	public function get_notes() {
		if (BookNote::where('book_id', $_GET['book_id'])->count() > 0) {
			return response()->json(BookNote::where('book_id', $_GET['book_id'])->first()->html, 200);
		} else {
			$note = new BookNote;
			$note->book_id = $_GET['book_id'];
			$note->html = '';
			$note->save();

			return response()->json($note->html, 200);
		}
	}

}
