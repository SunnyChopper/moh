<?php

namespace App\Http\Middleware;

use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Session;

use Closure;

class AffiliateLink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return app(StartSession::class)->handle($request, function ($request) use ($next) {
            $response = $next($request);

            // Check to see if session variable needs to be set
            if(isset($_GET['r'])) {
                Session::put('source', $_GET['r']);
                Session::save();
            }

            return $response;
        });
    }
}
