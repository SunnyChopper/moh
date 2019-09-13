<?php

namespace App\Http\Controllers;

use App\BookClubBook;

use Illuminate\Http\Request;

class BookClubBooksController extends Controller
{

	/* --------------------- *\
        CRUD Functions
    \* --------------------- */
    
	public function create(Request $data) {
		$book = new BookClubBook;
		$book->title = $data->title;
		$book->description = $data->description;
		$book->category = $data->category;
		$book->cover_url = $data->cover_url;
		$book->amazon_url = $data->amazon_url;
		$book->start_date = $data->start_date;
		$book->end_date = $data->end_date;
		$book->save();

		return response()->json(['success' => 'Successfully created book.'], 200);
	}

	public function read(Request $data) {
		return response()->json(BookClubBook::find($data->book_id)->toArray(), 200);
	}

	public function update(Request $data) {
		$book = BookClubBook::find($data->book_id);

		if (isset($data->title)) {
			$book->title = $data->title;
		}

		if (isset($data->description)) {
			$book->description = $data->description;
		}
		
		if (isset($data->category)) {
			$book->category = $data->category;
		}

		if (isset($data->cover_url)) {
			$book->cover_url = $data->cover_url;
		}

		if (isset($data->amazon_url)) {
			$book->amazon_url = $data->amazon_url;
		}

		$book->save();

		return response()->json(['success' => 'Successfully updated book.'], 200);
	}

	public function delete(Request $data) {
		$book = BookClubBook::find($data->book_id);
		$book->is_active = 0;
		$book->save();

		return response()->json(['success' => 'Successfully deleted book.'], 200);
	}

}
