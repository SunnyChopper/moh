<?php

namespace App\Custom;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Mail\NewUserWelcome;
use App\User;

use Mail;

class MailHelper {

	public function sendWelcomeEmail($to, User $user) {
		Mail::to($to)->send(new NewUserWelcome($user));
	}

}

?>