<?php

namespace App\Custom;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;

class UploadHelper {

	/* Public functions */
	public function upload_to_s3($file, $file_path) {
		$s3 = \Storage::disk('s3');
		$s3->put($file_path, file_get_contents($file), 'public');
		return \Storage::disk('s3')->url($file_path);
	}

	public function get_url_from_s3($file_path) {
		return \Storage::disk('s3')->url($file_path);
	}

}

?>