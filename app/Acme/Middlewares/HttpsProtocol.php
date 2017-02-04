<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
            if (!$request->secure() && env('APP_ENV') === 'prod') {
                return redirect()->secure($request->getRequestUri());
            }

            return $next($request); 
    }
}
