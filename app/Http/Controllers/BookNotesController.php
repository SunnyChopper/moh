<?php

namespace App\Http\Controllers;

use App\BookNote;

use Illuminate\Http\Request;

class BookNotesController extends Controller
{
    
    /* --------------------- *\
        CRUD Functions
    \* --------------------- */
    
	public function create(Request $data) {
    	$note = new BookNote;
    	$note->book_id = $data->book_id;
    	$note->html = $data->html;
    	$note->save();

    	return response()->json(['success' => 'Successfully created the notes.'], 200);
    }

    public function read(Request $data) {
    	return response()->json(BookNote::find($data->note_id)->toArray(), 200);
    }

    public function update(Request $data) {
    	$note = BookNote::where('book_id', $data->book_id)->first();

    	if (isset($data->html)) {
    		$note->html = $data->html;
    	}

    	$note->save();

    	return response()->json(['success' => 'Successfully updated the notes.'], 200);
    }

    public function delete(Request $data) {
    	$note = BookNote::find($data->note_id);
    	$note->is_active = 0;
    	$note->save();

    	return response()->json(['success' => 'Successfully deleted the notes.'], 200);
    }

}
