<?php

namespace App\Http\Controllers;

use App\BookPoll;

use Illuminate\Http\Request;

class BookPollsController extends Controller
{
    
    public function create(Request $data) {
    	$poll = new BookPoll;
    	$poll->book_1 = $data->book_1;
    	$poll->book_2 = $data->book_2;
    	$poll->book_3 = $data->book_3;
    	$poll->book_4 = $data->book_4;
    	$poll->start_date = $data->start_date;
    	$poll->end_date = $data->end_date;
    	$poll->save();

    	return response()->json(['success' => 'Successfully created the poll.'], 200);
    }

    public function read(Request $data) {
    	return response()->json(BookPoll::find($data->poll_id)->toArray(), 200);
    }

    public function update(Request $data) {
    	$poll = BookLink::find($data->poll_id);

    	if (isset($data->book_1)) {
    		$poll->book_1 = $data->book_1;
    	}

    	if (isset($data->book_2)) {
    		$poll->book_2 = $data->book_2;
    	}

    	if (isset($data->book_3)) {
    		$poll->book_3 = $data->book_3;
    	}

    	if (isset($data->book_4)) {
    		$poll->book_4 = $data->book_4;
    	}

    	if (isset($data->start_date)) {
    		$poll->start_date = $data->start_date;
    	}

    	if (isset($data->end_date)) {
    		$poll->end_date = $data->end_date;
    	}

    	$poll->save();

    	return response()->json(['success' => 'Successfully updated the poll.'], 200);
    }

    public function delete(Request $data) {
    	$poll = BookPoll::find($data->link_id);
    	$poll->is_active = 0;
    	$poll->save();

    	return response()->json(['success' => 'Successfully deleted the poll.'], 200);
    }

}
