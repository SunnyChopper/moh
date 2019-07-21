<?php

namespace App\Http\Controllers;

use App\BookDownload;

use Illuminate\Http\Request;

class BookDownloadsController extends Controller
{
    
    public function create(Request $data) {
    	$download = new BookDownload;
    	$download->book_id = $data->book_id;
    	$download->url = $data->url;
    	$download->category = $data->category;
    	$download->save();

    	return response()->json(['success' => 'Successfully created download.'], 200);
    }

    public function read(Request $data) {
    	return response()->json(BookDownload::find($data->download_id)->toArray(), 200);
    }

    public function update(Request $data) {
    	$download = BookDownload::find($data->download_id);

    	if (isset($data->url)) {
    		$download->url = $data->url;
    	}

    	if (isset($data->category)) {
    		$download->category = $data->category;
    	}

    	$download->save();

    	return response()->json(['success' => 'Successfully updated download.'], 200);
    }

    public function delete(Request $data) {
    	$download = BookDownload::find($data->download_id);
    	$download->is_active = 0;
    	$download->save();

    	return response()->json(['success' => 'Successfully deleted download.'], 200);
    }

}
