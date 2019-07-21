<?php

namespace App\Http\Controllers;

use App\BookVote;

use Illuminate\Http\Request;

class BookVotesController extends Controller
{
    
    public function create(Request $data) {
    	$vote = new BookVote;
    	$vote->poll_id = $data->poll_id;
    	$vote->user_id = $data->user_id;
    	$vote->vote = $data->vote;
    	$vote->save();

    	return response()->json(['success' => 'Successfully created your vote.'], 200);
    }

    public function read(Request $data) {
    	return response()->json(BookVote::find($data->vote_id)->toArray(), 200);
    }

    public function delete(Request $data) {
    	$vote = BookVote::find($data->vote_id);
    	$vote->is_active = 0;
    	$vote->save();

    	return response()->json(['success' => 'Successfully deleted your vote.'], 200);
    }

}
