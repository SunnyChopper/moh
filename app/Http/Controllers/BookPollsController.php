<?php

namespace App\Http\Controllers;

use App\BookPoll;
use App\BookVote;

use App\Custom\AdminHelper;

use Illuminate\Http\Request;

class BookPollsController extends Controller
{

    /* ------------------------ *\
        Admin Views
    \* ------------------------ */

    public function admin_dashboard() {
        if (AdminHelper::isAuthorized() == false) {
            return redirect(url('/admin'));
        }

        $page_title = "Book Club Voting";
        $page_header = $page_title;

        return view('admin.book-club.votes.dashboard')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    /* ------------------------ *\
        Get Functions
    \* ------------------------ */

    public function get_polls() {
        return response()->json(BookPoll::active()->orderBy('start_date', 'DESC')->get()->toArray(), 200);
    }

    public function get_results() {
        // Get the poll
        $poll = BookPoll::find($_GET['poll_id']);

        // Create array to hold number of votes for each option
        $vote_options = array();

        // Get all votes for this poll
        $votes = BookVote::where('poll_id', $poll->id)->get();

        // Count up how many total votes
        $total_votes = count($votes);

        // Check if there are no votes right now
        if ($total_votes == 0) {
            $return_array = array(
                "1" => 0,
                "2" => 0,
                "3" => 0,
                "4" => 0
            );

            return response()->json($return_array, 200);
        } else {
            // Loop through each vote and add up the results
            foreach($votes as $vote) {
                $option = $vote->vote;
                if (array_key_exists($option, $vote_options)) {
                    $vote_options[$option] = $vote_options[$option] + 1;
                } else {
                    $vote_options[$option] = 1;
                }
            }

            // Calculate percentages
            if (array_key_exists("1", $vote_options)) {
                $vote_1_percentage = (float) $vote_options["1"] / (float) $total_votes;
            } else {
                $vote_1_percentage = 0.00;
            }

            if (array_key_exists("2", $vote_options)) {
                $vote_2_percentage = (float) $vote_options["2"] / (float) $total_votes;
            } else {
                $vote_2_percentage = 0.00;
            }

            if (array_key_exists("3", $vote_options)) {
                $vote_3_percentage = (float) $vote_options["3"] / (float) $total_votes;
            } else {
                $vote_3_percentage = 0.00;
            }

            if (array_key_exists("4", $vote_options)) {
                $vote_4_percentage = (float) $vote_options["4"] / (float) $total_votes;
            } else {
                $vote_4_percentage = 0.00;
            }

            // Return results
            $return_array = array(
                "1" => $vote_1_percentage,
                "2" => $vote_2_percentage,
                "3" => $vote_3_percentage,
                "4" => $vote_4_percentage
            );

            return response()->json($return_array, 200);
        }
    }

    /* ------------------------ *\
        CRUD Functions
    \* ------------------------ */
    
    public function create(Request $data) {
    	$poll = new BookPoll;
        $poll->start_date = $data->start_date;
        $poll->end_date = $data->end_date;
    	$poll->book_1_title = $data->book_1_title;
        $poll->book_1_image_url = $data->book_1_image_url;
        $poll->book_1_description = $data->book_1_description;
        $poll->book_1_amazon_url = $data->book_1_amazon_url;
        $poll->book_2_title = $data->book_2_title;
        $poll->book_2_image_url = $data->book_2_image_url;
        $poll->book_2_description = $data->book_2_description;
        $poll->book_2_amazon_url = $data->book_2_amazon_url;
        $poll->book_3_title = $data->book_3_title;
        $poll->book_3_image_url = $data->book_3_image_url;
        $poll->book_3_description = $data->book_3_description;
        $poll->book_3_amazon_url = $data->book_3_amazon_url;
        $poll->book_4_title = $data->book_4_title;
        $poll->book_4_image_url = $data->book_4_image_url;
        $poll->book_4_description = $data->book_4_description;
        $poll->book_4_amazon_url = $data->book_4_amazon_url;
        $poll->save();

    	return response()->json(true, 200);
    }

    public function read(Request $data) {
    	return response()->json(BookPoll::find($data->poll_id)->toArray(), 200);
    }

    public function update(Request $data) {
    	$poll = BookPoll::find($data->poll_id);
        $poll->start_date = $data->start_date;
        $poll->end_date = $data->end_date;
        $poll->book_1_title = $data->book_1_title;
        $poll->book_1_image_url = $data->book_1_image_url;
        $poll->book_1_description = $data->book_1_description;
        $poll->book_1_amazon_url = $data->book_1_amazon_url;
        $poll->book_2_title = $data->book_2_title;
        $poll->book_2_image_url = $data->book_2_image_url;
        $poll->book_2_description = $data->book_2_description;
        $poll->book_2_amazon_url = $data->book_2_amazon_url;
        $poll->book_3_title = $data->book_3_title;
        $poll->book_3_image_url = $data->book_3_image_url;
        $poll->book_3_description = $data->book_3_description;
        $poll->book_3_amazon_url = $data->book_3_amazon_url;
        $poll->book_4_title = $data->book_4_title;
        $poll->book_4_image_url = $data->book_4_image_url;
        $poll->book_4_description = $data->book_4_description;
        $poll->book_4_amazon_url = $data->book_4_amazon_url;
        $poll->save();

    	return response()->json(true, 200);
    }

    public function delete(Request $data) {
    	$poll = BookPoll::find($data->poll_id);
    	$poll->is_active = 0;
    	$poll->save();

    	return response()->json(true, 200);
    }

}
