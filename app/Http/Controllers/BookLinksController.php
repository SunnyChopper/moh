<?php

namespace App\Http\Controllers;

use App\BookLink;

use Illuminate\Http\Request;

class BookLinksController extends Controller
{
    
	public function create(Request $data) {
    	$link = new BookLink;
    	$link->book_id = $data->book_id;
    	$link->title = $data->title;
    	$link->url = $data->url;
    	$link->save();

    	return response()->json(['success' => 'Successfully created link.'], 200);
    }

    public function read(Request $data) {
    	return response()->json(BookLink::find($data->link_id)->toArray(), 200);
    }

    public function update(Request $data) {
    	$link = BookLink::find($data->link_id);

    	if (isset($data->title)) {
    		$link->title = $data->title;
    	}

    	if (isset($data->url)) {
    		$link->url = $data->url;
    	}

    	$link->save();

    	return response()->json(['success' => 'Successfully updated link.'], 200);
    }

    public function delete(Request $data) {
    	$link = BookLink::find($data->link_id);
    	$link->is_active = 0;
    	$link->save();

    	return response()->json(['success' => 'Successfully deleted link.'], 200);
    }

}
